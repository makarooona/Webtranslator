<?php
require_once dirname(__FILE__) . "/BaseDao.class.php";

class ReviewDao extends BaseDao
{

    public function __construct()
    {
        parent::__construct("reviews");
    }

    public function get_reviews($search, $offset, $limit, $order)
    {
        list($order_column, $order_direction) = self::parse_order($order);

        return $this->query("SELECT *
                             FROM reviews
                             WHERE LOWER(name) LIKE CONCAT('%', :name, '%')
                             ORDER BY ${order_column} ${order_direction}
                             LIMIT ${limit} OFFSET ${offset}",
            ["name" => strtolower($search)]);
    }


    public function get_all_reviews(){
      $query = "SELECT * FROM reviews";
      return $this->query($query,[]);
    }
}
