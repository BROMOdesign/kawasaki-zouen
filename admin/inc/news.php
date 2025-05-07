<?php 
/*
 * Manage news tab
 */

// Add default values
add_filter( 'before_getting_design_plus_option', 'add_news_dp_default_options' );

//  Add label of news tab
add_action( 'tcd_tab_labels', 'add_news_tab_label' );

// Add HTML of news tab
add_action( 'tcd_tab_panel', 'add_news_tab_panel' );

// Register sanitize function
add_filter( 'theme_options_validate', 'add_news_theme_options_validate' );

function add_news_dp_default_options( $dp_default_options ) {

  // Page header
	$dp_default_options['news_ph_title'] = 'News';
	$dp_default_options['news_ph_title_font_size'] = 32;
	$dp_default_options['news_ph_title_color'] = '#ffffff';
	$dp_default_options['news_ph_sub'] = __( 'News', 'tcd-w' );
	$dp_default_options['news_ph_sub_font_size'] = 12;
	$dp_default_options['news_ph_sub_color'] = '#ffffff';
	$dp_default_options['news_ph_title_bg'] = '#111111';
	$dp_default_options['news_ph_desc'] = __( 'Here is the description. Here is the description. Here is the description.', 'tcd-w' );
	$dp_default_options['news_ph_desc_color'] = '#ffffff';
	$dp_default_options['news_ph_desc_bg'] = '#b7aa9d';

  // Single page
	$dp_default_options['news_title_font_size'] = 28;
	$dp_default_options['news_content_font_size'] = 14;

	// Display
	$dp_default_options['news_show_date'] = 1;
	$dp_default_options['news_show_thumbnail'] = 1;
	$dp_default_options['news_show_sns_top'] = 1;
	$dp_default_options['news_show_sns_btm'] = 1;
	$dp_default_options['news_show_next_post'] = 1;
	$dp_default_options['news_show_latest_post'] = 1;
  $dp_default_options['news_breadcrumb'] = __( 'News', 'tcd-w' );
  $dp_default_options['news_slug'] = 'news';

  // Single page banner
  for ( $i = 1; $i <= 6; $i++ ) {
	  $dp_default_options['news_ad_code' . $i] = '';
	  $dp_default_options['news_ad_image' . $i] = false;
	  $dp_default_options['news_ad_url' . $i] = '';
  }

  // Single page banner (mobile)
	$dp_default_options['news_mobile_ad_code1'] = '';
	$dp_default_options['news_mobile_ad_image1'] = false;
	$dp_default_options['news_mobile_ad_url1'] = '';

	return $dp_default_options;
}

function add_news_tab_label( $tab_labels ) {
	$tab_labels['news'] = __( 'News', 'tcd-w' );
	return $tab_labels;
}

