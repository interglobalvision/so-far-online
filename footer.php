<?php
$options = get_site_option('_igv_site_options');
?>

  <footer id="footer">
    <div class="grid-row">
      <div class="item-s-12 item-l-6">
        <div class="grid-row">
          <div class="grid-item">
            Newsletter
          </div>
        </div>
      </div>
      <div class="item-s-12 item-l-6">
        <div id="footer-nav">
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

        <div class="grid-row">
          <div class="grid-item item-s-12 item-l-auto">
            Connect with us on
          </div>
          <ul class="grid-row">
          <?php if (!empty($options['socialmedia_instagram'])) { ?>
            <li class="grid-item item-s-12 item-l-auto"><a href="https://instagram.com/<?php echo $options['socialmedia_instagram']; ?>">IG</a></li>
          <?php } if (!empty($options['socialmedia_facebook'])) { ?>
            <li class="grid-item item-s-12 item-l-auto"><a href="https://facebook.com/<?php echo $options['socialmedia_facebook']; ?>">FB</a></li>
          <?php } if (!empty($options['socialmedia_twitter'])) { ?>
            <li class="grid-item item-s-12 item-l-auto"><a href="https://twitter.com/<?php echo $options['socialmedia_twitter']; ?>">TW</a></li>
          <?php } if (!empty($options['socialmedia_vimeo'])) { ?>
            <li class="grid-item item-s-12 item-l-auto"><a href="https://vimeo.com/<?php echo $options['socialmedia_vimeo']; ?>">VI</a></li>
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
