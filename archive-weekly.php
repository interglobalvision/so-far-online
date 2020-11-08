<?php
get_header();
?>

<main id="main-content">
  <section id="posts">
    <div class="container">
      <div class="grid-row justify-center">
<?php
if (have_posts()) {
?>
        <h1 class="grid-item item-s-12 font-uppercase font-size-large font-heavy padding-top-small padding-bottom-small text-align-center">All Weeklies</h1>
<?php
  while (have_posts()) {
    the_post();
    $contributor_names = get_name_list($post->ID, 'contributor');
    $subtitle = get_post_meta($post->ID, '_igv_subtitle', true);
    $the_date = get_the_date('j F, Y');
    $type = get_custom_type_terms($post->ID, 'weeklytype');
?>
        <article <?php post_class('grid-item no-gutter item-s-12 padding-bottom-small grid-row'); ?> id="post-<?php the_ID(); ?>">
          <div class="grid-item item-s-12 item-m-4 offset-m-1 padding-bottom-small">
            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('article-item'); ?></a>
          </div>
          <div class="grid-item item-s-12 item-m-7 padding-bottom-small no-gutter grid-row align-content-between">
            <div class="grid-item item-s-6 margin-bottom-tiny font-color-grey font-heavy font-size-small">
              <span><?php echo $contributor_names ? $contributor_names : ''; ?></span>
            </div>
            <div class="grid-item item-s-6 margin-bottom-tiny font-color-grey font-heavy font-size-small font-uppercase">
              <span><?php echo $the_date; ?></span>
            </div>
            <h2 class="grid-item item-s-6 font-size-mid margin-bottom-micro"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <div class="grid-item item-s-10"><span><?php echo !empty($subtitle) ? $subtitle : ''; ?></span></div>
            <div class="grid-item item-s-6 font-size-small font-uppercase font-heavy font-color-blush"><span><span><?php echo $type ? $type : ''; ?></span></span></div>
          </div>
        </article>
<?php
  }
?>
<?php
}
?>
</main>

<?php
get_footer();
?>
