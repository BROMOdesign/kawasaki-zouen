<?php
function beauty_inline_styless() {

	global $post;
	$options = get_design_plus_option();

	$primary_color = $options['primary_color'];
	$secondary_color = $options['secondary_color'];

  switch ( $options['font_type'] ) {
    case 'type1' :
      $font_type_style = 'Verdana, "Hiragino Kaku Gothic ProN", "ヒラギノ角ゴ ProN W3", "メイリオ", Meiryo, sans-serif';
      break;
    case 'type2' :
      $font_type_style = '"Segoe UI", Verdana, "游ゴシック", YuGothic, "Hiragino Kaku Gothic ProN", Meiryo, sans-serif';
      break;
    case 'type3' :
      $font_type_style = '"Times New Roman", "游明朝", "Yu Mincho", "游明朝体", "YuMincho", "ヒラギノ明朝 Pro W3", "Hiragino Mincho Pro", "HiraMinProN-W3", "HGS明朝E", "ＭＳ Ｐ明朝", "MS PMincho", serif; font-weight: 500';
      break;
  }

  switch ( $options['headline_font_type'] ) {
    case 'type1' :
      $headline_font_type_style = 'Verdana, "Hiragino Kaku Gothic ProN", "ヒラギノ角ゴ ProN W3", "メイリオ", Meiryo, sans-serif';
      break;
    case 'type2' :
      $headline_font_type_style = '"Segoe UI", Verdana, "游ゴシック", YuGothic, "Hiragino Kaku Gothic ProN", Meiryo, sans-serif';
      break;
    case 'type3' :
      $headline_font_type_style = '"Times New Roman", "游明朝", "Yu Mincho", "游明朝体", "YuMincho", "ヒラギノ明朝 Pro W3", "Hiragino Mincho Pro", "HiraMinProN-W3", "HGS明朝E", "ＭＳ Ｐ明朝", "MS PMincho", serif; font-weight: 500';
      break;
  }

  if ( is_mobile() ) {
    $header_logo_type = $options['sp_header_use_logo_image'];
    $header_logo_color = $options['sp_header_logo_color']; 
    $header_logo_font_size = $options['sp_header_logo_font_size']; 
  } else {
    $header_logo_type = $options['header_use_logo_image'];
    $header_logo_color = $options['header_logo_color']; 
    $header_logo_font_size = $options['header_logo_font_size']; 
  }
 
  $inline_styles = array();

  // Primary color
  $inline_styles[] = array(
    'selectors' => array(
      '.p-headline',
      '.p-pager__item span', 
      '.p-portfolio__headline', 
      '.p-page-links > span', 
      '.c-pw__btn', 
      '.p-widget__title', 
      '.p-search__submit', 
      '.p-staff-blog__headline',
      '.p-readmore__btn'
    ),
    'properties' => sprintf( 'background: %s', esc_html( $primary_color ) )
  );
  $inline_styles[] = array(
    'selectors' => array(
      '.p-pager__item span', 
      '.p-page-links > span'
    ),
    'properties' => sprintf( 'border-color: %s', esc_html( $primary_color ) )
  );

  // Secondary color
  $inline_styles[] = array(
    'selectors' => array(
      '.p-pagetop a:hover', 
      '.p-nav02__item a:hover', 
      '.p-index-content__btn:hover', 
      '.p-menu-btn.is-active', 
      '.c-pw__btn:hover', 
      '.p-search__submit:hover',
      '.p-readmore__btn:hover'
    ),
    'properties' => sprintf( 'background: %s', esc_html( $secondary_color ) )
  );
  $inline_styles[] = array(
    'selectors' => array(
      '.p-article01__title a:hover',
      '.p-article01__cat a:hover',
      '.p-article02__title a:hover',
      '.p-article03__title a:hover', 
      '.p-breadcrumb a:hover', 
      '.p-entry__cat a:hover', 
      '.p-article04 a:hover .p-article04__title', 
      '.p-article06 a:hover .p-article06__name', 
      '.p-profile__social-item a:hover', 
      '.p-style-author__body:hover .p-style-author__portrait-name', 
      '.p-style-author__body:hover .p-style-author__comment::after', 
      '.p-news-ticker__item-date', 
      '.p-news-ticker__list-item-title:hover', 
      '.p-article05 a:hover .p-article05__title', 
      '.p-news-ticker__list-item-date', 
      '.p-author__name a:hover', 
      '.p-profile__table a:hover', 
      '.p-style__table a:hover'
    ),
    'properties' => sprintf( 'color: %s', esc_html( $secondary_color ) )
  );

  // Content link color
  $inline_styles[] = array(
    'selectors' => '.p-entry__body a',
    'properties' => sprintf( 'color: %s', esc_html( $options['content_link_color'] ) )
  );

  // Font type
  $inline_styles[] = array(
    'selectors' => array(
      'body',
      '.p-global-nav .sub-title', 
      '.p-page-header__sub', 
      '.p-index-content__header-title span'
    ),
    'properties' => sprintf( 'font-family: %s', $font_type_style )
  );

  // Headline font type
  $inline_styles[] = array(
    'selectors' => array(
      '.l-header__tel',
      '.c-logo',
      '.p-global-nav > ul > li > a',
      '.p-page-header__title',
      '.p-banner-list__item-catch',
      '.p-profile__table caption',
      '.p-search__title', 
      '.p-style__data-item-headline',
      '.p-index-content__header-title',
      '.p-header-slider__item-title',
      '.p-header-video__title',
      '.p-header-youtube__title'
    ),
    'properties' => sprintf( 'font-family: %s', $headline_font_type_style )
  );

  // Hover effect
  if ( 'type1' === $options['hover_type'] ) {

    $inline_styles[] = array(
      'selectors' => '.p-hover-effect--type1:hover img',
      'properties' => array(
        sprintf( '-webkit-transform: scale(%s)', esc_html( $options['hover1_zoom'] ) ),
        sprintf( 'transform: scale(%s)', esc_html( $options['hover1_zoom'] ) )
      )
    );

  } elseif ( 'type2' === $options['hover_type'] ) {

    $inline_styles[] = array(
      'selectors' => '.p-hover-effect--type2:hover img',
      'properties' => sprintf( 'opacity:%s', esc_html( $options['hover2_opacity'] ) )
    );

    if ( 'type1' === $options['hover2_direct'] ) {

      $inline_styles[] = array(
        'selectors' => '.p-hover-effect--type2 img',
        'properties' => array(
          'margin-left: 15px',
          '-webkit-transform: scale(1.3) translate3d(-15px, 0, 0)',
          'transform: scale(1.3) translate3d(-15px, 0, 0)'
        )
      );
      $inline_styles[] = array(
        'selectors' => '.p-author__img.p-hover-effect--type2 img',
        'properties' => array(
          'margin-left: 5px',
          '-webkit-transform: scale(1.3) translate3d(-5px, 0, 0)',
          'transform: scale(1.3) translate3d(-5px, 0, 0)'
        )
      );

    } else {

      $inline_styles[] = array(
        'selectors' => '.p-hover-effect--type2 img',
        'properties' => array(
          'margin-left: -15px',
          '-webkit-transform: scale(1.3) translate3d(15px, 0, 0)',
          'transform: scale(1.3) translate3d(15px, 0, 0)'
        )
      );
      $inline_styles[] = array(
        'selectors' => '.p-author__img.p-hover-effect--type2 img',
        'properties' => array(
          'margin-left: -5px',
          '-webkit-transform: scale(1.3) translate3d(5px, 0, 0)',
          'transform: scale(1.3) translate3d(5px, 0, 0)'
        )
      );

    }

  } else { // Hover type3

    $inline_styles[] = array(
      'selectors' => array(
        '.p-hover-effect--type3',
        '.p-article04__img',
        '.p-article06__img'
      ),
      'properties' => sprintf( 'background: %s', esc_html( $options['hover3_bgcolor'] ) )
    );
    $inline_styles[] = array(
      'selectors' => '.p-hover-effect--type3:hover img',
      'properties' => sprintf( 'opacity: %s', esc_html( $options['hover3_opacity'] ) )
    );

  }

  // Logo
  if ( 'type1' === $header_logo_type ) {
    $inline_styles[] = array(
      'selectors' => '.l-header__logo a',
      'properties' => array(
        sprintf( 'color: %s', esc_html( $header_logo_color ) ),
        sprintf( 'font-size: %dpx', esc_html( $header_logo_font_size ) )
      )
    );
  }

  if ( 'type1' === $options['footer_use_logo_image'] ) {
    $inline_styles[] = array(
      'selectors' => '.l-footer__logo',
      'properties' => array(
        sprintf( 'font-size: %dpx', esc_html( $options['footer_logo_font_size'] ) )
      )
    );
  }

  // Header
  $inline_styles[] = array(
    'selectors' => '.l-header',
    'properties' => sprintf( 'background: %s', esc_html( $options['header_bg'] ) )
  );
  $inline_styles[] = array(
    'selectors' => '.l-header__desc',
    'properties' => sprintf( 'color: %s', esc_html( $options['header_desc_color'] ) )
  );
  $inline_styles[] = array(
    'selectors' => '.p-global-nav .sub-menu a',
    'properties' => array(
      sprintf( 'background: %s', esc_html( $options['gnav_sub_bg'] ) ),
      sprintf( 'color: %s', esc_html( $options['gnav_sub_color'] ) )
    )
  );
  $inline_styles[] = array(
    'selectors' => '.p-global-nav .sub-menu a:hover',
    'properties' => array(
      sprintf( 'background: %s', esc_html( $options['gnav_sub_bg_hover'] ) ),
      sprintf( 'color: %s', esc_html( $options['gnav_sub_color_hover'] ) )
    )
  );

  if ( 'type2' === $options['contact_type'] ) {
    $inline_styles[] = array(
      'selectors' => '.p-contact__appointment',
      'properties' => array(
        sprintf( 'background: %s', esc_html( $options['contact_btn_bg'] ) ),
        sprintf( 'color: %s', esc_html( $options['contact_btn_color'] ) )
      )
    );
    $inline_styles[] = array(
      'selectors' => '.p-contact__appointment:hover',
      'properties' => array(
        sprintf( 'background: %s', esc_html( $options['contact_btn_bg_hover'] ) ),
        sprintf( 'color: %s', esc_html( $options['contact_btn_color_hover'] ) )
      )
    );
    $inline_styles[] = array(
      'selectors' => '.p-contact__appointment:hover',
      'properties' => array(
        sprintf( 'background: %s', esc_html( $options['contact_btn_bg_hover'] ) ),
        sprintf( 'color: %s', esc_html( $options['contact_btn_color_hover'] ) )
      )
    );
  }

  // Footer
  $inline_styles[] = array(
    'selectors' => array(
      '.l-footer__info',
      '.p-copyright'
    ),
    'properties' => sprintf( 'background: %s', esc_html( $options['footer_bg'] ) )
  );
  $inline_styles[] = array(
    'selectors' => '.p-copyright',
    'properties' => sprintf( 'border-color: %s', esc_html( $options['footer_border_color'] ) )
  );

  if ( is_front_page() ) {
  
    // Header content
    if ( 'type1' === $options['header_content_type'] ) { // Image slider

      for ( $i = 1; $i <= 5; $i++ ) {

        // Skip the loop if header slider img is not registered
        if ( ! $options['header_slider_img' . $i] ) continue;

        if ( $options['header_slider_catch' . $i] )  {
          $inline_styles[] = array(
            'selectors' => ".p-header-slider__item{$i} .p-header-slider__item-title",
            'properties' => array(
              sprintf( 'color: %s', esc_html( $options['header_slider_catch_color' . $i] ) ),
              sprintf( 'font-size: %dpx', esc_html( $options['header_slider_catch_font_size' . $i] ) )
            )
          );
        }

        if ( $options['header_slider_btn_label' . $i] ) {
          $inline_styles[] = array(
            'selectors' => ".p-header-slider__item{$i} .p-header-slider__item-btn",
            'properties' => array(
              sprintf( 'background: %s', esc_html( $options['header_slider_btn_bg' . $i] ) ),
              sprintf( 'color: %s', esc_html( $options['header_slider_btn_color' . $i] ) )
            )
          );
          $inline_styles[] = array(
            'selectors' => ".p-header-slider__item{$i} .p-header-slider__item-btn:hover",
            'properties' => array(
              sprintf( 'background: %s', esc_html( $options['header_slider_btn_bg_hover' . $i] ) ),
              sprintf( 'color: %s', esc_html( $options['header_slider_btn_color_hover' . $i] ) )
            )
          );
        }
      } // End for loop

    } elseif ( 'type2' === $options['header_content_type'] )  { // Video

      if ( wp_is_mobile() ) { // TB, SP
        $inline_styles[] = array(
          'selectors' => '.p-header-video__img',
          'properties' => sprintf( 'background-image: %s', esc_html( wp_get_attachment_url( $options['header_video_img'] ) ) ),
        );
      }

      if ( $options['header_video_catch'] ) {
        $inline_styles[] = array(
          'selectors' => '.p-header-video__title',
          'properties' => array(
            sprintf( 'color: %s', esc_html( $options['header_video_catch_color'] ) ),
            sprintf( 'font-size: %dpx', esc_html( $options['header_video_catch_font_size'] ) )
          )
        );
      }

      if ( $options['header_video_btn_label'] ) {
        $inline_styles[] = array(
          'selectors' => '.p-header-video__btn',
          'properties' => array(
            sprintf( 'background: %s', esc_html( $options['header_video_btn_bg'] ) ),
            sprintf( 'color: %s', esc_html( $options['header_video_btn_color'] ) )
          )
        );
        $inline_styles[] = array(
          'selectors' => '.p-header-video__btn:hover',
          'properties' => array(
            sprintf( 'background: %s', esc_html( $options['header_video_btn_bg_hover'] ) ),
            sprintf( 'color: %s', esc_html( $options['header_video_btn_color_hover'] ) )
          )
        );
      }

    } else { // YouTube

      if ( wp_is_mobile() ) { // TB, SP
        $inline_styles[] = array(
          'selectors' => '.p-header-youtube__img',
          'properties' => sprintf( 'background-image: %s', esc_html( wp_get_attachment_url( $options['header_youtube_img'] ) ) ),
        );
      }

      if ( $options['header_youtube_catch'] ) {
        $inline_styles[] = array(
          'selectors' => '.p-header-youtube__title',
          'properties' => array(
            sprintf( 'color: %s', esc_html( $options['header_youtube_catch_color'] ) ),
            sprintf( 'font-size: %dpx', esc_html( $options['header_youtube_catch_font_size'] ) )
          )
        );
      }

      if ( $options['header_youtube_btn_label'] ) {
        $inline_styles[] = array(
          'selectors' => '.p-header-youtube__btn',
          'properties' => array(
            sprintf( 'background: %s', esc_html( $options['header_youtube_btn_bg'] ) ),
            sprintf( 'color: %s', esc_html( $options['header_youtube_btn_color'] ) )
          )
        );
        $inline_styles[] = array(
          'selectors' => '.p-header-youtube__btn:hover',
          'properties' => array(
            sprintf( 'background: %s', esc_html( $options['header_youtube_btn_bg_hover'] ) ),
            sprintf( 'color: %s', esc_html( $options['header_youtube_btn_color_hover'] ) )
          )
        );
      }

    } // End header content

    // News ticker
    if ( $options['display_news_ticker'] && $options['news_ticker_btn_label'] ) {
      $inline_styles[] = array(
        'selectors' => '.p-news-ticker__btn',
        'properties' => array(
          sprintf( 'background: %s', esc_html( $options['news_ticker_btn_bg'] ) ),
          sprintf( 'color: %s', esc_html( $options['news_ticker_btn_color'] ) )
        )
      );
      $inline_styles[] = array(
        'selectors' => '.p-news-ticker__btn:hover',
        'properties' => array(
          sprintf( 'background: %s', esc_html( $options['news_ticker_btn_bg_hover'] ) ),
          sprintf( 'color: %s', esc_html( $options['news_ticker_btn_color_hover'] ) )
        )
      );
    }

  } elseif ( is_singular( 'post' ) || is_page() ) {

    $inline_styles[] = array(
      'selectors' => '.p-entry__title',
      'properties' => sprintf( 'font-size: %dpx', esc_html( $options['title_font_size'] ) )
    );
    $inline_styles[] = array(
      'selectors' => array(
        '.p-entry__body', 
        '.p-entry__body p'
      ),
      'properties' => sprintf( 'font-size: %dpx', esc_html( $options['content_font_size'] ) )
    );

  } elseif ( is_singular( 'news' ) ) {

    $inline_styles[] = array(
      'selectors' => '.p-entry__title',
      'properties' => sprintf( 'font-size: %dpx', esc_html( $options['news_title_font_size'] ) )
    );
    $inline_styles[] = array(
      'selectors' => array(
        '.p-entry__body', 
        '.p-entry__body p'
      ),
      'properties' => sprintf( 'font-size: %dpx', esc_html( $options['news_content_font_size'] ) )
    );

  } elseif ( is_singular( 'staff' ) ) {

    $inline_styles[] = array(
      'selectors' => array(
        '.p-profile__table caption', 
        '.p-work-schedule caption'
      ),
      'properties' => array( 
        sprintf( 'background: %s', esc_html( $options['staff_headline_bg'] ) ),
        sprintf( 'color: %s', esc_html( $options['staff_headline_color'] ) )
      )
    );

  } elseif ( is_post_type_archive( 'style' ) || is_tax() ) {

    $inline_styles[] = array(
      'selectors' => '.p-search__elem-item-title',
      'properties' => array( 
        sprintf( 'background: %s', esc_html( $options['style_search_headline_bg'] ) ),
        sprintf( 'color: %s', esc_html( $options['style_search_headline_color'] ) )
      )
    );

  } elseif ( is_singular( 'style' ) ) {

    $inline_styles[] = array(
      'selectors' => array(
        '.p-style__data-item-headline', 
        '.p-style-author__headline'
      ),
      'properties' => array( 
        sprintf( 'background: %s', esc_html( $options['style_headline_bg'] ) ),
        sprintf( 'color: %s', esc_html( $options['style_headline_color'] ) )
      )
    );

  }

  // You can add styles with 'tcd_inline_styles' filter
  $inline_styles = apply_filters( 'tcd_inline_styles', $inline_styles, $options );

  $responsive_styles = array();

  $responsive_styles['max-width: 991px'][] = array(
    'selectors' => '.p-global-nav__inner', 
    'properties' => array( 
      sprintf( 'background: rgba(%s, %s)', esc_html( implode( ',', hex2rgb( $options['gnav_bg_sp'] ) ) ), esc_html( $options['gnav_bg_opacity_sp'] ) ),
      sprintf( 'color: %s', esc_html( $options['style_headline_color'] ) )
    )
  );
  $responsive_styles['max-width: 991px'][] = array(
    'selectors' => '.p-global-nav ul li a', 
    'properties' => array(
      sprintf( 'font-family: %s', $font_type_style ),
      sprintf( 'color: %s !important', esc_html( $options['gnav_color_sp'] ) )
	)
  );

  $responsive_styles['max-width: 767px'][] = array(
    'selectors' => '.p-style + .p-nav02', 
    'properties' => 'display: none'
  );

  // You can add responsive styles with 'tcd_responsive_styles' filter
  $responsive_styles = apply_filters( 'tcd_responsive_styles', $responsive_styles, $options );

  echo '<style>' . "\n";

  $output = '';

  // Add $inline_styles to $output
  foreach ( $inline_styles as $style ) {
    $selectors = is_array( $style['selectors'] ) ? implode( ',', $style['selectors'] ) : $style['selectors']; 
    $properties = is_array( $style['properties'] ) ? implode( ';', $style['properties'] ) : $style['properties']; 
    $output .= sprintf( '%s{%s}', $selectors, $properties ); 
  }

  // Add $responsive_styles to $output
  foreach ( $responsive_styles as $media_query => $styles ) {

    $output .= sprintf( '@media screen and (%s) {', $media_query );

    foreach ( $styles as $style ) {
      $selectors = is_array( $style['selectors'] ) ? implode( ',', $style['selectors'] ) : $style['selectors']; 
      $properties = is_array( $style['properties'] ) ? implode( ';', $style['properties'] ) : $style['properties']; 
      $output .= sprintf( '%s{%s}', $selectors, $properties ); 
    }

    $output .= '}';
  }

  if ( $output ) { echo $output; }
  
  do_action( 'tcd_head', $options );

  // Custom CSS
  if ( $options['css_code'] ) { echo $options['css_code']; }

  echo '</style>' . "\n";

}
add_action( 'wp_head', 'beauty_inline_styless' );

// Custom head/script
function tcd_custom_head() {
  $options = get_design_plus_option();

  if ( $options['custom_head'] ) {
    echo $options['custom_head'] . "\n";
  }
}
add_action( 'wp_head', 'tcd_custom_head', 9999 );