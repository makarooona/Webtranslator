<?php

Flight::route('GET /reviews', function(){
  $offset = Flight::query('offset', 0);
  $limit = Flight::query('limit', 25);
  $search = Flight::query('search');
  $order = Flight::query('order', "-id");

  Flight::json(Flight::reviewService()->get_all_reviews());
});

  
  ?>

