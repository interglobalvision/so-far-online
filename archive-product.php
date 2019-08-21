<?php
get_header();
?>

<main id="main-content">

<?php
get_template_part('partials/shop-filter');

$filter_tax = get_query_var('filter');
$filter_slug = get_query_var('by');

if (!empty($filter_tax)) {

  $filter_args = array(
    'post_type' => 'product',
    'tax_query' => array(
      array(
        'taxonomy' => $filter_tax,
        'field' => 'slug',
        'terms' => $filter_slug,
      ),
    ),
    'posts_per_page' => -1,
  );

  $filter_query = new WP_Query($filter_args);

  if ($filter_query->have_posts()) {
    $term = get_term_by('slug', $filter_slug, $filter_tax);
?>
  <section class="padding-top-small padding-bottom-small">
    <div class="container">
      <h2 class="text-align-center font-uppercase padding-bottom-small font-size-mid"><?php echo $term->name; ?></h2>
      <div class="grid-row products-holder">
      <?php
        while ($filter_query->have_posts()) {
          $filter_query->the_post();
          get_template_part('partials/product-item');
        }
      ?>
      </div>
    </div>
  </section>
<?php
  }

  wp_reset_postdata();

} else {

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
      'posts_per_page' => -1,
    );

    $collection_query = new WP_Query($collection_args);

    if ($collection_query->have_posts()) {
  ?>
    <section class="padding-top-small padding-bottom-small">
      <div class="container">
        <h2 class="text-align-center font-uppercase padding-bottom-small font-size-mid"><?php echo $collection->name; ?></h2>
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
}
?>

</main>

<?php
get_footer();
?>
