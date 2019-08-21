<?php
$product_handle = get_post_meta($post->ID, '_gws_product_handle', true);
$artists = get_name_list($post->ID, 'artist');
$title = get_post_meta($post->ID, '_igv_artwork_title', true);
$year = get_post_meta($post->ID, '_igv_artwork_year', true);
?>
<article
  <?php post_class('gws-product grid-item grid-item-product item-s-4 item-l-3 margin-bottom-small'); ?>
  id="post-<?php the_ID(); ?>"
  data-gws-product-handle="<?php echo $product_handle; ?>"
  data-gws-available="true"
>
  <a class="font-size-small" href="<?php the_permalink(); ?>">
    <div class="thumb-holder product-item-thumb-holder margin-bottom-micro">
      <div class="thumb" style="background-image: url('<?php echo get_the_post_thumbnail_url($post, 'product-item'); ?>')"></div>
    </div>
    <div class="product-item-details">
      <?php echo !empty($artists) ? '<div class="font-heavy"><span>' . $artists . '</span></div>' : ''; ?>
      <div>
        <?php
          echo !empty($title) ? '<h3 class="u-inline">' . $title . '</h3>' : '';
          echo !empty($title) && !empty($year) ? '<span>, </span>' : '';
          echo !empty($year) ? '<span>' . $year . '</span>' : '';
        ?>
      </div>
      <div class="product-price"><span>$</span><span class="gws-product-price"></span></div>
      <div class="product-sold"><span>Sold</span></div>
    </div>
  </a>
</article>
