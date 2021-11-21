<?php 
$site_options = get_site_option('_igv_site_options');
if (!empty($site_options['shop_currencies'])) { ?>
  <select id="cart-currency-select">
  <?php foreach($site_options['shop_currencies'] as $currency) { ?>
    <option value="<?php echo $currency; ?>"><?php echo $currency; ?></option>
  <?php } ?>
  </select>
<?php } ?>