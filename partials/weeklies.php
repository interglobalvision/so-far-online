<?php
$args = array(
  'post_type' => 'weekly',
  'posts_per_page' => 12,
);

$weeklies_query = new WP_Query($args);

if ( $weeklies_query->have_posts() ) {
?>
<section id="weeklies-carousel" class="padding-top-small padding-bottom-small">
  <div class="container">
    <h2 class="text-align-center font-uppercase padding-bottom-small font-size-mid">Weeklies</h2>
    <div class="swiper-container" data-swiper-type="scroll">
      <div class="swiper-wrapper padding-bottom-small">
    <?php
    	while ( $weeklies_query->have_posts() ) {
        $weeklies_query->the_post();
        $type = get_weekly_type($post->ID);
        $contributors = get_name_list($post->ID, 'contributor');
    ?>
        <div class="swiper-slide text-align-center">
          <a href="<?php the_permalink(); ?>">
            <div class="font-color-grey font-size-small margin-bottom-micro font-uppercase">
              <span><?php echo $type ? $type : '&nbsp;'; ?></span>
            </div>
            <?php the_post_thumbnail(); ?>
            <h3 class="font-serif font-size-mid margin-top-micro"><?php the_title(); ?></h3>
            <?php
              if ($contributors) {
            ?>
            <div class="font-color-grey margin-top-tiny">
              <span><?php echo $contributors; ?></span>
            </div>
            <?php
              }
            ?>
          </a>
        </div>
    <?php
    	} // end while
    ?>
      </div>
      <div class="swiper-scrollbar"></div>
    </div>
  </div>
</section>
<?php
} // endif

// Reset Post Data
wp_reset_postdata();
