<!DOCTYPE html>
<html lang="en" prefix="og: http://ogp.me/ns#">
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title><?php wp_title('|',true,'right'); bloginfo('name'); ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

<?php
get_template_part('partials/globie');
get_template_part('partials/seo');
?>

  <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
  <link rel="icon" href="<?php bloginfo('stylesheet_directory'); ?>/dist/img/favicon.png">
  <link rel="shortcut" href="<?php bloginfo('stylesheet_directory'); ?>/dist/img/favicon.ico">
  <link rel="apple-touch-icon" href="<?php bloginfo('stylesheet_directory'); ?>/dist/img/favicon-touch.png">
  <link rel="apple-touch-icon" sizes="114x114" href="<?php bloginfo('stylesheet_directory'); ?>/dist/img/favicon.png">

<?php if (is_singular() && pings_open(get_queried_object())) { ?>
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
<?php } ?>

  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<!--[if lt IE 9]><p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p><![endif]-->

<section id="main-container">

  <header id="header" class="padding-top-tiny padding-bottom-tiny">
    <div class="container">
      <h1 class="u-visuallyhidden"><?php bloginfo('name'); ?></h1>
      <div class="grid-row justify-between align-items-center">
        <div class="grid-item font-size-zero">
          <a href="<?php echo home_url(); ?>"><img id="logo" src="<?php bloginfo('stylesheet_directory'); ?>/dist/img/so-far-logo.png" /></a>
        </div>
        <div id="main-nav" class="desktop-only">
          <ul class="grid-row text-align-center">
            <li class="grid-item item-s-12 item-l-auto">
              <a href="<?php echo home_url('issues'); ?>">Issues</a>
            </li>
            <li class="grid-item item-s-12 item-l-auto">
              <a href="<?php echo home_url('weeklies'); ?>">Weeklies</a>
            </li>
            <li class="grid-item item-s-12 item-l-auto">
              <a href="<?php echo home_url('artists'); ?>">Artists</a>
            </li>
            <li class="grid-item item-s-12 item-l-auto">
              <a href="<?php echo home_url('shop'); ?>">Shop</a>
            </li>
            <li class="grid-item item-s-12 item-l-auto">
              <a href="<?php echo home_url('about'); ?>">About</a>
            </li>
          </ul>
        </div>
        <div class="grid-item not-desktop">
          <div><span class="js-toggle-menu u-pointer">Toggle</span></div>
        </div>
        <div class="desktop-only">
          <div class="grid-row">
            <div class="grid-item font-size-zero no-gutter-right header-bag-holder">
              <a href="<?php echo home_url('bag'); ?>"><img class="header-icon" src="<?php bloginfo('stylesheet_directory'); ?>/dist/img/icon-bag.png" /></a>
              <!--div class="header-bag-count font-size-tiny"><span class="gws-cart-counter"></span></div-->
            </div>
            <div class="grid-item">
              <img class="u-pointer header-icon js-toggle-search" src="<?php bloginfo('stylesheet_directory'); ?>/dist/img/icon-search.png" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>

  <div id="mobile-nav" class="not-desktop">
    <ul class="grid-row text-align-center padding-top-basic">
      <li class="grid-item item-s-12 item-l-auto padding-bottom-basic">
        <a href="<?php echo home_url('issues'); ?>" class="padding-top-tiny padding-bottom-tiny">Issues</a>
      </li>
      <li class="grid-item item-s-12 item-l-auto padding-bottom-basic">
        <a href="<?php echo home_url('weeklies'); ?>" class="padding-top-tiny padding-bottom-tiny">Weeklies</a>
      </li>
      <li class="grid-item item-s-12 item-l-auto padding-bottom-basic">
        <a href="<?php echo home_url('artists'); ?>" class="padding-top-tiny padding-bottom-tiny">Artists</a>
      </li>
      <li class="grid-item item-s-12 item-l-auto padding-bottom-basic">
        <a href="<?php echo home_url('shop'); ?>" class="padding-top-tiny padding-bottom-tiny">Shop</a>
      </li>
      <li class="grid-item item-s-12 item-l-auto padding-bottom-basic">
        <a href="<?php echo home_url('about'); ?>" class="padding-top-tiny padding-bottom-tiny">About</a>
      </li>
    </ul>
    <div>
      <div class="grid-row justify-center">
        <div class="grid-item padding-bottom-basic font-size-zero">
          <a href="<?php echo home_url('bag'); ?>"><img class="header-icon" src="<?php bloginfo('stylesheet_directory'); ?>/dist/img/icon-bag.png" /></a>
        </div>
      </div>
    </div>
    <div class="padding-bottom-small"><?php get_search_form() ?></div>
  </div>

  <?php if (!is_search()) { ?>
    <div id="fixed-search-underlay" class="js-toggle-search"></div>
    <div id="fixed-search-holder">
      <?php get_search_form() ?>
    </div>
  <?php } ?>
