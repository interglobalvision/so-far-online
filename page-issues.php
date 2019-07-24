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
<div class="container">

<?php
foreach ($issues as $index => $issue) {
  $number = get_term_meta($issue->term_id, '_igv_issue_number', true);
  $season = get_term_meta($issue->term_id, '_igv_issue_season', true);
  $subtitle = get_term_meta($issue->term_id, '_igv_subtitle', true);
  $contributors = get_term_meta($issue->term_id, '_igv_issue_contributors', true);
  $image_id = get_term_meta($issue->term_id, '_igv_issue_image_id', true);
?>
  <div id="term-<?php echo $issue->term_id; ?>">
    <a href="<?php echo get_term_link($issue); ?>">
      <div class="desktop-only">
        <div class="grid-row">
          <div class="grid-item item-l-7 offset-l-1">
            <span><?php echo !empty($issue_number) ? 'Issue ' . $issue_number : ''; ?></span>
          </div>
          <div class="grid-item item-l-3">
            <span><?php echo !empty($season) ? $season : ''; ?></span>
          </div>
        </div>
      </div>

      <div class="grid-row justify-start">
        <div class="grid-item item-s-12 item-l-6 item-xl-7 no-gutter">
          <?php echo !empty($image_id) ? wp_get_attachment_image($image_id, 'full') : ''; ?>
        </div>

        <div class="grid-item item-s-12 item-l-6 item-xl-4 no-gutter grid-row align-content-end">
          <div class="grid-item item-s-12">
            <h3><?php echo $issue->name; ?></h3>
          </div>
          <?php if (!empty($subtitle)) { ?>
          <div class="grid-item item-s-12">
            <span><?php echo $subtitle; ?></span>
          </div>
          <?php } if ($contributors) { ?>
          <div class="grid-item item-s-12">
            <span><?php echo $contributors; ?></span>
          </div>
          <?php } ?>
        </div>
      </div>
    </a>
  </div>
<?php
}
?>
</div>
</main>

<?php
get_footer();
?>
