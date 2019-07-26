<?php
  global $articles_meta_query;
//  global $articles_tax_query;
  global $section_heading;

  $articles_args = array(
    'post_type' => 'post',
    'posts_per_page' => -1,
    'meta_query' => $articles_meta_query,
    //'tax_query' => $articles_tax_query,
  );

  $articles_query = new WP_Query($articles_args);

  if ($articles_query->have_posts()) {
?>
    <section>
      <h2 class="text-align-center font-uppercase background-pale padding-top-small"><?php echo $section_heading; ?></h2>
<?php
    while ($articles_query->have_posts()) {
      $articles_query->the_post();
      var_dump($articles_query->current_post);
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
