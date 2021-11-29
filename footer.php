<?php
$options = get_site_option('_igv_site_options');
?>

  <footer id="footer" class="font-size-basic padding-bottom-small">
    <div class="container">
      <div class="grid-row justify-between">
        <?php if (!empty($options['mailchimp_action'])) { ?>
        <div id="footer-form-holder" class="item-s-12 item-m-6 item-l-5 item-xl-4 margin-top-basic">
          <?php get_template_part('partials/newsletter-form'); ?>
          <div class="grid-item item-s-auto item-l-4 padding-top-tiny not-desktop">
            <span>© <?php echo date("Y"); ?> so-far.online</span>
          </div>
        </div>
        <?php } ?>

        <div id="footer-nav-holder" class="item-s-12 item-m-6 offset-xl-1 grid-column margin-top-basic">
          <nav id="footer-nav">
            <ul class="grid-row justify-between">
              <li class="grid-item item-s-6 item-l-4">
                <a href="<?php echo home_url('definitions'); ?>">Definitions</a>
              </li>
              <li class="grid-item item-s-6 item-l-4">
                <a href="<?php echo home_url('contribute'); ?>">Contribute</a>
              </li>
              <li class="grid-item item-s-6 item-l-4">
                <a href="<?php echo home_url('contact'); ?>">Contact</a>
              </li>
              <li class="grid-item item-s-6 item-l-4">
                <a href="<?php echo home_url('jobs'); ?>">Jobs</a>
              </li>
              <li class="grid-item item-s-6 item-l-4">
                <a href="<?php echo home_url('faq'); ?>">FAQ</a>
              </li>
              <li class="grid-item item-s-6 item-l-4">
                <a href="<?php echo home_url('terms-and-conditions'); ?>">Terms & Conditions</a>
              </li>
              <li class="grid-item item-s-6 item-l-4">
                <a href="<?php echo home_url('privacy-policy'); ?>">Privacy Policy</a>
              </li>
            </ul>
          </nav>

          <div class="grid-row align-items-center justify-between">
            <ul class="grid-row item-s-auto item-l-8 padding-top-micro font-size-zero">
            <?php if (!empty($options['socialmedia_instagram'])) { ?>
              <li class="grid-item">
                <a href="https://instagram.com/<?php echo $options['socialmedia_instagram']; ?>" class="social-icon-holder">
                  <img class="social-icon" src="<?php bloginfo('stylesheet_directory'); ?>/dist/img/icon-instagram.png" />
                  <img class="social-icon social-icon-white" src="<?php bloginfo('stylesheet_directory'); ?>/dist/img/icon-instagram-white.png" />
                </a>
              </li>
            <?php } if (!empty($options['socialmedia_facebook'])) { ?>
              <li class="grid-item">
                <a href="https://facebook.com/<?php echo $options['socialmedia_facebook']; ?>" class="social-icon-holder">
                  <img class="social-icon" src="<?php bloginfo('stylesheet_directory'); ?>/dist/img/icon-facebook.png" />
                  <img class="social-icon social-icon-white" src="<?php bloginfo('stylesheet_directory'); ?>/dist/img/icon-facebook-white.png" />
                </a>
              </li>
            <?php } if (!empty($options['socialmedia_twitter'])) { ?>
              <li class="grid-item">
                <a href="https://twitter.com/<?php echo $options['socialmedia_twitter']; ?>" class="social-icon-holder">
                  <img class="social-icon" src="<?php bloginfo('stylesheet_directory'); ?>/dist/img/icon-twitter.png" />
                  <img class="social-icon social-icon-white" src="<?php bloginfo('stylesheet_directory'); ?>/dist/img/icon-twitter-white.png" />
                </a>
              </li>
            <?php } if (!empty($options['socialmedia_vimeo'])) { ?>
              <li class="grid-item">
                <a href="https://vimeo.com/<?php echo $options['socialmedia_vimeo']; ?>" class="social-icon-holder">
                  <img class="social-icon" src="<?php bloginfo('stylesheet_directory'); ?>/dist/img/icon-vimeo.png" />
                  <img class="social-icon social-icon-white" src="<?php bloginfo('stylesheet_directory'); ?>/dist/img/icon-vimeo-white.png" />
                </a>
              </li>
            <?php } ?>
            </ul>
            <div class="grid-item item-s-auto item-l-4 padding-top-micro desktop-only">
              <span>© <?php echo date("Y"); ?> so-far.online</span>
            </div>
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
