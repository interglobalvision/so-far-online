<?php
get_header();
?>

<main id="main-content">
<div class="container">
<?php
$now = time();

$issues = get_terms( array(
  'taxonomy' => 'issue',
  'parent' => 0,
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

if (count($issues) > 0) {
  $latest_issue = $issues[0];
  $issue_number = get_term_meta($latest_issue->term_id, '_igv_issue_number', true);

  $chapters = get_terms( array(
    'taxonomy' => 'issue',
    'parent' => $latest_issue->term_id,
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

  if (count($chapters) > 0) {
    $latest_chapter = $chapters[0];
    $chapter_number = get_term_meta($latest_chapter->term_id, '_igv_issue_number', true);

    $articles_args = array(
      'post_type' => 'post',
      'tax_query' => array(
        array(
          'taxonomy' => 'issue',
          'field' => 'term_id',
          'terms' => $latest_chapter->term_id,
        ),
      ),
      'posts_per_page' => -1,
    );

    $articles_query = new WP_Query($articles_args);
    if ($articles_query->have_posts()) {
      while ($articles_query->have_posts()) {
        $articles_query->the_post();
        $index = $articles_query->current_post;
        $featured_caption = get_post_meta($post->ID, '_igv_featured_caption', true);
        $subtitle = get_post_meta($post->ID, '_igv_subtitle', true);
        $contributors = get_name_list($post->ID, 'contributor');
        $artists = get_name_list($post->ID, 'artist');
        $reverse = $index % 2;
        $background_class = $reverse || $index === 0 ? 'background-pale' : '';
?>

  <article <?php post_class($background_class); ?> id="post-<?php the_ID(); ?>">

    <div class="desktop-only">
      <div class="grid-row">
        <div class="grid-item item-l-7 offset-l-1">
          <span><?php
            echo 'Issue';
            echo !empty($issue_number) ? $issue_number . ': ' : ': ';
            echo $latest_issue->name;
          ?></span>
        </div>
        <div class="grid-item item-l-3">
          <span><?php
            echo 'Chapter ';
            echo !empty($chapter_number) ? $chapter_number . ': ' : ': ';
            echo $latest_chapter->name;
          ?></span>
        </div>
      </div>
    </div>

    <div class="grid-row justify-start <?php echo $reverse ? 'row-l-reverse' : ''; ?>">
      <div class="grid-item item-s-12 item-l-6 item-xl-7 no-gutter <?php echo $reverse ? 'text-align-right' : ''; ?>">
        <a href="<?php the_permalink() ?>">
          <?php the_post_thumbnail(); ?>
        </a>
        <?php if (!empty($featured_caption)) { ?>
          <div><span><?php echo $featured_caption; ?></span></div>
        <?php } ?>
      </div>

      <a href="<?php the_permalink() ?>" class="grid-item item-s-12 item-l-6 item-xl-4 no-gutter grid-row align-content-end">
        <div class="grid-item item-s-12">
          <h3><?php the_title(); ?></h3>
        </div>
        <?php if (!empty($subtitle)) { ?>
        <div class="grid-item item-s-12">
          <span><?php echo $subtitle; ?></span>
        </div>
        <?php } ?>
        <div class="grid-item item-s-12 offset-m-4 offset-l-2 offset-xl-4">
        <?php if ($contributors) { ?>
          <div>
            <span>Text by: <?php echo $contributors; ?></span>
          </div>
        <?php } if ($artists) { ?>
          <div>
            <span>Artwork by: <?php echo $artists; ?></span>
          </div>
        <?php } ?>
        </div>
      </a>
    </div>

  </article>

<?php
        if ($index === 0) {
          get_template_part('partials/weeklies');
        }
      }
    } else {
      get_template_part('partials/weeklies');
    }

    wp_reset_postdata();

    $products_args = array(
      'post_type' => 'product',
      'posts_per_page' => 3,
    );

    $products_query = new WP_Query($products_args);
    if ($products_query->have_posts()) {
?>
  <h2 class="text-align-center font-uppercase">Recent Artworks</h2>
  <div class="grid-row justify-end">
<?php
      while ($products_query->have_posts()) {
        $products_query->the_post();
        $artists = get_name_list($post->ID, 'artist');
        $title = get_post_meta($post->ID, '_igv_artwork_title', true);
        $year = get_post_meta($post->ID, '_igv_artwork_year', true);
?>
    <div class="grid-item item-s-12 item-l-3 no-gutter">
      <div><?php the_post_thumbnail(); ?></div>
      <div><span><?php echo !empty($artists) ? $artists : ''; ?></span></div>
      <div><span>
        <?php
          echo !empty($title) ? $title : '';
          echo !empty($title) && !empty($year) ? ', ' : '';
          echo !empty($year) ? $year : '';
        ?>
      </span></div>
    </div>
<?php
      }
?>
  </div>
<?php
    }
  }
}
?>
</div>
</main>

<?php
get_footer();
?>
