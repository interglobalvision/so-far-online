<?php
/* Template Name: Bio Archive */

get_header();

$queried_object = get_queried_object();
$tax = rtrim($queried_object->post_name, 's');

$list = get_terms( array(
  'taxonomy' => $tax,
  'parent' => 0,
  'orderby' => 'name',
  'hide_empty' => false,
) );
?>

<main id="main-content">
<div class="container">
  <h1 class="u-visuallyhidden"><?php the_title(); ?></h1>
  <div class="grid-row justify-center padding-bottom-basic">
    <div class="item-m-10 grid-row">
      <?php
        foreach ($list as $index => $item) {
      ?>
        <div id="term-<?php echo $item->term_id; ?>" class="grid-item item-s-12 item-m-4 margin-bottom-small font-size-mid text-align-center">
          <a href="<?php echo get_term_link($item); ?>">
            <?php echo $item->name; ?>
          </a>
        </div>
      <?php
        }
      ?>
    </div>
  </div>
</div>
</main>

<?php
get_footer();
?>
