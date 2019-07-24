<?php
get_header();
?>

<main id="main-content">

<?php
$collections = get_terms( 'collection' );

foreach ($collections as $collection) {
  $products_args = array(
    'post_type' => 'product',
    'tax_query' => array(
      array(
        'taxonomy' => 'collection',
        'field' => 'term_id',
        'terms' => $collection->term_id,
      ),
    ),
    'posts_per_page' => -1,
  );

  $products_query = new WP_Query($products_args);

  if ($products_query->have_posts()) {
?>
  <section>
    <div class="container">
      <h2 class="text-align-center font-uppercase"><?php echo $collection->name; ?></h2>
      <div class="grid-row">
        <div class="grid-item item-s-12 item-l-9 offfset-s-3 no-gutter grid-row">
        <?php
          while ($products_query->have_posts()) {
            $products_query->the_post();
            $product_handle = get_post_meta($post->ID, '_gws_product_handle', true);
            $artist_names = get_name_list($post->ID, 'artist');
            $title = get_post_meta($post->ID, '_igv_artwork_title', true);
        ?>
          <article <?php post_class('gws-product grid-item item-s-6 item-l-4'); ?> id="post-<?php the_ID(); ?>" data-gws-product-handle="<?php echo $product_handle; ?>">
            <a href="<?php the_permalink(); ?>">
              <div><?php the_post_thumbnail(); ?></div>
              <?php echo !empty($artist_names) ? '<div><span>' . $artist_names . '</span></div>' : ''; ?>
              <?php echo !empty($title) ? '<div><h3>' . $title . '</h3></div>' : ''; ?>
              <div><span class="gws-product-price"></span></div>
            </a>
          </article>
        <?php
          }
        ?>
        </div>
      </div>
    </div>
  </section>
<?php
  }
}
?>

</main>

<?php
get_footer();
?>
