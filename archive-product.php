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
    'posts_per_page' => 12,
  );

  $filter_query = new WP_Query($filter_args);

  if ($filter_query->have_posts()) {
    $term = get_term_by('slug', $filter_slug, $filter_tax);
?>
  <section class="padding-top-small padding-bottom-small">
    <div class="container">
      <div class="grid-row padding-bottom-small">
        <div class="grid-item item-s-12">
          <h2 class="font-uppercase font-size-large"><?php echo $term->name; ?></h2>
        </div>
      </div>
      <div class="grid-row products-holder" id="posts-holder">
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
  $max_page = $filter_query->max_num_pages;
  $paged = get_query_var('paged', 1);
  if ($max_page > $paged) {
  ?>
    <section class="padding-bottom-basic">
      <div class="container">
        <div class="grid-row justify-center">
          <div class="grid-item item-s-10 item-m-8 item-l-6 text-align-center margin-top-small">
            <a id="load-more" href="<?php echo next_posts( $max_page, false ); ?>" class="link-underline font-uppercase font-heavy u-pointer" data-maxpage="<?php echo $max_page; ?>">Load More</a>
          </div>
        </div>
      </div>
    </section>
<?php
  }
}

  wp_reset_postdata();

} else {
  if (have_posts()) {
?>
    <section class="padding-top-small padding-bottom-small">
      <div class="container">
        <div class="grid-row padding-bottom-small">
          <div class="grid-item item-s-12">
            <h2 class="font-uppercase font-size-large">&nbsp;</h2>
          </div>
        </div>
        <div class="grid-row products-holder" id="posts-holder">
        <?php
          while (have_posts()) {
            the_post();
            get_template_part('partials/product-item');
          }
        ?>
        </div>
      </div>
    </section>
<?php
    global $wp_query;
    $max_page = $wp_query->max_num_pages;
    $paged = get_query_var('paged', 1);
    if ($max_page > $paged) {
?>
    <section class="padding-bottom-basic">
      <div class="container">
        <div class="grid-row justify-center">
          <div class="grid-item item-s-10 item-m-8 item-l-6 text-align-center margin-top-small">
            <a id="load-more" href="<?php echo next_posts( $max_page, false ); ?>" class="link-underline font-uppercase font-heavy u-pointer" data-maxpage="<?php echo $max_page; ?>">Load More</a>
          </div>
        </div>
      </div>
    </section>
<?php
    }
  }
}
?>

</main>

<?php
get_footer();
?>
