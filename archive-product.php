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
      <?php
        while ($products_query->have_posts()) {
          $products_query->the_post();
          get_template_part('partials/product-item');
        }
      ?>
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
