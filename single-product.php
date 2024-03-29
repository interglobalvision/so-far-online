<?php
get_header();
?>

<main id="main-content">

<?php
get_template_part('partials/shop-filter');

if (have_posts()) {
  while (have_posts()) {
    the_post();
    $images = get_post_meta($post->ID, '_igv_artwork_images', true);
    $artist_names = get_name_list($post->ID, 'artist');
    $title = get_post_meta($post->ID, '_igv_artwork_title', true);
    $year = get_post_meta($post->ID, '_igv_artwork_year', true);
    $specs = get_post_meta($post->ID, '_igv_artwork_specs', true);
    $artists = get_the_terms($post, 'artist');
    $authenticity = get_post_meta($post->ID, '_igv_product_authenticity', true);
    $framing = get_post_meta($post->ID, '_igv_product_framing', true);
    $shipping = get_post_meta($post->ID, '_igv_product_shipping', true);
    $mediums = get_the_terms($post, 'medium');
    $price = get_post_meta($post->ID, '_igv_product_price', true);
    $inventory = get_post_meta($post->ID, '_igv_product_inventory', true);
?>

    <article
      <?php post_class(); ?>
      id="post-<?php the_ID(); ?>"
      data-post-id="<?php the_ID(); ?>" 
      data-in-cart=""
      data-inventory="<?php echo $inventory; ?>"
    >

      <section class="padding-top-small padding-bottom-small">
        <div class="container">
          <div class="grid-row">
            <div class="grid-item item-s-12 item-l-7 offset-l-1">
            <?php if (!empty($images)) { ?>
              <div class="swiper-container" data-swiper-type="slide">
                <div class="swiper-wrapper">
                <?php foreach ($images as $image) { ?>
                  <div class="swiper-slide trigger-overlay grid-row justify-center align-items-center">
                    <div>
                      <?php
                        $attachment_url = str_replace('//wp-content', '/wp-content', $image);
                        echo wp_get_attachment_image(attachment_url_to_postid($attachment_url), 'product-slide');
                      ?>
                    </div>
                  </div>
                <?php } ?>
                </div>
              </div>
              <!--div class="slide-pagination text-align-center margin-top-micro <?php echo count($images) === 1 ? 'u-hidden' : ''; ?>">
              </div-->
            <?php } ?>
            </div>
            <div class="grid-item item-s-12 item-l-3">
              <h1 class="u-visuallyhidden"><?php the_title(); ?></h1>
              <?php echo !empty($artist_names) ? '<div class="margin-bottom-tiny margin-top-tiny"><span>' . $artist_names . '</span></div>' : ''; ?>
              <?php
                echo !empty($title) || !empty($year) ? '<div class="margin-bottom-micro">' : '';
                echo !empty($title) ? '<span class="font-italic">' . $title . '</span>' : '';
                echo !empty($title) && !empty($year) ? ', ' : '';
                echo !empty($year) ? '<span>' . $year . '</span>' : '';
                echo !empty($title) || !empty($year) ? '</div>' : '';
              ?>
              <?php if (!empty($specs)) { ?>
              <ul class="font-color-grey font-size-small">
                <?php foreach ($specs as $spec) { ?>
                <li class="margin-bottom-micro"><?php echo $spec; ?></li>
                <?php } ?>
              </ul>
              <?php } if (!empty($images)) { ?>
              <div class="padding-top-tiny padding-bottom-small desktop-only font-color-grey font-size-small">
                <span class="<?php echo count($images) === 1 ? 'u-hidden' : ''; ?>">More views of this artwork </span>
              </div>
              <div class="margin-bottom-small desktop-only font-color-grey <?php echo count($images) === 1 ? 'u-hidden' : ''; ?>">
                <div class="grid-row align-items-center">
                  <div class="slide-prev-holder">
                    <span class="slide-prev u-pointer"><img class="slide-pagination-icon" src="<?php bloginfo('stylesheet_directory'); ?>/dist/img/icon-prev.png" /></span>
                  </div>
                  <div>
                    <span><span class="slide-current">1</span>/<span><?php echo count($images); ?></span></span>
                  </div>
                  <div class="slide-next-holder">
                    <span class="slide-next u-pointer"><img class="slide-pagination-icon" src="<?php bloginfo('stylesheet_directory'); ?>/dist/img/icon-next.png" /></span>
                  </div>
                </div>
              </div>
              <?php } ?>

              <div class="margin-bottom-tiny font-color-grey">
                <?php productPrice($post->ID, 'font-size-mid'); ?>
              </div>

              <div>
                <button 
                  type="submit" 
                  data-post-id="<?php the_ID(); ?>" 
                  data-price="<?php echo !empty($price) ? $price : ''; ?>"
                  class="button add-to-cart item-s-6 item-m-4 item-l-12">Purchase this Artwork</button>
                <button class="button item-in-cart item-s-6 item-m-4 item-l-12" disabled>Added to Bag</button>
                <div class="sold-out item-s-6 item-m-4 item-l-12 font-bold font-color-grey"><span>Sold Out</span></div>
              </div>
              
              <div class="padding-top-tiny font-size-tiny font-color-grey font-light">
                <span>Contact <a href="team@so-far.online" class="link-underline">team@so-far.online</a> if you would like to purchase in installments. We can create a payment plan tailored to your needs. For collectors in the US, Australia or New Zealand, we partner with Art Money: 10 payments, 10 months, no interest.</span>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="padding-top-basic padding-bottom-basic background-pale">
        <div class="container">
          <div class="grid-row">
            <div class="grid-item item-s-12 item-l-7 offset-l-1">
              <h3 class="margin-bottom-tiny">Description</h3>
              <div class="font-size-mid"><?php the_content(); ?></div>
            </div>
            <div class="grid-item item-s-12 item-l-3 grid-row align-content-start">
            <?php if (!empty($authenticity)) { ?>
              <div class="margin-bottom-tiny item-s-12 item-m-4 item-l-12">
                <h3 class="margin-bottom-tiny">Authenticity</h3>
                <div class="font-size-small">
                  <?php echo apply_filters('the_content', $authenticity); ?>
                </div>
              </div>
            <?php } if (!empty($framing)) { ?>
              <div class="margin-bottom-tiny item-s-12 item-m-4 item-l-12">
                <h3 class="margin-bottom-tiny">Framing & Installation</h3>
                <div class="font-size-small">
                  <?php echo apply_filters('the_content', $framing); ?>
                </div>
              </div>
            <?php } if (!empty($shipping)) { ?>
              <div class="item-s-12 item-m-4 item-l-12">
                <h3 class="margin-bottom-tiny">Shipping & Taxes</h3>
                <div class="font-size-small">
                  <?php echo apply_filters('the_content', $shipping); ?>
                </div>
              </div>
            <?php } ?>
            </div>
          </div>
        </div>
      </section>

    </article>

<?php
    if($artists) {
?>
    <section class="padding-top-small padding-bottom-small">
      <div class="container">
        <h2 class="text-align-center font-uppercase padding-bottom-small font-size-large">Meet the Artist</h2>
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
      <h2 class="text-align-center font-uppercase background-pale padding-top-small font-size-large">This artwork appears in...</h2>
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

    $products_query = query_products_by_artists_then_mediums($artists, $mediums);

    if ($products_query->have_posts()) {
  ?>
  <section class="padding-bottom-basic background-pale">
    <div class="container">
      <h2 class="text-align-center font-uppercase background-pale padding-top-small padding-bottom-small font-size-large">More like this</h2>
      <div class="grid-row justify-center">
        <?php
          while ($products_query->have_posts()) {
            $products_query->the_post();
            get_template_part('partials/product-item');
          }
        ?>
      </div>
      <div class="grid-row justify-center padding-top-small">
        <div>
          <a class="button" href="<?php echo home_url('shop'); ?>">Visit the Shop</a>
        </div>
      </div>
    </div>
  </section>
<?php
    }

    wp_reset_postdata();
  }
}

if (!empty($images)) {
  global $images;
  get_template_part('partials/overlay-gallery');
}
?>
</main>

<?php
get_footer();
?>
