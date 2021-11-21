<?php 

function get_all_products(WP_REST_Request $request){
  $secret_key = get_site_option('_igv_site_options')['shop_stripe_key'];
  $stripe = new \Stripe\StripeClient($secret_key);
  try {
    $products = $stripe->products->all([
      'ids' => $request['ids']
    ]);
    return json_encode([
      'success' => 'true',
      'data' => $products
    ]);
  } catch (\Stripe\Exception\InvalidRequestException $e) {
    return json_encode([
      'success' => 'false', 
      'error' => $e->getError()->message
    ]);
  } catch (Exception $e) {
    return json_encode([
      'success' => 'false', 
      'error' => $e->getError()->message
    ]);
  } 
}

function get_product(WP_REST_Request $request){
  $secret_key = get_site_option('_igv_site_options')['shop_stripe_key'];
  $stripe = new \Stripe\StripeClient($secret_key);
  try {
    $product = $stripe->products->retrieve(
      $request['id'],
      []
    );
    return json_encode([
      'success' => 'true',
      'data' => $product
    ]);
  } catch (\Stripe\Exception\InvalidRequestException $e) {
    return json_encode([
      'success' => 'false', 
      'error' => $e->getError()->message
    ]);
  } catch (Exception $e) {
    return json_encode([
      'success' => 'false', 
      'error' => $e->getError()->message
    ]);
  } 
}

function get_all_prices(WP_REST_Request $request){
  $secret_key = get_site_option('_igv_site_options')['shop_stripe_key'];
  $stripe = new \Stripe\StripeClient($secret_key);
  try {
    $products = $stripe->prices->all([
      'ids' => $request['ids']
    ]);
    return json_encode([
      'success' => 'true',
      'data' => $products
    ]);
  } catch (\Stripe\Exception\InvalidRequestException $e) {
    return json_encode([
      'success' => 'false', 
      'error' => $e->getError()->message
    ]);
  } catch (Exception $e) {
    return json_encode([
      'success' => 'false', 
      'error' => $e->getError()->message
    ]);
  } 
}

function get_price(WP_REST_Request $request){
  $secret_key = get_site_option('_igv_site_options')['shop_stripe_key'];
  $stripe = new \Stripe\StripeClient($secret_key);
  try {
    $price = $stripe->prices->retrieve(
      $request['id'],
      []
    );
    return json_encode([
      'success' => 'true',
      'data' => $price
    ]);
  } catch (\Stripe\Exception\InvalidRequestException $e) {
    return json_encode([
      'success' => 'false', 
      'error' => $e->getError()->message
    ]);
  } catch (Exception $e) {
    return json_encode([
      'success' => 'false', 
      'error' => $e->getError()->message
    ]);
  } 
}

function create_checkout(WP_REST_Request $request){
  $secret_key = get_site_option('_igv_site_options')['shop_stripe_key'];
  $stripe = new \Stripe\StripeClient($secret_key);
  $line_items = json_decode($request['line_items'], true);
  $metadata = json_decode($request['metadata'], true);
  $shipping_address_collection = json_decode($request['shipping_address_collection'], true);
  $shipping_options = json_decode($request['shipping_options'], true);

  try {
    $checkout = $stripe->checkout->sessions->create([
      'mode' => 'payment',
      'success_url' => $request['success_url'],
      'cancel_url' => $request['cancel_url'],
      'line_items' => $line_items,
      'metadata' => $metadata,
      'shipping_address_collection' => $shipping_address_collection,
      'shipping_options' => $shipping_options
    ]);
    return json_encode([
      'success' => 'true',
      'data' => $checkout
    ]);
  } catch (\Stripe\Exception\InvalidRequestException $e) {
    return json_encode([
      'success' => 'false', 
      'data' => [
        $line_items,
        $metadata,
        $shipping_address_collection,
        $shipping_options
      ],
      'error' => $e->getError()->message
    ]);
  } catch (Exception $e) {
    return json_encode([
      'success' => 'false', 
      'error' => $e->getError()->message
    ]);
  } 
}

/**
 * Checkout success callback
 */
function checkout_success(WP_REST_Request $request){
  $ids = $request->get_param( 'ids' );
  $product_ids = explode(",", $ids);
  $nonce = $request->get_param( 'nonce' );

  if (!$nonce) {
    return json_encode([
      'success' => 'false', 
      'error' => 'no nonce'
    ]);
  }

  $verified = verify_guest_nonce( $nonce, 'checkout_success' );

  if (!$verified) { 
    return json_encode([
      'success' => 'false', 
      'error' => 'bad nonce'
    ]);
  }

  foreach($product_ids as $product_id) {
    $current = get_post_meta($product_id, '_igv_product_inventory', true);
    $int = !empty($current) ? intval($current) : 0;
    $new = $int > 0 ? $int - 1 : 0;
    update_post_meta($product_id, '_igv_product_inventory', $new );
  }

  return json_encode([
    'success' => 'true', 
    'data' => $ids
  ]);
}

add_action('rest_api_init', function(){
  register_rest_route( 'endpoint/v1', '/getAllProducts', array(
    'methods' => 'POST, GET',
    'callback' => 'get_all_products',
  ));
  register_rest_route( 'endpoint/v1', '/getProduct', array(
    'methods' => 'POST, GET',
    'callback' => 'get_product',
  ));
  register_rest_route( 'endpoint/v1', '/getPrice', array(
    'methods' => 'POST, GET',
    'callback' => 'get_price',
  ));
  register_rest_route( 'endpoint/v1', '/createCheckout', array(
    'methods' => 'POST, GET',
    'callback' => 'create_checkout',
  ));
  register_rest_route( 'endpoint/v1', '/checkoutSuccess', array(
    'methods' => 'POST, GET',
    'callback' => 'checkout_success',
  ));
});

?>