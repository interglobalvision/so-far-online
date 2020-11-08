<?php
$options = get_site_option('_igv_site_options');
if (!empty($options['mailchimp_action'])) {
?>
<div class="grid-row">
  <div class="grid-item item-s-12 margin-bottom-micro">
    <span>Join our mailing list to receive monthly updates</span>
  </div>
</div>
<form novalidate="true" id="mailchimp-form" class="text-align-center">
  <div class="margin-bottom-micro grid-row">
    <div class="grid-item item-s-6">
      <input type="name" name="FNAME" placeholder="Name" id="mailchimp-first">
    </div>
    <div class="grid-item item-s-6">
      <input type="name" name="LNAME" placeholder="Surname" id="mailchimp-last">
    </div>
  </div>
  <div class="grid-row align-items-center">
    <div class="grid-item flex-grow margin-bottom-micro">
      <input type="email" name="EMAIL" placeholder="Email Address" id="mailchimp-email">
    </div>
    <div class="grid-item margin-bottom-micro">
      <button type="submit" id="mailchimp-submit" class="font-heavy">Subscribe</button>
    </div>
  </div>
</form>
<div id="mailchimp-response" class="margin-top-micro text-align-center">&nbsp;</div>
<?php
}
?>
