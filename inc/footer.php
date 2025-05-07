<?php
function tcd_footer() {

	$options = get_design_plus_option();

  if ( is_front_page() ) :
    /*
    if ( 'type1' === $options['header_content_type'] ) :
?>
<script>jQuery(function($) { $('#js-header-slider').slick({autoplay: true, autoplaySpeed: <?php echo esc_js( $options['header_slider_animation_time'] * 1000 ); ?>, infinite: true, slidesToShow: 1, responsive: [{ breakpoint: 768, settings: { arrows: false } }], <?php if ( 'type1' === $options['header_slider_animation'] ) :?>fade: true<?php else : ?>speed: 1000<?php endif; ?> }); });</script>
<?php
		elseif ( 'type3' === $options['header_content_type'] ) : // YouTube
    */
		if ( 'type3' === $options['header_content_type'] ) : // YouTube
?>
<script>jQuery(function(e){e("#js-header-youtube__player").mb_YTPlayer()});</script>
<?php
    endif;
    if ( $options['display_news_ticker'] ) : 
        $news_ticker_array = array();
        for( $i = 1; $i <= 5; $i++ ) :
          if($options['news_ticker_catch' . $i]):
            array_push($news_ticker_array, $options['news_ticker_catch' . $i]);
          endif;
        endfor;
        if(count($news_ticker_array)>1){
?>
<script>jQuery(function(t){if(t("#js-news-ticker").length){var e,a=t("#js-news-ticker__list"),r=t(".p-news-ticker__list-item:first-child",a),i=t("#js-news-ticker__btn");r.addClass("is-active"),i.attr("href",r.children("a").attr("href")).attr("target",r.children("a").attr("target")?"_blank":""),e=setInterval(function(){t(".is-active",a).next().addClass("is-active").end().removeClass("is-active").appendTo(a),i.attr("href",t(".is-active a",a).attr("href")).attr("target",t(".is-active a",a).attr("target")?"_blank":"")},5e3)}});</script>
<?php }else{ ?>
<script>jQuery(function(t){if(t("#js-news-ticker").length){var e,a=t("#js-news-ticker__list_static"),r=t(".p-news-ticker__list-item:first-child",a),i=t("#js-news-ticker__btn");r.addClass("is-active"),i.attr("href",r.children("a").attr("href")).attr("target",r.children("a").attr("target")?"_blank":"")}});</script>
<?php
	}
    endif;
	elseif ( is_post_type_archive( 'style' ) && is_mobile() ) :
?>
<script>jQuery(function(e){e(".p-search__elem-item-title").addClass("p-search__elem-item-title--arrow"),e(".p-search__elem-item-list").hide(),e(".p-search__elem-item-title--arrow").click(function(){e(this).toggleClass("is-active").next(".p-search__elem-item-list:not(:animated)").slideToggle()})});</script>
<?php
	elseif ( is_singular( 'style' ) ) :
?>
<script>jQuery(function(l){l("#js-style-gallery-slider").length&&l("#js-style-gallery-slider").slick({arrows:!1,autoplay:!0,infinite:!0,slidesToShow:1})});</script>
<?php
	elseif ( is_singular( 'post' ) || is_singular( 'news' ) ) :
		if ( 'type5' == $options['sns_type_top'] || 'type5' == $options['sns_type_btm'] ) :
			if ( $options['show_twitter_top'] || $options['show_twitter_btm'] ) :
?>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
<?php
			endif;
			if ( $options['show_fblike_top'] || $options['show_fbshare_top'] || $options['show_fblike_btm'] || $options['show_fbshare_btm'] ) :
?>
<!-- facebook share button code -->
<div id="fb-root"></div>
<script>
(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
   	js = d.createElement(s); js.id = id;
   	js.src = "//connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v2.5";
   	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
<?php
			endif;
			if ( $options['show_google_top'] || $options['show_google_btm'] ) :
?>
<script type="text/javascript">window.___gcfg = {lang: 'ja'};(function() {var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;po.src = 'https://apis.google.com/js/plusone.js';var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);})();
</script>
<?php
			endif;
			if ( $options['show_hatena_top'] || $options['show_hatena_btm'] ) :
?>
<script type="text/javascript" src="http://b.st-hatena.com/js/bookmark_button.js" charset="utf-8" async="async"></script>
<?php
			endif;
			if ( $options['show_pocket_top'] || $options['show_pocket_btm'] ) :
?>
<script type="text/javascript">!function(d,i){if(!d.getElementById(i)){var j=d.createElement("script");j.id=i;j.src="https://widgets.getpocket.com/v1/j/btn.js?v=1";var w=d.getElementById(i);d.body.appendChild(j);}}(document,"pocket-btn-js");</script>
<?php
			endif; 
			if ( $options['show_pinterest_top'] || $options['show_pinterest_btm'] ) :
?>
<script async defer src="//assets.pinterest.com/js/pinit.js"></script>
<?php
			endif; 
		endif; 
	endif;
}
add_action( 'wp_footer', 'tcd_footer' );
