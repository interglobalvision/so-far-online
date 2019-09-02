<?php
global $bio;
$birth_year = get_term_meta($bio->term_id, '_igv_bio_year', true);
$bio_photo_id = get_term_meta($bio->term_id, '_igv_bio_photo_id', true);
?>
<div class="grid-row justify-center margin-bottom-small">
  <div class="grid-item item-s-6 item-l-3">
    <?php echo !empty($bio_photo_id) ? wp_get_attachment_image($bio_photo_id, 'full') : ''; ?>
  </div>
  <div class="grid-item item-s-6 mobile-only font-serif">
    <div><span class="font-size-mid"><?php echo $bio->name; ?></span></div>
    <div><span><?php echo !empty($birth_year) ? 'b. ' . $birth_year : ''; ?></span></div>
  </div>
  <div class="grid-item item-s-12 item-l-5">
    <div class="desktop-only font-serif">
      <div><span class="font-size-mid"><?php echo $bio->name; ?></span></div>
      <div><span><?php echo !empty($birth_year) ? 'b. ' . $birth_year : ''; ?></span></div>
    </div>
    <div class="padding-top-tiny">
      <?php echo $bio->description; ?>
    </div>
  </div>
</div>