function add_news_tab_panel( $options ) {

	global $dp_default_options;
?>
<div id="tab-content-news">
	<?php // Page header ?>
	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Page header settings', 'tcd-w' ); ?><?php _e( '(archive and single page)', 'tcd-w' ); ?></h3>
    <h4 class="theme_option_headline2"><?php _e( 'Title', 'tcd-w' ); ?></h4>
    <input type="text" class="regular-text" name="dp_options[news_ph_title]" value="<?php echo esc_attr( $options['news_ph_title'] ); ?>">
    <p><label><?php _e( 'Font size', 'tcd-w' ); ?> <input type="number" class="tiny-text" name="dp_options[news_ph_title_font_size]" value="<?php echo esc_attr( $options['news_ph_title_font_size'] ); ?>" min="1" step="1"> px</label></p>
    <p><label><?php _e( 'Font color', 'tcd-w' ); ?> <input type="text" class="c-color-picker" name="dp_options[news_ph_title_color]" value="<?php echo esc_attr( $options['news_ph_title_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['news_ph_title_color'] ); ?>"></label></p>
    <h4 class="theme_option_headline2"><?php _e( 'Sub title', 'tcd-w' ); ?></h4>
    <input type="text" class="regular-text" name="dp_options[news_ph_sub]" value="<?php echo esc_attr( $options['news_ph_sub'] ); ?>">
    <p><label><?php _e( 'Font size', 'tcd-w' ); ?> <input type="number" class="tiny-text" name="dp_options[news_ph_sub_font_size]" value="<?php echo esc_attr( $options['news_ph_sub_font_size'] ); ?>" min="1" step="1"> px</label></p>
    <p><label><?php _e( 'Font color', 'tcd-w' ); ?> <input type="text" class="c-color-picker" name="dp_options[news_ph_sub_color]" value="<?php echo esc_attr( $options['news_ph_sub_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['news_ph_sub_color'] ); ?>"></label></p>
    <h4 class="theme_option_headline2"><?php _e( 'Background color of title and sub title', 'tcd-w' ); ?></h4>
    <input type="text" class="c-color-picker" name="dp_options[news_ph_title_bg]" value="<?php echo esc_attr( $options['news_ph_title_bg'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['news_ph_title_bg'] ); ?>"></label></p>
    <h4 class="theme_option_headline2"><?php _e( 'Description', 'tcd-w' ); ?></h4>
    <textarea class="large-text" name="dp_options[news_ph_desc]"><?php echo esc_textarea( $options['news_ph_desc'] ); ?></textarea>
    <p><label><?php _e( 'Font color', 'tcd-w' ); ?> <input type="text" class="c-color-picker" name="dp_options[news_ph_desc_color]" value="<?php echo esc_attr( $options['news_ph_desc_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['news_ph_desc_color'] ); ?>"></label></p>
    <h4 class="theme_option_headline2"><?php _e( 'Background color of description', 'tcd-w' ); ?></h4>
    <input type="text" class="c-color-picker" name="dp_options[news_ph_desc_bg]" value="<?php echo esc_attr( $options['news_ph_desc_bg'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['news_ph_desc_bg'] ); ?>"></label></p>
    <input type="submit" class="button-ml ajax_button" value="<?php echo _e( 'Save Changes', 'tcd-w' ); ?>">
	</div>
	<?php // Single page ?>
  <div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Single Page Settings', 'tcd-w' ); ?></h3>
  	<h4 class="theme_option_headline2"><?php _e( 'Font size of post title', 'tcd-w' ); ?></h4>
  	<input class="hankaku tiny-text" type="number" min="1" step="1" name="dp_options[news_title_font_size]" value="<?php echo esc_attr( $options['news_title_font_size'] ); ?>"> <span>px</span>
  	<h4 class="theme_option_headline2"><?php _e( 'Font size of post contents', 'tcd-w' ); ?></h4>
  	<input class="hankaku tiny-text" type="number" min="1" step="1" name="dp_options[news_content_font_size]" value="<?php echo esc_attr( $options['news_content_font_size'] ); ?>"> <span>px</span>
  	<input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
	</div>
	<?php // Display ?>
  <div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Display settings', 'tcd-w' ); ?></h3>
    <ul>
    	<li><label><input name="dp_options[news_show_date]" type="checkbox" value="1" <?php checked( '1', $options['news_show_date'] ); ?>><?php _e( 'Display date', 'tcd-w' ); ?></label></li>
    	<li><label><input name="dp_options[news_show_thumbnail]" type="checkbox" value="1" <?php checked( '1', $options['news_show_thumbnail'] ); ?>><?php _e( 'Display thumbnail', 'tcd-w' ); ?></label></li>
    	<li><label><input name="dp_options[news_show_sns_top]" type="checkbox" value="1" <?php checked( '1', $options['news_show_sns_top'] ); ?>><?php _e( 'Display share buttons before the article', 'tcd-w' ); ?></label></li>
    	<li><label><input name="dp_options[news_show_sns_btm]" type="checkbox" value="1" <?php checked( '1', $options['news_show_sns_btm'] ); ?>><?php _e( 'Display share buttons after the article', 'tcd-w' ); ?></label></li>
    	<li><label><input name="dp_options[news_show_next_post]" type="checkbox" value="1" <?php checked( '1', $options['news_show_next_post'] ); ?>><?php _e( 'Display next previous post link', 'tcd-w' ); ?></label></li>
    	<li><label><input name="dp_options[news_show_latest_post]" type="checkbox" value="1" <?php checked( '1', $options['news_show_latest_post'] ); ?>><?php _e( 'Display latest news', 'tcd-w' ); ?></label></li>
    </ul>
		<h4 class="theme_option_headline2"><?php _e( 'Breadcrumb settings', 'tcd-w' ); ?></h4>
		<p><?php _e( 'It is used in the breadcrumb navigation. If it is not registerd, "News" is displayed instead.', 'tcd-w' ); ?></p>
		<p><input type="text" name="dp_options[news_breadcrumb]" value="<?php echo esc_attr( $options['news_breadcrumb'] ); ?>"></p>
    <h4 class="theme_option_headline2"><?php _e( 'Slug settings', 'tcd-w' ); ?></h4>
		<p><?php _e( 'It is used in URL. You can use only alphanumeric. If it is not registerd, "news" is used instead.', 'tcd-w' ); ?></p>
		<p><?php _e( 'Note: if you want to change the slug, change permalinks from "Plain".', 'tcd-w' ); ?></p>
		<p><?php _e( 'Note: after changing the slug, you need to go to "Permalink Settings" and click "Save Changes".', 'tcd-w' ); ?></p>
		<p><input type="text" name="dp_options[news_slug]" value="<?php echo esc_attr( $options['news_slug'] ); ?>"></p>
    <input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
	</div>
	<?php // Single page banner ?>
	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Single page banner settings', 'tcd-w' ); ?>1</h3>
  	<p><?php _e( 'This banner will be displayed before contents.', 'tcd-w' ); ?></p>
  	<div class="sub_box cf"> 
  		<h3 class="theme_option_subbox_headline"><?php _e( 'Left banner', 'tcd-w' ); ?></h3>
			<div class="sub_box_content">
  			<div class="theme_option_content">
  				<h4 class="theme_option_headline2"><?php _e( 'Banner code', 'tcd-w' ); ?></h4>
  				<p><?php _e( 'If you are using google adsense, enter all code below.', 'tcd-w' ); ?></p>
  				<textarea class="large-text" rows="10" name="dp_options[news_ad_code1]"><?php echo esc_textarea( $options['news_ad_code1'] ); ?></textarea>
  			</div>
  			<p><?php _e( 'If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w' ); ?></p>
  			<div class="theme_option_content">
  				<h4 class="theme_option_headline2"><?php _e( 'Register banner image.', 'tcd-w' ); _e( 'Recommend size. Width:300px Height:250px', 'tcd-w' ); ?></h4>
  				<div class="image_box cf">
  					<div class="cf cf_media_field hide-if-no-js news_ad_image1">
  						<input type="hidden" value="<?php echo esc_attr( $options['news_ad_image1'] ); ?>" id="news_ad_image1" name="dp_options[news_ad_image1]" class="cf_media_id">
  						<div class="preview_field"><?php if ( $options['news_ad_image1'] ) { echo wp_get_attachment_image( $options['news_ad_image1'], 'medium' ); } ?></div>
  						<div class="button_area">
  							<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
  							<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $options['news_ad_image1'] ) { echo 'hidden'; } ?>">
  						</div>
  					</div>
  				</div>
  			</div>
  			<div class="theme_option_content">
  				<h4 class="theme_option_headline2"><?php _e( 'Register affiliate code', 'tcd-w' ); ?></h4>
  				<input class="regular-text" type="text" name="dp_options[news_ad_url1]" value="<?php echo esc_attr( $options['news_ad_url1'] ); ?>">
  				<input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>">
  			</div>
			</div>
  	</div><!-- END .sub_box -->
  	<div class="sub_box cf"> 
  		<h3 class="theme_option_subbox_headline"><?php _e( 'Right banner', 'tcd-w' ); ?></h3>
			<div class="sub_box_content">
  			<div class="theme_option_content">
  				<h4 class="theme_option_headline2"><?php _e( 'Banner code', 'tcd-w' ); ?></h4>
  				<p><?php _e( 'If you are using google adsense, enter all code below.', 'tcd-w' ); ?></p>
  				<textarea class="large-text" rows="10" name="dp_options[news_ad_code2]"><?php echo esc_textarea( $options['news_ad_code2'] ); ?></textarea>
  			</div>
  			<p><?php _e( 'If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w' );  ?></p>
  			<div class="theme_option_content">
  				<h4 class="theme_option_headline2"><?php _e( 'Register banner image.', 'tcd-w' ); _e( 'Recommend size. Width:300px Height:250px', 'tcd-w' ); ?></h4>
  				<div class="image_box cf">
  					<div class="cf cf_media_field hide-if-no-js news_ad_image2">
  						<input type="hidden" value="<?php echo esc_attr( $options['news_ad_image2'] ); ?>" id="news_ad_image2" name="dp_options[news_ad_image2]" class="cf_media_id">
  						<div class="preview_field"><?php if ( $options['news_ad_image2'] ) { echo wp_get_attachment_image($options['news_ad_image2'], 'medium' ); } ?></div>
  						<div class="button_area">
  							<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
  							<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $options['news_ad_image2'] ) { echo 'hidden'; } ?>">
  						</div>
  					</div>
  				</div>
  			</div>
  			<div class="theme_option_content">
  				<h4 class="theme_option_headline2"><?php _e( 'Register affiliate code', 'tcd-w' );  ?></h4>
  				<input class="regular-text" type="text" name="dp_options[news_ad_url2]" value="<?php echo esc_attr( $options['news_ad_url2'] ); ?>">
  				<input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>">
  			</div>
  		</div><!-- END .sub_box -->
		</div>
  </div><!-- END .theme_option_field -->
	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Single page banner settings', 'tcd-w' ); ?>2</h3>
  	<p><?php _e( 'This banner will be displayed after contents.', 'tcd-w' ); ?></p>
  	<div class="sub_box cf"> 
  		<h3 class="theme_option_subbox_headline"><?php _e( 'Left banner', 'tcd-w' ); ?></h3>
			<div class="sub_box_content">
  			<div class="theme_option_content">
  				<h4 class="theme_option_headline2"><?php _e( 'Banner code', 'tcd-w' ); ?></h4>
  				<p><?php _e( 'If you are using google adsense, enter all code below.', 'tcd-w' ); ?></p>
  				<textarea class="large-text" rows="10" name="dp_options[news_ad_code3]"><?php echo esc_textarea( $options['news_ad_code3'] ); ?></textarea>
  			</div>
  			<p><?php _e( 'If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w' ); ?></p>
  			<div class="theme_option_content">
  				<h4 class="theme_option_headline2"><?php _e( 'Register banner image.', 'tcd-w' ); _e( 'Recommend size. Width:300px Height:250px', 'tcd-w' ); ?></h4>
  				<div class="image_box cf">
  					<div class="cf cf_media_field hide-if-no-js news_ad_image3">
  						<input type="hidden" value="<?php echo esc_attr( $options['news_ad_image3'] ); ?>" id="news_ad_image3" name="dp_options[news_ad_image3]" class="cf_media_id">
  						<div class="preview_field"><?php if ( $options['news_ad_image3'] ) { echo wp_get_attachment_image( $options['news_ad_image3'], 'medium' ); } ?></div>
  						<div class="button_area">
  							<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
  							<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $options['news_ad_image3'] ) { echo 'hidden'; } ?>">
  						</div>
  					</div>
  				</div>
  			</div>
  			<div class="theme_option_content">
  				<h4 class="theme_option_headline2"><?php _e( 'Register affiliate code', 'tcd-w' ); ?></h4>
  				<input class="regular-text" type="text" name="dp_options[news_ad_url3]" value="<?php echo esc_attr( $options['news_ad_url3'] ); ?>">
  				<input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>">
  			</div>
			</div>
  	</div><!-- END .sub_box -->
  	<div class="sub_box cf"> 
  		<h3 class="theme_option_subbox_headline"><?php _e( 'Right banner', 'tcd-w' ); ?></h3>
			<div class="sub_box_content">
  			<div class="theme_option_content">
  				<h4 class="theme_option_headline2"><?php _e( 'Banner code', 'tcd-w' ); ?></h4>
  				<p><?php _e( 'If you are using google adsense, enter all code below.', 'tcd-w' ); ?></p>
  				<textarea class="large-text" rows="10" name="dp_options[news_ad_code4]"><?php echo esc_textarea( $options['news_ad_code4'] ); ?></textarea>
  			</div>
  			<p><?php _e( 'If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w' );  ?></p>
  			<div class="theme_option_content">
  				<h4 class="theme_option_headline2"><?php _e( 'Register banner image.', 'tcd-w' ); _e( 'Recommend size. Width:300px Height:250px', 'tcd-w' ); ?></h4>
  				<div class="image_box cf">
  					<div class="cf cf_media_field hide-if-no-js news_ad_image4">
  						<input type="hidden" value="<?php echo esc_attr( $options['news_ad_image4'] ); ?>" id="news_ad_image4" name="dp_options[news_ad_image4]" class="cf_media_id">
  						<div class="preview_field"><?php if ( $options['news_ad_image4'] ) { echo wp_get_attachment_image($options['news_ad_image4'], 'medium' ); } ?></div>
  						<div class="button_area">
  							<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
  							<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $options['news_ad_image4'] ) { echo 'hidden'; } ?>">
  						</div>
  					</div>
  				</div>
  			</div>
  			<div class="theme_option_content">
  				<h4 class="theme_option_headline2"><?php _e( 'Register affiliate code', 'tcd-w' );  ?></h4>
  				<input class="regular-text" type="text" name="dp_options[news_ad_url4]" value="<?php echo esc_attr( $options['news_ad_url4'] ); ?>">
  				<input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>">
  			</div>
  		</div><!-- END .sub_box -->
		</div>
  </div><!-- END .theme_option_field -->
	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Single page banner settings', 'tcd-w' ); ?>3</h3>
  	<p><?php _e( 'Please copy and paste the short code inside the content to show this banner.', 'tcd-w' ); ?></p>
  	<p><?php _e( 'Short code', 'tcd-w' );  ?> : <input type="text" readonly="readonly" value="[n_ad]"></p>
  	<div class="sub_box cf"> 
  		<h3 class="theme_option_subbox_headline"><?php _e( 'Left banner', 'tcd-w' ); ?></h3>
			<div class="sub_box_content">
  			<div class="theme_option_content">
  				<h4 class="theme_option_headline2"><?php _e( 'Banner code', 'tcd-w' ); ?></h4>
  				<p><?php _e( 'If you are using google adsense, enter all code below.', 'tcd-w' ); ?></p>
  				<textarea class="large-text" rows="10" name="dp_options[news_ad_code5]"><?php echo esc_textarea( $options['news_ad_code5'] ); ?></textarea>
  			</div>
  			<p><?php _e( 'If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w' ); ?></p>
  			<div class="theme_option_content">
  				<h4 class="theme_option_headline2"><?php _e( 'Register banner image.', 'tcd-w' ); _e( 'Recommend size. Width:300px Height:250px', 'tcd-w' ); ?></h4>
  				<div class="image_box cf">
  					<div class="cf cf_media_field hide-if-no-js news_ad_image5">
  						<input type="hidden" value="<?php echo esc_attr( $options['news_ad_image5'] ); ?>" id="news_ad_image5" name="dp_options[news_ad_image5]" class="cf_media_id">
  						<div class="preview_field"><?php if ( $options['news_ad_image5'] ) { echo wp_get_attachment_image( $options['news_ad_image5'], 'medium' ); } ?></div>
  						<div class="button_area">
  							<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
  							<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $options['news_ad_image5'] ) { echo 'hidden'; } ?>">
  						</div>
  					</div>
  				</div>
  			</div>
  			<div class="theme_option_content">
  				<h4 class="theme_option_headline2"><?php _e( 'Register affiliate code', 'tcd-w' ); ?></h4>
  				<input class="regular-text" type="text" name="dp_options[news_ad_url5]" value="<?php echo esc_attr( $options['news_ad_url5'] ); ?>">
  				<input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>">
  			</div>
			</div>
  	</div><!-- END .sub_box -->
  	<div class="sub_box cf"> 
  		<h3 class="theme_option_subbox_headline"><?php _e( 'Right banner', 'tcd-w' ); ?></h3>
			<div class="sub_box_content">
  			<div class="theme_option_content">
  				<h4 class="theme_option_headline2"><?php _e( 'Banner code', 'tcd-w' ); ?></h4>
  				<p><?php _e( 'If you are using google adsense, enter all code below.', 'tcd-w' ); ?></p>
  				<textarea class="large-text" rows="10" name="dp_options[news_ad_code6]"><?php echo esc_textarea( $options['news_ad_code6'] ); ?></textarea>
  			</div>
  			<p><?php _e( 'If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w' ); ?></p>
  			<div class="theme_option_content">
  				<h4 class="theme_option_headline2"><?php _e( 'Register banner image.', 'tcd-w' ); _e( 'Recommend size. Width:300px Height:250px', 'tcd-w' ); ?></h4>
  				<div class="image_box cf">
  					<div class="cf cf_media_field hide-if-no-js news_ad_image6">
  						<input type="hidden" value="<?php echo esc_attr( $options['news_ad_image6'] ); ?>" id="news_ad_image6" name="dp_options[news_ad_image6]" class="cf_media_id">
  						<div class="preview_field"><?php if ( $options['news_ad_image6'] ) { echo wp_get_attachment_image( $options['news_ad_image6'], 'medium' ); } ?></div>
  						<div class="button_area">
  							<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
  							<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if( ! $options['news_ad_image6'] ) { echo 'hidden'; } ?>">
  						</div>
  					</div>
  				</div>
  			</div>
  			<div class="theme_option_content">
  				<h4 class="theme_option_headline2"><?php _e( 'Register affiliate code', 'tcd-w' ); ?></h4>
  				<input class="regular-text" type="text" name="dp_options[news_ad_url6]" value="<?php echo esc_attr( $options['news_ad_url6'] ); ?>">
  				<input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>">
  			</div>
  		</div>
  	</div><!-- END .sub_box -->
  </div><!-- END .theme_option_field -->
 	<?php // Single page banner ?>
	<div class="theme_option_field cf">
		<h3 class="theme_option_headline"><?php _e( 'Single page banner settings (mobile)', 'tcd-w' ); ?></h3>
		<p><?php _e( 'This banner will be displayed on mobile device.', 'tcd-w' ); ?></p>
 	 	<div class="theme_option_content">
 	 		<h4 class="theme_option_headline2"><?php _e( 'Banner code', 'tcd-w' ); ?></h4>
 	    <p><?php _e( 'If you are using google adsense, enter all code below.', 'tcd-w' ); ?></p>
 	    <textarea class="large-text" rows="10" name="dp_options[news_mobile_ad_code1]"><?php echo esc_textarea( $options['news_mobile_ad_code1'] ); ?></textarea>
 	  </div>
 	  <p><?php _e( 'If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w' );  ?></p>
 	  <div class="theme_option_content">
 	  	<h4 class="theme_option_headline2"><?php _e( 'Register banner image.', 'tcd-w' ); ?></h4>
 	  	<div class="image_box cf">
 	    	<div class="cf cf_media_field hide-if-no-js news_mobile_ad_image1">
 	      	<input type="hidden" value="<?php echo esc_attr( $options['news_mobile_ad_image1'] ); ?>" id="news_mobile_ad_image" name="dp_options[news_mobile_ad_image1]" class="cf_media_id">
 	      	<div class="preview_field"><?php if($options['news_mobile_ad_image1']){ echo wp_get_attachment_image($options['news_mobile_ad_image1'], 'medium' ); }; ?></div>
 	      	<div class="buttton_area">
 	       		<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
 	       		<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if(!$options['news_mobile_ad_image1']){ echo 'hidden'; }; ?>">
 	     		</div>
 	    	</div>
			</div>
 	  </div>
 	 	<div class="theme_option_content">
 	    <h4 class="theme_option_headline2"><?php _e( 'Register affiliate code', 'tcd-w' ); ?></h4>
 	    <input class="regular-text" type="text" name="dp_options[news_mobile_ad_url1]" value="<?php echo esc_attr( $options['news_mobile_ad_url1'] ); ?>">
 	  	<input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>">
		</div>
	</div><!-- END .theme_option_field -->
