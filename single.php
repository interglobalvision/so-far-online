<?php
get_header();
?>

<main id="main-content">
  <div class="container">

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
?>

        <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
          <header>
            <?php if ($chapter) { ?>
              <div class="grid-row">
                <div class="grid-item item-s-12 item-l-7 offset-l-1">
                  <span><?php
                    echo 'Issue';
                    echo !empty($issue_number) ? $issue_number . ': ' : ': ';
                    echo $issue->name;
                  ?></span>
                </div>
                <div class="grid-item item-s-12 item-l-3">
                  <span><?php
                    echo 'Chapter ';
                    echo !empty($chapter_number) ? $chapter_number . ': ' : ': ';
                    echo $chapter->name;
                  ?></span>
                </div>
              </div>
            <?php } ?>

            <div class="grid-row justify-end row-l-reverse">
              <div class="grid-item item-s-12 item-l-6 item-xl-4 no-gutter grid-row align-content-end">
                <div class="grid-item item-s-12">
                  <h3><?php the_title(); ?></h3>
                </div>
                <?php if (!empty($subtitle)) { ?>
                <div class="grid-item item-s-12">
                  <span><?php echo $subtitle; ?></span>
                </div>
                <?php } ?>
                <div class="grid-item item-s-12 offset-m-4 offset-l-2 offset-xl-4">
                <?php if ($contributor_names) { ?>
                  <div>
                    <span>Text by: <?php echo $contributor_names; ?></span>
                  </div>
                <?php } if ($artist_names) { ?>
                  <div>
                    <span>Artwork by: <?php echo $artist_names; ?></span>
                  </div>
                <?php } ?>
                </div>
              </div>

              <div class="grid-item item-s-12 item-l-6 item-xl-7 no-gutter">
                <?php the_post_thumbnail(); ?>
                <?php if (!empty($featured_caption)) { ?>
                  <div><span><?php echo $featured_caption; ?></span></div>
                <?php } ?>
              </div>
            </div>
          </header>

          <div id="article-content" class="grid-row">
            <?php the_content(); ?>
          </div>

          <div class="grid-row">
            <div class="grid-item no-gutter grid-row item-s-12 item-l-8 offset-l-2 justify-end">
              <div class="grid-item"><span>Share</span></div>
              <div class="grid-item">
                <a href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>">Tweet</a>
                <a href="mailto:?body=<?php the_permalink(); ?>">Email</a>
              </div>
            </div>
          </div>

        <?php if (!empty($artworks)) { ?>

          <h2 class="text-align-center font-uppercase">Recent Artworks</h2>
          <div class="grid-row justify-end">
          <?php
            foreach ($artworks as $artwork_id) {
              $artwork_artists = get_name_list($artwork_id, 'artist');
              $artwork_title = get_post_meta($artwork_id, '_igv_artwork_title', true);
              $artwork_year = get_post_meta($artwork_id, '_igv_artwork_year', true);
          ?>
            <div class="grid-item item-s-12 item-l-3 no-gutter">
              <div><?php echo get_the_post_thumbnail($artwork_id); ?></div>
              <div><span><?php echo !empty($artwork_artists) ? $artwork_artists : ''; ?></span></div>
              <div><span>
                <?php
                  echo !empty($artwork_title) ? $artwork_title : '';
                  echo !empty($artwork_title) && !empty($artwork_year) ? ', ' : '';
                  echo !empty($artwork_year) ? $artwork_year : '';
                ?>
              </span></div>
            </div>
          <?php } ?>
          </div>

        <?php } if (!empty($footnotes)) { ?>

          <div class="grid-row justify-center">
            <div class="grid-item item-s-12 item-l-8">
              <ol>
              <?php foreach($footnotes as $index => $footnote) { ?>
                <li id="footnote-ref-<?php echo $index + 1; ?>"><a href="#article-ref-<?php echo $index + 1; ?>"><?php echo $footnote; ?></a></li>
              <?php } ?>
              </ol>
            </div>
          </div>

        <?php } if ($artists || $contributors) { ?>
          <?php
            $artists = !$artists ? array() : $artists;
            $contributors = !$contributors ? array() : $contributors;
            $bios = array_merge($artists, $contributors);
          ?>
          <div>
            <h2 class="text-align-center font-uppercase">Artists & Contributors</h2>
          <?php
            foreach($bios as $bio) {
              $birth_year = get_term_meta($bio->term_id, '_igv_bio_year', true);
              $bio_photo_id = get_term_meta($bio->term_id, '_igv_bio_photo_id', true);
          ?>
            <div class="grid-row justify-center">
              <div class="grid-item item-s-6 item-l-3">
                <?php echo !empty($bio_photo_id) ? wp_get_attachment_image($bio_photo_id, 'full') : ''; ?>
              </div>
              <div class="grid-item item-s-6 mobile-only">
                <div><span><?php echo $bio->name; ?></span></div>
                <div><span><?php echo !empty($birth_year) ? 'b. ' . $birth_year : ''; ?></span></div>
              </div>
              <div class="grid-item item-s-12 item-l-5">
                <div class="desktop-only">
                  <div><span><?php echo $bio->name; ?></span></div>
                  <div><span><?php echo !empty($birth_year) ? 'b. ' . $birth_year : ''; ?></span></div>
                </div>
                <div>
                  <?php echo $bio->description; ?>
                </div>
              </div>
            </div>
          <?php } ?>
          </div>
        <?php } ?>
        </article>

<?php
  }
}
?>

  </div>
</main>

<?php
get_footer();
?>
