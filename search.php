<?php
get_header();
?>

<main id="main-content" class="background-pale">
  <section class="background-pink border-bottom">
    <?php get_search_form(); ?>
  </section>
<?php
if (have_posts()) {
?>
  <section id="posts">
    <div class="container">
      <div class="grid-row justify-center">
        <h1 class="grid-item item-s-12 font-uppercase font-size-basic padding-top-small padding-bottom-basic text-align-center">Search Results</h1>
      </div>
      <div class="grid-row justify-center" id="posts-holder">
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
?>
      </div>
    </div>
  </section>
<?php
  global $wp_query;
  $max_page = $wp_query->max_num_pages;
  $paged = get_query_var('paged') ? get_query_var('paged') : 1;
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
} else {
?>
  <section id="posts">
    <div class="container">
      <div class="grid-row justify-center">
        <h1 class="grid-item item-s-12 font-uppercase font-size-basic padding-top-small padding-bottom-basic">Nothing Found</h1>
      </div>
    </div>
  </section>
<?php
}
?>

</main>

<?php
get_footer();
?>
