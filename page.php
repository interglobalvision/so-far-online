<?php
get_header();
?>

<main id="main-content">

<?php
if (have_posts()) {
  while (have_posts()) {
    the_post();
    $intro = get_post_meta($post->ID, '_igv_page_intro', true);
?>

  <article <?php post_class('padding-top-small padding-bottom-basic'); ?> id="post-<?php the_ID(); ?>">
    <div class="container">
      <div class="grid-row justify-center">
        <div class="grid-item item-s-10 item-m-9 item-l-8 item-xl-7 item-xxl-6">
          <h1 class="text-align-center font-uppercase padding-bottom-small font-size-large"><?php the_title(); ?></h1>
          <?php the_content(); ?>
        </div>
      </div>
    </div>
  </article>

<?php
  }
}
?>

</main>

<?php
get_footer();
?>
