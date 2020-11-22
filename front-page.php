<?php
get_header();
?>

<main id="main-content">

<?php
$now = time();

$issues = get_terms( array(
  'taxonomy' => 'issue',
  'parent' => 0,
  //'number' => 1,
  'orderby' => 'meta_value_num',
  'order' => 'DESC',
  'meta_key' => '_igv_publish_date',
  'meta_query' => array(
    array(
  		'key'     => '_igv_publish_date',
  		'value'   => $now,
  		'compare' => '<='
  	),
  ),
  'hide_empty' => true,
) );

$weeklies_args = array(
  'post_type' => 'weekly',
  'posts_per_page' => 12,
);
$weeklies_section_title = 'Weeklies';
global $weeklies_args;
global $weeklies_section_title;

if ($issues) {
  $issue = array_shift(array_values($issues));
  $issue_number = get_term_meta($issue->term_id, '_igv_issue_number', true);

  $chapters = get_terms( array(
    'taxonomy' => 'issue',
    'parent' => $issue->term_id,
    //'number' => 1,
    'orderby' => 'meta_value_num',
    'order' => 'DESC',
    'meta_key' => '_igv_publish_date',
    'meta_query' => array(
      array(
    		'key'     => '_igv_publish_date',
    		'value'   => $now,
    		'compare' => '<='
    	),
    ),
    'hide_empty' => true,
  ) );

  if (count($chapters) > 0) {
    $chapter = array_shift(array_values($chapters));
    $chapter_number = get_term_meta($chapter->term_id, '_igv_issue_number', true);

    $articles_args = array(
      'post_type' => 'post',
      'tax_query' => array(
        array(
          'taxonomy' => 'issue',
          'field' => 'term_id',
          'terms' => $chapter->term_id,
        ),
      ),
      'posts_per_page' => -1,
    );

    $articles_query = new WP_Query($articles_args);

    $weeklies_carousel_archive_link = get_post_type_archive_link('weekly');
    global $weeklies_carousel_archive_link;

    if ($articles_query->have_posts()) {
      while ($articles_query->have_posts()) {
        $articles_query->the_post();

        $index = $articles_query->current_post;

        global $index;
        global $issue_number;
        global $issue;
        global $chapter_number;
        global $chapter;

        get_template_part('partials/article-full-item');

        if ($index === 0) {
          get_template_part('partials/weeklies-carousel');
        }
      }
    } else {
      get_template_part('partials/weeklies-carousel');
    }

    wp_reset_postdata();

    $products_args = array(
      'post_type' => 'product',
      'posts_per_page' => 3,
    );

    $products_query = new WP_Query($products_args);
    if ($products_query->have_posts()) {
?>
  <section class="padding-top-basic padding-bottom-basic background-pale">
    <div class="container">
      <h2 class="text-align-center font-uppercase padding-bottom-small font-size-large">Recent Artworks</h2>
      <div class="grid-row justify-center">
<?php
      while ($products_query->have_posts()) {
        $products_query->the_post();
        get_template_part('partials/product-item');
      }
?>
      </div>
      <div class="grid-row justify-center padding-top-small">
        <div>
          <a class="button" href="<?php echo home_url('shop'); ?>">Visit the Shop</a>
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
