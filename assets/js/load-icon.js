jQuery(function($){
  
  if ($('#site_loader_overlay').length) {

		var loadTime = 3000;
		var bodyHeight = $('body').height();
		$('#site_wrap').css('display', 'none');
		$('body').height(bodyHeight);

		// After the document loading process
		$(window).load(function() {
			$('#site_wrap').css('display', 'block');
			if ($('.slick-slider').length) { $('.slick-slider').slick('setPosition'); }
			$('body').height('');
			$('#site_loader_animation').delay(600).fadeOut(400);
		  $('#site_loader_overlay').delay(900).fadeOut(800, initialize);
		});

		// Display #site_wrap even if the document loading process is not over
		$(function() {
			setTimeout(function(){
				$('#site_loader_animation').delay(600).fadeOut(400);
				$('#site_loader_overlay').delay(900).fadeOut(800);
				$('#site_wrap').css('display', 'block');
		  }, loadTime);
		});
	} else {
		initialize();
	}

	function initialize() {
    if ($('#js-header-slider').length) {
	    $('#js-header-slider').slick({
	      autoplay: true,
	      autoplaySpeed: 5000,
	      infinite: true,
	      slidesToShow: 1,
	      responsive: [
	        {
	          breakpoint: 768,
	          settings: {
	            arrows: false
	          }
	        }
	      ]
	    }); 
    }
    if ($('#js-header-video').length) {
      $('#js-header-video').addClass('is-active');
    }
    if ($('#js-header-youtube').length) {
      $('#js-header-youtube').addClass('is-active');
    }
	}

});	