</div><!-- END #tab-content4 -->
<?php
}

function add_news_theme_options_validate( $input ) {

 	// Page header
 	$input['news_ph_title'] = wp_filter_nohtml_kses( $input['news_ph_title'] );
 	$input['news_ph_title_font_size'] = wp_filter_nohtml_kses( $input['news_ph_title_font_size'] );
 	$input['news_ph_title_color'] = wp_filter_nohtml_kses( $input['news_ph_title_color'] );
 	$input['news_ph_sub'] = wp_filter_nohtml_kses( $input['news_ph_sub'] );
 	$input['news_ph_sub_font_size'] = wp_filter_nohtml_kses( $input['news_ph_sub_font_size'] );
 	$input['news_ph_sub_color'] = wp_filter_nohtml_kses( $input['news_ph_sub_color'] );
 	$input['news_ph_title_bg'] = wp_filter_nohtml_kses( $input['news_ph_title_bg'] );
 	$input['news_ph_desc'] = wp_filter_nohtml_kses( $input['news_ph_desc'] );
 	$input['news_ph_desc_color'] = wp_filter_nohtml_kses( $input['news_ph_desc_color'] );
 	$input['news_ph_desc_bg'] = wp_filter_nohtml_kses( $input['news_ph_desc_bg'] );

  // Single page
 	$input['news_title_font_size'] = wp_filter_nohtml_kses( $input['news_title_font_size'] );
 	$input['news_content_font_size'] = wp_filter_nohtml_kses( $input['news_content_font_size'] );

 	// Display
 	if ( ! isset( $input['news_show_date'] ) ) $input['news_show_date'] = null;
  $input['news_show_date'] = ( $input['news_show_date'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['news_show_thumbnail'] ) ) $input['news_show_thumbnail'] = null;
  $input['news_show_thumbnail'] = ( $input['news_show_thumbnail'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['news_show_sns_top'] ) ) $input['news_show_sns_top'] = null;
  $input['news_show_sns_top'] = ( $input['news_show_sns_top'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['news_show_sns_btm'] ) ) $input['news_show_sns_btm'] = null;
  $input['news_show_sns_btm'] = ( $input['news_show_sns_btm'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['news_show_next_post'] ) ) $input['news_show_next_post'] = null;
  $input['news_show_next_post'] = ( $input['news_show_next_post'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['news_show_latest_post'] ) ) $input['news_show_latest_post'] = null;
  $input['news_show_latest_post'] = ( $input['news_show_latest_post'] == 1 ? 1 : 0 );
 	$input['news_breadcrumb'] = wp_filter_nohtml_kses( $input['news_breadcrumb'] );
 	$input['news_slug'] = wp_filter_nohtml_kses( $input['news_slug'] );

  // Single page banner
	for ( $i = 1; $i <= 6; $i++ ) {
 		$input['news_ad_code' . $i] = $input['news_ad_code' . $i];
 		$input['news_ad_image' . $i] = wp_filter_nohtml_kses( $input['news_ad_image' . $i] );
 		$input['news_ad_url' . $i] = wp_filter_nohtml_kses( $input['news_ad_url' . $i] );
	}

  // Single page banner (mobile)
	$input['news_mobile_ad_code1'] = $input['news_mobile_ad_code1'];
 	$input['news_mobile_ad_image1'] = wp_filter_nohtml_kses( $input['news_mobile_ad_image1'] );
 	$input['news_mobile_ad_url1'] = wp_filter_nohtml_kses( $input['news_mobile_ad_url1'] );

	return $input;
}
