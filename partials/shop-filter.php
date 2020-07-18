<?php
$mediums = get_terms_by_post_type( array('medium'), array('product') );
$artists = get_terms_by_post_type( array('artist'), array('product') );
$collections = get_terms_by_post_type( array('collection'), array('product') );
?>
<div id="shop-menu" class="background-pale border-bottom">
  <div class="container">
    <ul id="shop-menu-list" class="grid-row padding-top-tiny">
      <li class="padding-bottom-tiny grid-item item-s-12 item-m-auto offset-l-6 shop-sub-menu-trigger">
        <span>Mediums</span>
        <div class="shop-sub-menu padding-top-small padding-bottom-tiny grid-row">
          <ul class="shop-menu-list grid-item item-s-12 item-m-6 offset-m-6 no-gutter grid-row">
          <?php
            foreach ($mediums as $term) {
              $params = array('filter' => 'medium', 'by' => $term->slug);
          ?>
            <li class="grid-item item-s-12 item-m-3 margin-bottom-tiny"><a href="<?php echo add_query_arg($params); ?>"><?php echo $term->name; ?></a></li>
          <?php } ?>
          </ul>
        </div>
      </li>
      <li class="padding-bottom-tiny grid-item item-s-12 item-m-auto shop-sub-menu-trigger">
        <span>Artists</span>
        <div class="shop-sub-menu padding-top-small padding-bottom-tiny grid-row">
          <ul class="shop-menu-list grid-item item-s-12 item-m-6 offset-m-6 no-gutter grid-row">
          <?php
            foreach ($artists as $term) {
              $params = array('filter' => 'artist', 'by' => $term->slug);
          ?>
            <li class="grid-item item-s-12 item-m-3 margin-bottom-tiny"><a href="<?php echo add_query_arg($params); ?>"><?php echo $term->name; ?></a></li>
          <?php } ?>
          </ul>
        </div>
      </li>
      <li class="padding-bottom-tiny grid-item item-s-12 item-m-auto shop-sub-menu-trigger">
        <span>Collections</span>
        <div class="shop-sub-menu padding-top-small padding-bottom-tiny grid-row">
          <ul class="shop-menu-list grid-item item-s-12 item-m-6 offset-m-6 no-gutter grid-row">
          <?php
            foreach ($collections as $term) {
              $params = array('filter' => 'collection', 'by' => $term->slug);
          ?>
            <li class="grid-item item-s-12 item-m-3 margin-bottom-tiny"><a href="<?php echo add_query_arg($params); ?>"><?php echo $term->name; ?></a></li>
          <?php } ?>
          </ul>
        </div>
      </li>
      <?php if (is_post_type_archive('product')) { ?>
      <li class="padding-bottom-tiny grid-item item-s-12 item-m-auto shop-sub-menu-trigger">
        <span>Sort By</span>
        <div class="shop-sub-menu padding-top-small padding-bottom-tiny grid-row">
          <ul class="shop-menu-list grid-item item-s-12 item-m-6 offset-m-6 no-gutter grid-row">
            <li class="grid-item item-s-12 item-m-3 margin-bottom-tiny">
              <button class="shop-sort-option active" data-sort="newest">Newest</button>
            </li>
            <li class="grid-item item-s-12 item-m-3 margin-bottom-tiny">
              <button class="shop-sort-option" data-sort="editors-picks">Editor's Picks</button>
            </li>
            <li class="grid-item item-s-12 item-m-3 margin-bottom-tiny">
              <button class="shop-sort-option" data-sort="low-high">Low to High</button>
            </li>
            <li class="grid-item item-s-12 item-m-3 margin-bottom-tiny">
              <button class="shop-sort-option" data-sort="high-low">High to Low</button>
            </li>
            <li class="grid-item item-s-12 item-m-3 margin-bottom-tiny">
              <button class="shop-sort-option" data-sort="under-500">Under $500</button>
            </li>
            <li class="grid-item item-s-12 item-m-3 margin-bottom-tiny">
              <button class="shop-sort-option" data-sort="under-1000">Under $1000</button>
            </li>
          </ul>
        </div>
      </li>
      <?php } ?>
    </ul>
  </div>
</div>
