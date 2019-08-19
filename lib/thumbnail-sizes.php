<?php

if( function_exists( 'add_theme_support' ) ) {
  add_theme_support( 'post-thumbnails' );
}

if( function_exists( 'add_image_size' ) ) {
  add_image_size( 'admin-thumb', 150, 150, false );
  add_image_size( 'opengraph', 1200, 630, true );
  add_image_size( 'article-item', 815, 570, true );
  add_image_size( 'scroll-slider', 311, 210, true );
  add_image_size( 'product-item', 357, 462, true );
  add_image_size( 'gallery', 1200, 9999, false );
}
