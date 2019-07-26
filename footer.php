<?php
$options = get_site_option('_igv_site_options');
?>

  <footer id="footer" class="background-pale padding-top-small">
    <div class="grid-row">
    <?php if (!empty($options['mailchimp_action'])) { ?>
      <div class="item-s-12 item-l-6 text-align-center padding-bottom-small">
        <form novalidate="true" id="mailchimp-form" class="grid-row align-items-center">
          <div class="grid-item item-s-12 item-m-6 margin-bottom-micro">
            <input type="name" name="FNAME" placeholder="First Name" id="mailchimp-first">
          </div>
          <div class="grid-item item-s-12 item-m-6 margin-bottom-micro">
            <input type="name" name="LNAME" placeholder="Last Name" id="mailchimp-last">
          </div>
          <div class="grid-item item-s-12 margin-bottom-micro">
            <input type="email" name="EMAIL" placeholder="Email Address" id="mailchimp-email">
          </div>
          <div class="grid-item item-s-12">
            <button type="submit" id="mailchimp-submit">Subscribe</button>
          </div>
        </form>
        <div id="mailchimp-response" class="margin-top-micro">&nbsp;</div>
      </div>
    <?php } ?>

      <div class="item-s-12 item-l-6">
        <div id="footer-nav" class="padding-bottom-small">
          <ul class="grid-row">
            <li class="grid-item item-s-12 item-l-4">
              <a href="<?php echo home_url('contribute'); ?>">Contribute</a>
            </li>
            <li class="grid-item item-s-12 item-l-4">
              <a href="<?php echo home_url('contact'); ?>">Contact</a>
            </li>
            <li class="grid-item item-s-12 item-l-4">
              <a href="<?php echo home_url('faq'); ?>">FAQ</a>
            </li>
            <li class="grid-item item-s-12 item-l-4">
              <a href="<?php echo home_url('terms-and-conditions'); ?>">Terms & Conditions</a>
            </li>
            <li class="grid-item item-s-12 item-l-4">
              <a href="<?php echo home_url('privacy-policy'); ?>">Privacy Policy</a>
            </li>
          </ul>
        </div>

        <div class="grid-row padding-bottom-small">
          <div class="grid-item item-s-12 item-l-auto margin-bottom-micro">
            Connect with us on
          </div>
          <ul class="grid-row item-s-12 item-l-auto">
          <?php if (!empty($options['socialmedia_instagram'])) { ?>
            <li class="grid-item"><a href="https://instagram.com/<?php echo $options['socialmedia_instagram']; ?>">IG</a></li>
          <?php } if (!empty($options['socialmedia_facebook'])) { ?>
            <li class="grid-item"><a href="https://facebook.com/<?php echo $options['socialmedia_facebook']; ?>">FB</a></li>
          <?php } if (!empty($options['socialmedia_twitter'])) { ?>
            <li class="grid-item"><a href="https://twitter.com/<?php echo $options['socialmedia_twitter']; ?>">TW</a></li>
          <?php } if (!empty($options['socialmedia_vimeo'])) { ?>
            <li class="grid-item"><a href="https://vimeo.com/<?php echo $options['socialmedia_vimeo']; ?>">VI</a></li>
          <?php } ?>
          </ul>
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
