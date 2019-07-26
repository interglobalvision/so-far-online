<?php
global $images;
?>
<div id="overlay-gallery" class="grid-column justify-center align-items-center">
  <div class="swiper-container" data-swiper-type="overlay">
    <div class="swiper-wrapper">
    <?php
      foreach ($images as $image) {
        $image_id = attachment_url_to_postid($image);
    ?>
      <div class="swiper-slide grid-row justify-center align-items-center" data-image-id="<?php echo $image_id; ?>">
        <div>
          <?php echo wp_get_attachment_image($image_id, 'full'); ?>
        </div>
      </div>
    <?php } ?>
    </div>
  </div>
  <div class="grid-row">
    <div><span class="overlay-prev u-pointer"><</div>
    <div><span class="overlay-current">1</span>/<span><?php echo count($images); ?></span></div>
    <div><span class="overlay-next u-pointer">></div>
  </div>
</div>
