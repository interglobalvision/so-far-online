<?php
get_header();
$options = get_site_option('_igv_site_options');
?>

<main id="main-content">

<?php
if (have_posts()) {
  while (have_posts()) {
    the_post();
    $product_handle = get_post_meta($post->ID, '_gws_product_handle', true);
    $images = get_post_meta($post->ID, '_igv_artwork_images', true);
    $artist_names = get_name_list($post->ID, 'artist');
    $title = get_post_meta($post->ID, '_igv_artwork_title', true);
    $specs = get_post_meta($post->ID, '_igv_artwork_specs', true);
    $artists = get_the_terms($post, 'artist');
?>

    <article <?php post_class('gws-product'); ?> id="post-<?php the_ID(); ?>" data-gws-product-handle="<?php echo $product_handle; ?>">

      <section class="padding-top-small padding-bottom-small">
        <div class="container">
          <div class="grid-row">
            <div class="grid-item item-s-12 item-l-7 offset-l-1">
            <?php if (!empty($images)) { ?>
              <div class="swiper-container" data-carousel-type="slide">
                <div class="swiper-wrapper">
                <?php foreach ($images as $image) { ?>
                  <div class="swiper-slide">
                    <?php echo wp_get_attachment_image(attachment_url_to_postid($image)); ?>
                  </div>
                <?php } ?>
                </div>
              </div>
            <?php } ?>
            </div>
            <div class="grid-item item-s-12 item-l-3">
              <h1 class="u-visuallyhidden"><?php the_title(); ?></h1>
              <?php echo !empty($artist_names) ? '<div><span>' . $artist_names . '</span></div>' : ''; ?>
              <?php echo !empty($title) ? '<div><span>' . $title . '</span></div>' : ''; ?>
              <?php if (!empty($specs)) { ?>
              <ul>
                <?php foreach ($specs as $spec) { ?>
                <li><?php echo $spec; ?></li>
                <?php } ?>
              </ul>
              <?php } if (!empty($images)) { ?>
              <div>
                <span class="slide-prev u-pointer"><</span>
                <span><span class="current-slide">1</span>/<span><?php echo count($images); ?></span></span>
                <span class="slide-next u-pointer">></span>
              </div>
              <?php } ?>
              <div><span class="gws-product-price"></span></div>
            </div>
          </div>
        </div>
      </section>

      <section class="padding-top-small padding-bottom-small background-pale">
        <div class="container">
          <div class="grid-row">
            <div class="grid-item item-s-12 item-l-7 offset-l-1">
              <h3>Description</h3>
              <?php the_content(); ?>
            </div>
            <div class="grid-item item-s-12 item-l-3 grid-row">
            <?php if (!empty($options['product_authenticity'])) { ?>
              <div>
                <h3>Authenticity</h3>
                <div>
                  <?php echo apply_filters('the_content', $options['product_authenticity']); ?>
                </div>
              </div>
            <?php } if (!empty($options['product_framing'])) { ?>
              <div>
                <h3>Framing & Installation</h3>
                <div>
                  <?php echo apply_filters('the_content', $options['product_framing']); ?>
                </div>
              </div>
            <?php } if (!empty($options['product_shipping'])) { ?>
              <div>
                <h3>Shipping & Taxes</h3>
                <div>
                  <?php echo apply_filters('the_content', $options['product_shipping']); ?>
                </div>
              </div>
            <?php } ?>
            </div>
          </div>
        </div>
      </section>

    </article>

<?php
  }

  if($artists) {
?>
    <section class="padding-top-small padding-bottom-small">
      <div class="container">
        <h2 class="text-align-center font-uppercase padding-bottom-small">Meet the Artist</h2>
        <?php
          foreach($artists as $bio) {
            global $bio;
            get_template_part('partials/bio');
          }
        ?>
      </div>
    </section>
<?php
  }

  $articles_args = array(
    'post_type' => 'post',
    'posts_per_page' => -1,
    'meta_query' => array(
      array(
        'compare' => 'LIKE',
        'value' => strval($post->ID),
        'key' => '_igv_article_artworks',
      ),
    ),
  );

  $articles_query = new WP_Query($articles_args);

  if ($articles_query->have_posts()) {
?>
    <section>
      <h2 class="text-align-center font-uppercase background-pale padding-top-small padding-bottom-small">This artwork appears in...</h2>
<?php
    while ($articles_query->have_posts()) {
      $articles_query->the_post();

      $index = $articles_query->current_post + 1;
      global $index;

      $issue_terms = get_the_terms($post, 'issue');
      $chapter = false;
      if (!empty($issue_terms)) {
        $chapter = $issue_terms[0]->parent !== 0 ? $issue_terms[0] : false;
      }
      if ($chapter) {
        $issue = get_term($chapter->parent);
        $chapter_number = get_term_meta($chapter->term_id, '_igv_issue_number', true);
        $issue_number = get_term_meta($issue->term_id, '_igv_issue_number', true);
      }

      global $issue_number;
      global $issue;
      global $chapter_number;
      global $chapter;

      get_template_part('partials/article-full-item');

    }
?>
    </section>
<?php
  }

  wp_reset_postdata();
}
?>

</main>

<?php
get_footer();
?>
