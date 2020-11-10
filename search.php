<?php
get_header();
?>

<main id="main-content" class="background-pale">
  <section class="background-pink border-bottom">
    <?php get_search_form(); ?>
  </section>
  <section id="posts">
    <div class="container">
      <div class="grid-row justify-center">
<?php
if (have_posts()) {
?>
        <h1 class="grid-item item-s-12 font-uppercase font-size-basic padding-top-small padding-bottom-basic text-align-center">Search Results</h1>
<?php
  while (have_posts()) {
    the_post();
    $result_id = $post->ID;
    global $result_id;
?>
        <article <?php post_class('grid-item item-s-6 item-m-5 margin-bottom-basic text-align-center'); ?> id="post-<?php the_ID(); ?>">
          <?php get_template_part('partials/search-result'); ?>
        </article>
<?php
  }
} else {
?>
        <h1 class="grid-item item-s-12 font-uppercase font-size-basic padding-top-small padding-bottom-basic">Nothing Found</h1>
<?php
}
?>
      </div>
    </div>
  </section>
</main>

<?php
get_footer();
?>
