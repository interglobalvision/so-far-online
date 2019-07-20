<?php
$args = array(
  'post_type' => 'weekly',
  'posts_per_page' => 12,
);

$weeklies_query = new WP_Query($args);

if ( $weeklies_query->have_posts() ) {
?>
<section class="background-pink">
  <div><h2 class="text-align-center font-uppercase">Weeklies</h2></div>
  <div class="swiper-container swiper-scroll">
    <div class="swiper-wrapper padding-bottom-mid">
  <?php
  	while ( $weeklies_query->have_posts() ) {
      $weeklies_query->the_post();
      $type = get_weekly_type($post->ID);
      $contributors = get_name_list($post->ID, 'contributor');
  ?>
      <div class="swiper-slide text-align-center">
        <div>
          <span><?php echo $type ? $type : '&nbsp;'; ?></span>
        </div>
        <?php the_post_thumbnail(); ?>
        <?php the_title(); ?>
        <?php
          if ($contributors) {
        ?>
        <div>
          <span><?php echo $contributors; ?></span>
        </div>
        <?php
          }
        ?>

      </div>
  <?php
  	} // end while
  ?>
    </div>
    <div class="swiper-scrollbar"></div>
  </div>
</section>
<?php
} // endif

// Reset Post Data
wp_reset_postdata();
