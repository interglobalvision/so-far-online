<?php
// Menu icons for Custom Post Types
// https://developer.wordpress.org/resource/dashicons/
function add_menu_icons_styles(){
?>

<style>
#menu-posts-weekly .dashicons-admin-post:before {
    content: '\f109';
}
#menu-posts-product .dashicons-admin-post:before {
    content: '\f513';
}
#menu-posts-issue .dashicons-admin-post:before {
    content: '\f309';
}
#menu-posts-contributor .dashicons-admin-post:before {
    content: '\f483';
}
</style>

<?php
}
add_action( 'admin_head', 'add_menu_icons_styles' );

//Register Custom Post Types
add_action( 'init', 'register_cpt_weekly' );

function register_cpt_weekly() {

  $labels = array(
    'name' => _x( 'Weeklies', 'weekly' ),
    'singular_name' => _x( 'Weekly', 'weekly' ),
    'add_new' => _x( 'Add New', 'weekly' ),
    'add_new_item' => _x( 'Add New Weekly', 'weekly' ),
    'edit_item' => _x( 'Edit Weekly', 'weekly' ),
    'new_item' => _x( 'New Weekly', 'weekly' ),
    'view_item' => _x( 'View Weekly', 'weekly' ),
    'search_items' => _x( 'Search Weeklies', 'weekly' ),
    'not_found' => _x( 'No weeklies found', 'weekly' ),
    'not_found_in_trash' => _x( 'No weeklies found in Trash', 'weekly' ),
    'parent_item_colon' => _x( 'Parent Weekly:', 'weekly' ),
    'menu_name' => _x( 'Weeklies', 'weekly' ),
  );

  $args = array(
    'labels' => $labels,
    'hierarchical' => false,

    'supports' => array( 'title', 'editor', 'thumbnail' ),

    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_position' => 5,

    'show_in_nav_menus' => true,
    'publicly_queryable' => true,
    'exclude_from_search' => false,
    'has_archive' => 'weeklies-archive',
    'query_var' => true,
    'can_export' => true,
    'rewrite'     => true,
    'capability_type' => 'post',
    'show_in_rest' => true,
  );

  register_post_type( 'weekly', $args );
}

add_action( 'init', 'register_cpt_diary' );

function register_cpt_diary() {

  $labels = array(
    'name' => _x( 'Diaries', 'diary' ),
    'singular_name' => _x( 'Diary', 'diary' ),
    'add_new' => _x( 'Add New', 'diary' ),
    'add_new_item' => _x( 'Add New Diary', 'diary' ),
    'edit_item' => _x( 'Edit Diary', 'diary' ),
    'new_item' => _x( 'New Diary', 'diary' ),
    'view_item' => _x( 'View Diary', 'diary' ),
    'search_items' => _x( 'Search Diaries', 'diary' ),
    'not_found' => _x( 'No Diaries found', 'diary' ),
    'not_found_in_trash' => _x( 'No Diaries found in Trash', 'diary' ),
    'parent_item_colon' => _x( 'Parent Diary:', 'diary' ),
    'menu_name' => _x( 'Diaries', 'diary' ),
  );

  $args = array(
    'labels' => $labels,
    'hierarchical' => false,

    'supports' => array( 'title', 'editor', 'thumbnail' ),

    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_position' => 5,

    'show_in_nav_menus' => true,
    'publicly_queryable' => true,
    'exclude_from_search' => false,
    'has_archive' => 'incubator-diary',
    'query_var' => true,
    'can_export' => true,
    'rewrite'     => true,
    'capability_type' => 'post',
    'show_in_rest' => true,
  );

  register_post_type( 'diary', $args );
}

add_action( 'init', 'register_cpt_incubator' );

function register_cpt_incubator() {

  $labels = array(
    'name' => _x( 'Incubators', 'incubator' ),
    'singular_name' => _x( 'Incubator', 'incubator' ),
    'add_new' => _x( 'Add New', 'incubator' ),
    'add_new_item' => _x( 'Add New Incubator', 'incubator' ),
    'edit_item' => _x( 'Edit Incubator', 'incubator' ),
    'new_item' => _x( 'New Incubator', 'incubator' ),
    'view_item' => _x( 'View Incubator', 'incubator' ),
    'search_items' => _x( 'Search Incubators', 'incubator' ),
    'not_found' => _x( 'No Incubators found', 'incubator' ),
    'not_found_in_trash' => _x( 'No Incubators found in Trash', 'incubator' ),
    'parent_item_colon' => _x( 'Parent Incubator:', 'incubator' ),
    'menu_name' => _x( 'Incubators', 'incubator' ),
  );

  $args = array(
    'labels' => $labels,
    'hierarchical' => false,

    'supports' => array( 'title', 'editor', 'thumbnail' ),

    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_position' => 5,

    'show_in_nav_menus' => true,
    'publicly_queryable' => true,
    'exclude_from_search' => false,
    'has_archive' => 'all-incubator',
    'query_var' => true,
    'can_export' => true,
    'rewrite'     => true,
    'capability_type' => 'post',
    'show_in_rest' => true,
  );

  register_post_type( 'incubator', $args );
}

