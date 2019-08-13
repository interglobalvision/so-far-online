<section id="searchform-holder" class="background-pale">
  <div class="container">
    <div class="grid-row justify-center padding-top-basic padding-bottom-small">
      <div class="grid-item item-s-12 item-m-8 item-l-6">
        <form id="searchform" method="get" class="text-align-center" action="<?php echo home_url('/'); ?>">
          <input type="text" class="search-field" name="s" placeholder="<?php if (is_search()) { the_search_query(); } else { echo 'Search'; } ?>">
          <input type="hidden" name="post_type[]" value="post" />
          <input type="hidden" name="post_type[]" value="weekly" />
          <input type="hidden" name="post_type[]" value="product" />
          <button type="submit" class="font-heavy margin-top-tiny">Submit</button>
        </form>
      </div>
    </div>
  </div>
</section>
