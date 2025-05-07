jQuery(document).ready(function($) {
  $('.p-search__elem-item-title').addClass('p-search__elem-item-title--arrow');
  $('.p-search__elem-item-list').hide();
  $('.p-search__elem-item-title--arrow').click(function() {
    $(this).toggleClass('is-active').next('.p-search__elem-item-list:not(:animated)').slideToggle();
  });
});
