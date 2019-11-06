<?php

if( function_exists( 'add_theme_support' ) ) {
  add_theme_support( 'post-thumbnails' );
}

if( function_exists( 'add_image_size' ) ) {
  add_image_size( 'admin-thumb', 150, 150, false );
  add_image_size( 'opengraph', 1200, 630, true );
  add_image_size( 'article-item', 810, 540, true );
  add_image_size( 'scroll-slider', 440, 308, true );
  add_image_size( 'product-item', 357, 462, true );
  add_image_size( 'product-slide', 780, 9999, false );
  add_image_size( 'overlay-gallery', 1100, 9999, false );
  add_image_size( 'search-result', 540, 375, true );
  add_image_size( 'about-header', 1440, 725, true );
  add_image_size( 'about-artists', 680, 725, true );
  add_image_size( 'about-team', 300, 300, true );
  add_image_size( 'about-partner', 200, 200, false );
  add_image_size( 'gallery', 1200, 9999, false );
}
