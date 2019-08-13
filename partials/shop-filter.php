<?php
$collections = get_terms_by_post_type( array('collection'), array('product') );
$mediums = get_terms_by_post_type( array('medium'), array('product') );
$artists = get_terms_by_post_type( array('artist'), array('product') );
?>
<section class="padding-top-small padding-bottom-small background-pale border-bottom">
  <div class="container">
    <div class="grid-row">
      <?php if (!empty($mediums)) { ?>
      <div class="grid-item item-s-12 item-m-6 item-l-3">
        <h3 class="font-size-mid margin-bottom-tiny">Medium</h3>
        <ul>
        <?php
          foreach ($mediums as $term) {
            $params = array('filter' => 'medium', 'by' => $term->slug);
        ?>
          <li class="margin-bottom-tiny"><a href="<?php echo add_query_arg($params); ?>"><?php echo $term->name; ?></a></li>
        <?php } ?>
      </div>
      <?php } if (!empty($artists)) { ?>
      <div class="grid-item item-s-12 item-m-6 item-l-3">
        <h3 class="font-size-mid margin-bottom-tiny">Artists</h3>
        <ul>
        <?php
          foreach ($artists as $term) {
            $params = array('filter' => 'artist', 'by' => $term->slug);
        ?>
          <li class="margin-bottom-tiny"><a href="<?php echo add_query_arg($params); ?>"><?php echo $term->name; ?></a></li>
        <?php } ?>
      </div>
      <?php } if (!empty($collections)) { ?>
      <div class="grid-item item-s-12 item-m-6 item-l-3">
        <h3 class="font-size-mid margin-bottom-tiny">Collections</h3>
        <ul>
        <?php
          foreach ($collections as $term) {
            $params = array('filter' => 'collection', 'by' => $term->slug);
        ?>
          <li class="margin-bottom-tiny"><a href="<?php echo add_query_arg($params); ?>"><?php echo $term->name; ?></a></li>
        <?php } ?>
      </div>
      <?php } ?>
    </div>
  </div>
</section>
