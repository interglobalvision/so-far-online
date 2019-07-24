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
    var swiperArgs = {
      scroll: {
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
      },
      slide: {
        simulateTouch: true,
        slidesPerView: 1,
        loop: true,
        navigation: {
          nextEl: '.slide-next',
          prevEl: '.slide-prev',
        },
      },
    }

    $('.swiper-container').each(function(index, element) {
      $(this).addClass('swiper-instance-' + index);
      var type = $(this).attr('data-carousel-type');
      var swiperInstance = new Swiper ('.swiper-instance-' + index, swiperArgs[type]);
      if (type === 'slide') {
        swiperInstance.on('slideChange', function () {
          $('.current-slide').html(swiperInstance.realIndex + 1);
        });
      }
    });
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
