jQuery(document).ready(function($) {

	var activeClass = 'is-active';

  // Header
  var header = $('#js-header');
  if ( header.hasClass('l-header--fixed') ) {
    $(window).scroll(function() {
      if ($(window).scrollTop() > 0) {
        header.addClass('is-active');
      } else {
        header.removeClass('is-active');
      }
    });
  }

  // Global navigation
  $('#js-menu-btn').click(function(e) {
    e.preventDefault();
    $(this).toggleClass('is-active');
    $('#js-global-nav').slideToggle();
  });
  $('.sub-menu-toggle').click(function() {
    $(this).toggleClass('is-active').parent('a').next('.sub-menu').slideToggle();
    return false;
  });

  // Blog slider
  if ($('#js-blog-slider__inner').length) {
    $('#js-blog-slider__inner').slick({
      autoplay: true,
      infinite: true,
      slidesToShow: 3,
      responsive: [
        {
          breakpoint: 992,
          settings: {
            arrows: false
          }
        },
        {
          breakpoint: 768,
          settings: {
            arrows: false,
            slidesToShow: 2
          }
        }
      ]
    });
  }

  // SP Scroll Menu
  if ($('.p-scroll-menu__list').length) {
    $('.p-scroll-menu__list').slick({
      infinite: true,
      slidesToShow: 3,
      slidesToScroll: 1,
      swipeToSlide: true,
      arrows: true,
      prevArrow: $('.p-scroll-menu__arrow--prev'),
      nextArrow: $('.p-scroll-menu__arrow--next'),
      variableWidth: false,
      centerMode: false,
      responsive: [
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 1
          }
        }
      ]
    });
  }

  // Pagetop
  var pagetop = $('#js-pagetop');
  $(window).scroll(function() {
    if ($(window).scrollTop() > 100) {
      pagetop.addClass('is-active');
    } else {
      pagetop.removeClass('is-active');
    }
  });
  pagetop.click(function(e) {
    $('body, html').animate({
      scrollTop: 0
    }, 1000);
    e.preventDefault();
  });

  // Widgets
  if ($('.p-tab-panel').length) {
    $('.p-tab-panel').each(function() {
      var tabPanel = $(this);
			$('.p-tab-panel__tab-item:first', tabPanel).addClass('is-active');
      $('.p-tab-panel__tab a', tabPanel).click(function(e) {
        if (! $(this).parent().hasClass('is-active')) {

          // Toggle tab
          $('.is-active', tabPanel).removeClass('is-active');
          $(this).parent().addClass('is-active');

          // Toggle panel
          $('.p-tab-panel__panel', tabPanel).hide();
          $($(this).attr('href')).show();
        }
        e.preventDefault();
      });
    });
  }

  if ($('.p-dropdown').length) {
    $('.p-dropdown__title').click(function() {
      $(this).toggleClass('is-active');
      $('+ .p-dropdown__list:not(:animated)', this).slideToggle();
    });
  }

  // Comment
  if ($('#js-comment__tab').length) {
    var commentTab = $('#js-comment__tab');
    commentTab.find('a').click(function(e) {
			e.preventDefault();
      if (!$(this).parent().hasClass(activeClass)) {
        $($('.is-active a', commentTab).attr('href')).animate({opacity: 'hide'}, 0); 
        $('.is-active', commentTab).removeClass(activeClass);
        $(this).parent().addClass(activeClass);
        $($(this).attr('href')).animate({opacity: 'show'}, 1000);
      }   
    }); 
  }

  // Style gallery
  if ($('#js-style-gallery-slider').length) {
    //$('#js-style-gallery-slider').slick({
    //  arrows: false,
    //  autoplay: true,
    //  infinite: true,
    //  slidesToShow: 1
    //});
    $('#js-style-gallery-nav .p-style__gallery-nav-img').click(function() {
      var index = $(this).index();
      $('#js-style-gallery-slider').slick('slickGoTo', parseInt(index));
    });
  }
});
