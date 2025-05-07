<?php
/*
 * Manage front page tab
 */

// Add default values
add_filter( 'before_getting_design_plus_option', 'add_top_dp_default_options' );

// Add label of front page tab
add_action( 'tcd_tab_labels', 'add_top_tab_label' );

// Add HTML of front page tab
add_action( 'tcd_tab_panel', 'add_top_tab_panel' );

// Register sanitize function
add_filter( 'theme_options_validate', 'add_top_theme_options_validate' );

global $header_content_type_options;
$header_content_type_options = array();
for ( $i = 1; $i <= 3; $i++ ) {
  $header_content_type_options['type' . $i] = array(
    'value' => 'type' . $i,
    'label' => 1 === $i ? __( 'Image slider', 'tcd-w' ) : ( 2 === $i ? __( 'Video', 'tcd-w' ) : 'YouTube' )
  );
}

global $header_slider_animation_options;
$header_slider_animation_options = array();
for ( $i = 1; $i <= 2; $i++ ) {
  $header_slider_animation_options['type' . $i] = array(
    'value' => 'type' . $i,
    'label' => 1 === $i ? __( 'Fade', 'tcd-w' ) : __( 'Slide', 'tcd-w' )
  );
}

global $header_slider_animation_time_options;
$header_slider_animation_time_options = array();
for ( $i = 5; $i <= 10; $i++ ) {
  $header_slider_animation_time_options[$i] = array(
    'value' => $i,
    'label' => sprintf( __( '%d seconds', 'tcd-w' ), $i )
  );
}

function add_top_dp_default_options( $dp_default_options ) {

  // Header contents
  $dp_default_options['header_content_type'] = 'type1';

  // Image slider
  for ( $i = 1; $i <= 5; $i++ ) {
    $dp_default_options['header_slider_img' . $i] = '';
    $dp_default_options['header_slider_img_sp' . $i] = '';
    $dp_default_options['header_slider_catch' . $i] = sprintf( __( 'Slider %d catchphrase', 'tcd-w' ), $i );
    $dp_default_options['header_slider_catch_font_size' . $i] = 52;
    $dp_default_options['header_slider_catch_color' . $i] = '#ffffff';
    $dp_default_options['header_slider_btn_label' . $i] = '';
    $dp_default_options['header_slider_btn_url' . $i] = '';
    $dp_default_options['header_slider_btn_target' . $i] = '';
    $dp_default_options['header_slider_btn_color' . $i] = '#ffffff';
    $dp_default_options['header_slider_btn_bg' . $i] = '#bbbbbb';
    $dp_default_options['header_slider_btn_color_hover' . $i] = '#ffffff';
    $dp_default_options['header_slider_btn_bg_hover' . $i] = '#422414';
  }
  $dp_default_options['header_slider_animation'] = 'type1';
  $dp_default_options['header_slider_animation_time'] = 5;

  // Video
  $dp_default_options['header_video'] = '';
  $dp_default_options['header_video_img'] = '';
  $dp_default_options['header_video_catch'] = '';
  $dp_default_options['header_video_catch_font_size'] = 52;
  $dp_default_options['header_video_catch_color'] = '#ffffff';
  $dp_default_options['header_video_btn_label'] = '';
  $dp_default_options['header_video_btn_url'] = '';
  $dp_default_options['header_video_btn_target'] = '';
  $dp_default_options['header_video_btn_color'] = '#ffffff';
  $dp_default_options['header_video_btn_bg'] = '#bbbbbb';
  $dp_default_options['header_video_btn_color_hover'] = '#ffffff';
  $dp_default_options['header_video_btn_bg_hover'] = '#422414';

  // YouTube
  $dp_default_options['header_youtube_url'] = '';
  $dp_default_options['header_youtube_img'] = '';
  $dp_default_options['header_youtube_catch'] = '';
  $dp_default_options['header_youtube_catch_font_size'] = 52;
  $dp_default_options['header_youtube_catch_color'] = '#ffffff';
  $dp_default_options['header_youtube_btn_label'] = '';
  $dp_default_options['header_youtube_btn_url'] = '';
  $dp_default_options['header_youtube_btn_target'] = '';
  $dp_default_options['header_youtube_btn_color'] = '#ffffff';
  $dp_default_options['header_youtube_btn_bg'] = '#bbbbbb';
  $dp_default_options['header_youtube_btn_color_hover'] = '#ffffff';
  $dp_default_options['header_youtube_btn_bg_hover'] = '#422414';

  // News ticker
  $dp_default_options['display_news_ticker'] = 1;
  for ( $i = 1; $i <= 5; $i++ ) {
    $dp_default_options['news_ticker_date' . $i] = '2017-12-01';
    $dp_default_options['news_ticker_catch' . $i] = sprintf( __( 'News %d catchphrase', 'tcd-w' ), $i );
    $dp_default_options['news_ticker_url' . $i] = '';
    $dp_default_options['news_ticker_target' . $i] = 0;
  }
  $dp_default_options['news_ticker_btn_label'] = __( 'View details', 'tcd-w' );
  // $dp_default_options['news_ticker_btn_url'] = '';
  // $dp_default_options['news_ticker_btn_target'] = 0;
  $dp_default_options['news_ticker_btn_color'] = '#ffffff';
  $dp_default_options['news_ticker_btn_bg'] = '#111111';
  $dp_default_options['news_ticker_btn_color_hover'] = '#ffffff';
  $dp_default_options['news_ticker_btn_bg_hover'] = '#422414';

  // contents
  $dp_default_options['index_contents_order'] = array( 'news', 'style', 'staff' );

  // News contents
  $dp_default_options['display_index_news'] = 1;
  $dp_default_options['index_news_title'] = 'News';
  $dp_default_options['index_news_title_font_size'] = 34;
  $dp_default_options['index_news_title_color'] = '#ffffff';
  $dp_default_options['index_news_sub'] = __( 'News', 'tcd-w' );
  $dp_default_options['index_news_sub_font_size'] = 12;
  $dp_default_options['index_news_sub_color'] = '#ffffff';
  $dp_default_options['index_news_title_bg'] = '#111111';
  $dp_default_options['index_news_desc'] = __( 'Here is the description of the news content.', 'tcd-w' );
  $dp_default_options['index_news_num'] = 6;
  $dp_default_options['index_news_link_text'] = __( 'News archive', 'tcd-w' );
  
  // Style contents
  $dp_default_options['display_index_style'] = 1;
  $dp_default_options['index_style_title'] = 'Style';
  $dp_default_options['index_style_title_font_size'] = 34;
  $dp_default_options['index_style_title_color'] = '#ffffff';
  $dp_default_options['index_style_sub'] = __( 'Style', 'tcd-w' );
  $dp_default_options['index_style_sub_font_size'] = 12;
  $dp_default_options['index_style_sub_color'] = '#ffffff';
  $dp_default_options['index_style_title_bg'] = '#111111';
  $dp_default_options['index_style_desc'] = __( 'Here is the description of the style content.', 'tcd-w' );
  $dp_default_options['index_style_num'] = 8;
  $dp_default_options['index_style_link_text'] = __( 'Style archive', 'tcd-w' );

  // Staff contents
  $dp_default_options['display_index_staff'] = 1;
  $dp_default_options['index_staff_title'] = 'Staff';
  $dp_default_options['index_staff_title_font_size'] = 34;
  $dp_default_options['index_staff_title_color'] = '#ffffff';
  $dp_default_options['index_staff_sub'] = __( 'Staff', 'tcd-w' );
  $dp_default_options['index_staff_sub_font_size'] = 12;
  $dp_default_options['index_staff_sub_color'] = '#ffffff';
  $dp_default_options['index_staff_title_bg'] = '#111111';
  $dp_default_options['index_staff_desc'] = __( 'Here is the description of the staff content.', 'tcd-w' );;
  $dp_default_options['index_staff_num'] = 4;
  $dp_default_options['index_staff_link_text'] = __( 'Staff archive', 'tcd-w' );

	return $dp_default_options;
}

