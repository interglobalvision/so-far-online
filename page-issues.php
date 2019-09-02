<?php
get_header();

$now = time();

$issues = get_terms( array(
  'taxonomy' => 'issue',
  'parent' => 0,
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
foreach ($issues as $index => $issue) {
  $issue_number = get_term_meta($issue->term_id, '_igv_issue_number', true);
  $season = get_term_meta($issue->term_id, '_igv_issue_season', true);
  $subtitle = get_term_meta($issue->term_id, '_igv_subtitle', true);
  $contributors = get_term_meta($issue->term_id, '_igv_issue_contributors', true);
  $image_id = get_term_meta($issue->term_id, '_igv_issue_image_id', true);
  $image_caption = get_term_meta($issue->term_id, '_igv_issue_image_caption', true);
  $background_class = $index % 2 ? '' : 'background-pale' ;
?>
  <section id="term-<?php echo $issue->term_id; ?>" class="padding-bottom-basic <?php echo $background_class; ?>">
    <div class="container">
      <a href="<?php echo get_term_link($issue); ?>">
        <div class="desktop-only">
          <div class="grid-row padding-top-small padding-bottom-small font-size-small font-uppercase">
            <div class="grid-item item-l-7 offset-l-1">
              <span><?php echo !empty($issue_number) ? 'Issue ' . $issue_number : ''; ?></span>
            </div>
            <div class="grid-item item-l-3">
              <span><?php echo !empty($season) ? $season : ''; ?></span>
            </div>
          </div>
        </div>

        <div class="grid-row justify-start">
          <?php if (!empty($image_id)) { ?>
          <figure class="grid-item item-s-12 item-l-6 item-xl-7 no-gutter-left font-size-zero">
            <?php echo wp_get_attachment_image($image_id, 'full'); ?>
            <?php if (!empty($image_caption)) { ?>
              <figcaption class="font-size-small"><?php echo $image_caption; ?></figcaption>
            <?php } ?>
          </figure>
          <?php } ?>
          
          <div class="grid-item item-s-12 item-l-6 item-xl-4 no-gutter grid-row align-content-center">
            <div class="grid-item item-s-12 margin-bottom-tiny">
              <h1 class="font-size-extra"><?php echo $issue->name; ?></h1>
            </div>
            <?php if (!empty($subtitle)) { ?>
            <div class="grid-item item-s-12 font-size-mid margin-top-tiny">
              <span><?php echo $subtitle; ?></span>
            </div>
            <?php } if ($contributors) { ?>
            <div class="grid-item item-s-12 margin-top-small">
              <span><?php echo $contributors; ?></span>
            </div>
            <?php } ?>
          </div>
        </div>
      </a>
    </div>
  </section>
<?php
}
?>

</main>

<?php
get_footer();
?>
