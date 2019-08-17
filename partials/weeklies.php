<?php
global $weeklies_args;
global $weeklies_section_title;

$weeklies_query = new WP_Query($weeklies_args);

if ( $weeklies_query->have_posts() ) {
?>
<section id="weeklies-carousel" class="padding-top-small padding-bottom-small">
  <div class="container">
    <h2 class="text-align-center font-uppercase padding-bottom-small font-size-mid"><?php echo $weeklies_section_title; ?></h2>
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
            <div class="font-color-grey font-size-tiny margin-bottom-micro font-uppercase">
              <span><?php echo $type ? $type : '&nbsp;'; ?></span>
            </div>
            <div class="thumb-holder font-size-zero" style="height: 250px">
              <?php the_post_thumbnail(); ?>
            </div>
            <h3 class="font-serif margin-top-micro underline-on-hover"><?php the_title(); ?></h3>
            <?php
              if ($contributors) {
            ?>
            <div class="font-color-grey margin-top-tiny font-size-small">
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
