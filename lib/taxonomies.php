<?php
// hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_custom_taxonomies', 0 );

function create_custom_taxonomies() {

	$labels = array(
		'name'              => _x( 'Issues', 'taxonomy general name', 'igv' ),
		'singular_name'     => _x( 'Issue', 'taxonomy singular name', 'igv' ),
		'search_items'      => __( 'Search Issues', 'igv' ),
		'all_items'         => __( 'All Issues', 'igv' ),
		'parent_item'       => __( 'Parent Issue', 'igv' ),
		'parent_item_colon' => __( 'Parent Issue:', 'igv' ),
		'edit_item'         => __( 'Edit Issue', 'igv' ),
		'update_item'       => __( 'Update Issue', 'igv' ),
		'add_new_item'      => __( 'Add New Issue', 'igv' ),
		'new_item_name'     => __( 'New Issue Name', 'igv' ),
		'menu_name'         => __( 'Issue', 'igv' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'issue' ),
    'show_in_rest'      => true,
    'public'            => true,
	);

	register_taxonomy( 'issue', array( 'post' ), $args );

	$labels = array(
		'name'              => _x( 'Contributors', 'taxonomy general name', 'igv' ),
		'singular_name'     => _x( 'Contributor', 'taxonomy singular name', 'igv' ),
		'search_items'      => __( 'Search Contributors', 'igv' ),
		'all_items'         => __( 'All Contributors', 'igv' ),
		'parent_item'       => __( 'Parent Contributor', 'igv' ),
		'parent_item_colon' => __( 'Parent Contributor:', 'igv' ),
		'edit_item'         => __( 'Edit Contributor', 'igv' ),
		'update_item'       => __( 'Update Contributor', 'igv' ),
		'add_new_item'      => __( 'Add New Contributor', 'igv' ),
		'new_item_name'     => __( 'New Contributor Name', 'igv' ),
		'menu_name'         => __( 'Contributor', 'igv' ),
	);

	$args = array(
		'hierarchical'      => false,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'contributor' ),
    'show_in_rest'      => true,
    'public'            => true,
	);

	register_taxonomy( 'contributor', array( 'post','weekly' ), $args );

	$labels = array(
		'name'              => _x( 'Artists', 'taxonomy general name', 'igv' ),
		'singular_name'     => _x( 'Artist', 'taxonomy singular name', 'igv' ),
		'search_items'      => __( 'Search Artists', 'igv' ),
		'all_items'         => __( 'All Artists', 'igv' ),
		'parent_item'       => __( 'Parent Artist', 'igv' ),
		'parent_item_colon' => __( 'Parent Artist:', 'igv' ),
		'edit_item'         => __( 'Edit Artist', 'igv' ),
		'update_item'       => __( 'Update Artist', 'igv' ),
		'add_new_item'      => __( 'Add New Artist', 'igv' ),
		'new_item_name'     => __( 'New Artist Name', 'igv' ),
		'menu_name'         => __( 'Artist', 'igv' ),
	);

	$args = array(
		'hierarchical'      => false,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'artist' ),
    'show_in_rest'      => true,
    'public'            => true,
	);

	register_taxonomy( 'artist', array( 'post','product','weekly' ), $args );

	$labels = array(
		'name'              => _x( 'Types', 'taxonomy general name', 'igv' ),
		'singular_name'     => _x( 'Type', 'taxonomy singular name', 'igv' ),
		'search_items'      => __( 'Search Types', 'igv' ),
		'all_items'         => __( 'All Types', 'igv' ),
		'parent_item'       => __( 'Parent Type', 'igv' ),
		'parent_item_colon' => __( 'Parent Type:', 'igv' ),
		'edit_item'         => __( 'Edit Type', 'igv' ),
		'update_item'       => __( 'Update Type', 'igv' ),
		'add_new_item'      => __( 'Add New Type', 'igv' ),
		'new_item_name'     => __( 'New Type Name', 'igv' ),
		'menu_name'         => __( 'Type', 'igv' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'type' ),
    'public'            => true,
    'show_in_rest'      => true,
	);

	register_taxonomy( 'weeklytype', array( 'weekly' ), $args );

  $labels = array(
    'name'              => _x( 'Collections', 'taxonomy general name', 'igv' ),
    'singular_name'     => _x( 'Collection', 'taxonomy singular name', 'igv' ),
    'search_items'      => __( 'Search Collections', 'igv' ),
    'all_items'         => __( 'All Collections', 'igv' ),
    'parent_item'       => __( 'Parent Collection', 'igv' ),
    'parent_item_colon' => __( 'Parent Collection:', 'igv' ),
    'edit_item'         => __( 'Edit Collection', 'igv' ),
    'update_item'       => __( 'Update Collection', 'igv' ),
    'add_new_item'      => __( 'Add New Collection', 'igv' ),
    'new_item_name'     => __( 'New Collection Name', 'igv' ),
    'menu_name'         => __( 'Collection', 'igv' ),
  );

  $args = array(
    'hierarchical'      => false,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => 'collection' ),
    'public'            => true,
    'show_in_rest'      => true,
  );

  register_taxonomy( 'collection', array( 'product' ), $args );

  wp_insert_term( 'Featured', 'collection' );

  $labels = array(
    'name'              => _x( 'Mediums', 'taxonomy general name', 'igv' ),
    'singular_name'     => _x( 'Medium', 'taxonomy singular name', 'igv' ),
    'search_items'      => __( 'Search Mediums', 'igv' ),
    'all_items'         => __( 'All Mediums', 'igv' ),
    'parent_item'       => __( 'Parent Medium', 'igv' ),
    'parent_item_colon' => __( 'Parent Medium:', 'igv' ),
    'edit_item'         => __( 'Edit Medium', 'igv' ),
    'update_item'       => __( 'Update Medium', 'igv' ),
    'add_new_item'      => __( 'Add New Medium', 'igv' ),
    'new_item_name'     => __( 'New Medium Name', 'igv' ),
    'menu_name'         => __( 'Medium', 'igv' ),
  );

  $args = array(
    'hierarchical'      => false,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => 'medium' ),
    'public'            => true,
    'show_in_rest'      => true,
  );

  register_taxonomy( 'medium', array( 'product' ), $args );

}
?>
