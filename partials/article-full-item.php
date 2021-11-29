<?php
global $index;
global $issue_number;
global $issue;
global $chapter_number;
global $chapter;
global $pale;

$featured_caption = get_post_meta($post->ID, '_igv_featured_caption', true);
$subtitle = get_post_meta($post->ID, '_igv_subtitle', true);
$contributor_names = get_name_list($post->ID, 'contributor');
$artist_names = get_name_list($post->ID, 'artist');
$reverse = $index % 2;
$background_class = $reverse || $index === 0 || $pale === true ? 'background-pale' : '';
$the_date = get_the_date('j F, Y');
$weekly_type = get_the_terms($post, 'weeklytype');
$post_type = get_post_type($post);
?>

<article <?php post_class($background_class . ' padding-top-small padding-bottom-basic'); ?> id="post-<?php the_ID(); ?>">
  <div class="container">
    <?php if ($chapter || $post_type === 'weekly') { ?>
    <div class="desktop-only">
      <div class="grid-row padding-bottom-small font-size-small font-uppercase">
        <div class="grid-item item-l-7 offset-l-1 <?php echo $post_type === 'weekly' ? 'font-color-blush' : ''; ?>">
          <?php
            if ($post_type === 'weekly' && !empty($weekly_type)) {
          ?>
            <a href="<?php echo get_term_link($weekly_type[0]->term_id); ?>"><?php echo $weekly_type[0]->name; ?></a>
          <?php
            } else if ($post_type === 'post' && $issue) {
          ?>
            <span><?php
              echo '<a href="' . get_term_link($issue->term_id) . '">';
              echo 'Issue';
              echo !empty($issue_number) ? ' ' . $issue_number . ': ' : ': ';
              echo $issue->name;
              echo '</a>';
            ?></span>
          <?php
            }
          ?>
        </div>
        <div class="grid-item item-l-3">
          <span>
            <?php
              if ($post_type === 'weekly') {
                echo $the_date;
              }
              if ($post_type === 'post') {
                echo $issue ? '<a href="' . get_term_link($issue->term_id) . '">' : '';
                echo 'Chapter';
                echo !empty($chapter_number) ? ' ' . $chapter_number . ': ' : ': ';
                echo $chapter->name;
                echo $issue ? '</a>' : '';
              }
            ?>
          </span>
        </div>
      </div>
    </div>
    <?php } ?>

    <div class="grid-row justify-start <?php echo $reverse ? 'row-l-reverse' : ''; ?>">
      <figure class="grid-item item-s-12 item-l-6 item-xl-7 font-size-zero <?php echo $reverse ? 'text-align-right no-gutter-right' : 'no-gutter-left'; ?>">
        <a href="<?php the_permalink() ?>">
          <?php the_post_thumbnail('article-item'); ?>
        </a>
        <?php if (!empty($featured_caption)) { ?>
          <figcaption class="font-size-small"><?php echo $featured_caption; ?></figcaption>
        <?php } ?>
      </figure>

      <div class="grid-item item-s-12 item-l-6 item-xl-4 no-gutter grid-row align-content-center">
        <div class="grid-item item-s-12">
          <h1 class="font-serif font-size-extra">
            <a href="<?php the_permalink() ?>">
              <?php the_title(); ?>
            </a>
          </h1>
        </div>

        <?php if (!empty($subtitle)) { ?>
        <div class="grid-item item-s-12 font-size-mid margin-top-tiny">
          <span><?php echo $subtitle; ?></span>
        </div>
        <?php } ?>

        <div class="grid-item item-s-12 font-color-grey">
        <?php if ($contributor_names) { ?>
          <div class="margin-top-tiny">
            <span>Text by <?php echo $contributor_names; ?></span>
          </div>
        <?php } if ($artist_names) { ?>
          <div class="margin-top-tiny">
            <span>Artwork by <?php echo $artist_names; ?></span>
          </div>
        <?php } ?>
        </div>
      </div>
    </div>
  </div>
</article>

<?php
