<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once dirname(__FILE__).'/dao/ReviewDao.class.php';
require_once dirname(__FILE__).'/dao/BaseDao.class.php';

$dao = new ReviewDao();



$reviews = $dao->get_reviews();


print_r($reviews);








?>