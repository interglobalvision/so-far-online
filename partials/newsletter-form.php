<?php
$options = get_site_option('_igv_site_options');
if (!empty($options['mailchimp_action'])) {
?>
<div class="grid-row">
  <div class="grid-item item-s-12 margin-bottom-micro">
    <span>Join our mailing list to receive monthly updates</span>
  </div>
</div>
<form novalidate="true" id="mailchimp-form" class="text-align-center grid-row">
  <div class="grid-item item-s-12 margin-bottom-micro grid-row newsletter-form-row">
    <div class="form-grid-item item-s-6">
      <input type="name" name="FNAME" placeholder="Name" id="mailchimp-first">
    </div>
    <div class="form-grid-item item-s-6">
      <input type="name" name="LNAME" placeholder="Surname" id="mailchimp-last">
    </div>
  </div>
  <div class="grid-item item-s-12 grid-row align-items-center">
    <div class="form-grid-item grid-item flex-grow margin-bottom-micro">
      <input type="email" name="EMAIL" placeholder="Email Address" id="mailchimp-email">
    </div>
    <div class="form-grid-item margin-bottom-micro">
      <button type="submit" id="mailchimp-submit" class="font-heavy">Subscribe</button>
    </div>
  </div>
</form>
<div id="mailchimp-response" class="margin-top-micro text-align-center">&nbsp;</div>
<?php
}
?>
