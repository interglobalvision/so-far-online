/* jshint esversion: 6, browser: true, devel: true, indent: 2, curly: true, eqeqeq: true, futurehostile: true, latedef: true, undef: true, unused: true */
/* global $, document, WP */

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
    this.handleClosePopup = this.handleClosePopup.bind(this);
  }

  onResize() {
    this.navbarHeight = $('#header').outerHeight();
    this.windowHeight = $(window).height();
    this.documentHeight = $(document).height();
  }

  onReady() {
    this.didScroll = false;
    this.lastScrollTop = 0;
    this.delta = 5;
    this.navbarHeight = $('#header').outerHeight();
    this.windowHeight = $(window).height();
    this.documentHeight = $(document).height();
    this.swiperInstance = {};
    this.initialOverlayIndex = 0;

    lazySizes.init();
    this.handlePopup();
    this.bindClosePopup();
    this.initSwiper();
    this.bindStickyHeader();
    this.bindMenuToggle();
    this.bindOverlayTriggers();
    this.bindSearchToggle();
    this.bindRefClick();
    this.bindShopMenuToggle();
    this.bindShopSubMenu();
    this.bindShopFilterImage();
    this.bindAnimatedLoad();
    this.handleSortRadioChange();
    this.fixWidows();

    this.handleImageFadeIn($(window).scrollTop());
    $('#dissolve').fadeTo(500, 0);
  }

  bindClosePopup() {
    $('.js-close-popup').on('click', this.handleClosePopup);
  }

  handleClosePopup(e) {
    e.preventDefault();
    $('#popup-notice-holder').addClass('hide');
    localStorage.setItem('hidePopup', 'true');
  }

  handlePopup() {
    var hidePopup = localStorage.getItem('hidePopup');
    if (hidePopup !== 'true') {
      $('#popup-notice-holder').removeClass('hide');
    }
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
    var _this = this;

    if ($('.igv-block-image').length) {
      $('.igv-block-image figure').each(function(i) {
        $(this).prepend('<span class="trigger-overlay" data-index="' + (i + 1) + '"></span>');
      });
    }

    $('.trigger-overlay').on('click', function() {
      var slideIndex = 0;
      if ($(this).attr('data-index')) {
        slideIndex = $(this).attr('data-index');
      } else {
        slideIndex = _this.swiperInstance.slide.activeIndex;
      }
      _this.handleOpenOverlay(slideIndex);
    });

    $('#overlay-gallery').on('click', function(e) {
      if (e.target.tagName === 'IMG' || $(e.target).hasClass('overlay-nav')) {
        return;
      }

      $('body').removeClass('overlay-open');
    });
  }

  handleOpenOverlay(slideIndex) {
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
    $('#shop-menu-toggle').on('click', this.handleShopMenu);
  }

  bindShopSubMenu() {
    $('.shop-sub-menu-trigger').hover(
      function() {
        $(this).addClass('show');
      },
      function() {
        $(this).removeClass('show');
      }
    );
  }

  handleShopMenu() {
    $('#shop-menu').toggleClass('open');
  }

  bindShopFilterImage() {
    $('.shop-sub-menu-item a').hover(
      function() {
        var termId = $(this).parent('li').attr('data-termid');
        if (termId) {
          $('.shop-filter-image[data-termid="' + termId + '"]').addClass('show');
        }
      },
      function() {
        $('.shop-filter-image.show').removeClass('show');
      }
    )
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
    var scrollTop = $(window).scrollTop();

    // Make sure they scroll more than delta
    if(Math.abs(this.lastScrollTop - scrollTop) <= this.delta) {
      return;
    }

    // If they scrolled down and are past the navbar, add class .nav-up.
    // This is necessary so you never see what is "behind" the navbar.
    if (scrollTop > this.lastScrollTop && scrollTop > this.navbarHeight){
      // Scroll Down
      $('body').removeClass('search-open');
      $('#header').removeClass('nav-down').addClass('nav-up');
      this.handleImageFadeIn(scrollTop);
    } else {
      // Scroll Up
      if(scrollTop + this.windowHeight < this.documentHeight) {
        $('#header').removeClass('nav-up').addClass('nav-down');
      }
    }

    this.lastScrollTop = scrollTop;
  }

  handleImageFadeIn(scrollTop) {
    var windowHeight = this.windowHeight;
    $('img, div.thumb').each(function() {
      var imageTop = $(this).offset().top;
      if (imageTop < ((windowHeight * 0.95) + scrollTop)) {
        $(this).addClass('fade-in');
      }
    });
  }

  bindAnimatedLoad() {
    $('a').on('click', this.handleLoadAnimation);
    $('#searchform').on('submit', this.handleSearchLoadAnimation);
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

  handleSortRadioChange() {
    $('.shop-sort-option').on('click', function() {
      $('.shop-sort-option.active').removeClass('active');
      $(this).addClass('active');

      switch($(this).attr('data-sort')) {
        case 'newest':
          $('.products-holder').each(function() {
            $(this).find('.gws-product').sort(function(a, b) {
              return b.dataset.time - a.dataset.time;
            }).appendTo(this);
          });
          break;
        case 'editors-picks':
          $('.products-holder').each(function() {
            $(this).find('.gws-product').sort(function(a, b) {
              if (a.dataset.pick === 'on') {
                return -1;
              }
              if (b.dataset.pick === 'on') {
                return 1;
              }
              return -1;
            }).appendTo(this);
          });
          break;
        case 'low-high':
          $('.products-holder').each(function() {
            $(this).find('.gws-product').sort(function(a, b) {
              if (a.dataset.gwsPrice === 'false') {
                return 1;
              } else if (b.dataset.gwsPrice === 'false') {
                return -1;
              } else {
                return a.dataset.gwsPrice - b.dataset.gwsPrice;
              }
            }).appendTo(this);
          });
          break;
        case 'high-low':
          $('.products-holder').each(function() {
            $(this).find('.gws-product').sort(function(a, b) {
              if (a.dataset.gwsPrice === 'false') {
                return 1;
              } else if (b.dataset.gwsPrice === 'false') {
                return -1;
              } else {
                return b.dataset.gwsPrice - a.dataset.gwsPrice;
              }
            }).appendTo(this);
          });
          break;
        case 'under-500':
          $('.products-holder').each(function() {
            $(this).find('.gws-product').sort(function(a, b) {
              if (a.dataset.gwsPrice === 'false' || parseInt(a.dataset.gwsPrice) >= 500) {
                return 1;
              } else if (b.dataset.gwsPrice === 'false' || parseInt(b.dataset.gwsPrice) >= 500) {
                return -1;
              } else {
                return a.dataset.gwsPrice - b.dataset.gwsPrice;
              }
            }).appendTo(this);
          });
          break;
        case 'under-1000':
          $('.products-holder').each(function() {
            $(this).find('.gws-product').sort(function(a, b) {
              if (a.dataset.gwsPrice === 'false' || parseInt(a.dataset.gwsPrice) >= 1000) {
                return 1;
              } else if (b.dataset.gwsPrice === 'false' || parseInt(b.dataset.gwsPrice) >= 1000) {
                return -1;
              } else {
                return a.dataset.gwsPrice - b.dataset.gwsPrice;
              }
            }).appendTo(this);
          });
          break;
        default:
          return false;
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
new Mailchimp();
