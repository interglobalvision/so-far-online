<?php
get_header();
?>

<main id="main-content">
<?php
  $top_weekly_args = array(
    'post_type' => 'weekly',
    'posts_per_page' => 1,
  );

  $top_weekly_query = new WP_Query($top_weekly_args);
  if ($top_weekly_query->have_posts()) {
    while ($top_weekly_query->have_posts()) {
      $top_weekly_query->the_post();
      
      get_template_part('partials/article-full-item');
    }
  }

  wp_reset_postdata();

  $weeklies_args = array(
    'post_type' => 'weekly',
    'posts_per_page' => 30,
    'offset' => 1,
  );
  $weeklies_section_title = 'Recent Weeklies';
  global $weeklies_args;
  global $weeklies_section_title;

  get_template_part('partials/weeklies');
?>
</main>

<?php
get_footer();
?>