function add_top_tab_label( $tab_labels ) {
	$tab_labels['top'] = __( 'Front page', 'tcd-w' );
	return $tab_labels;
}

function add_top_tab_panel( $options ) {
  global $dp_default_options, $header_content_type_options, $header_slider_animation_options, $header_slider_animation_time_options;
?>
<div id="tab-content-top">
	<?php // Header slider content ?>
	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Header content settings', 'tcd-w' ); ?></h3>
    <h4 class="theme_option_headline2"><?php _e( 'Header content type', 'tcd-w' ); ?></h4>
    <?php foreach ( $header_content_type_options as $option ) : ?>
    <p><label><input type="radio" name="dp_options[header_content_type]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $option['value'], $options['header_content_type'] ); ?>><?php echo esc_html_e( $option['label'] ); ?></label></p>
    <?php endforeach; ?>
		<input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
	</div>
  <?php // Image slider ?>
  <div id="header_content_type_type1"<?php if ( 'type1' !== $options['header_content_type'] ) { echo ' style="display: none;"'; } ?>>
	  <div class="theme_option_field cf">
  	  <h3 class="theme_option_headline"><?php _e( 'Image slider settings', 'tcd-w' ); ?></h3>
		  <?php for ( $i = 1; $i <= 5; $i++ ) : ?>
		  <div class="sub_box cf"> 
      	<h3 class="theme_option_subbox_headline"><?php _e( 'Slider', 'tcd-w' ); ?><?php echo $i; ?></h3>
      	<div class="sub_box_content">
      		<h4 class="theme_option_headline2"><?php _e( 'Image', 'tcd-w' ); ?></h4>
          <p><?php _e( 'Recommended size: width:1350px, height:630px', 'tcd-w' ); ?></p>
      		<div class="image_box cf">
      			<div class="cf cf_media_field hide-if-no-js">
      				<input type="hidden" value="<?php echo esc_attr( $options['header_slider_img' . $i] ); ?>" id="header_slider_img<?php echo $i; ?>" name="dp_options[header_slider_img<?php echo $i; ?>]" class="cf_media_id">
      				<div class="preview_field"><?php if ( $options['header_slider_img' . $i] ) { echo wp_get_attachment_image( $options['header_slider_img' . $i], 'medium' ); } ?></div>
      				<div class="button_area">
      					<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
      					<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $options['header_slider_img' . $i] ) { echo 'hidden'; } ?>">
      				</div>
      			</div>
      		</div>
      		<h4 class="theme_option_headline2"><?php _e( 'Image for mobile', 'tcd-w' ); ?></h4>
          <p><?php _e( 'Recommended size: width:980px, height:760px', 'tcd-w' ); ?></p>
      		<div class="image_box cf">
      			<div class="cf cf_media_field hide-if-no-js">
      				<input type="hidden" value="<?php echo esc_attr( $options['header_slider_img_sp' . $i] ); ?>" id="header_slider_img_sp<?php echo $i; ?>" name="dp_options[header_slider_img_sp<?php echo $i; ?>]" class="cf_media_id">
      				<div class="preview_field"><?php if ( $options['header_slider_img_sp' . $i] ) { echo wp_get_attachment_image( $options['header_slider_img_sp' . $i], 'medium' ); } ?></div>
      				<div class="button_area">
      					<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
      					<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $options['header_slider_img_sp' . $i] ) { echo 'hidden'; } ?>">
      				</div>
      			</div>
      		</div>
      		<h4 class="theme_option_headline2"><?php _e( 'Catchphrase', 'tcd-w' ); ?></h4>
          <input type="text" class="regular-text" name="dp_options[header_slider_catch<?php echo $i; ?>]" value="<?php echo esc_attr( $options['header_slider_catch' . $i] ); ?>">
          <p><label><?php _e( 'Font size', 'tcd-w' ); ?> <input type="number" min="1" step="1" class="tiny-text" name="dp_options[header_slider_catch_font_size<?php echo $i; ?>]" value="<?php echo esc_attr( $options['header_slider_catch_font_size' . $i] ); ?>"> px</label></p>
          <p><label for="header_slider_catch_color<?php echo $i; ?>"><?php _e( 'Font color', 'tcd-w' ); ?> </label><input type="text" class="c-color-picker" id="header_slider_catch_color<?php echo $i; ?>" name="dp_options[header_slider_catch_color<?php echo $i; ?>]" value="<?php echo esc_attr( $options['header_slider_catch_color' . $i] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['header_slider_catch_color' . $i] ); ?>"></p>
      		<h4 class="theme_option_headline2"><?php _e( 'Button', 'tcd-w' ); ?></h4>
          <p><label><?php _e( 'Button label', 'tcd-w' ); ?> <input type="text" name="dp_options[header_slider_btn_label<?php echo $i; ?>]" value="<?php echo esc_attr( $options['header_slider_btn_label' . $i] ); ?>" class="regular-text"></label></p>
          <p><label><?php _e( 'Link URL', 'tcd-w' ); ?> <input type="text" name="dp_options[header_slider_btn_url<?php echo $i; ?>]" value="<?php echo esc_attr( $options['header_slider_btn_url' . $i] ); ?>" class="regular-text"></label></p>
          <p><label><input type="checkbox" name="dp_options[header_slider_btn_target<?php echo $i; ?>]" value="1" <?php checked( 1, $options['header_slider_btn_target' . $i] ); ?>> <?php _e( 'Open link in new window', 'tcd-w' ); ?></label></p>
          <p><label for="header_slider_btn_color<?php echo $i; ?>"><?php _e( 'Font color', 'tcd-w' ); ?> </label><input type="text" id="header_slider_btn_color<?php echo $i; ?>" class="c-color-picker" name="dp_options[header_slider_btn_color<?php echo $i; ?>]" value="<?php echo esc_attr( $options['header_slider_btn_color' . $i] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['header_slider_btn_color' . $i] ); ?>"></p>
          <p><label for="header_slider_btn_bg<?php echo $i; ?>"><?php _e( 'Background color', 'tcd-w' ); ?> </label><input type="text" id="header_slider_btn_bg<?php echo $i; ?>" class="c-color-picker" name="dp_options[header_slider_btn_bg<?php echo $i; ?>]" value="<?php echo esc_attr( $options['header_slider_btn_bg' . $i] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['header_slider_btn_bg' . $i] ); ?>"></p>
          <p><label for="header_slider_btn_color_hover<?php echo $i; ?>"><?php _e( 'Font color on hover', 'tcd-w' ); ?> </label><input type="text" id="header_slider_btn_color_hover<?php echo $i; ?>" class="c-color-picker" name="dp_options[header_slider_btn_color_hover<?php echo $i; ?>]" value="<?php echo esc_attr( $options['header_slider_btn_color_hover' . $i] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['header_slider_btn_color_hover' . $i] ); ?>"></p>
          <p><label for="header_slider_btn_bg_hover<?php echo $i; ?>"><?php _e( 'Background color on hover', 'tcd-w' ); ?> </label><input type="text" id="header_slider_btn_bg_hover<?php echo $i; ?>" class="c-color-picker" name="dp_options[header_slider_btn_bg_hover<?php echo $i; ?>]" value="<?php echo esc_attr( $options['header_slider_btn_bg_hover' . $i] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['header_slider_btn_bg_hover' . $i] ); ?>"></p>
		  		<input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
		  	</div>
		  </div><!-- .sub_box END -->
		  <?php endfor; ?>	
      <h4 class="theme_option_headline2"><?php _e( 'Image slider animation', 'tcd-w' ); ?></h4>
      <?php foreach ( $header_slider_animation_options as $option ) : ?>
      <p><label><input type="radio" name="dp_options[header_slider_animation]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $option['value'], $options['header_slider_animation'] ); ?>> <?php echo esc_attr_e( $option['label'] ); ?></label></p>
      <?php endforeach; ?>
      <h4 class="theme_option_headline2"><?php _e( 'Image slider animation time', 'tcd-w' ); ?></h4>
      <select name="dp_options[header_slider_animation_time]">
        <?php foreach ( $header_slider_animation_time_options as $option ) : ?>
        <option value="<?php echo esc_attr( $option['value'] ); ?>" <?php selected( $option['value'], $options['header_slider_animation_time'] ); ?>><?php echo esc_attr_e( $option['label'] ); ?></option>
        <?php endforeach; ?>
      </select>
		  <input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
    </div>
  </div>
  <?php // Video ?>
  <div id="header_content_type_type2"<?php if ( 'type2' !== $options['header_content_type'] ) { echo ' style="display: none;"'; } ?>>
	  <div class="theme_option_field cf">
  	  <h3 class="theme_option_headline"><?php _e( 'Video settings', 'tcd-w' ); ?></h3>
      <h4 class="theme_option_headline2"><?php _e( 'Video file', 'tcd-w' ); ?></h4>
      <p><?php _e( 'Please upload MP4 format file.', 'tcd-w' ); ?></p>
      <div class="image_box cf">
		    <div class="cf cf_media_field hide-if-no-js header_video">
		    	<input type="hidden" value="<?php echo esc_attr( $options['header_video'] ); ?>" id="header_video" name="dp_options[header_video]" class="cf_media_id">
		    	<div class="preview_field preview_field_video">
		    		<?php if ( $options['header_video'] ) : ?>
		    		<h5><?php _e( 'Uploaded MP4 file', 'tcd-w' ); ?></h5>
        		<p><?php echo esc_html( wp_get_attachment_url( $options['header_video'] ) ); ?></p>
		    		<?php endif; ?>
        	</div>
        	<div class="button_area">
        		<input type="button" value="<?php _e( 'Select MP4 file', 'tcd-w' ); ?>" class="cfmf-select-video button">
        		<input type="button" value="<?php _e( 'Remove MP4 file', 'tcd-w' ); ?>" class="cfmf-delete-video button <?php if ( ! $options['header_video'] ) { echo 'hidden'; }; ?>">
        	</div>
        </div>
      </div>
      <h4 class="theme_option_headline2"><?php _e( 'Substitute image', 'tcd-w' ); ?></h4>
      <p><?php _e( 'Substitute image is displayed on tablet and mobile devices. Recommended size: width:1350px, height:630px', 'tcd-w' ); ?></p>
      <div class="image_box cf">
      	<div class="cf cf_media_field hide-if-no-js">
      		<input type="hidden" value="<?php echo esc_attr( $options['header_video_img'] ); ?>" id="header_video_img" name="dp_options[header_video_img]" class="cf_media_id">
      		<div class="preview_field"><?php if ( $options['header_video_img'] ) { echo wp_get_attachment_image( $options['header_video_img'], 'medium' ); } ?></div>
      		<div class="button_area">
      			<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
      			<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $options['header_video_img'] ) { echo 'hidden'; } ?>">
      		</div>
      	</div>
      </div>
      <h4 class="theme_option_headline2"><?php _e( 'Catchphrase', 'tcd-w' ); ?></h4>
      <input type="text" class="regular-text" name="dp_options[header_video_catch]" value="<?php echo esc_attr( $options['header_video_catch'] ); ?>">
      <p><label><?php _e( 'Font size', 'tcd-w' ); ?> <input type="number" min="1" step="1" name="dp_options[header_video_catch_font_size]" value="<?php echo esc_attr( $options['header_video_catch_font_size'] ); ?>" class="tiny-text"> px</label></p>
      <p><label for="header_video_catch_color"><?php _e( 'Font color', 'tcd-w' ); ?></label> <input type="text" class="c-color-picker" name="dp_options[header_video_catch_color]" value="<?php echo esc_attr( $options['header_video_catch_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['header_video_catch_color'] ); ?>"></p>
      <h4 class="theme_option_headline2"><?php _e( 'Button', 'tcd-w' ); ?></h4>
      <p><label><?php _e( 'Button label', 'tcd-w' ); ?> <input type="text" name="dp_options[header_video_btn_label]" value="<?php echo esc_attr( $options['header_video_btn_label'] ); ?>" class="regular-text"></label></p>
      <p><label><?php _e( 'Link URL', 'tcd-w' ); ?> <input type="text" name="dp_options[header_video_btn_url]" value="<?php echo esc_attr( $options['header_video_btn_url'] ); ?>" class="regular-text"></label></p>
      <p><label><input type="checkbox" name="dp_options[header_video_btn_target]" value="1" <?php checked( 1, $options['header_video_btn_target'] ); ?>> <?php _e( 'Open link in new window', 'tcd-w' ); ?></label></p>
      <p><label for="header_video_btn_color"><?php _e( 'Font color', 'tcd-w' ); ?> </label><input type="text" id="header_video_btn_color" class="c-color-picker" name="dp_options[header_video_btn_color]" value="<?php echo esc_attr( $options['header_video_btn_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['header_video_btn_color'] ); ?>"></p>
      <p><label for="header_video_btn_bg"><?php _e( 'Background color', 'tcd-w' ); ?> </label><input type="text" id="header_video_btn_bg" class="c-color-picker" name="dp_options[header_video_btn_bg]" value="<?php echo esc_attr( $options['header_video_btn_bg'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['header_video_btn_bg'] ); ?>"></p>
      <p><label for="header_video_btn_color_hover"><?php _e( 'Font color on hover', 'tcd-w' ); ?> </label><input type="text" id="header_video_btn_color_hover" class="c-color-picker" name="dp_options[header_video_btn_color_hover]" value="<?php echo esc_attr( $options['header_video_btn_color_hover'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['header_video_btn_color_hover'] ); ?>"></p>
      <p><label for="header_video_btn_bg_hover"><?php _e( 'Background color on hover', 'tcd-w' ); ?> </label><input type="text" id="header_video_btn_bg_hover" class="c-color-picker" name="dp_options[header_video_btn_bg_hover]" value="<?php echo esc_attr( $options['header_video_btn_bg_hover'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['header_video_btn_bg_hover'] ); ?>"></p>
		<input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
    </div>
  </div>
  <?php // YouTube ?>
  <div id="header_content_type_type3"<?php if ( 'type3' !== $options['header_content_type'] ) { echo ' style="display: none;"'; } ?>>
	  <div class="theme_option_field cf">
  	  <h3 class="theme_option_headline"><?php _e( 'YouTube settings', 'tcd-w' ); ?></h3>
      <h4 class="theme_option_headline2"><?php _e( 'YouTube URL', 'tcd-w' ); ?></h4>
      <input type="text" class="regular-text" name="dp_options[header_youtube_url]" value="<?php echo esc_attr( $options['header_youtube_url'] ); ?>">
      <h4 class="theme_option_headline2"><?php _e( 'Substitute image', 'tcd-w' ); ?></h4>
      <p><?php _e( 'Substitute image is displayed on tablet and mobile devices. Recommended size: width:1350px, height:630px', 'tcd-w' ); ?></p>
      <div class="image_box cf">
      	<div class="cf cf_media_field hide-if-no-js">
      		<input type="hidden" value="<?php echo esc_attr( $options['header_youtube_img'] ); ?>" id="header_youtube_img" name="dp_options[header_youtube_img]" class="cf_media_id">
      		<div class="preview_field"><?php if ( $options['header_youtube_img'] ) { echo wp_get_attachment_image( $options['header_youtube_img'], 'medium' ); } ?></div>
      		<div class="button_area">
      			<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
      			<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $options['header_youtube_img'] ) { echo 'hidden'; } ?>">
      		</div>
      	</div>
      </div>
      <h4 class="theme_option_headline2"><?php _e( 'Catchphrase', 'tcd-w' ); ?></h4>
      <input type="text" class="regular-text" name="dp_options[header_youtube_catch]" value="<?php echo esc_attr( $options['header_youtube_catch'] ); ?>">
      <p><label><?php _e( 'Font size', 'tcd-w' ); ?> <input type="number" min="1" step="1" name="dp_options[header_youtube_catch_font_size]" value="<?php echo esc_attr( $options['header_youtube_catch_font_size'] ); ?>" class="tiny-text"> px</label></p>
      <p><label for="header_youtube_catch_color"><?php _e( 'Font color', 'tcd-w' ); ?></label> <input type="text" class="c-color-picker" name="dp_options[header_youtube_catch_color]" value="<?php echo esc_attr( $options['header_youtube_catch_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['header_youtube_catch_color'] ); ?>"></p>
      <h4 class="theme_option_headline2"><?php _e( 'Button', 'tcd-w' ); ?></h4>
      <p><label><?php _e( 'Button label', 'tcd-w' ); ?> <input type="text" name="dp_options[header_youtube_btn_label]" value="<?php echo esc_attr( $options['header_youtube_btn_label'] ); ?>" class="regular-text"></label></p>
      <p><label><?php _e( 'Link URL', 'tcd-w' ); ?> <input type="text" name="dp_options[header_youtube_btn_url]" value="<?php echo esc_attr( $options['header_youtube_btn_url'] ); ?>" class="regular-text"></label></p>
      <p><label><input type="checkbox" name="dp_options[header_youtube_btn_target]" value="1" <?php checked( 1, $options['header_youtube_btn_target'] ); ?>> <?php _e( 'Open link in new window', 'tcd-w' ); ?></label></p>
      <p><label for="header_youtube_btn_color"><?php _e( 'Font color', 'tcd-w' ); ?> </label><input type="text" id="header_youtube_btn_color" class="c-color-picker" name="dp_options[header_youtube_btn_color]" value="<?php echo esc_attr( $options['header_youtube_btn_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['header_youtube_btn_color'] ); ?>"></p>
      <p><label for="header_youtube_btn_bg"><?php _e( 'Background color', 'tcd-w' ); ?> </label><input type="text" id="header_youtube_btn_bg" class="c-color-picker" name="dp_options[header_youtube_btn_bg]" value="<?php echo esc_attr( $options['header_youtube_btn_bg'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['header_youtube_btn_bg'] ); ?>"></p>
      <p><label for="header_youtube_btn_color_hover"><?php _e( 'Font color on hover', 'tcd-w' ); ?> </label><input type="text" id="header_youtube_btn_color_hover" class="c-color-picker" name="dp_options[header_youtube_btn_color_hover]" value="<?php echo esc_attr( $options['header_youtube_btn_color_hover'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['header_youtube_btn_color_hover'] ); ?>"></p>
      <p><label for="header_youtube_btn_bg_hover"><?php _e( 'Background color on hover', 'tcd-w' ); ?> </label><input type="text" id="header_youtube_btn_bg_hover" class="c-color-picker" name="dp_options[header_youtube_btn_bg_hover]" value="<?php echo esc_attr( $options['header_youtube_btn_bg_hover'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['header_youtube_btn_bg_hover'] ); ?>"></p>
		  <input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
    </div>
  </div>
	<?php // News ticker ?>
	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'News ticker settings', 'tcd-w' ); ?></h3>
		<p><label><input type="checkbox" name="dp_options[display_news_ticker]" value="1" <?php checked( 1, $options['display_news_ticker'] ); ?>> <?php _e( 'Display news ticker', 'tcd-w' ); ?></label></p>
		<?php for ( $i = 1; $i <= 5; $i++ ) : ?>
		<div class="sub_box cf"> 
    	<h3 class="theme_option_subbox_headline"><?php printf( __( 'News %d', 'tcd-w' ), $i ); ?></h3>
    	<div class="sub_box_content">
    		<h4 class="theme_option_headline2"><?php _e( 'Date', 'tcd-w' ); ?></h4>
        <input type="date" name="dp_options[news_ticker_date<?php echo $i; ?>]" value="<?php echo esc_attr( $options['news_ticker_date' . $i] ); ?>">
    		<h4 class="theme_option_headline2"><?php _e( 'Catchphrase', 'tcd-w' ); ?></h4>
        <input type="text" name="dp_options[news_ticker_catch<?php echo $i; ?>]" value="<?php echo esc_attr( $options['news_ticker_catch' . $i] ); ?>" class="large-text">
    		<h4 class="theme_option_headline2">URL</h4>
        <input type="text" name="dp_options[news_ticker_url<?php echo $i; ?>]" value="<?php echo esc_attr( $options['news_ticker_url' . $i] ); ?>" class="regular-text">
        <p><label><input type="checkbox" name="dp_options[news_ticker_target<?php echo $i; ?>]" value="1" <?php checked( 1, $options['news_ticker_target' . $i] ); ?>> <?php _e( 'Open link in new window', 'tcd-w' ); ?></label></p>
				<input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
			</div>
		</div><!-- .sub_box END -->
		<?php endfor; ?>	
    <h4 class="theme_option_headline2"><?php _e( 'Button settings', 'tcd-w' ); ?></h4>
    <p><label><?php _e( 'Button label', 'tcd-w' ); ?> <input type="text" name="dp_options[news_ticker_btn_label]" value="<?php echo esc_attr( $options['news_ticker_btn_label'] ); ?>" class="regular-text"></label></p>
    <?php /*
    <p><label><?php _e( 'Link URL', 'tcd-w' ); ?> <input type="text" name="dp_options[news_ticker_btn_url]" value="<?php echo esc_attr( $options['news_ticker_btn_url'] ); ?>" class="regular-text"></label></p>
    <p><label><input type="checkbox" name="dp_options[news_ticker_btn_target]" value="1" <?php checked( 1, $options['news_ticker_btn_target'] ); ?>> <?php _e( 'Open link in new window', 'tcd-w' ); ?></label></p>
    */ ?>
    <p><label for="news_ticker_btn_color"><?php _e( 'Font color', 'tcd-w' ); ?> </label><input type="text" id="news_ticker_btn_color" class="c-color-picker" name="dp_options[news_ticker_btn_color]" value="<?php echo esc_attr( $options['news_ticker_btn_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['news_ticker_btn_color'] ); ?>"></p>
    <p><label for="news_ticker_btn_bg"><?php _e( 'Background color', 'tcd-w' ); ?> </label><input type="text" id="news_ticker_btn_bg" class="c-color-picker" name="dp_options[news_ticker_btn_bg]" value="<?php echo esc_attr( $options['news_ticker_btn_bg'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['news_ticker_btn_bg'] ); ?>"></p>
    <p><label for="news_ticker_btn_color_hover"><?php _e( 'Font color on hover', 'tcd-w' ); ?> </label><input type="text" id="news_ticker_btn_color_hover" class="c-color-picker" name="dp_options[news_ticker_btn_color_hover]" value="<?php echo esc_attr( $options['news_ticker_btn_color_hover'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['news_ticker_btn_color_hover'] ); ?>"></p>
    <p><label for="news_ticker_btn_bg_hover"><?php _e( 'Background color on hover', 'tcd-w' ); ?> </label><input type="text" id="news_ticker_btn_bg_hover" class="c-color-picker" name="dp_options[news_ticker_btn_bg_hover]" value="<?php echo esc_attr( $options['news_ticker_btn_bg_hover'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['news_ticker_btn_bg_hover'] ); ?>"></p>
		<input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
	</div>
	<?php // ?>
	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Main content', 'tcd-w' ); ?></h3>
    <p><?php _e( 'You can change order by dragging each headline of option field.', 'tcd-w' ); ?></p>
    <div class="sortable">
      <?php 
      foreach ( $options['index_contents_order'] as $order ) :
        if ( 'news' === $order ) :
      ?>
		  <div class="sub_box cf"> 
      	<h3 class="theme_option_subbox_headline"><?php _e( 'News contents', 'tcd-w' ); ?></h3>
      	<div class="sub_box_content">
          <input type="hidden" name="dp_options[index_contents_order][]" value="news">
          <p><label><input type="checkbox" name="dp_options[display_index_news]" value="1" <?php checked( 1, $options['display_index_news'] ); ?>> <?php _e( 'Display this contents', 'tcd-w' ); ?></label></p>
      		<h4 class="theme_option_headline2"><?php _e( 'Title', 'tcd-w' ); ?></h4>
          <input type="text" name="dp_options[index_news_title]" value="<?php echo esc_attr( $options['index_news_title'] ); ?>" class="regular-text">
          <p><label><?php _e( 'Font size', 'tcd-w' ); ?> <input class="tiny-text" type="number" min="1" step="1" name="dp_options[index_news_title_font_size]" value="<?php echo esc_attr( $options['index_news_title_font_size'] ); ?>"> px</label></p>
          <p><label for="index_news_title_color"><?php _e( 'Font color', 'tcd-w' ); ?> </label><input type="text" class="c-color-picker" id="index_news_title_color" name="dp_options[index_news_title_color]" value="<?php echo esc_attr( $options['index_news_title_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['index_news_title_color'] ); ?>"></p>
      		<h4 class="theme_option_headline2"><?php _e( 'Sub title', 'tcd-w' ); ?></h4>
          <input type="text" name="dp_options[index_news_sub]" value="<?php echo esc_attr( $options['index_news_sub'] ); ?>" class="regular-text">
          <p><label><?php _e( 'Font size', 'tcd-w' ); ?> <input class="tiny-text" type="number" min="1" step="1" name="dp_options[index_news_sub_font_size]" value="<?php echo esc_attr( $options['index_news_sub_font_size'] ); ?>"> px</label></p>
          <p><label for="index_news_sub_color"><?php _e( 'Font color', 'tcd-w' ); ?> </label><input type="text" class="c-color-picker" id="index_news_sub_color" name="dp_options[index_news_sub_color]" value="<?php echo esc_attr( $options['index_news_sub_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['index_news_sub_color'] ); ?>"></p>
      		<h4 class="theme_option_headline2"><?php _e( 'Background color of title and sub title', 'tcd-w' ); ?></h4>
          <input type="text" class="c-color-picker" name="dp_options[index_news_title_bg]" value="<?php echo esc_attr( $options['index_news_title_bg'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['index_news_title_bg'] ); ?>">
      		<h4 class="theme_option_headline2"><?php _e( 'Description', 'tcd-w' ); ?></h4>
          <textarea class="large-text" name="dp_options[index_news_desc]"><?php echo esc_textarea( $options['index_news_desc'] ); ?></textarea>
      		<h4 class="theme_option_headline2"><?php _e( 'Display number', 'tcd-w' ); ?></h4>
          <input class="tiny-text" type="number" min="1" step="1" name="dp_options[index_news_num]" value="<?php echo esc_attr( $options['index_news_num'] ); ?>"><?php _e( ' posts', 'tcd-w' ); ?>
      		<h4 class="theme_option_headline2"><?php _e( 'Archive link', 'tcd-w' ); ?></h4>
          <p><label><?php _e( 'Link text', 'tcd-w' ); ?> <input type="text" class="regular-text" name="dp_options[index_news_link_text]" value="<?php echo esc_attr( $options['index_news_link_text'] ); ?>"></label></p>
		  		<input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
		  	</div>
		  </div><!-- .sub_box END -->
      <?php
        elseif ( 'style' === $order ) :
      ?>
		  <div class="sub_box cf"> 
      	<h3 class="theme_option_subbox_headline"><?php _e( 'Style contents', 'tcd-w' ); ?></h3>
      	<div class="sub_box_content">
          <input type="hidden" name="dp_options[index_contents_order][]" value="style">
          <p><label><input type="checkbox" name="dp_options[display_index_style]" value="1" <?php checked( 1, $options['display_index_style'] ); ?>> <?php _e( 'Display this contents', 'tcd-w' ); ?></label></p>
      		<h4 class="theme_option_headline2"><?php _e( 'Title', 'tcd-w' ); ?></h4>
          <input type="text" name="dp_options[index_style_title]" value="<?php echo esc_attr( $options['index_style_title'] ); ?>" class="regular-text">
          <p><label><?php _e( 'Font size', 'tcd-w' ); ?> <input class="tiny-text" type="number" min="1" step="1" name="dp_options[index_style_title_font_size]" value="<?php echo esc_attr( $options['index_style_title_font_size'] ); ?>"> px</label></p>
          <p><label for="index_style_title_color"><?php _e( 'Font color', 'tcd-w' ); ?> </label><input type="text" class="c-color-picker" id="index_style_title_color" name="dp_options[index_style_title_color]" value="<?php echo esc_attr( $options['index_style_title_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['index_style_title_color'] ); ?>"></p>
      		<h4 class="theme_option_headline2"><?php _e( 'Sub title', 'tcd-w' ); ?></h4>
          <input type="text" name="dp_options[index_style_sub]" value="<?php echo esc_attr( $options['index_style_sub'] ); ?>" class="regular-text">
          <p><label><?php _e( 'Font size', 'tcd-w' ); ?> <input class="tiny-text" type="number" min="1" step="1" name="dp_options[index_style_sub_font_size]" value="<?php echo esc_attr( $options['index_style_sub_font_size'] ); ?>"> px</label></p>
          <p><label for="index_style_sub_color"><?php _e( 'Font color', 'tcd-w' ); ?> </label><input type="text" class="c-color-picker" id="index_style_sub_color" name="dp_options[index_style_sub_color]" value="<?php echo esc_attr( $options['index_style_sub_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['index_style_sub_color'] ); ?>"></p>
      		<h4 class="theme_option_headline2"><?php _e( 'Background color of title and sub title', 'tcd-w' ); ?></h4>
          <input type="text" class="c-color-picker" name="dp_options[index_style_title_bg]" value="<?php echo esc_attr( $options['index_style_title_bg'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['index_style_title_bg'] ); ?>">
      		<h4 class="theme_option_headline2"><?php _e( 'Description', 'tcd-w' ); ?></h4>
          <textarea class="large-text" name="dp_options[index_style_desc]"><?php echo esc_textarea( $options['index_style_desc'] ); ?></textarea>
      		<h4 class="theme_option_headline2"><?php _e( 'Display number', 'tcd-w' ); ?></h4>
          <input class="tiny-text" type="number" min="1" step="1" name="dp_options[index_style_num]" value="<?php echo esc_attr( $options['index_style_num'] ); ?>"><?php _e( ' posts', 'tcd-w' ); ?>
      		<h4 class="theme_option_headline2"><?php _e( 'Archive link', 'tcd-w' ); ?></h4>
          <p><label><?php _e( 'Link text', 'tcd-w' ); ?> <input type="text" class="regular-text" name="dp_options[index_style_link_text]" value="<?php echo esc_attr( $options['index_style_link_text'] ); ?>"></label></p>
      		<h4 class="theme_option_headline2"><?php _e( 'Post order', 'tcd-w' ); ?></h4>
          <p><?php _e( 'You can change the order of styles by dragging in admin style list page. This order also applys to archive page.', 'tcd-w' ); ?></p>
		  		<input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
		  	</div>
		  </div><!-- .sub_box END -->
      <?php
        elseif ( 'staff' === $order ) :
      ?>
		  <div class="sub_box cf"> 
      	<h3 class="theme_option_subbox_headline"><?php _e( 'Staff contents', 'tcd-w' ); ?></h3>
      	<div class="sub_box_content">
          <input type="hidden" name="dp_options[index_contents_order][]" value="staff">
          <p><label><input type="checkbox" name="dp_options[display_index_staff]" value="1" <?php checked( 1, $options['display_index_staff'] ); ?>> <?php _e( 'Display this contents', 'tcd-w' ); ?></label></p>
      		<h4 class="theme_option_headline2"><?php _e( 'Title', 'tcd-w' ); ?></h4>
          <input type="text" name="dp_options[index_staff_title]" value="<?php echo esc_attr( $options['index_staff_title'] ); ?>" class="regular-text">
          <p><label><?php _e( 'Font size', 'tcd-w' ); ?> <input class="tiny-text" type="number" min="1" step="1" name="dp_options[index_staff_title_font_size]" value="<?php echo esc_attr( $options['index_staff_title_font_size'] ); ?>"> px</label></p>
          <p><label for="index_staff_title_color"><?php _e( 'Font color', 'tcd-w' ); ?> </label><input type="text" class="c-color-picker" id="index_staff_title_color" name="dp_options[index_staff_title_color]" value="<?php echo esc_attr( $options['index_staff_title_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['index_staff_title_color'] ); ?>"></p>
      		<h4 class="theme_option_headline2"><?php _e( 'Sub title', 'tcd-w' ); ?></h4>
          <input type="text" name="dp_options[index_staff_sub]" value="<?php echo esc_attr( $options['index_staff_sub'] ); ?>" class="regular-text">
          <p><label><?php _e( 'Font size', 'tcd-w' ); ?> <input class="tiny-text" type="number" min="1" step="1" name="dp_options[index_staff_sub_font_size]" value="<?php echo esc_attr( $options['index_staff_sub_font_size'] ); ?>"> px</label></p>
          <p><label for="index_staff_sub_color"><?php _e( 'Font color', 'tcd-w' ); ?> </label><input type="text" class="c-color-picker" id="index_staff_sub_color" name="dp_options[index_staff_sub_color]" value="<?php echo esc_attr( $options['index_staff_sub_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['index_staff_sub_color'] ); ?>"></p>
      		<h4 class="theme_option_headline2"><?php _e( 'Background color of title and sub title', 'tcd-w' ); ?></h4>
          <input type="text" class="c-color-picker" name="dp_options[index_staff_title_bg]" value="<?php echo esc_attr( $options['index_staff_title_bg'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['index_staff_title_bg'] ); ?>">
      		<h4 class="theme_option_headline2"><?php _e( 'Description', 'tcd-w' ); ?></h4>
          <textarea class="large-text" name="dp_options[index_staff_desc]"><?php echo esc_textarea( $options['index_staff_desc'] ); ?></textarea>
      		<h4 class="theme_option_headline2"><?php _e( 'Display number', 'tcd-w' ); ?></h4>
          <input class="tiny-text" type="number" min="1" step="1" name="dp_options[index_staff_num]" value="<?php echo esc_attr( $options['index_staff_num'] ); ?>"><?php _e( ' posts', 'tcd-w' ); ?>
      		<h4 class="theme_option_headline2"><?php _e( 'Archive link', 'tcd-w' ); ?></h4>
          <p><label><?php _e( 'Link text', 'tcd-w' ); ?> <input type="text" class="regular-text" name="dp_options[index_staff_link_text]" value="<?php echo esc_attr( $options['index_staff_link_text'] ); ?>"></label></p>
      		<h4 class="theme_option_headline2"><?php _e( 'Post order', 'tcd-w' ); ?></h4>
          <p><?php _e( 'You can change the order of staffs by dragging in admin staff list page. This order also applys to archive page.', 'tcd-w' ); ?></p>
		  		<input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
		  	</div>
		  </div><!-- .sub_box END -->
      <?php endif; endforeach; ?>
		  <input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
    </div>
  </div>
