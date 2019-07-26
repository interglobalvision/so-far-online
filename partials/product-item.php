<?php
$product_handle = get_post_meta($post->ID, '_gws_product_handle', true);
$artist_names = get_name_list($post->ID, 'artist');
$title = get_post_meta($post->ID, '_igv_artwork_title', true);
$year = get_post_meta($post->ID, '_igv_artwork_year', true);
?>
<article
  <?php post_class('gws-product grid-item item-s-6 item-l-3'); ?>
  id="post-<?php the_ID(); ?>"
  data-gws-product-handle="<?php echo $product_handle; ?>"
  data-gws-available="true"
>
  <a href="<?php the_permalink(); ?>">
    <div><?php the_post_thumbnail(); ?></div>
    <?php echo !empty($artist_names) ? '<div><span>' . $artist_names . '</span></div>' : ''; ?>
    <?php echo !empty($title) ? '<div><h3>' . $title . '</h3></div>' : ''; ?>
    <div class="product-price"><span class="gws-product-price"></span></div>
    <div class="product-sold"><span>Sold</span></div>
  </a>
</article>
