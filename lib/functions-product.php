<?php 
function productPrice($post_id, $priceClass = '') {
  $price = get_post_meta($post_id, '_igv_product_price', true);
  $inventory = get_post_meta($post_id, '_igv_product_inventory', true);

  if (!empty($inventory) && !empty($price)) {
    if ($inventory > 0) {
  ?>
    <div class="product-price <?php echo $priceClass; ?>">
      <span>$<?php echo $price; ?></span>
    </div>
  <?php 
    } else {
  ?> 
    <div class="product-sold">
      <span>Sold</span>
    </div>
  <?php 
    }
  }
}