</div><!-- END #tab-content3 -->
<?php
}

function add_top_theme_options_validate( $input ) {

  global $header_content_type_options, $header_slider_animation_options, $recent_post_num_options, $style_list_num_options, $staff_list_num_options, $header_slider_animation_time_options;

  // Header contents
  if ( ! isset( $input['header_content_type'] ) ) $input['header_content_type'] = null;
  if ( ! array_key_exists( $input['header_content_type'], $header_content_type_options ) ) $input['header_content_type'] = null;

  // Image slider
  for ( $i = 1; $i <= 5; $i++ ) {
	  $input['header_slider_img' . $i] = wp_filter_nohtml_kses( $input['header_slider_img' . $i] );
	  $input['header_slider_img_sp' . $i] = wp_filter_nohtml_kses( $input['header_slider_img_sp' . $i] );
	  $input['header_slider_catch' . $i] = $input['header_slider_catch' . $i]; // Not apply sanitization
	  $input['header_slider_catch_font_size' . $i] = wp_filter_nohtml_kses( $input['header_slider_catch_font_size' . $i] );
	  $input['header_slider_catch_color' . $i] = wp_filter_nohtml_kses( $input['header_slider_catch_color' . $i] );
	  $input['header_slider_btn_label' . $i] = wp_filter_nohtml_kses( $input['header_slider_btn_label' . $i] );
	  $input['header_slider_btn_url' . $i] = wp_filter_nohtml_kses( $input['header_slider_btn_url' . $i] );
    if ( ! isset( $input['header_slider_btn_target' . $i] ) ) $input['header_slider_btn_target' . $i] = null;
    $input['header_slider_btn_target' . $i] = ( $input['header_slider_btn_target' . $i] == 1 ? 1 : 0 );
	  $input['header_slider_btn_color' . $i] = wp_filter_nohtml_kses( $input['header_slider_btn_color' . $i] );
	  $input['header_slider_btn_color_hover' . $i] = wp_filter_nohtml_kses( $input['header_slider_btn_color_hover' . $i] );
	  $input['header_slider_btn_bg' . $i] = wp_filter_nohtml_kses( $input['header_slider_btn_bg' . $i] );
	  $input['header_slider_btn_bg_hover' . $i] = wp_filter_nohtml_kses( $input['header_slider_btn_bg_hover' . $i] );
  }
  if ( ! isset( $input['header_slider_animation'] ) ) $input['header_slider_animation'] = null;
  if ( ! array_key_exists( $input['header_slider_animation'], $header_slider_animation_options ) ) $input['header_slider_animation'] = null;
  if ( ! isset( $input['header_slider_animation_time'] ) ) $input['header_slider_animation_time'] = null;
  if ( ! array_key_exists( $input['header_slider_animation_time'], $header_slider_animation_time_options ) ) $input['header_slider_animation_time'] = null;

  // Video
	$input['header_video'] = wp_filter_nohtml_kses( $input['header_video'] );
	$input['header_video_img'] = wp_filter_nohtml_kses( $input['header_video_img'] );
	$input['header_video_catch'] = wp_filter_nohtml_kses( $input['header_video_catch'] );
	$input['header_video_catch_font_size'] = wp_filter_nohtml_kses( $input['header_video_catch_font_size'] );
	$input['header_video_catch_color'] = wp_filter_nohtml_kses( $input['header_video_catch_color'] );
	$input['header_video_btn_label'] = wp_filter_nohtml_kses( $input['header_video_btn_label'] );
	$input['header_video_btn_url'] = wp_filter_nohtml_kses( $input['header_video_btn_url'] );
  if ( ! isset( $input['header_video_btn_target'] ) ) $input['header_video_btn_target'] = null;
  $input['header_video_btn_target'] = ( $input['header_video_btn_target'] == 1 ? 1 : 0 );
	$input['header_video_btn_color'] = wp_filter_nohtml_kses( $input['header_video_btn_color'] );
	$input['header_video_btn_bg'] = wp_filter_nohtml_kses( $input['header_video_btn_bg'] );
	$input['header_video_btn_color_hover'] = wp_filter_nohtml_kses( $input['header_video_btn_color_hover'] );
	$input['header_video_btn_bg_hover'] = wp_filter_nohtml_kses( $input['header_video_btn_bg_hover'] );

  // YouTube
	$input['header_youtube_url'] = wp_filter_nohtml_kses( $input['header_youtube_url'] );
	$input['header_youtube_img'] = wp_filter_nohtml_kses( $input['header_youtube_img'] );
	$input['header_youtube_catch'] = wp_filter_nohtml_kses( $input['header_youtube_catch'] );
	$input['header_youtube_catch_font_size'] = wp_filter_nohtml_kses( $input['header_youtube_catch_font_size'] );
	$input['header_youtube_catch_color'] = wp_filter_nohtml_kses( $input['header_youtube_catch_color'] );
	$input['header_youtube_btn_label'] = wp_filter_nohtml_kses( $input['header_youtube_btn_label'] );
	$input['header_youtube_btn_url'] = wp_filter_nohtml_kses( $input['header_youtube_btn_url'] );
  if ( ! isset( $input['header_youtube_btn_target'] ) ) $input['header_youtube_btn_target'] = null;
  $input['header_youtube_btn_target'] = ( $input['header_youtube_btn_target'] == 1 ? 1 : 0 );
	$input['header_youtube_btn_color'] = wp_filter_nohtml_kses( $input['header_youtube_btn_color'] );
	$input['header_youtube_btn_bg'] = wp_filter_nohtml_kses( $input['header_youtube_btn_bg'] );
	$input['header_youtube_btn_color_hover'] = wp_filter_nohtml_kses( $input['header_youtube_btn_color_hover'] );
	$input['header_youtube_btn_bg_hover'] = wp_filter_nohtml_kses( $input['header_youtube_btn_bg_hover'] );

  // News ticker
	if ( ! isset( $input['display_news_ticker'] ) ) $input['display_news_ticker'] = null;
	$input['display_news_ticker'] = ( $input['display_news_ticker'] == 1 ? 1 : 0 );
  for ( $i = 1; $i <= 5; $i++ ) {
	  $input['news_ticker_date' . $i] = wp_filter_nohtml_kses( $input['news_ticker_date' . $i] );
	  $input['news_ticker_catch' . $i] = wp_filter_nohtml_kses( $input['news_ticker_catch' . $i] );
	  $input['news_ticker_url' . $i] = wp_filter_nohtml_kses( $input['news_ticker_url' . $i] );
	  if ( ! isset( $input['news_ticker_target' . $i] ) ) $input['news_ticker_target' . $i] = null;
	  $input['news_ticker_target' . $i] = ( $input['news_ticker_target' . $i] == 1 ? 1 : 0 );
  }
	$input['news_ticker_btn_label'] = wp_filter_nohtml_kses( $input['news_ticker_btn_label'] );
	//$input['news_ticker_btn_url'] = wp_filter_nohtml_kses( $input['news_ticker_btn_url'] );
	//if ( ! isset( $input['news_ticker_btn_target'] ) ) $input['news_ticker_btn_target'] = null;
	//$input['news_ticker_btn_target'] = ( $input['news_ticker_btn_target'] == 1 ? 1 : 0 );
	$input['news_ticker_btn_color'] = wp_filter_nohtml_kses( $input['news_ticker_btn_color'] );
	$input['news_ticker_btn_bg'] = wp_filter_nohtml_kses( $input['news_ticker_btn_bg'] );
	$input['news_ticker_btn_color_hover'] = wp_filter_nohtml_kses( $input['news_ticker_btn_color_hover'] );
	$input['news_ticker_btn_bg_hover'] = wp_filter_nohtml_kses( $input['news_ticker_btn_bg_hover'] );

  // contents
  if ( ! isset( $input['index_contents_order'] ) ) { 
    $input['index_contents_order'] = array( 'news', 'style', 'staff' );
  }
  foreach ( $input['index_contents_order'] as $order ) {
    if ( ! in_array( $order, array( 'news', 'style', 'staff' ) ) ) {
      $input['index_contents_order'] = array( 'news', 'style', 'staff' );
      break;
    }
  }

  // News contents
	if ( ! isset( $input['display_index_news'] ) ) $input['display_index_news'] = null;
	$input['display_index_news'] = ( $input['display_index_news'] == 1 ? 1 : 0 );
	$input['index_news_title'] = wp_filter_nohtml_kses( $input['index_news_title'] );
	$input['index_news_title_font_size'] = wp_filter_nohtml_kses( $input['index_news_title_font_size'] );
	$input['index_news_title_color'] = wp_filter_nohtml_kses( $input['index_news_title_color'] );
	$input['index_news_sub'] = wp_filter_nohtml_kses( $input['index_news_sub'] );
	$input['index_news_sub_font_size'] = wp_filter_nohtml_kses( $input['index_news_sub_font_size'] );
	$input['index_news_sub_color'] = wp_filter_nohtml_kses( $input['index_news_sub_color'] );
	$input['index_news_title_bg'] = wp_filter_nohtml_kses( $input['index_news_title_bg'] );
	$input['index_news_desc'] = wp_filter_nohtml_kses( $input['index_news_desc'] );
	$input['index_news_num'] = wp_filter_nohtml_kses( $input['index_news_num'] );
	$input['index_news_link_text'] = wp_filter_nohtml_kses( $input['index_news_link_text'] );

  // Style contents
	if ( ! isset( $input['display_index_style'] ) ) $input['display_index_style'] = null;
	$input['display_index_style'] = ( $input['display_index_style'] == 1 ? 1 : 0 );
	$input['index_style_title'] = wp_filter_nohtml_kses( $input['index_style_title'] );
	$input['index_style_title_font_size'] = wp_filter_nohtml_kses( $input['index_style_title_font_size'] );
	$input['index_style_title_color'] = wp_filter_nohtml_kses( $input['index_style_title_color'] );
	$input['index_style_sub'] = wp_filter_nohtml_kses( $input['index_style_sub'] );
	$input['index_style_sub_font_size'] = wp_filter_nohtml_kses( $input['index_style_sub_font_size'] );
	$input['index_style_sub_color'] = wp_filter_nohtml_kses( $input['index_style_sub_color'] );
	$input['index_style_title_bg'] = wp_filter_nohtml_kses( $input['index_style_title_bg'] );
	$input['index_style_desc'] = wp_filter_nohtml_kses( $input['index_style_desc'] );
	$input['index_style_num'] = wp_filter_nohtml_kses( $input['index_style_num'] );
	$input['index_style_link_text'] = wp_filter_nohtml_kses( $input['index_style_link_text'] );

  // Staff contents
	if ( ! isset( $input['display_index_staff'] ) ) $input['display_index_staff'] = null;
	$input['display_index_staff'] = ( $input['display_index_staff'] == 1 ? 1 : 0 );
	$input['index_staff_title'] = wp_filter_nohtml_kses( $input['index_staff_title'] );
	$input['index_staff_title_font_size'] = wp_filter_nohtml_kses( $input['index_staff_title_font_size'] );
	$input['index_staff_title_color'] = wp_filter_nohtml_kses( $input['index_staff_title_color'] );
	$input['index_staff_sub'] = wp_filter_nohtml_kses( $input['index_staff_sub'] );
	$input['index_staff_sub_font_size'] = wp_filter_nohtml_kses( $input['index_staff_sub_font_size'] );
	$input['index_staff_sub_color'] = wp_filter_nohtml_kses( $input['index_staff_sub_color'] );
	$input['index_staff_title_bg'] = wp_filter_nohtml_kses( $input['index_staff_title_bg'] );
	$input['index_staff_desc'] = wp_filter_nohtml_kses( $input['index_staff_desc'] );
	$input['index_staff_num'] = wp_filter_nohtml_kses( $input['index_staff_num'] );
	$input['index_staff_link_text'] = wp_filter_nohtml_kses( $input['index_staff_link_text'] );

	return $input;
}
