<?php
$args = array(
  'post_type' => 'diary',
  'posts_per_page' => 12,
);

$query = new WP_Query($args);

if ( $query->have_posts() ) {
?>
<div class="container">
  <div class="swiper-container" data-swiper-type="scroll">
    <div class="swiper-wrapper padding-bottom-small">
  <?php
  	while ( $query->have_posts() ) {
      $query->the_post();
      $type = get_custom_type_terms($post->ID, 'diarytype');
      $contributors = get_name_list($post->ID, 'contributor');
  ?>
      <article class="swiper-slide text-align-center">
        <a href="<?php the_permalink(); ?>">
          <div class="font-color-grey font-size-tiny margin-bottom-micro font-uppercase">
            <span><?php echo $type ? $type : '&nbsp;'; ?></span>
          </div>
          <div class="thumb-holder scroll-slider-thumb-holder">
            <div class="thumb" style="background-image: url('<?php echo get_the_post_thumbnail_url($post, 'scroll-slider'); ?>')"></div>
          </div>
          <h3 class="font-serif margin-top-micro js-fix-widows"><?php the_title(); ?></h3>
          <?php
            if ($contributors) {
          ?>
          <div class="font-color-grey font-size-small">
            <span><?php echo $contributors; ?></span>
          </div>
          <?php
            }
          ?>
        </a>
      </article>
  <?php
  	} // end while
  ?>
    </div>
    <div class="swiper-scrollbar"></div>
  </div>
</div>
<?php
} // endif

// Reset Post Data
wp_reset_postdata();
