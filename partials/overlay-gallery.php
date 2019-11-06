<?php
global $images;
?>
<div id="overlay-gallery" class="grid-column justify-center align-items-center">
  <div class="swiper-container" data-swiper-type="overlay">
    <div class="swiper-wrapper">
    <?php
      foreach ($images as $image) {
        $attachment_url = str_replace('//wp-content', '/wp-content', $image);
        $image_id = attachment_url_to_postid($attachment_url);
    ?>
      <div class="swiper-slide grid-row justify-center align-items-center" data-image-id="<?php echo $image_id; ?>">
        <?php echo wp_get_attachment_image($image_id, 'overlay-gallery'); ?>
      </div>
    <?php } ?>
    </div>
  </div>
  <div class="grid-row align-items-center margin-top-micro font-color-grey <?php echo count($images) === 1 ? 'u-hidden' : ''; ?>">
    <div class="slide-prev-holder u-pointer">
      <span class="overlay-nav overlay-prev u-pointer"><img class="slide-pagination-icon u-pointer" src="<?php bloginfo('stylesheet_directory'); ?>/dist/img/icon-prev.png" />
    </div>
    <div>
      <span class="overlay-current">1</span>/<span><?php echo count($images); ?></span>
    </div>
    <div class="slide-next-holder u-pointer">
      <span class="overlay-nav overlay-next u-pointer"><img class="slide-pagination-icon u-pointer" src="<?php bloginfo('stylesheet_directory'); ?>/dist/img/icon-next.png" />
    </div>
  </div>
</div>
