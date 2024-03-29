<?php
get_header();
?>

<main id="main-content">


<?php
if (have_posts()) {
?>
  <section id="posts">
    <div class="container">
      <div class="grid-row justify-center">
        <h1 class="grid-item item-s-12 font-uppercase font-size-large font-heavy padding-top-small padding-bottom-small text-align-center font-color-blush">All Weeklies</h1>
      </div>
      <div class="grid-row justify-center" id="posts-holder">
<?php
  while (have_posts()) {
    the_post();
    $contributor_names = get_name_list($post->ID, 'contributor');
    $subtitle = get_post_meta($post->ID, '_igv_subtitle', true);
    $the_date = get_the_date('j F, Y');
    $weekly_type = get_the_terms($post, 'weeklytype');
?>
        <article <?php post_class('grid-item no-gutter item-s-12 padding-bottom-small grid-row'); ?> id="post-<?php the_ID(); ?>">
          <div class="grid-item item-s-12 item-m-4 offset-m-1 padding-bottom-small">
            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('article-item'); ?></a>
          </div>
          <div class="grid-item item-s-12 item-m-7 padding-bottom-small no-gutter grid-row align-content-between">
            <div class="grid-row item-s-12 justify-between">
              <div class="grid-item item-s-6 margin-bottom-tiny font-color-grey font-heavy font-size-small">
                <span><?php echo $contributor_names ? $contributor_names : ''; ?></span>
              </div>
              <div class="grid-item item-s-auto item-m-6 margin-bottom-tiny font-color-grey font-heavy font-size-small font-uppercase">
                <span><?php echo $the_date; ?></span>
              </div>
            </div>
            <h2 class="grid-item item-s-10 font-size-mid margin-bottom-micro"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <div class="grid-item item-s-10 margin-bottom-micro"><span><?php echo !empty($subtitle) ? $subtitle : ''; ?></span></div>
            <div class="grid-item item-s-6 font-size-small font-uppercase font-heavy font-color-blush"><?php if ($weekly_type) { ?>
              <a href="<?php echo get_term_link($weekly_type[0]->term_id); ?>"><?php echo $weekly_type[0]->name; ?></a>
            <?php } ?></div>
          </div>
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
}
?>
</main>

<?php
get_footer();
?>
