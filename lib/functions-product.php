<?php 
function productPrice($post_id, $priceClass = '') {
  $price = get_post_meta($post_id, '_igv_product_price', true);
  $inventory = get_post_meta($post_id, '_igv_product_inventory', true);

  if ($inventory !== '' && intval($inventory) < 1) {
?> 

<div class="product-sold">
  <span>Sold</span>
</div>

<?php 
  } else if (!empty($price)) {
?>

<div class="product-price <?php echo $priceClass; ?>">
  <span>$<?php echo $price; ?></span>
</div>

<?php 
  } 
}
