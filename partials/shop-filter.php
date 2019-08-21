<?php
$collections = get_terms_by_post_type( array('collection'), array('product') );
$mediums = get_terms_by_post_type( array('medium'), array('product') );
$artists = get_terms_by_post_type( array('artist'), array('product') );
?>
<section class="padding-top-small background-pale border-bottom">
  <div class="container">
    <div class="not-desktop">
      <div class="grid-row justify-center padding-bottom-small">
        <div class="grid-item">
          <span class="font-uppercase font-size-mid js-shop-menu-toggle u-pointer">Shop Menu</span>
        </div>
      </div>
    </div>
    <div id="shop-menu">
      <div class="grid-row padding-bottom-small">
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
          </ul>
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
          </ul>
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
          </ul>
        </div>
        <?php } ?>
        <div class="grid-item item-s-12 item-m-6 item-l-3">
          <h3 class="font-size-mid margin-bottom-tiny">Sort By</h3>
          <form>
            <div class="margin-bottom-tiny grid-row align-items-center">
              <input type="radio" name="sort" value="newest" checked />
              <span>Newest</span>
            </div>
            <div class="margin-bottom-tiny grid-row align-items-center">
              <input type="radio" name="sort" value="low-high" />
              <span>Low to High</span>
            </div>
            <div class="margin-bottom-tiny grid-row align-items-center">
              <input type="radio" name="sort" value="high-low" />
              <span>High to Low</span>
            </div>
            <div class="margin-bottom-tiny grid-row align-items-center">
              <input type="radio" name="sort" value="under-500" />
              <span>Under $500</span>
            </div>
            <div class="margin-bottom-tiny grid-row align-items-center">
              <input type="radio" name="sort" value="under-1000" />
              <span>Under $1000</span>
            </div>
            <div class="margin-bottom-tiny grid-row align-items-center">
              <input type="radio" name="sort" value="editors-picks" />
              <span>Editor's Picks</span>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
