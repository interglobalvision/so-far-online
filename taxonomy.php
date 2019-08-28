<?php
get_header();
?>

<main id="main-content">

<?php
$bio = get_queried_object();
global $bio;
?>

  <section id="term-<?php echo $bio->$term_id; ?>" class="padding-top-basic padding-bottom-basic">
    <div class="container">
      <?php get_template_part('partials/bio'); ?>
    </div>
  </section>

<?php
$articles_args = array(
  'post_type' => array('post','weekly'),
  'posts_per_page' => -1,
  'order' => 'DESC',
  'orderby' => 'publish_date',
  'post_status' => 'publish',
  'tax_query' => array(
    array(
      'taxonomy' => $bio->taxonomy,
      'terms' => $bio->slug,
      'field' => 'slug',
      'operator' => 'IN',
    ),
  ),
);

$articles_query = new WP_Query($articles_args);

if ($articles_query->have_posts()) {
?>
  <section>
    <h2 class="text-align-center font-uppercase background-pale padding-top-small">Articles featuring this <?php echo $bio->taxonomy; ?></h2>
<?php
  while ($articles_query->have_posts()) {
    $articles_query->the_post();

    $index = $articles_query->current_post + 1;
    global $index;

    $issue_terms = get_the_terms($post, 'issue');
    $chapter = false;
    if (!empty($issue_terms)) {
      $chapter = $issue_terms[0]->parent !== 0 ? $issue_terms[0] : false;
    }
    if ($chapter) {
      $issue = get_term($chapter->parent);
      $chapter_number = get_term_meta($chapter->term_id, '_igv_issue_number', true);
      $issue_number = get_term_meta($issue->term_id, '_igv_issue_number', true);
    }

    global $issue_number;
    global $issue;
    global $chapter_number;
    global $chapter;

    get_template_part('partials/article-full-item');

  }
?>
  </section>
<?php
}

wp_reset_postdata();
?>

</main>

<?php
get_footer();
?>
