<?php
get_header();

$artists = get_terms( array(
  'taxonomy' => 'artist',
  'parent' => 0,
  'orderby' => 'name',
  'hide_empty' => false,
) );
?>

<main id="main-content">
<div class="container">

<?php
if (count($artists) > 0) {
?>
  <div class="grid-row justify-center">
    <div class="grid-item item-s-12 item-m-10 item-l-8 text-columns-m-2 text-columns-l-3">
    <?php
      foreach ($artists as $index => $artist) {
    ?>
      <div id="artist-<?php echo $artist->term_id; ?>">
        <a href="<?php echo get_term_link($artist); ?>">
          <?php echo $artist->name; ?>
        </a>
      </div>
    <?php
      }
    ?>
    </div>
  </div>
<?php
}
?>
</div>
</main>

<?php
get_footer();
?>
