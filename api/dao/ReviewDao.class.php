<?php
require_once dirname(__FILE__) . "/BaseDao.class.php";

class ReviewDao extends BaseDao
{

    public function __construct(){
        parent::__construct("reviews");
      }
    
      public function get_reviews($status, $offset, $limit, $search, $order){
        list($order_column, $order_direction) = self::parse_order($order);
        $params = [];
        $query = "SELECT r.*, a.name AS account_name, u.name AS user_name, u.email
                  FROM reviews r JOIN
                       accounts a ON a.id = r.account_id JOIN
                       users u ON u.account_id = r.id
                  WHERE 1 = 1 ";
    
        if (isset($search)){
          $query .= "AND ( LOWER(r.name) LIKE CONCAT('%', :search, '%') OR
                           LOWER(a.name) LIKE CONCAT('%', :search, '%') OR
                           LOWER(u.name) LIKE CONCAT('%', :search, '%') OR
                           LOWER(u.email) LIKE CONCAT('%', :search, '%'))";
          $params['search'] = strtolower($search);
        }
    
        $query .="ORDER BY ${order_column} ${order_direction} ";
        $query .="LIMIT ${limit} OFFSET ${offset}";
    
        return $this->query($query, $params);
      }
    

}
