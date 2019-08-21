<section id="searchform-holder">
  <div class="container">
    <div class="grid-row justify-center padding-top-basic padding-bottom-small">
      <div class="grid-item item-s-12 item-m-8 item-l-6">
        <form id="searchform" method="get" class="text-align-center" action="<?php echo home_url('/'); ?>">
          <input type="text" class="search-field" name="s" placeholder="<?php if (is_search()) { the_search_query(); } else { echo 'Search'; } ?>">
          <button type="submit" id="search-submit" class="margin-top-tiny button">Submit</button>
        </form>
      </div>
    </div>
  </div>
</section>
