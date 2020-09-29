<?php
$options = get_site_option('_igv_site_options');
?>

  <footer id="footer" class="padding-top-small padding-bottom-small font-size-small">
    <div class="container">
      <div class="grid-row">
        <?php if (!empty($options['mailchimp_action'])) { ?>
        <div id="footer-form-holder" class="item-s-12 item-m-6 item-l-5 offset-l-1 item-xl-4">
          <?php get_template_part('partials/newsletter-form'); ?>
        </div>
        <?php } ?>

        <div id="footer-nav-holder" class="item-s-12 item-m-6 offset-xl-1 grid-column justify-between">
          <div id="footer-nav">
            <ul class="grid-row">
              <li class="grid-item item-s-6 item-l-4 padding-bottom-tiny">
                <a href="<?php echo home_url('contribute'); ?>">Contribute</a>
              </li>
              <li class="grid-item item-s-6 item-l-4 padding-bottom-tiny">
                <a href="<?php echo home_url('contact'); ?>">Contact</a>
              </li>
              <li class="grid-item item-s-6 item-l-4 padding-bottom-tiny">
                <a href="<?php echo home_url('faq'); ?>">FAQ</a>
              </li>
              <li class="grid-item item-s-6 item-l-4 padding-bottom-tiny">
                <a href="<?php echo home_url('terms-and-conditions'); ?>">Terms & Conditions</a>
              </li>
              <li class="grid-item item-s-6 item-l-4 padding-bottom-tiny">
                <a href="<?php echo home_url('privacy-policy'); ?>">Privacy Policy</a>
              </li>
              <li class="grid-item item-s-6 item-l-4 padding-bottom-tiny font-size-tiny font-color-grey">
                <span>© <?php echo date("Y"); ?> so-far.online</span>
              </li>
            </ul>
          </div>

          <div class="grid-row align-items-end">
            <div class="grid-item item-s-12 item-l-auto">
              Connect with Us
            </div>
            <ul class="grid-row item-s-12 item-l-auto padding-top-micro font-size-zero">
            <?php if (!empty($options['socialmedia_instagram'])) { ?>
              <li class="grid-item">
                <a href="https://instagram.com/<?php echo $options['socialmedia_instagram']; ?>">
                  <img class="social-icon" src="<?php bloginfo('stylesheet_directory'); ?>/dist/img/icon-instagram.png" />
                </a>
              </li>
            <?php } if (!empty($options['socialmedia_facebook'])) { ?>
              <li class="grid-item">
                <a href="https://facebook.com/<?php echo $options['socialmedia_facebook']; ?>">
                  <img class="social-icon" src="<?php bloginfo('stylesheet_directory'); ?>/dist/img/icon-facebook.png" />
                </a>
              </li>
            <?php } if (!empty($options['socialmedia_twitter'])) { ?>
              <li class="grid-item">
                <a href="https://twitter.com/<?php echo $options['socialmedia_twitter']; ?>">
                  <img class="social-icon" src="<?php bloginfo('stylesheet_directory'); ?>/dist/img/icon-twitter.png" />
                </a>
              </li>
            <?php } if (!empty($options['socialmedia_vimeo'])) { ?>
              <li class="grid-item">
                <a href="https://vimeo.com/<?php echo $options['socialmedia_vimeo']; ?>">
                  <img class="social-icon" src="<?php bloginfo('stylesheet_directory'); ?>/dist/img/icon-vimeo.png" />
                </a>
              </li>
            <?php } ?>
            </ul>
            <div class="grid-item item-s-12 margin-top-micro">&nbsp;</div>
          </div>
        </div>
      </div>
    </div>
  </footer>

</section>

<?php
get_template_part('partials/scripts');
get_template_part('partials/schema-org');
?>

</body>
</html>
