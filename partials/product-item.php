<?php
$artists = get_name_list($post->ID, 'artist');
$title = get_post_meta($post->ID, '_igv_artwork_title', true);
$year = get_post_meta($post->ID, '_igv_artwork_year', true);
$time = get_post_time();
$pick = get_post_meta($post->ID, '_igv_product_pick', true);
?>
<article
  <?php post_class('grid-item grid-item-product item-s-6 item-m-4 item-l-3 margin-bottom-small'); ?>
  id="post-<?php the_ID(); ?>"
  data-post-id="<?php the_ID(); ?>"
  data-time="<?php echo $time; ?>"
  data-pick="<?php echo $pick; ?>"
>
  <a class="font-size-small" href="<?php the_permalink(); ?>">
    <div class="thumb-holder product-item-thumb-holder margin-bottom-micro">
      <div class="thumb" style="background-image: url('<?php echo get_the_post_thumbnail_url($post, 'product-item'); ?>')"></div>
    </div>
    <div class="product-item-details">
      <?php echo !empty($artists) ? '<div class="font-heavy"><span>' . $artists . '</span></div>' : ''; ?>
      <div>
        <?php
          echo !empty($title) ? '<h3 class="u-inline font-italic">' . $title . '</h3>' : '';
          echo !empty($title) && !empty($year) ? '<span>, </span>' : '';
          echo !empty($year) ? '<span>' . $year . '</span>' : '';
        ?>
      </div>
      <?php productPrice($post->ID); ?>
    </div>
  </a>
</article>
