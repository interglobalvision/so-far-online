<?php

// Enqueue

function scripts_and_styles_method() {
  $templateuri = get_template_directory_uri();

  $javascriptMain = $templateuri . '/dist/js/main.js';

  $is_admin = current_user_can('administrator') ? 1 : 0;

  $site_options = get_site_option('_igv_site_options');

  $javascriptVars = array(
    'siteUrl' => home_url(),
    'themeUrl' => get_template_directory_uri(),
    'isAdmin' => $is_admin,
    'mailchimp' => !empty($site_options['mailchimp_action']) ? $site_options['mailchimp_action'] : null,
    'shopItemSlug' => !empty($site_options['shop_item_slug']) ? $site_options['shop_item_slug'] : 'product',
    'shippingDomesticLabel' => !empty($site_options['shop_shipping_domestic_label']) ? $site_options['shop_shipping_domestic_label'] : 'Domestic',
    'shippingInternationalLabel' => !empty($site_options['shop_shipping_international_label']) ? $site_options['shop_shipping_international_label'] : 'International',
    'shippingOptions' => [
      'domestic' => !empty($site_options['shop_shipping_domestic']) ? $site_options['shop_shipping_domestic'] : false,
      'international' => !empty($site_options['shop_shipping_international']) ? $site_options['shop_shipping_international'] : false,
    ]
  );

  wp_register_script('javascript-main', $javascriptMain, array(), '3.0.2', true);
  wp_localize_script('javascript-main', 'WP', $javascriptVars);
  wp_enqueue_script('javascript-main', $javascriptMain, '', '', true);

  // Enqueue style
  wp_enqueue_style( 'style-site', get_stylesheet_directory_uri() . '/dist/css/site.css', [], '3.0.1' );

  // dashicons for admin
  if (is_admin()) {
    wp_enqueue_style( 'dashicons' );
  }
}
add_action('wp_enqueue_scripts', 'scripts_and_styles_method');

// Declare thumbnail sizes

get_template_part( 'lib/thumbnail-sizes' );

// Register Nav Menus
/*
register_nav_menus( array(
  'menu_location' => 'Location Name',
) );
 */

// Add third party PHP libs

function cmb_initialize_cmb_meta_boxes() {
  if (!class_exists( 'cmb2_bootstrap_202' ) ) {
    require_once 'vendor/cmb2/cmb2/init.php';
    require_once 'vendor/alexis-magina/cmb2-field-post-search-ajax/cmb-field-post-search-ajax.php';
  }
}
add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 11 );

function composer_autoload() {
  require_once( 'vendor/autoload.php' );
}
add_action( 'init', 'composer_autoload', 10 );

// Setup stripe api endpoint

function load_stripe_client() {
  require_once( 'vendor/stripe/stripe-php/init.php' );
}
add_action( 'init', 'load_stripe_client', 11 );

get_template_part('lib/endpoint');

// Add libs

get_template_part( 'lib/custom-gallery' );
get_template_part( 'lib/post-types' );
get_template_part( 'lib/taxonomies' );
get_template_part( 'lib/meta-boxes' );
get_template_part( 'lib/site-options' );

// Add custom functions

get_template_part( 'lib/functions-misc' );
get_template_part( 'lib/functions-custom' );
get_template_part( 'lib/functions-filters' );
get_template_part( 'lib/functions-hooks' );
get_template_part( 'lib/functions-utility' );
get_template_part( 'lib/functions-product' );

add_action('admin_head', 'igv_admin_css');

function igv_admin_css() {
?>
<style>
  #wp-_igv_featured_caption-wrap .mce-btn {
    display: none;
  }
  #wp-_igv_featured_caption-wrap #mceu_2,
  #wp-_igv_featured_caption-wrap #mceu_1,
  #wp-_igv_featured_caption-wrap #mceu_9 {
    display: inline-block;
  }
</style>
<?php
}

?>
