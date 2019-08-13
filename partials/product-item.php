<?php
$product_handle = get_post_meta($post->ID, '_gws_product_handle', true);
$artists = get_name_list($post->ID, 'artist');
$title = get_post_meta($post->ID, '_igv_artwork_title', true);
$year = get_post_meta($post->ID, '_igv_artwork_year', true);
?>
<article
  <?php post_class('gws-product grid-item item-s-6 item-l-3 margin-bottom-small'); ?>
  id="post-<?php the_ID(); ?>"
  data-gws-product-handle="<?php echo $product_handle; ?>"
  data-gws-available="true"
>
  <a class="font-size-small hover-desaturate" href="<?php the_permalink(); ?>">
    <div class="margin-bottom-micro font-size-zero"><?php the_post_thumbnail(); ?></div>
    <?php echo !empty($artists) ? '<div><span>' . $artists . '</span></div>' : ''; ?>
    <div>
      <?php
        echo !empty($title) ? '<h3 class="u-inline-block">' . $title . '</h3>' : '';
        echo !empty($title) && !empty($year) ? ', ' : '';
        echo !empty($year) ? '<span>' . $year . '</span>' : '';
      ?>
    </div>
    <div class="product-price"><span class="gws-product-price"></span></div>
    <div class="product-sold"><span>Sold</span></div>
  </a>
</article>
