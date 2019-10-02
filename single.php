<?php
get_header();
?>

<main id="main-content">

<?php
if (have_posts()) {
  while (have_posts()) {
    the_post();
    $featured_caption = get_post_meta($post->ID, '_igv_featured_caption', true);
    $subtitle = get_post_meta($post->ID, '_igv_subtitle', true);
    $contributor_names = get_name_list($post->ID, 'contributor');
    $artist_names = get_name_list($post->ID, 'artist');
    $footnotes = get_post_meta($post->ID, '_igv_footnotes', true);
    $artworks = get_post_meta($post->ID, '_igv_article_artworks', true);
    $artists = get_the_terms($post, 'artist');
    $contributors = get_the_terms($post, 'contributor');
    $weekly_type = get_the_terms($post, 'weeklytype');
    $the_date = get_the_date('j F, Y');
    $post_type = get_post_type($post);
    $further_reading = get_post_meta($post->ID, '_igv_article_related', true);
    $publish_date = get_post_meta($post->ID, '_igv_publish_date', true);

    $issue = false;
    $chapter = false;

    $issue_terms = get_terms(array(
      'taxonomy' => 'issue',
      'parent' => 0
    ));

    if (!empty($issue_terms)) {
      $issue = $issue_terms[0];
      if ($issue) {
        $chapter_terms = get_terms(array(
          'taxonomy' => 'issue',
          'parent' => $issue->term_id
        ));
        if (!empty($chapter_terms)) {
          $chapter = $chapter_terms[0];
          $chapter_number = get_term_meta($chapter->term_id, '_igv_issue_number', true);
          $issue_number = get_term_meta($issue->term_id, '_igv_issue_number', true);
        }
      }
    }
?>

        <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
          <header class="padding-bottom-basic">
            <div class="container">
              <?php if ($issue || $post_type === 'weekly') { ?>
                <div class="grid-row padding-top-small padding-bottom-small font-uppercase">
                  <div class="grid-item item-s-12 item-l-7 offset-l-1">
                    <span>
                      <?php
                        if ($post_type === 'weekly') {
                          echo !empty($weekly_type) ? $weekly_type[0]->name : '';
                        }
                        if ($post_type === 'post') {
                          echo 'Issue';
                          echo !empty($issue_number) ? ' ' . $issue_number . ': ' : ': ';
                          echo $issue->name;
                        }
                      ?>
                    </span>
                  </div>
                  <div class="grid-item item-s-12 item-l-3">
                    <span>
                      <?php
                        if ($post_type === 'weekly') {
                          echo $the_date;
                        }
                        if ($post_type === 'post' && $chapter) {
                          echo 'Chapter';
                          echo !empty($chapter_number) ? ' ' . $chapter_number . ': ' : ': ';
                          echo $chapter->name;
                        }
                      ?>
                    </span>
                  </div>
                </div>
              <?php } ?>

              <div class="grid-row justify-end row-l-reverse">
                <div class="grid-item item-s-12 item-l-6 item-xl-4 no-gutter grid-row align-content-end">
                  <div class="grid-item item-s-12 margin-bottom-basic">
                    <h1 class="font-serif font-size-extra"><?php the_title(); ?></h1>
                  </div>
                  <?php if (!empty($subtitle)) { ?>
                  <div class="grid-item item-s-12 font-size-mid">
                    <span><?php echo $subtitle; ?></span>
                  </div>
                  <?php } if ($contributor_names || $artist_names) { ?>
                  <div class="grid-item item-s-12 offset-l-4 offset-xl-3 margin-top-small margin-bottom-small font-color-grey">
                  <?php if ($contributor_names) { ?>
                    <div class="margin-top-tiny">
                      <span>Text by <?php echo $contributor_names; ?></span>
                    </div>
                  <?php } if ($artist_names) { ?>
                    <div class="margin-top-tiny">
                      <span>Artwork by <?php echo $artist_names; ?></span>
                    </div>
                  <?php } if (!empty($publish_date)) { ?>
                    <div class="margin-top-tiny">
                      <span>Published on <?php echo $publish_date; ?></span>
                    </div>
                  <?php } ?>
                  </div>
                  <?php } ?>
                </div>

                <figure class="grid-item item-s-12 item-l-6 item-xl-7 no-gutter-left font-size-zero">
                  <?php the_post_thumbnail('article-item'); ?>
                  <?php if (!empty($featured_caption)) { ?>
                    <figcaption class="font-size-small"><?php echo $featured_caption; ?></figcaption>
                  <?php } ?>
                </figure>
              </div>
            </div>
          </header>

          <section class="padding-bottom-small">
            <div class="container">
              <div id="article-content" class="font-serif font-light">
                <?php the_content(); ?>
              </div>
            </div>
          </section>

          <!--section class="padding-bottom-basic">
            <div class="container">
              <div class="grid-row">
                <div class="grid-item no-gutter grid-row item-s-12 item-l-8 offset-l-2 justify-end">
                  <div class="grid-item"><span>Share</span></div>
                  <div class="grid-item">
                    <a href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>">Tweet</a>
                    <a href="mailto:?body=<?php the_permalink(); ?>">Email</a>
                  </div>
                </div>
              </div>
            </div>
          </section-->

        <?php if (!empty($artworks)) { ?>
          <section class="padding-top-small padding-bottom-basic">
            <div class="container">
              <h2 class="text-align-center font-uppercase padding-bottom-basic font-size-large">Featured Artworks</h2>
              <div class="grid-row justify-center">
              <?php
                foreach ($artworks as $artwork_id) {
                  $artwork_artists = get_name_list($artwork_id, 'artist');
                  $artwork_title = get_post_meta($artwork_id, '_igv_artwork_title', true);
                  $artwork_year = get_post_meta($artwork_id, '_igv_artwork_year', true);
                  $product_handle = get_post_meta($artwork_id, '_gws_product_handle', true);
              ?>
                <div class="gws-product grid-item grid-item-product item-s-6 item-m-4 item-l-3 margin-bottom-small"
                data-gws-product-handle="<?php echo $product_handle; ?>"
                data-gws-available="true"
                >
                  <a class="font-size-small" href="<?php echo get_the_permalink($artwork_id); ?>">
                    <div class="thumb-holder product-item-thumb-holder margin-bottom-micro">
                      <div class="thumb" style="background-image: url('<?php echo get_the_post_thumbnail_url($artwork_id, 'product-item'); ?>')"></div>
                    </div>
                    <div class="product-item-details">
                      <?php echo !empty($artwork_artists) ? '<div class="font-heavy"><span>' . $artwork_artists . '</span></div>' : ''; ?>
                      <div>
                        <?php
                          echo !empty($artwork_title) ? '<h3 class="u-inline font-italic">' . $artwork_title . '</h3>' : '';
                          echo !empty($artwork_title) && !empty($artwork_year) ? ', ' : '';
                          echo !empty($artwork_year) ? '<span>' . $artwork_year . '</span>' : '';
                        ?>
                      </div>
                      <div class="product-price"><span class="gws-product-price"></span></div>
                      <div class="product-sold"><span>Sold</span></div>
                    </div>
                  </a>
                </div>
              <?php } ?>
              </div>
              <div class="grid-row justify-center padding-top-small">
                <div>
                  <a class="button" href="<?php echo home_url('shop'); ?>">Visit the Shop</a>
                </div>
              </div>
            </div>
          </section>

        <?php } if (!empty($footnotes)) { ?>

          <section class="padding-top-small padding-bottom-small background-pale">
            <div class="container">
              <div class="grid-row justify-center">
                <div class="grid-item item-s-12 item-l-8">
                  <h2 class="font-uppercase padding-bottom-small font-size-basic">Footnotes</h2>
                  <ol class="font-size-small">
                  <?php foreach($footnotes as $index => $footnote) { ?>
                    <li class="margin-bottom-tiny" id="footnote-ref-<?php echo $index + 1; ?>"><a class="js-footnote-ref" href="#" data-ref="<?php echo $index + 1; ?>"><?php echo $footnote; ?></a></li>
                  <?php } ?>
                  </ol>
                </div>
              </div>
            </div>
          </section>

        <?php } if ($artists || $contributors) { ?>
          <?php
            $artists = !$artists ? array() : $artists;
            $contributors = !$contributors ? array() : $contributors;
            $dups = [];

            foreach($artists as $artist_key => $artist_value) {
              foreach ($contributors as $contributor_key => $contributor_value) {
                if ($artist_value->slug === $contributor_value->slug) {
                  array_push($dups, $contributor_key);
                }
              }
            }

            foreach($dups as $key => $value) {
              unset($contributors[$value]);
            };

            $bios = array_merge($artists, $contributors);
          ?>
          <section class="padding-top-small padding-bottom-small">
            <div class="container">
              <h2 class="text-align-center font-uppercase padding-bottom-small font-size-large">Artists & Contributors</h2>
              <?php
                foreach($bios as $bio) {
                  global $bio;
                  get_template_part('partials/bio');
                }
              ?>
            </div>
          </section>
        <?php } if (!empty($further_reading)) { ?>
          <section class="padding-top-small padding-bottom-small">
            <div class="container">
              <h2 class="text-align-center font-uppercase padding-bottom-small font-size-large">Further Reading</h2>
              <div class="grid-row justify-center">
              <?php
                foreach($further_reading as $id) {
                  $result_id = $id;
                  global $result_id;
              ?>
                <article <?php post_class('grid-item item-s-6 item-m-4 item-l-3 margin-bottom-basic text-align-center'); ?> id="post-<?php echo $result_id; ?>">
                  <?php get_template_part('partials/search-result'); ?>
                </article>
              <?php
                }
              ?>
              </div>
            </div>
          </section>
        <?php } ?>
        </article>

<?php
  }
}
?>

</main>

<?php
get_footer();
?>
