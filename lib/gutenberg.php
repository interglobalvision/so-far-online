<?php

// Custom gutenberg stuff

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
      'igv/test-block',
    ));
	};

	return $allowed_blocks;
}
add_filter( 'allowed_block_types', 'igv_allowed_block_types', 10, 2 );

function igv_gutenberg_blocks() {
  wp_register_script('igv_custom_gutenberg_js', get_template_directory_uri() . '/gutenberg/build/index.js', array( 'wp-blocks' ));
  register_block_type('igv/test-block', array(
    'editor_script' => 'igv_custom_gutenberg_js',
  ));
}
add_action('init', 'igv_gutenberg_blocks');
