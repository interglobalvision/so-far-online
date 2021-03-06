<?php
global $weeklies_args;
global $weeklies_section_title;
global $weeklies_carousel_archive_link;

$weeklies_query = new WP_Query($weeklies_args);

if ( $weeklies_query->have_posts() ) {
?>
<section id="weeklies-carousel" class="padding-top-small padding-bottom-small">
  <div class="container">
    <h2 class="text-align-center font-uppercase padding-bottom-small font-size-large font-color-blush"><?php echo $weeklies_section_title; ?></h2>
    <div class="swiper-container" data-swiper-type="scroll">
      <div class="swiper-wrapper padding-bottom-small">
    <?php
    	while ( $weeklies_query->have_posts() ) {
        $weeklies_query->the_post();
        $contributors = get_name_list($post->ID, 'contributor');
    ?>
        <article class="swiper-slide text-align-center">
          <a href="<?php the_permalink(); ?>">
            <div class="font-color-grey font-size-tiny margin-bottom-micro font-uppercase">
              <span><?php the_date('j F, Y'); ?></span>
            </div>
            <div class="thumb-holder scroll-slider-thumb-holder">
              <div class="thumb" style="background-image: url('<?php echo get_the_post_thumbnail_url($post, 'scroll-slider'); ?>')"></div>
            </div>
            <h3 class="margin-top-micro js-fix-widows"><?php the_title(); ?></h3>
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

      if ($weeklies_carousel_archive_link) {
    ?>
        <div class="swiper-slide align-self-center">
          <div class="text-align-center"><a href="<?php echo $weeklies_carousel_archive_link; ?>" class="link-underline font-size-mid font-uppercase font-light">View All</a></div>
        </div>
    <?php
      }
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
