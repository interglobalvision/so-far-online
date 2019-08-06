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
    <div class="gws-cart margin-bottom-mid">
      <header id="cart-header" class="grid-row font-uppercase padding-top-small padding-bottom-small justify-center">
      	<div class="grid-item item-s-12 item-l-10"><h1 class="font-size-basic">Shopping Bag</h1></div>
      </header>

      <section id="cart-body">
        <div class="desktop-only">
          <div class="grid-row font-uppercase margin-bottom-small justify-center">
            <div class="grid-item item-l-3">Item</div>
            <div class="grid-item item-l-3">Description</div>
            <div class="grid-item item-l-2">Price</div>
            <div class="grid-item item-l-2">Quantity</div>
            <div class="grid-item item-s-10 margin-top-small">
              <div class="border"></div>
            </div>
          </div>
        </div>
        <div id="cart-items" class="gws-cart-items border-bottom">
          <div class="gws-cart-item margin-bottom-small">
            <div>
              <a class="gws-cart-remove u-pointer">&times;</a>
            </div>
            <div class="grid-row justify-center">
              <div class="grid-row item-s-12 item-l-6">
                <div class="grid-item item-s-6">
                  <div class="gws-cart-thumb"></div>
                </div>

                <div class="grid-item item-s-6">
                  <div class="gws-cart-title"></div>
                  <div class="gws-cart-description"></div>
                </div>
              </div>

              <div class="grid-row item-s-12 item-l-4">
                <div class="grid-item item-s-6">
                  <span>$ <span class="gws-cart-item-subtotal"></span></span>
                </div>
                <div class="grid-item item-s-6">
                  <input type="number" min="1" max="100" class="gws-cart-quantity" />
                </div>
              </div>

              <div class="grid-item item-s-12 item-l-10 margin-top-small">
                <div class="border"></div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section id="cart-footer">
        <div class="grid-row margin-bottom-small">
          <div class="grid-item item-s-12 item-l-4 offset-l-4">
            <label class="grid-row align-items-center">
              <input type="checkbox" class="gws-cart-attribute" data-gws-cart-attr-key="Contact about framing">
              <span>Contact me about framing</span>
            </label>
          </div>
        </div>
        <div class="grid-row item-s-12 item-l-10">
          <div class="grid-item item-s-6 item-l-3 offset-l-4 font-uppercase font-bold">
            <span>Subtotal</span>
          </div>
          <div class="grid-item item-s-6 item-l-2 font-bold">
            $ <span id="gws-cart-subtotal"></span>
          </div>
          <div class="grid-item item-s-6 item-l-2">
            <a href="" class="gws-checkout-link">Proceed to Checkout</a>
          </div>
        </div>
      </section>

      <section id="cart-empty" class="u-hidden">
        <div>
          <div>
            <span>Your bag is empty</span>
          </div>
          <a href="<?php echo home_url('shop'); ?>">Return To Shop</a>
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
