/* jshint esversion: 6, browser: true, devel: true, indent: 2, curly: true, eqeqeq: true, futurehostile: true, latedef: true, undef: true, unused: true */
/* global $, document */

// Import dependencies
import lazySizes from 'lazysizes';
import Swiper from 'swiper';
import Mailchimp from './mailchimp';

// Import style
import '../styl/site.styl';

class Site {
  constructor() {
    this.mobileThreshold = 601;

    $(window).resize(this.onResize.bind(this));

    $(document).ready(this.onReady.bind(this));

    this.onScroll = this.onScroll.bind(this);
    this.onScrollInterval = this.onScrollInterval.bind(this);
    this.setupSwiperInstance = this.setupSwiperInstance.bind(this);
    this.handleOpenOverlay = this.handleOpenOverlay.bind(this);
    this.handleFootnoteRefClick = this.handleFootnoteRefClick.bind(this);
    this.handleArticleRefClick = this.handleArticleRefClick.bind(this);
    this.handleShopMenu = this.handleShopMenu.bind(this);
    this.handleLoadAnimation = this.handleLoadAnimation.bind(this);
  }

  onResize() {
    this.navbarHeight = $('#header').outerHeight();
  }

  onReady() {
    this.didScroll = false;
    this.lastScrollTop = 0;
    this.delta = 5;
    this.navbarHeight = $('#header').outerHeight();
    this.swiperInstance = {};

    lazySizes.init();
    this.initSwiper();
    this.bindStickyHeader();
    this.bindMenuToggle();
    this.bindOverlayTriggers();
    this.bindSearchToggle();
    this.bindRefClick();
    this.bindShopMenuToggle();
    this.bindAnimatedLoad();

    $('#dissolve').fadeTo(500, 0);
  }

  initSwiper() {
    this.swiperArgs = {
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
          dragSize: 200,
        },
      },
      slide: {
        simulateTouch: true,
        slidesPerView: 1,
        initialSlide: 0,
        loop: true,
        effect: 'slide',
        navigation: {
          nextEl: '.slide-next',
          prevEl: '.slide-prev',
        },
        pagination: {
          el: '.slide-pagination',
          bulletClass: 'slide-pagination-bullet',
          bulletActiveClass: 'slide-pagination-bullet-active',
          type: 'bullets',
          clickable: true,
        },
      },
      overlay: {
        simulateTouch: true,
        slidesPerView: 1,
        initialSlide: 0,
        loop: true,
        effect: 'slide',
        navigation: {
          nextEl: '.overlay-next',
          prevEl: '.overlay-prev',
        },
      },
    };

    $('.swiper-container').each(this.setupSwiperInstance);
  }

  setupSwiperInstance(index, element) {
    var type = $(element).attr('data-swiper-type');
    var selector = '.swiper-container[data-swiper-type="' + type + '"]';

    if (type === 'scroll') {
      $(element).addClass('swiper-instance-' + index);
      selector = '.swiper-instance-' + index;
    }

    var slidesLength = $(selector).find('.swiper-slide').length;
    var swiperArgs = this.swiperArgs[type];
    swiperArgs.simulateTouch = slidesLength > 1 ? true : false;

    var swiperInstance = new Swiper (selector, swiperArgs);

    if (type === 'slide' || type === 'overlay') {
      swiperInstance.on('slideChange', function () {
        $('.' + type + '-current').html(swiperInstance.realIndex + 1);
      });
      this.swiperInstance[type] = swiperInstance;
    }
  }

  bindOverlayTriggers() {
    $('.trigger-overlay').on('click', this.handleOpenOverlay);

    $('#overlay-gallery').on('click', function(e) {
      if (e.target.tagName === 'IMG' || $(e.target).hasClass('overlay-nav')) {
        return;
      }

      $('body').removeClass('overlay-open');
    });
  }

  handleOpenOverlay() {
    var slideIndex = this.swiperInstance.slide.activeIndex;
    this.swiperInstance.overlay.slideTo(slideIndex, 0);
    $('body').addClass('overlay-open');
  }

  bindMenuToggle() {
    $('.js-toggle-menu').on('click', function() {
      $('body').toggleClass('nav-open');
      $('#header').removeClass('nav-up');
    });
  }

  bindStickyHeader() {
    $(window).scroll(this.onScroll);

    setInterval(this.onScrollInterval, 250);
  }

  bindSearchToggle() {
    $('.js-toggle-search').on('click', function() {
      $('body').toggleClass('search-open');
    });
  }

  bindRefClick() {
    $('.js-footnote-ref').on('click', this.handleFootnoteRefClick);
    $('.js-article-ref').on('click', this.handleArticleRefClick);
  }

  handleFootnoteRefClick(e) {
    e.preventDefault();
    var refIndex = $(e.target).attr('data-ref');
    var $targetRef = $('.js-article-ref[data-ref="' + refIndex + '"]');
    this.scrollToRef($targetRef, 2);
  }

  handleArticleRefClick(e) {
    e.preventDefault();
    var refIndex = $(e.target).attr('data-ref');
    var $targetRef = $('.js-footnote-ref[data-ref="' + refIndex + '"]');
    this.scrollToRef($targetRef, 1);
  }

  bindShopMenuToggle() {
    $('.js-shop-menu-toggle').on('click', this.handleShopMenu);
  }

  handleShopMenu() {
    var isOpen = $('body').hasClass('shop-menu-open');
    var autoHeight = $('#shop-menu').height();

    if (isOpen) {
      $('#shop-menu').animate({ height: 0 }, autoHeight * 1.5, 'swing', function() {
        $('body').removeClass('shop-menu-open');
      });
    } else {
      $('#shop-menu').css('height', 'auto');
      autoHeight = $('#shop-menu').height();
      $('#shop-menu').height(0).animate({ height: autoHeight }, autoHeight * 1.5, 'swing', function() {
        $('body').addClass('shop-menu-open');
      });
    }
  }

  scrollToRef($targetRef, offsetMultiplier) {
    $('html, body').animate({
      scrollTop: $targetRef.offset().top - (this.navbarHeight * offsetMultiplier)
    }, 800);
  }

  onScroll() {
    this.didScroll = true;
  }

  onScrollInterval() {
    if (this.didScroll) {
      this.hasScrolled();
      this.didScroll = false;
    }
  }

  hasScrolled() {
    var st = $(window).scrollTop();

    // Make sure they scroll more than delta
    if(Math.abs(this.lastScrollTop - st) <= this.delta) {
      return;
    }

    // If they scrolled down and are past the navbar, add class .nav-up.
    // This is necessary so you never see what is "behind" the navbar.
    if (st > this.lastScrollTop && st > this.navbarHeight){
      // Scroll Down
      $('body').removeClass('search-open');
      $('#header').removeClass('nav-down').addClass('nav-up');
    } else {
      // Scroll Up
      if(st + $(window).height() < $(document).height()) {
        $('#header').removeClass('nav-up').addClass('nav-down');
      }
    }

    this.lastScrollTop = st;
  }

  bindAnimatedLoad() {
    $('a').on('click', this.handleLoadAnimation);
  }

  handleLoadAnimation(e) {
    e.preventDefault();
    var $target = $(e.target).is('a') ? $(e.target) : $(e.target).closest('a');
    var url = $target.attr('href');

    if (url.startsWith(WP.siteUrl)) {
      $('#dissolve').fadeTo(500, 1, function() {
        window.location.href = url;
      });
    } else {
      window.location.href = url;
    }
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
new Mailchimp();
