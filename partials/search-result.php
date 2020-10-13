<?php
global $result_id;
$post_type = get_post_type($result_id);
$title = $post_type === 'product' ? get_post_meta($result_id, '_igv_artwork_title', true) : get_the_title($result_id);
$contributors = $post_type === 'product' ? get_name_list($result_id, 'artist') : get_name_list($result_id, 'contributor');
?>
<a href="<?php echo get_the_permalink($result_id); ?>">
  <div class="font-color-grey font-size-tiny margin-bottom-micro font-uppercase">
    <span><?php
      switch ($post_type) {
        case 'product':
          echo 'artwork';
          break;
        case 'weekly':
          $type = get_custom_type_terms($result_id, 'weeklytype');
          echo $type ? $type : '&nbsp;';
          break;
        case 'post':
          echo 'article';
          break;
        default:
          echo '&emsp;';
      };
    ?></span>
  </div>
  <div class="thumb-holder <?php echo is_search() ? 'search-result-thumb-holder' : 'further-reading-thumb-holder'; ?>">
    <div class="thumb" style="background-image: url('<?php echo get_the_post_thumbnail_url($result_id, 'search-result'); ?>')"></div>
  </div>
  <h3 class="font-serif margin-top-micro"><?php echo $title; ?></h3>
  <?php
    if ($contributors) {
  ?>
  <div class="font-color-grey margin-top-micro font-size-small">
    <span><?php echo $contributors; ?></span>
  </div>
  <?php
    }
  ?>
</a>

<?php
