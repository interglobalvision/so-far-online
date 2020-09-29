<?php
get_header();
$pale = true;
global $pale;
?>

<main id="main-content">
<?php
$top_weekly_args = array(
  'post_type' => 'weekly',
  'posts_per_page' => 1,
  'tax_query' => array(
    array(
      'taxonomy' => 'weeklytype',
      'field'    => 'slug',
      'terms'    => 'studios',
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
      'terms'    => 'studios',
    ),
  ),
);
$weeklies_section_title = 'So-Far Studios';
global $weeklies_args;
global $weeklies_section_title;

get_template_part('partials/weeklies');

$top_weekly_args = array(
  'post_type' => 'weekly',
  'posts_per_page' => 1,
  'tax_query' => array(
    array(
      'taxonomy' => 'weeklytype',
      'field'    => 'slug',
      'terms'    => 'reviews',
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
      'terms'    => 'reviews',
    ),
  ),
);
$weeklies_section_title = 'So-Far Reviews';
global $weeklies_args;
global $weeklies_section_title;

get_template_part('partials/weeklies');

$top_weekly_args = array(
  'post_type' => 'weekly',
  'posts_per_page' => 1,
  'tax_query' => array(
    array(
      'taxonomy' => 'weeklytype',
      'field'    => 'slug',
      'terms'    => 'friendships',
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
      'terms'    => 'friendships',
    ),
  ),
);
$weeklies_section_title = 'So-Far Friendships';
global $weeklies_args;
global $weeklies_section_title;

get_template_part('partials/weeklies');
?>

  <section class="padding-bottom-basic">
    <div class="container">
      <div class="grid-row justify-center">
        <div class="grid-item item-s-12 item-m-9 item-l-6 text-align-center margin-top-small padding-top-small border-top">
          <a href="<?php echo get_post_type_archive_link('weekly'); ?>" class="link-underline font-uppercase font-size-small font-heavy">View Weeklies Archive</a>
        </div>
      </div>
    </div>
  </section>
</main>

<?php
get_footer();
?>
