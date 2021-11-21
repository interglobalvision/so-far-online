<?php
get_header();
?>

<main id="main-content">
  <div class="container">

<?php
if (have_posts()) {
  while (have_posts()) {
    the_post();
    
    $checkout_nonce = create_guest_nonce( 'checkout_success' );
?>
    <div 
      data-cart-empty=""
      id="cart"
      class="margin-bottom-mid">
      <header id="cart-header">
        <div class="grid-row font-uppercase padding-top-small padding-bottom-small justify-center">
        	<div class="grid-item item-s-12 item-l-10"><h1 class="font-size-basic">Shopping Bag</h1></div>
        </div>
      </header>

      <section id="cart-body">

        <div class="desktop-only">
          <div class="grid-row font-uppercase margin-bottom-small">
            <div class="grid-item item-l-3 offset-l-1">Item</div>
            <div class="grid-item item-l-3">Description</div>
            <div class="grid-item item-l-2">Price</div>
            <div class="grid-item item-l-2">Quantity</div>
            <div class="grid-item item-l-10 offset-l-1 margin-top-small">
              <div class="border"></div>
            </div>
          </div>
        </div>

        <div id="cart-items" class="cart-items">

          <div class="cart-item grid-row">

            <div class="grid-row item-s-12 item-l-6 offset-l-1">
              <div class="grid-item item-s-6 margin-bottom-small">
                <a class="cart-thumb"></a>
              </div>

              <div class="grid-item item-s-6 margin-bottom-small">
                <a class="cart-title"></a>
              </div>
            </div>

            <div class="grid-row item-s-12 item-l-4">
              <div class="grid-item item-s-6 margin-bottom-small">
                <span>$<span class="cart-item-subtotal"></span></span>
              </div>
              <div class="grid-item item-s-4 margin-bottom-small">
                <input type="number" min="1" max="100" class="cart-quantity" />
              </div>
              <div class="grid-item item-s-2 margin-bottom-small">
                <a class="cart-remove u-pointer">&times;</a>
              </div>
            </div>

            <div class="grid-item item-s-12 item-l-10 offset-l-1 margin-bottom-small">
              <div class="border"></div>
            </div>

          </div>

        </div>

      </section>

      <section id="cart-footer">
        <div class="grid-row margin-bottom-small">
          <div class="grid-item item-s-12 item-l-4 offset-l-4">
            <label class="grid-row align-items-center">
              <input type="checkbox" id="cart-framing">
              <span class="grid-item">Contact me about framing</span>
            </label>
          </div>
        </div>
        <div class="grid-row item-s-12 item-l-10">
          <div class="grid-item item-s-6 item-l-3 offset-l-4 font-uppercase">
            <span>Subtotal</span>
          </div>
          <div class="grid-item item-s-6 item-l-5 no-gutter grid-row">
            <div class="grid-item item-l-3"><span id="cart-subtotal"></span></div>
            <div class="grid-item item-l-3">
              <?php get_template_part('partials/cart-currency'); ?>
            </div>
          </div>
          <div class="grid-item item-s-12 item-l-11 margin-top-small text-align-right">
            <button class="button cart-checkout" data-checkout-nonce="<?php echo $checkout_nonce; ?>">Proceed to Checkout</button>
          </div>
        </div>
      </section>

      <section id="cart-empty">
        <div class="grid-row justify-center">
          <div class="grid-item text-align-center">
            <div class="padding-top-basic padding-bottom-basic">
              <span>Your shopping bag is empty.</span>
            </div>
            <a class="button" href="<?php echo home_url('shop'); ?>">Visit the Shop</a>
          </div>
        </div>
      </section>
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