add_action( 'init', 'register_cpt_product' );

function register_cpt_product() {
  $site_options = get_site_option('_igv_site_options');
  $archive_slug = !empty($site_options['shop_archive_slug']) ? $site_options['shop_archive_slug'] : 'shop';
  //$archive_slug = gws_get_option('_gws_shopify_archive_slug') === false || empty(gws_get_option('_gws_shopify_archive_slug')) ? 'shop' : gws_get_option('_gws_shopify_archive_slug');
  //$archive_slug = 'shop-all';
  $item_slug = !empty($site_options['shop_item_slug']) ? $site_options['shop_item_slug'] : 'product';
  //$item_slug = gws_get_option('_gws_shopify_item_slug') === false || empty(gws_get_option('_gws_shopify_item_slug')) ? 'product' : gws_get_option('_gws_shopify_item_slug');
  //$item_slug = 'artwork';

  $labels = array(
    'name' => _x( 'Products', 'product' ),
    'singular_name' => _x( 'Product', 'product' ),
    'add_new' => _x( 'Add New', 'product' ),
    'add_new_item' => _x( 'Add New Product', 'product' ),
    'edit_item' => _x( 'Edit Product', 'product' ),
    'new_item' => _x( 'New Product', 'product' ),
    'view_item' => _x( 'View Product', 'product' ),
    'search_items' => _x( 'Search Products', 'product' ),
    'not_found' => _x( 'No products found', 'product' ),
    'not_found_in_trash' => _x( 'No products found in Trash', 'product' ),
    'parent_item_colon' => _x( 'Parent Product:', 'product' ),
    'menu_name' => _x( 'Products', 'product' ),
  );

  $args = array(
    'labels' => $labels,
    'hierarchical' => false,
    'supports' => array( 'title', 'editor', 'thumbnail' ),
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_position' => 5,
    'show_in_nav_menus' => true,
    'publicly_queryable' => true,
    'exclude_from_search' => false,
    'has_archive' => $archive_slug,
    'query_var' => true,
    'can_export' => true,
    'rewrite' => array('slug' => $item_slug, 'with_front' => false),
    'capability_type' => 'post',
    'show_in_rest' => true
  );

  register_post_type( 'product', $args );
}

/*
add_action( 'init', 'register_cpt_issue' );

function register_cpt_issue() {

  $labels = array(
    'name' => _x( 'Issues', 'issue' ),
    'singular_name' => _x( 'Weekly', 'issue' ),
    'add_new' => _x( 'Add New', 'issue' ),
    'add_new_item' => _x( 'Add New Weekly', 'issue' ),
    'edit_item' => _x( 'Edit Weekly', 'issue' ),
    'new_item' => _x( 'New Weekly', 'issue' ),
    'view_item' => _x( 'View Weekly', 'issue' ),
    'search_items' => _x( 'Search Issues', 'issue' ),
    'not_found' => _x( 'No issues found', 'issue' ),
    'not_found_in_trash' => _x( 'No issues found in Trash', 'issue' ),
    'parent_item_colon' => _x( 'Parent Weekly:', 'issue' ),
    'menu_name' => _x( 'Issues', 'issue' ),
  );

  $args = array(
    'labels' => $labels,
    'hierarchical' => false,

    'supports' => array( 'title', 'editor', 'thumbnail' ),

    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_position' => 5,

    'show_in_nav_menus' => true,
    'publicly_queryable' => true,
    'exclude_from_search' => false,
    'has_archive' => true,
    'query_var' => true,
    'can_export' => true,
    'rewrite' => true,
    'capability_type' => 'post'
  );

  register_post_type( 'issue', $args );
}

add_action( 'init', 'register_cpt_contributor' );

function register_cpt_contributor() {

  $labels = array(
    'name' => _x( 'Contributors', 'contributor' ),
    'singular_name' => _x( 'Weekly', 'contributor' ),
    'add_new' => _x( 'Add New', 'contributor' ),
    'add_new_item' => _x( 'Add New Weekly', 'contributor' ),
    'edit_item' => _x( 'Edit Weekly', 'contributor' ),
    'new_item' => _x( 'New Weekly', 'contributor' ),
    'view_item' => _x( 'View Weekly', 'contributor' ),
    'search_items' => _x( 'Search Contributors', 'contributor' ),
    'not_found' => _x( 'No contributors found', 'contributor' ),
    'not_found_in_trash' => _x( 'No contributors found in Trash', 'contributor' ),
    'parent_item_colon' => _x( 'Parent Weekly:', 'contributor' ),
    'menu_name' => _x( 'Contributors', 'contributor' ),
  );

  $args = array(
    'labels' => $labels,
    'hierarchical' => false,

    'supports' => array( 'title', 'editor', 'thumbnail' ),

    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_position' => 5,

    'show_in_nav_menus' => true,
    'publicly_queryable' => true,
    'exclude_from_search' => false,
    'has_archive' => true,
    'query_var' => true,
    'can_export' => true,
    'rewrite' => true,
    'capability_type' => 'post'
  );

  register_post_type( 'contributor', $args );
}
*/
