<?php
get_header();
?>

<main id="main-content">

<?php
get_template_part('partials/shop-filter');

$collections = get_terms( 'collection' );

foreach ($collections as $collection) {

  $collection_args = array(
    'post_type' => 'product',
    'tax_query' => array(
      array(
        'taxonomy' => 'collection',
        'field' => 'slug',
        'terms' => $collection->slug,
      ),
    ),
    'posts_per_page' => 12,
  );

  $collection_query = new WP_Query($collection_args);

  if ($collection_query->have_posts()) {
?>
  <section class="padding-top-small padding-bottom-small">
    <div class="container">
      <div class="grid-row padding-bottom-small">
        <div class="grid-item item-s-12">
          <h2 class="font-uppercase font-size-large"><?php echo $collection->name; ?></h2>
        </div>
      </div>
      <div class="grid-row products-holder">
      <?php
        while ($collection_query->have_posts()) {
          $collection_query->the_post();

          get_template_part('partials/product-item');
        }
      ?>
      </div>
    </div>
  </section>
<?php
  }

  wp_reset_postdata();
}

?>

</main>

<?php
get_footer();
?>
