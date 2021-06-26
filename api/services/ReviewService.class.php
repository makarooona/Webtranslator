<?php
require_once dirname(__FILE__)."/BaseService.class.php";
require_once dirname(__FILE__)."/../dao/ReviewDao.class.php";   
   
class ReviewService extends BaseService{
    public function __construct(){
    $this->dao = new ReviewDao();
    }

    public function get_reviews($search, $offset, $limit, $order){
        if ($search){
          return $this->dao->get_reviews($search, $offset, $limit, $order);
        }else{
          return $this->dao->get_all($offset, $limit, $order);
        }
      }
    
    public function get_all_reviews(){
        return $this->dao->get_all_reviews();
    } 


    public function add($review){
        // validation of review data
        if (!isset($review['name'])) throw new Exception("Name is missing");
        $review['created_at'] = date(Config::DATE_FORMAT);
        return parent::add($review);
      }

    }


?>
