<?php
get_header();
?>

<main id="main-content">
  <div class="container">

<?php
if (have_posts()) {
  while (have_posts()) {
    the_post();
?>
    <div class="gws-cart">
      <div id="cart-header">
      	<h1>Shopping Bag</h1>
      </div>

      <div id="cart-body">
        <div class="grid-row">
          <div class="grid-item">Item</div>
          <div class="grid-item">Description</div>
          <div class="grid-item">Price</div>
          <div class="grid-item">Quantity</div>
        </div>
        <div id="cart-items" class="gws-cart-items">
          <div class="gws-cart-item">
            <div>
              <a class="gws-cart-remove u-pointer">&times;</a>
            </div>

            <div><div class="gws-cart-thumb"></div></div>

            <div class="gws-cart-title"></div>

            <div>$ <span class="gws-cart-item-subtotal"></span></div>
          </div>
        </div>

        <div id="cart-footer">
          <div>
            SUBTOTAL: $ <span id="gws-cart-subtotal"></span>
          </div>
          <div>
            <a href="" class="gws-checkout-link">Proceed to Checkout</a>
          </div>
        </div>
      </div>

      <div id="cart-empty">
        <div>
          <div>
            <span>Your bag is empty</span>
          </div>
          <a href="<?php echo home_url('shop'); ?>">Return To Shop</a>
        </div>
      </div>
    </div>
<?php
  }
}
?>

  </div>
</main>

<?php
get_footer();
?>
