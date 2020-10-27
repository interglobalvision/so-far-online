<?php
get_header();
$pale = true;
global $pale;
?>

<main id="main-content">
<?php
$weekly_types = array(
  get_term_by('slug', 'so-far-studios', 'weeklytype'),
  get_term_by('slug', 'so-far-reviews', 'weeklytype'),
  get_term_by('slug', 'so-far-friendships', 'weeklytype'),
);
/*    get_terms(array(
  'taxonomy' => 'weeklytype',
  'orderby' => 'count',
  'order' => 'DESC',
));*/

if ($weekly_types[0]) {
  foreach ($weekly_types as $weekly_type) {
    $top_weekly_args = array(
      'post_type' => 'weekly',
      'posts_per_page' => 1,
      'tax_query' => array(
        array(
          'taxonomy' => 'weeklytype',
          'field'    => 'slug',
          'terms'    => $weekly_type->slug,
        ),
      ),
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
      'posts_per_page' => 10,
      'offset' => 1,
      'tax_query' => array(
        array(
          'taxonomy' => 'weeklytype',
          'field'    => 'slug',
          'terms'    => $weekly_type->slug,
        ),
      ),
    );
    $weeklies_section_title = $weekly_type->name;
    global $weeklies_args;
    global $weeklies_section_title;

    get_template_part('partials/weeklies-carousel');

    wp_reset_postdata();
  }
}
?>

  <section class="padding-bottom-basic">
    <div class="container">
      <div class="grid-row justify-center">
        <div class="grid-item item-s-10 item-m-8 item-l-6 text-align-center margin-top-small">
          <a href="<?php echo get_post_type_archive_link('weekly'); ?>" class="link-underline font-uppercase font-size-small font-heavy">View Weeklies Archive</a>
        </div>
      </div>
    </div>
  </section>
</main>

<?php
get_footer();
?>
