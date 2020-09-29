<?php

// Custom hooks (like excerpt length etc)

// Programatically create pages
function create_custom_pages() {
  $custom_pages = array(
    'issues' => 'Issues',
    'weeklies' => 'Weeklies',
    'artists' => 'Artists',
    'contributors' => 'Contributors',
    'incubator' => 'Incubator',
    'about' => 'About',
    'contribute' => 'How to Contribute',
    'contact' => 'Contact Us',
    'faq' => 'FAQ',
    'terms-and-conditions' => 'Terms & Conditions',
    'bag' => 'Bag',
  );
  foreach($custom_pages as $page_name => $page_title) {
    $page = get_page_by_path($page_name);
    if( empty($page) ) {
      wp_insert_post( array(
        'post_type' => 'page',
        'post_title' => $page_title,
        'post_name' => $page_name,
        'post_status' => 'publish'
      ));
    }
  }
}
add_filter( 'after_setup_theme', 'create_custom_pages' );

function assign_bio_archive_template( $page_template ) {
  global $post;
  if ($post->post_name === 'artists' || $post->post_name === 'contributors') {
    $page_template = get_template_directory() . '/bio-archive.php';
  }
  return $page_template;
}
add_filter( 'page_template', 'assign_bio_archive_template' );

function igv_allowed_block_types( $allowed_blocks, $post ) {
  $allowed_blocks = array(
		'core/paragraph',
		'core/heading',
		'core/list',
	);

  if( $post->post_type !== 'product' ) {
		$allowed_blocks = array_merge($allowed_blocks, array(
      'core/image',
      'core/quote',
      'core/pullquote',
      'core-embed/twitter',
      'core-embed/youtube',
      'core-embed/instagram',
      'core-embed/vimeo',
      'core-embed/soundcloud',
      'core-embed/spotify',
      'core/audio',
      'core/video',
    ));
	};

	return $allowed_blocks;
}
add_filter( 'allowed_block_types', 'igv_allowed_block_types', 10, 2 );

function igv_product_post_type_args( $args, $post_type ) {
  if ( $post_type === 'product' ) {
    $args['show_in_rest'] = true;
  }
  return $args;
}
add_filter( 'register_post_type_args', 'igv_product_post_type_args', 20, 2 );
