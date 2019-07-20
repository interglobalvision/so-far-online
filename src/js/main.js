/* jshint esversion: 6, browser: true, devel: true, indent: 2, curly: true, eqeqeq: true, futurehostile: true, latedef: true, undef: true, unused: true */
/* global $, document */

// Import dependencies
import lazySizes from 'lazysizes';
import Swiper from 'swiper';

// Import style
import '../styl/site.styl';

class Site {
  constructor() {
    this.mobileThreshold = 601;

    $(window).resize(this.onResize.bind(this));

    $(document).ready(this.onReady.bind(this));

  }

  onResize() {

  }

  onReady() {
    lazySizes.init();
    this.initSwiper();
  }

  initSwiper() {
    $('.swiper-scroll').each(function(index, element) {
      $(this).addClass('swiper-instance-'+index);
      var swiperInstance = new Swiper ('.swiper-instance-'+index, {
        simulateTouch: true,
        slidesPerView: 'auto',
        freeMode: true,
        mousewheel: {
          sensitivity: 1,
          forceToAxis: true,
          invert: true,
        },
        scrollbar: {
          el: '.swiper-scrollbar',
          draggable: true,
          hide: false,
          snapOnRelease: false,
        },
      });
    })
  }

  fixWidows() {
    // utility class mainly for use on headines to avoid widows [single words on a new line]
    $('.js-fix-widows').each(function(){
      var string = $(this).html();
      string = string.replace(/ ([^ ]*)$/,'&nbsp;$1');
      $(this).html(string);
    });
  }
}

new Site();
