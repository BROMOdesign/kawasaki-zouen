jQuery(function($) {

  // Get the image path of ajax-loader.gif
  var ajaxLoaderPath = search.ajax_loader_path;

  // Create a image element with ajaxLoaderPath
  var ajaxLoaderImg = $('<img class="p-search-result__loader" alt="">').attr('src', ajaxLoaderPath);

  // Auto-submit on checkbox click (single selection only)
  $('.p-search-list__item-checkbox').on('click', function() {
    var $this = $(this);
    var $form = $('#js-search__form');

    // Uncheck all other checkboxes
    $form.find('.p-search-list__item-checkbox').not($this).prop('checked', false);

    // Auto-submit the form
    $form.submit();
  });

  $('#js-search__form').submit(function(event) {

    event.preventDefault();

    // Get form
    var $form = $(this);

    // Get submit button
    var $button = $form.find('#js-search__submit');

    // Collect names and descriptions from checked checkboxes
    var categoryInfo = [];
    $form.find('.p-search-list__item-checkbox:checked').each(function() {
      var name = $(this).data('name');
      var description = $(this).data('description');

      if (name) {
        var info = '<strong>' + name + '</strong>';
        if (description && description.trim() !== '') {
          info += description;
        }
        categoryInfo.push(info);
      }
    });

    // Display or hide category descriptions
    var $descriptionBlock = $('#js-category-description');
    var $descriptionContent = $descriptionBlock.find('.p-category-description__content');

    if (categoryInfo.length > 0) {
      $descriptionContent.html(categoryInfo.join('<br><br>'));
      $descriptionBlock.show();
    } else {
      $descriptionContent.html('');
      $descriptionBlock.hide();
    }

    // Get scroll distance - scroll to description if shown, otherwise to search result
    var $scrollTarget = categoryInfo.length > 0 ? $descriptionBlock : $('#js-search-result');
    var scrollDistance = $scrollTarget.offset().top - parseInt($('#js-search').css('margin-bottom'));
    if ($('#js-header').hasClass('l-header--fixed')) {
      scrollDistance -= $('#js-header').height();
    }

    // Display the ajax loader icon
    $('#js-search-result').html(ajaxLoaderImg);

    // Scroll to target element
    $('body, html').animate({
      scrollTop: scrollDistance + 'px'
    }, 800);

    // Submit data by AJAX
    $.ajax({
      type: 'POST',
      url: search.ajaxurl,
      timeout: 10000,
      beforeSend: function() {
        // Preventing double form submission
        $button.attr('disabled', true);
      },
      complete: function() {
        // Enable form submission
        $button.attr('disabled', false);
      },
      data: {
        action: 'search_style_list',
        security: search.nonce,
        form_data: $form.serialize()
      }
    }).done(function(data, textStatus, jqXHR) { // Display results
      $('#js-search-result')
        .css({'opacity': 0})
        .html(data.html)
        .fadeTo('slow', 1);
    }).fail(function() {
      $('#js-search-result').html('<p>' + search.error_message + '</p>');
    }); 
  });
});
