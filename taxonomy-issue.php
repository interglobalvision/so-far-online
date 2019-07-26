<?php
get_header();

$now = time();

$issue_id = get_queried_object()->term_id;

$chapters = get_terms( array(
  'taxonomy' => 'issue',
  'parent' => $issue_id,
  'number' => 1,
  'orderby' => 'meta_value_num',
  'meta_key' => '_igv_publish_date',
  'meta_query' => array(
    array(
      'key'     => '_igv_publish_date',
      'value'   => $now,
      'compare' => '<='
    ),
  ),
  'hide_empty' => true,
) );
?>

<main id="main-content">

<?php
if (count($chapters) > 0) {
  $issue = get_term($issue_id);
  $issue_number = get_term_meta($issue_id, '_igv_issue_number', true);

  foreach ($chapters as $index => $chapter) {
    $chapter_number = get_term_meta($chapter->term_id, '_igv_issue_number', true);
    $background_class = $index % 1 ? 'background-pale' : '';

    $articles_args = array(
      'post_type' => 'post',
      'tax_query' => array(
        array(
          'taxonomy' => 'issue',
          'field' => 'term_id',
          'terms' => $chapter->term_id,
        ),
      ),
      'posts_per_page' => -1,
    );

    $articles_query = new WP_Query($articles_args);
?>

  <section <?php post_class($background_class . ' padding-top-small padding-bottom-small'); ?> id="term-<?php echo $chapter->term_id; ?>">
    <div class="container">
      <div class="grid-row padding-bottom-small">
        <div class="grid-item item-s-12 item-l-11 offset-l-1">
          <h1><?php
            echo 'Issue';
            echo !empty($issue_number) ? $issue_number . ': ' : ': ';
            echo $issue->name;
          ?></h1>
        </div>
      </div>
      <div class="grid-row">
        <div class="grid-item item-s-12 item-m-8 offset-m-2 item-l-6 offset-l-3 padding-bottom-basic">
          <div class="text-align-center">
            <span>Chapter<?php echo !empty($chapter_number) ? ' ' . $chapter_number : ''; ?></span>
            <h2 class="padding-bottom-small"><?php echo $chapter->name; ?></h2>
          </div>
          <?php if (!empty($chapter->description)) { ?>
          <div>
            <?php echo apply_filters('the_content', $chapter->description); ?>
          </div>
          <?php } ?>
        </div>
      </div>
      <?php
      if ($articles_query->have_posts()) {
      ?>
      <div class="swiper-container" data-carousel-type="scroll">
        <div class="swiper-wrapper padding-bottom-small">
        <?php
          while ($articles_query->have_posts()) {
            $articles_query->the_post();
            $authors = get_name_list($post->ID, 'contributor');
        ?>
          <div class="swiper-slide text-align-center">
            <div><span>Published on <?php echo get_the_date(); ?></span></div>
            <div>
              <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail(); ?>
                <h3 class="margin-bottom-micro"><?php the_title(); ?></h3>
              </a>
            </div>
            <div class="padding-bottom-tiny"><span><?php echo $authors ? 'by ' . $authors : ''; ?></span></div>
          </div>
        <?php
          }
        ?>
        </div>
        <div class="swiper-scrollbar"></div>
      </div>
      <?php
      }
      wp_reset_postdata();
      ?>
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
