<?php
get_header();
?>

<main id="main-content">
  <?php get_search_form(); ?>
  <section id="posts">
    <class="container">
      <div class="grid-row justify-center">
        <h1 class="grid-item item-s-12 font-uppercase font-size-basic padding-top-small padding-bottom-basic">Search Results</h1>

  <?php
  if (have_posts()) {
    while (have_posts()) {
      the_post();
      $post_type = get_post_type($post);
      $title = $post_type === 'product' ? get_post_meta($post->ID, '_igv_artwork_title', true) : get_the_title();
  ?>

          <article <?php post_class('grid-item item-s-12 item-m-6 item-l-4 margin-bottom-basic'); ?> id="post-<?php the_ID(); ?>">

            <a href="<?php the_permalink() ?>">
              <h3 class="font-serif"><?php echo $title; ?></h3>
            </a>

          </article>

  <?php
    }
  }
  ?>

      </div>
    </div>
  </section>
</main>

<?php
get_footer();
?>
