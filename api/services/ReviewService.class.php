<?php
require_once dirname(__FILE__)."/BaseService.class.php";
require_once dirname(__FILE__)."/../dao/ReviewDao.class.php";   
   
class ReviewService extends BaseService{
    public function __construct(){
    $this->dao = new ReviewDao();
    }

    public function get_reviews( $status, $offset, $limit, $search, $order){
      return $this->dao->get_reviews($status, $offset, $limit, $search, $order);
    }
  
 
  public function add_reviews($user, $review){
 
    try {
      $review['account_id'] = $user['aid'];
      $review['user_id'] = $user['id'];
      $review['created_at'] = date(Config::DATE_FORMAT);
      return parent::add($review);
    } catch (\Exception $e) {
      if (str_contains($e->getMessage(), 'campaigns.uq_campaign_name')) {
        throw new Exception("Campaign with same name already exists", 400, $e);
      }else{
        throw new Exception($e->getMessage(), 400, $e);
      }
    }
  }
}

?>
