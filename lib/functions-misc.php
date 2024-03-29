<?php

// Remove WP Emoji
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

// Disable that freaking admin bar
add_filter('show_admin_bar', '__return_false');

// Turn off version in meta
function no_generator() { return ''; }
add_filter( 'the_generator', 'no_generator' );

// Show thumbnails in admin lists
add_filter('manage_posts_columns', 'new_add_post_thumbnail_column');
function new_add_post_thumbnail_column($cols) {
  $cols['new_post_thumb'] = __('Thumbnail');
  return $cols;
}
add_action('manage_posts_custom_column', 'new_display_post_thumbnail_column', 5, 2);
function new_display_post_thumbnail_column($col, $id) {
  if ($col === 'new_post_thumb' && function_exists('the_post_thumbnail')) {
    echo the_post_thumbnail( 'admin-thumb' );
  }
}

// remove automatic <a> links from images in blog
function wpb_imagelink_setup() {
  $image_set = get_option( 'image_default_link_type' );
  if ($image_set !== 'none') {
    update_option('image_default_link_type', 'none');
  }
}
add_action('admin_init', 'wpb_imagelink_setup', 10);

// Clean site desc. after theme activation
function clean_site_blog_info() {
  $old  = get_option('blogdescription');
  if ( $old == 'Just another WordPress site' || $old == 'Otro sitio realizado con WordPress' ) {
    update_option( 'blogdescription', '' );
  }
}
add_action( 'after_setup_theme', 'clean_site_blog_info' );

// custom login logo
/*
function custom_login_logo() {
  echo '<style type="text/css">h1 a { background-image:url(' . get_bloginfo( 'template_directory' ) . '/images/login-logo.png) !important; background-size:300px auto !important; width:300px !important; }</style>';
}
add_action( 'login_head', 'custom_login_logo' );
 */

add_filter( 'render_block', 'igv_wrap_image_block', 10, 2 );
function igv_wrap_image_block( $block_content, $block ) {
	if ( 'core/image' !== $block['blockName'] ) {
		return $block_content;
	}

	$return  = '<div class="igv-block-image">';
	$return .= $block_content;
	$return .= '</div>';

	return $return;
}

// Guest nonce
function create_guest_nonce( $action = -1 ) {
  $ip = $_SERVER['REMOTE_ADDR'];
  $i     = wp_nonce_tick();

  return substr( wp_hash( $i . '|' . $action . '|' . $ip . '|' . $ip, 'nonce' ), -12, 10 );
}

function verify_guest_nonce( $nonce, $action = -1 ) {
  $nonce = (string) $nonce;
  $ip = $_SERVER['REMOTE_ADDR'];

  if ( empty( $nonce ) ) {
    return false;
  }

  $i     = wp_nonce_tick();

  // Nonce generated 0-12 hours ago
  $expected = substr( wp_hash( $i . '|' . $action . '|' . $ip . '|' . $ip, 'nonce' ), -12, 10 );

  if ( hash_equals( $expected, $nonce ) ) {
    return 1;
  }

  // Nonce generated 12-24 hours ago
  $expected = substr( wp_hash( ( $i - 1 ) . '|' . $action . '|' . $ip . '|' . $ip, 'nonce' ), -12, 10 );
  if ( hash_equals( $expected, $nonce ) ) {
    return 2;
  }

  // Invalid nonce
  return false;
}