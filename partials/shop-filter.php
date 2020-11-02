<?php
$mediums = get_terms_by_post_type( array('medium'), array('product') );
$artists = get_terms_by_post_type( array('artist'), array('product') );
$collections = get_terms_by_post_type( array('collection'), array('product') );
$is_shop_archive = is_post_type_archive('product');
$shop_archive_url = get_post_type_archive_link('product');
?>
<div id="shop-menu" class="background-white">
  <div id="shop-menu-toggle" class="not-desktop border-bottom text-align-center padding-top-tiny padding-bottom-tiny background-white u-pointer">
    <span class="font-bold font-size-mid font-uppercase">Shop Menu</span>
  </div>
  <div id="shop-menu-holder" class="border-bottom background-white">
    <div class="container">
      <div class="not-desktop"><?php get_search_form() ?></div>
      <ul id="shop-menu-list" class="grid-row padding-top-tiny justify-center">
        <li class="padding-bottom-tiny grid-item item-s-12 item-l-auto">
          <div class="shop-menu-label"><a href="<?php echo $shop_archive_url; ?>">Shop All</a></div>
        </li>
        <li class="shop-sub-menu-trigger padding-bottom-tiny grid-item item-s-12 item-l-auto">
          <div class="shop-menu-label"><span>Mediums</span></div>
          <div class="shop-sub-menu padding-bottom-tiny grid-row justify-center background-white">
            <div class="grid-item item-l-6">&nbsp;</div>
            <ul class="shop-sub-menu-list grid-item item-s-12 item-l-6 offset-l-6 no-gutter grid-row">
            <?php
              foreach ($mediums as $term) {
                $params = array('filter' => 'medium', 'by' => $term->slug);
                $href = add_query_arg($params, $shop_archive_url);
            ?>
              <li class="shop-sub-menu-item grid-item item-s-auto item-l-3 margin-bottom-tiny"><a href="<?php echo $href; ?>"><?php echo $term->name; ?></a></li>
            <?php } ?>
            </ul>
          </div>
        </li>
        <li class="shop-sub-menu-trigger padding-bottom-tiny grid-item item-s-12 item-l-auto">
          <div class="shop-menu-label"><span>Artists</span></div>
          <div class="shop-sub-menu padding-bottom-tiny grid-row justify-center background-white">
            <div class="grid-item item-l-6">&nbsp;</div>
            <ul class="shop-sub-menu-list grid-item item-s-12 item-l-6 offset-l-6 no-gutter grid-row">
            <?php
              foreach ($artists as $term) {
                $params = array('filter' => 'artist', 'by' => $term->slug);
                $href = add_query_arg($params, $shop_archive_url);
            ?>
              <li class="shop-sub-menu-item grid-item item-s-auto item-l-3 margin-bottom-tiny"><a href="<?php echo $href; ?>"><?php echo $term->name; ?></a></li>
            <?php } ?>
            </ul>
          </div>
        </li>
        <li class="shop-sub-menu-trigger padding-bottom-tiny grid-item item-s-12 item-l-auto">
          <div class="shop-menu-label"><span>Collections</span></div>
          <div class="shop-sub-menu padding-bottom-tiny grid-row justify-center background-white">
            <div class="grid-item item-l-6">&nbsp;</div>
            <ul class="shop-sub-menu-list grid-item item-s-12 item-l-6 offset-l-6 no-gutter grid-row">
            <?php
              foreach ($collections as $term) {
                $params = array('filter' => 'collection', 'by' => $term->slug);
                $href = add_query_arg($params, $shop_archive_url);
            ?>
              <li class="shop-sub-menu-item grid-item item-s-auto item-l-3 margin-bottom-tiny"><a href="<?php echo $href; ?>"><?php echo $term->name; ?></a></li>
            <?php } ?>
            </ul>
          </div>
        </li>
        <?php if (is_post_type_archive('product')) { ?>
        <li class="shop-sub-menu-trigger padding-bottom-tiny grid-item item-s-12 item-l-auto">
          <div class="shop-menu-label"><span>Sort By</span></div>
          <div class="shop-sub-menu padding-bottom-tiny grid-row justify-center background-white">
            <ul class="shop-sub-menu-list grid-item item-s-12 item-l-6 offset-l-6 no-gutter grid-row">
              <li class="shop-sub-menu-item grid-item item-s-auto item-l-3 margin-bottom-tiny">
                <button class="shop-sort-option active" data-sort="newest">Newest</button>
              </li>
              <li class="shop-sub-menu-item grid-item item-s-auto item-l-3 margin-bottom-tiny">
                <button class="shop-sort-option" data-sort="editors-picks">Editor's Picks</button>
              </li>
              <li class="shop-sub-menu-item grid-item item-s-auto item-l-3 margin-bottom-tiny">
                <button class="shop-sort-option" data-sort="low-high">Low to High</button>
              </li>
              <li class="shop-sub-menu-item grid-item item-s-auto item-l-3 margin-bottom-tiny">
                <button class="shop-sort-option" data-sort="high-low">High to Low</button>
              </li>
              <li class="shop-sub-menu-item grid-item item-s-auto item-l-3 margin-bottom-tiny">
                <button class="shop-sort-option" data-sort="under-500">Under $500</button>
              </li>
              <li class="shop-sub-menu-item grid-item item-s-auto item-l-3 margin-bottom-tiny">
                <button class="shop-sort-option" data-sort="under-1000">Under $1000</button>
              </li>
            </ul>
          </div>
        </li>
        <?php } ?>
      </ul>
    </div>
  </div>
</div>
