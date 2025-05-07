jQuery(document).ready(function($) {

  /**
   * inc/footer.php で圧縮して使用
   */

  // Header slider
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
      ],
      fade: true,
      //cssEase: 'cubic-bezier(0.000, 0.975, 0.505, 0.945)',
      //speed: 700
    });
  }

  // Header YouTube
  if ($('#js-header-youtube').length) {
    $('#js-header-youtube').mb_YTPlayer();
  }

  // News ticker
  if ($('#js-news-ticker').length) {

    var timerId;
    var newsTickerList = $('#js-news-ticker__list');
    var newsTickerListFirst = $('.p-news-ticker__list-item:first-child', newsTickerList);
    var newsTickerBtn = $('#js-news-ticker__btn');

    newsTickerListFirst.addClass('is-active');
    newsTickerBtn
      .attr('href', newsTickerListFirst.children('a').attr('href'))
      .attr('target', newsTickerListFirst.children('a').attr('target') ? '_blank' : '');

    timerId = setInterval(function() {
      $('.is-active', newsTickerList)
        .next().addClass('is-active')
        .end().removeClass('is-active').appendTo(newsTickerList);
      newsTickerBtn
        .attr('href', $('.is-active a', newsTickerList).attr('href'))
        .attr('target', $('.is-active a', newsTickerList).attr('target') ? '_blank' : '');
    }, 5000);
  }
