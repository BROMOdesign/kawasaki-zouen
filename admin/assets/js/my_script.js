jQuery(document).ready(function($){

	// Initialize wordpress color picker API
	$('.c-color-picker').wpColorPicker();

  // Sortable
	$('.sortable').sortable({
    handle: '.theme_option_subbox_headline',
  	placeholder: 'sortable-placeholder',
  	helper: 'clone',
  	forceHelperSize: true,
  	forcePlaceholderSize: true
	});

	// Theme options
	if ($('#my_theme_option').length) {

		// CookieTab
  	$('#my_theme_option').cookieTab({
  		tabMenuElm: '#theme_tab',
   		tabPanelElm: '#tab-panel'
  	});


	  $('.theme_option_field')

      // Toggle .sub_box
      .on('click', '.theme_option_subbox_headline', function(e){
  	    $(this).parent('.sub_box').toggleClass('active');
      })

      // Change .sub_box headline
      .on('change keyup', '.change_subbox_headline', function(e){
    	  $(this).closest('.sub_box').find('.theme_option_subbox_headline').text($(this).val());
      })

      // Toggle HTML to display on clicking radio button
		  .on('click', 'input[type="radio"]', function() {

        // Get name attribute value inside bracket
        var name = $(this).attr('name').match(/dp_options\[(\w+)\]/)[1];

        // Get value of the radio button
        var value = $(this).val();

        if ($('[id^="' + name + '"]').length) {
          // Hide all HTML related to the radio buttons
          $('[id^="' + name + '"]').hide();

          // Display HTML related to checked radio button
          $('[id="' + name + '_' + value + '"]').show();
        }
		  });

    // Footer bar
    $('.repeater-wrapper').on('change', '.footer-bar-type select', function() {
			var subBox = $(this).parents('.sub_box');
			var target = subBox.find('.footer-bar-target');
			var url = subBox.find('.footer-bar-url');
			var number = subBox.find('.footer-bar-number');
			switch ($(this).val()) {
			  case 'type1' :
				  target.show();
				  url.show();
				  number.hide();
				  break;
			  case 'type2' :
				  target.hide();
				  url.hide();
				  number.hide();
				  break;
			  case 'type3' :
				  target.hide();
				  url.hide();
				  number.show();
				  break;
			}
		});
    
    // Prevent duplicate taxonomy slugs
    var theme_option_validation = function() {

      var style_cat_length = $('.style-cat').length;
      //var style_cat_empty = 0;
      var style_cat_duplicate = 0;
      var style_cat_error_index = [];
      var style_cat_error_message = [];

      $('#myOptionsForm .invalid').removeClass('invalid');

      for (var i = 1; i <= style_cat_length; i++) {

        var $style_cat = $('input[name="dp_options\\[style_cat' + i + '\\]"');

        if (! $style_cat.val()) { continue; }
        
        for (var j = i + 1; j <= style_cat_length; j++) {

          var $style_cat2 = $('input[name="dp_options\\[style_cat' + j + '\\]"');
          if ($style_cat.val() == $style_cat2.val()) {
            style_cat_duplicate++;
            if ($.inArray(i, style_cat_error_index) == -1) {
              style_cat_error_index.push(i);
            }
            if ($.inArray(j, style_cat_error_index) == -1) {
              style_cat_error_index.push(j);
            }
          }
        }
      }

      if (style_cat_duplicate) {
        style_cat_error_message.push(error_messages.duplicate);
      }
      if (style_cat_error_index.length) {
        $('#saving_data').hide();
        $.each(style_cat_error_index, function(i,v) {
          var $style_cat = $('input[name="dp_options\\[style_cat'+v+'\\]"');
          $style_cat.addClass('invalid').on('focus', function(){
            $(this).removeClass('invalid').off('focus');
            $('#errorMessage:visible').stop().fadeOut(500).off('click');
          });
          if (i === 0) {
            //$style_cat.closest('.theme_option_field_ac').addClass('active');
            if (! $style_cat.parents('.sub_box').hasClass('active')) {
              $style_cat.parents('.sub_box').addClass('active');
            }
            if ($style_cat.parents('.tab-content').is(':hidden')) {
              $('#tab-panel .tab-content').hide();
              $style_cat.parents('.tab-content').show();
              $('#theme_tab li.current').removeClass('current');
              $('#theme_tab li a[href*="#'+$style_cat.parents('.tab-content').attr('id')+'"]').closest('li').addClass('current');
            }
            $(window).scrollTop($style_cat.offset().top - 150);
          }
        });
        if (style_cat_error_message.length) {
          $('#saved_data').html('<div id="errorMessage" class="errorModal"></div>');
          $('#errorMessage')
            .html('<p>'+style_cat_error_message.join('<br>')+'</p>')
            .height($('#errorMessage').children().outerHeight(true))
            .fadeIn(300)
            .delay(5000)
            .fadeOut(500)
            .on('click', function(){
              $(this).stop().fadeOut(500);
            });
        }
        return false;
      }
      return true;
    };

	  // submit by AJAX
    //$('#myOptionsForm').submit(function(event) {
    $('#tab-panel').on( 'click', '.ajax_button', function(event) {

      if (!theme_option_validation()) return false;

	  	event.preventDefault();

      var $button = $('.button-ml');
      $('#saving_data').show();
      if (window.tinyMCE) {
        tinyMCE.triggerSave();//tinymceを利用しているフィールドのデータを保存
      }
      $('#myOptionsForm').ajaxSubmit({
        beforeSend: function() {
          $button.attr('disabled', true); // ボタンを無効化し、二重送信を防止
        },
        complete: function() {
          $button.attr('disabled', false); // ボタンを有効化し、送信を許可
        },
        success: function(){
          $('#saving_data').hide();
          $('#saved_data').html('<div id="saveMessage" class="successModal"></div>');
          $('#saveMessage').append('<p>' + error_messages.success + '</p>').show();
        },
        error: function() {
          $('#saving_data').hide();
          alert(error_messages.error);
        },
        timeout: 10000
      }); 
      setTimeout(function() { 
	  		jQuery('#saveMessage').hide();
	  	}, 3000);
    });
	}

  // Add and delete repeater fields
  $('.repeater-wrapper')

    .each(function() {
      var nextIndex = $(this).find('.repeater-item').last().index();
      $(this).find('.button-add-row').click(function(e) {
        e.preventDefault();
        var clone = $(this).attr('data-clone');
        var $parent = $(this).closest('.repeater-wrapper');
        if (clone && $parent.length) {
          nextIndex++;
          $parent.find('.repeater').append(clone.replace(/addindex/g, nextIndex));
        }
      });
    })
    
    .on('click', '.button-delete-row', function(e) {
      e.preventDefault();
      var del = true;
      var confirmMessage = $(this).closest('.repeater-wrapper').attr('data-delete-confirm');
      if (confirmMessage.length) {
        del = confirm(confirmMessage);
      }
      if (del) {
        $(this).closest('.repeater-item').remove();
      }
	  });
});

	function countField(target) {
		jQuery(target).after('<span class="word_counter" style="display:block; margin:0 15px 0 0; font-weight:bold;"></span>');
		jQuery(target).bind({
    	keyup: function() {
      	setCounter();
   	 	},
  	 	change: function() {
  	 		setCounter();
   	 	}
	  });
  	setCounter();
  	function setCounter(){
    	jQuery('span.word_counter').text(translation.word_counter+jQuery(target).val().length);
  	};
	}
