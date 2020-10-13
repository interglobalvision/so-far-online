<?php
get_header();
?>
<main id="main-content">
<div class="container">
<?php
if (have_posts()) {
  while (have_posts()) {
    the_post();
    $headline = get_post_meta($post->ID, '_igv_incubator_headline', true);
    $projects_brief = get_post_meta($post->ID, '_igv_incubator_projects_brief', true);
?>
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
  <section class="padding-top-small padding-bottom-basic">
    <div class="grid-row">
      <div class="grid-item item-s-12 item-l-8 offset-l-2">
        <?php if (!empty($headline)) { ?>
        <div class="padding-bottom-small font-size-mid"><span><?php echo $headline; ?></span></div>
        <?php } ?>
        <div><?php the_content(); ?></div>
      </div>
    </div>
  </section>
  <section class="text-align-center padding-bottom-basic">
    <div><?php the_post_thumbnail('about-header'); ?></div>
    <div class="grid-row justify-center">
      <div class="grid-item item-s-12 item-m-9 item-l-6">
        <span class="font-color-grey font-size-small"><?php the_post_thumbnail_caption(); ?></span>
      </div>
    </div>
  </section>
</article>

<?php get_template_part('partials/incubator-carousel'); ?>
<?php
  }
}
?>
</div>
</main>

<?php
get_footer();
?>
