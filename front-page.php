<?php
get_header();
?>

<main id="main-content">

<?php
$now = time();

$issues = get_terms( array(
  'taxonomy' => 'issue',
  'parent' => 0,
  'number' => 1,
  'orderby' => 'meta_value_num',
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

if ($issues) {
  $issue = $issues[0];
  $issue_number = get_term_meta($issue->term_id, '_igv_issue_number', true);

  $chapters = get_terms( array(
    'taxonomy' => 'issue',
    'parent' => $issue->term_id,
    'number' => 1,
    'orderby' => 'meta_value_num',
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
    $chapter = $chapters[0];
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
          get_template_part('partials/weeklies');
        }
      }
    } else {
      get_template_part('partials/weeklies');
    }

    wp_reset_postdata();

    $products_args = array(
      'post_type' => 'product',
      'posts_per_page' => 3,
    );

    $products_query = new WP_Query($products_args);
    if ($products_query->have_posts()) {
?>
  <section>
    <div class="container">
      <h2 class="text-align-center font-uppercase">Recent Artworks</h2>
      <div class="grid-row justify-end">
<?php
      while ($products_query->have_posts()) {
        $products_query->the_post();
        $artist_names = get_name_list($post->ID, 'artist');
        $title = get_post_meta($post->ID, '_igv_artwork_title', true);
        $year = get_post_meta($post->ID, '_igv_artwork_year', true);
?>
        <div class="grid-item item-s-12 item-l-3 no-gutter">
          <a href="<?php the_permalink(); ?>">
            <div><?php the_post_thumbnail(); ?></div>
            <div><span><?php echo !empty($artist_names) ? $artist_names : ''; ?></span></div>
            <div><span>
              <?php
                echo !empty($title) ? $title : '';
                echo !empty($title) && !empty($year) ? ', ' : '';
                echo !empty($year) ? $year : '';
              ?>
            </span></div>
          </a>
        </div>
<?php
      }
?>
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
