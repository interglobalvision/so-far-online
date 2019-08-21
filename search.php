<?php
get_header();
?>

<main id="main-content" class="background-pale">
  <section class="background-pink border-bottom">
    <?php get_search_form(); ?>
  </section>
  <section id="posts">
    <class="container">
      <div class="grid-row justify-center">
<?php
if (have_posts()) {
?>
        <h1 class="grid-item item-s-12 font-uppercase font-size-basic padding-top-small padding-bottom-basic">Search Results</h1>
<?php
  while (have_posts()) {
    the_post();
    $post_type = get_post_type($post);
    $title = $post_type === 'product' ? get_post_meta($post->ID, '_igv_artwork_title', true) : get_the_title();
    $contributors = $post_type === 'product' ? get_name_list($post->ID, 'artist') : get_name_list($post->ID, 'contributor');
?>

        <article <?php post_class('grid-item item-s-6 item-m-5 margin-bottom-basic text-align-center'); ?> id="post-<?php the_ID(); ?>">

          <a href="<?php the_permalink() ?>">
            <div class="font-color-grey font-size-tiny margin-bottom-micro font-uppercase">
              <span><?php
                switch ($post_type) {
                  case 'product':
                    echo 'artwork';
                    break;
                  case 'weekly':
                    $type = get_weekly_type($post->ID);
                    echo $type ? $type : '&nbsp;';
                    break;
                  case 'post':
                    echo 'article';
                    break;
                  default:
                    echo '&emsp;';
                };
              ?></span>
            </div>
            <div class="thumb-holder search-result-thumb-holder">
              <div class="thumb" style="background-image: url('<?php echo get_the_post_thumbnail_url($post, 'full'); ?>')"></div>
            </div>
            <h3 class="font-serif margin-top-micro"><?php echo $title; ?></h3>
            <?php
              if ($contributors) {
            ?>
            <div class="font-color-grey margin-top-micro font-size-small">
              <span><?php echo $contributors; ?></span>
            </div>
            <?php
              }
            ?>
          </a>

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
