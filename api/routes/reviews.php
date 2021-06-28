<?php
/**
 * @OA\Get(path="/user/reviews", tags={"x-user", "reviews"}, security={{"ApiKeyAuth": {}}},
 *     @OA\Parameter(type="string", in="query", name="status", default="ACTIVE", description="showing all reviews"),
 *     @OA\Parameter(type="integer", in="query", name="offset", default=0, description="Offset for pagination"),
 *     @OA\Parameter(type="integer", in="query", name="limit", default=25, description="Limit for pagination"),
 *     @OA\Parameter(type="string", in="query", name="search", description="Search string for accounts. Case insensitive search."),
 *     @OA\Parameter(type="string", in="query", name="order", default="-id", description="Sorting for return elements. -column_name ascending order by column_name or +column_name descending order by column_name"),
 *     @OA\Response(response="200", description="List campaigns for user")
 * )
 */

Flight::route('GET /reviews', function(){
  print_r(Flight::get('user'));
  $account_id = Flight::get('user')['aid'];
  $status = Flight::query('status', 'ACTIVE');
  $offset = Flight::query('offset', 0);
  $limit = Flight::query('limit', 25);
  $search = Flight::query('search');
  $order = Flight::query('order', '-id');
  Flight::json(Flight::reviewService()->get_reviews($account_id, $status, $offset, $limit, $search, $order));
});

/**
 * @OA\Post(path="/user/reviews", tags={"x-user", "reviews"}, security={{"ApiKeyAuth": {}}},
 *   @OA\RequestBody(description="Basic review info", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *    				 @OA\Property(property="name", required="true", type="string", example="name",	description="Name of the r" ),
 *    				 @OA\Property(property="comment", required="true", type="string", example="this is my comment",	description="your review" ),
 *    				 
 *          )
 *       )
 *     ),
 *  @OA\Response(response="200", description="Saved campaign")
 * )
 */

Flight::route('POST /reviews', function(){
  Flight::json(Flight::reviewService()->add_reviews(Flight::get('user'), Flight::request()->data->getData()));
});



  ?>

