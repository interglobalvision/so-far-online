<?php
get_header();
?>

<main id="main-content">
  <?php
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
