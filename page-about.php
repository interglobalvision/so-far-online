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
<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
<?php
    $headline = get_post_meta($post->ID, '_igv_about_headline', true);
    $mission = get_post_meta($post->ID, '_igv_about_mission', true);
    $team = get_post_meta($post->ID, '_igv_about_team', true);
    $contributors_text = get_post_meta($post->ID, '_igv_about_contributors_text', true);
    $contributors_image_id = get_post_meta($post->ID, '_igv_about_contributors_image_id', true);
    $artists_text = get_post_meta($post->ID, '_igv_about_artists_text', true);
    $artists_image_id = get_post_meta($post->ID, '_igv_about_artists_image_id', true);
    $partners = get_post_meta($post->ID, '_igv_about_partners', true);
?>

  <section class="padding-top-small padding-bottom-basic">
    <div class="grid-row">
      <div class="grid-item item-s-12 item-l-8 offset-l-2">
        <?php if (!empty($headline)) { ?>
        <div class="padding-bottom-small font-size-mid"><span><?php echo $headline; ?></span></div>
        <?php } the_content(); ?>
      </div>
    </div>
  </section>
  <section class="text-align-center padding-bottom-basic">
    <?php the_post_thumbnail('full'); ?>
  </section>
<?php if (!empty($mission)) { ?>
  <section class="padding-bottom-basic">
    <h2 class="text-align-center font-uppercase padding-bottom-basic font-size-mid">Our Mission</h2>
    <div class="grid-row">
      <div class="grid-item item-s-12 item-l-8 offset-l-2">
        <div><?php echo apply_filters('the_content', $mission); ?></div>
      </div>
    </div>
  </section>
<?php } if (!empty($team)) { ?>
  <section class="padding-bottom-basic">
    <h2 class="text-align-center font-uppercase padding-bottom-basic font-size-mid">Our Team</h2>
    <div class="grid-row justify-center">
    <?php foreach($team as $member) { ?>
      <div class="grid-item item-s-12 item-m-6 item-l-4 item-xxl-3">
        <div><?php echo !empty($member['photo_id']) ? wp_get_attachment_image($member['photo_id'], 'full') : ''; ?></div>
        <div class="margin-top-micro"><span><?php echo !empty($member['name']) ? $member['name'] : ''; ?></span></div>
        <div class="margin-top-micro"><?php echo !empty($member['bio']) ? apply_filters('the_content', $member['bio']) : ''; ?></div>
      </div>
    <?php } ?>
    </div>
  </section>
<?php } if (!empty($contributors_text) || !empty($contributors_image_id)) { ?>
  <section class="padding-bottom-basic">
    <h2 class="text-align-center font-uppercase padding-bottom-basic font-size-mid">Contributors</h2>
    <div class="grid-row">
      <div class="grid-item item-s-12 item-l-6 item-xl-7 no-gutter-left">
        <?php echo !empty($contributors_image_id) ? wp_get_attachment_image($contributors_image_id, 'full') : ''; ?>
      </div>
      <div class="grid-item item-s-12 item-l-6 item-xl-4 no-gutter">
        <?php echo !empty($contributors_text) ? apply_filters('the_content', $contributors_text) : ''; ?>
        <div class="padding-top-small text-align-center font-uppercase">
          <a class="button" href="<?php echo home_url('contributors'); ?>">Meet our contributors</a>
        </div>
      </div>
    </div>
  </section>
<?php } if (!empty($artists_text) || !empty($artists_image_id)) { ?>
  <section class="padding-bottom-basic">
    <h2 class="text-align-center font-uppercase padding-bottom-basic font-size-mid">Artists</h2>
    <div class="grid-row row-l-reverse">
      <div class="grid-item item-s-12 item-l-6 item-xl-7 no-gutter-right">
        <?php echo !empty($artists_image_id) ? wp_get_attachment_image($artists_image_id, 'full') : ''; ?>
      </div>
      <div class="grid-item item-s-12 item-l-6 item-xl-4 no-gutter">
        <?php echo !empty($artists_text) ? apply_filters('the_content', $artists_text) : ''; ?>
        <div class="padding-top-small text-align-center font-uppercase">
          <a class="button" href="<?php echo home_url('artists'); ?>">Meet our artists</a>
        </div>
      </div>
    </div>
  </section>
<?php } if (!empty($partners)) { ?>
  <section class="padding-bottom-basic">
    <h2 class="text-align-center font-uppercase padding-bottom-basic font-size-mid">Partners</h2>
    <div class="grid-row justify-center">
    <?php
      foreach ($partners as $partner) {
        if (!empty($partner['logo_id'])) {
    ?>
      <div class="grid-item padding-bottom-tiny">
        <?php
          echo !empty($partner['link']) ? '<a href="' . $partner['link'] . '" class="hover-saturate">' : '';
          echo wp_get_attachment_image($partner['logo_id']);
          echo !empty($partner['link']) ? '</a>' : '';
        ?>
      </div>
    <?php
        }
      }
    ?>
    </div>
  </section>
<?php
    }
?>
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
