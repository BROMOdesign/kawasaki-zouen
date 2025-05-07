<?php 
/*
 * Manage header tab
 */

// Add default values
add_filter( 'before_getting_design_plus_option', 'add_header_dp_default_options' );

// Add label of header tab
add_action( 'tcd_tab_labels', 'add_header_tab_label' );

// Add HTML of header tab
add_action( 'tcd_tab_panel', 'add_header_tab_panel' );

// Register sanitize function
add_filter( 'theme_options_validate', 'add_header_theme_options_validate' );

// Header position
global $header_fix_options;
$header_fix_options = array(
	'type1' => array(
		'value' => 'type1',
		'label' => __( 'Normal header', 'tcd-w' ) 
	),
 	'type2' => array(
		'value' => 'type2',
		'label' => __( 'Fix at top after page scroll', 'tcd-w' )
	),
);

// Contact type
global $contact_type_options;
$contact_type_options = array(
	'type1' => array(
		'value' => 'type1',
		'label' => __( 'Phone number', 'tcd-w' ) 
	),
 	'type2' => array(
		'value' => 'type2',
		'label' => __( 'Link', 'tcd-w' )
	),
);

function add_header_dp_default_options( $dp_default_options ) {

  // Header
	$dp_default_options['header_fix'] = 'type1';
	$dp_default_options['mobile_header_fix'] = 'type1';
	$dp_default_options['header_bg'] = '#111111';
	$dp_default_options['header_desc_color'] = '#999999';

  // Global navigation
	$dp_default_options['gnav_sub_color'] = '#ffffff';
	$dp_default_options['gnav_sub_bg'] = '#111111';
	$dp_default_options['gnav_sub_color_hover'] = '#ffffff';
	$dp_default_options['gnav_sub_bg_hover'] = '#422414';
	$dp_default_options['gnav_color_sp'] = '#ffffff';
	$dp_default_options['gnav_bg_sp'] = '#111111';
	$dp_default_options['gnav_bg_opacity_sp'] = 1;

  // Contact information
	$dp_default_options['contact_type'] = 'type1';
	$dp_default_options['contact_tel'] = '00-0000-0000';
	$dp_default_options['contact_tel_link'] = 1;
	$dp_default_options['contact_btn_label'] = '';
	$dp_default_options['contact_btn_url'] = '';
	$dp_default_options['contact_btn_target'] = 0;
	$dp_default_options['contact_btn_color'] = '#ffffff';
	$dp_default_options['contact_btn_bg'] = '#333333';
	$dp_default_options['contact_btn_color_hover'] = '#ffffff';
	$dp_default_options['contact_btn_bg_hover'] = '#422414';

	return $dp_default_options;
}

function add_header_tab_label( $tab_labels ) {
	$tab_labels['header'] = __( 'Header', 'tcd-w' );
	return $tab_labels;
}

function add_header_tab_panel( $options ) {

	global $dp_default_options, $header_fix_options, $contact_type_options; 
?>
<div id="tab-content-header">
  <?php // Header ?>
  <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e( 'Header settings', 'tcd-w' ); ?></h3>
  	<h4 class="theme_option_headline2"><?php _e( 'Header position', 'tcd-w' ); ?></h4>
   	<fieldset class="cf select_type2">
			<?php foreach ( $header_fix_options as $option ) : ?>
     	<label class="description"><input type="radio" name="dp_options[header_fix]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php checked( $option['value'], $options['header_fix'] ); ?>><?php _e( $option['label'], 'tcd-w' ); ?></label>
			<?php endforeach; ?>
    </fieldset>
  	<h4 class="theme_option_headline2"><?php _e( 'Header position (mobile)', 'tcd-w' ); ?></h4>
  	<fieldset class="cf select_type2">
			<?php foreach ( $header_fix_options as $option ) : ?>
			<label class="description"><input type="radio" name="dp_options[mobile_header_fix]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $option['value'], $options['mobile_header_fix'] ); ?>><?php esc_html_e( $option['label'], 'tcd-w' ); ?></label>
			<?php endforeach; ?>
		</fieldset>
  	<h4 class="theme_option_headline2"><?php _e( 'Font color of the site catchphrase', 'tcd-w' ); ?></h4>
		<input type="text" name="dp_options[header_desc_color]" value="<?php echo esc_attr( $options['header_desc_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['header_desc_color'] ); ?>" class="c-color-picker">
  	<h4 class="theme_option_headline2"><?php _e( 'Background color', 'tcd-w' ); ?></h4>
		<input type="text" name="dp_options[header_bg]" value="<?php echo esc_attr( $options['header_bg'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['header_bg'] ); ?>" class="c-color-picker">
  	<input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
  </div>
  <?php // Global navigation ?>
  <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e( 'Global navigation settings', 'tcd-w' ); ?></h3>
  	<h4 class="theme_option_headline2"><?php _e( 'Submenu settings', 'tcd-w' ); ?></h4>
    <p><label for="gnav_sub_color"><?php _e( 'Font color', 'tcd-w' ); ?> </label><input type="text" id="gnav_sub_color" class="c-color-picker" name="dp_options[gnav_sub_color]" value="<?php echo esc_attr( $options['gnav_sub_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['gnav_sub_color'] ); ?>"></p>
    <p><label for="gnav_sub_bg"><?php _e( 'Background color', 'tcd-w' ); ?> </label><input type="text" id="gnav_sub_bg" class="c-color-picker" name="dp_options[gnav_sub_bg]" value="<?php echo esc_attr( $options['gnav_sub_bg'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['gnav_sub_bg'] ); ?>"></p>
    <p><label for="gnav_sub_color_hover"><?php _e( 'Font color on hover', 'tcd-w' ); ?> </label><input type="text" id="gnav_sub_color_hover" class="c-color-picker" name="dp_options[gnav_sub_color_hover]" value="<?php echo esc_attr( $options['gnav_sub_color_hover'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['gnav_sub_color_hover'] ); ?>"></p>
    <p><label for="gnav_sub_bg_hover"><?php _e( 'Background color on hover', 'tcd-w' ); ?> </label><input type="text" class="c-color-picker" name="dp_options[gnav_sub_bg_hover]" value="<?php echo esc_attr( $options['gnav_sub_bg_hover'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['gnav_sub_bg_hover'] ); ?>"></p>
  	<h4 class="theme_option_headline2"><?php _e( 'Menu setting for mobile', 'tcd-w' ); ?></h4>
    <p><label for="gnav_color_sp"><?php _e( 'Font color', 'tcd-w' ); ?> </label><input type="text" class="c-color-picker" name="dp_options[gnav_color_sp]" value="<?php echo esc_attr( $options['gnav_color_sp'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['gnav_color_sp'] ); ?>"></p>
    <p><label for="gnav_bg_sp"><?php _e( 'Background color', 'tcd-w' ); ?> </label><input type="text" class="c-color-picker" name="dp_options[gnav_bg_sp]" value="<?php echo esc_attr( $options['gnav_bg_sp'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['gnav_bg_sp'] ); ?>"></p>
    <p><label><?php _e( 'Opacity of background color', 'tcd-w' ); ?> <input type="number" class="tiny-text" min="0" max="1" step="0.1" name="dp_options[gnav_bg_opacity_sp]" value="<?php echo esc_attr( $options['gnav_bg_opacity_sp'] ); ?>"></label></p>
  	<input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
  </div>
  <?php // Contact information ?>
  <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e( 'Contact information settings', 'tcd-w' ); ?></h3>
    <p><?php _e( 'Note: The contact information is displayed in the footer for mobile and tablet devices.', 'tcd-w' ); ?></p>
  	<h4 class="theme_option_headline2"><?php _e( 'Content type', 'tcd-w' ); ?></h4>
    <?php foreach ( $contact_type_options as $option ) : ?>
    <p><label><input type="radio" name="dp_options[contact_type]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $option['value'], $options['contact_type'] ); ?>> <?php echo esc_html_e( $option['label'] ); ?></label></p>
    <?php endforeach; ?>
    <div id="contact_type_type1" style="<?php if ( 'type1' !== $options['contact_type'] ) { echo 'display: none;'; } ?>">
  	  <h4 class="theme_option_headline2"><?php _e( 'Phone number', 'tcd-w' ); ?></h4>
      <input type="tel" class="regular-text" name="dp_options[contact_tel]" value="<?php echo esc_attr( $options['contact_tel'] ); ?>">
      <p><label><input type="checkbox" name="dp_options[contact_tel_link]" value="1" <?php checked( 1, $options['contact_tel_link'] ); ?>> <?php _e( 'Set telephone number link', 'tcd-w' ); ?></label></p>
    </div>
    <div id="contact_type_type2" style="<?php if ( 'type2' !== $options['contact_type'] ) { echo 'display: none;'; } ?>">
  	  <h4 class="theme_option_headline2"><?php _e( 'Link', 'tcd-w' ); ?></h4>
      <p><label><?php _e( 'Link text', 'tcd-w' ); ?> <input type="text" class="regular-text" name="dp_options[contact_btn_label]" value="<?php echo esc_attr( $options['contact_btn_label'] ); ?>"></label></p>
      <p><label><?php _e( 'Link URL', 'tcd-w' ); ?> <input type="text" class="regular-text" name="dp_options[contact_btn_url]" value="<?php echo esc_attr( $options['contact_btn_url'] ); ?>"></label></p>
      <p><label><input type="checkbox" name="dp_options[contact_btn_target]" value="1" <?php checked( 1, $options['contact_btn_target'] ); ?>> <?php _e( 'Open link in new window', 'tcd-w' ); ?></label></p>
      <p><label for="contact_btn_color"><?php _e( 'Font color', 'tcd-w' ); ?></label> <input type="text" class="c-color-picker" name="dp_options[contact_btn_color]" value="<?php echo esc_attr( $options['contact_btn_color'] ); ?>" id="contact_btn_color"></p>
      <p><label for="contact_btn_bg"><?php _e( 'Background color', 'tcd-w' ); ?></label> <input type="text" class="c-color-picker" name="dp_options[contact_btn_bg]" value="<?php echo esc_attr( $options['contact_btn_bg'] ); ?>" id="contact_btn_bg"></p>
      <p><label for="contact_btn_color_hover"><?php _e( 'Font color on hover', 'tcd-w' ); ?></label> <input type="text" class="c-color-picker" name="dp_options[contact_btn_color_hover]" value="<?php echo esc_attr( $options['contact_btn_color_hover'] ); ?>" id="contact_btn_color_hover"></p>
      <p><label for="contact_btn_bg_hover"><?php _e( 'Background color on hover', 'tcd-w' ); ?></label> <input type="text" class="c-color-picker" name="dp_options[contact_btn_bg_hover]" value="<?php echo esc_attr( $options['contact_btn_bg_hover'] ); ?>" id="contact_btn_bg_hover"></p>
    </div>
  	<input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
  </div>
</div><!-- END #tab-content7 -->
<?php
}

function add_header_theme_options_validate( $input ) {

	global $header_fix_options, $contact_type_options;

  // Header
 	if ( ! isset( $input['header_fix'] ) ) $input['header_fix'] = null;
 	if ( ! array_key_exists( $input['header_fix'], $header_fix_options ) ) $input['header_fix'] = null;
 	if ( ! isset( $input['mobile_header_fix'] ) ) $input['mobile_header_fix'] = null;
 	if ( ! array_key_exists( $input['mobile_header_fix'], $header_fix_options ) ) $input['mobile_header_fix'] = null;
	$input['header_bg'] = wp_filter_nohtml_kses( $input['header_bg'] );
	$input['header_desc_color'] = wp_filter_nohtml_kses( $input['header_desc_color'] );

  // Global navigation
	$input['gnav_sub_color'] = wp_filter_nohtml_kses( $input['gnav_sub_color'] );
	$input['gnav_sub_bg'] = wp_filter_nohtml_kses( $input['gnav_sub_bg'] );
	$input['gnav_sub_color_hover'] = wp_filter_nohtml_kses( $input['gnav_sub_color_hover'] );
	$input['gnav_sub_bg_hover'] = wp_filter_nohtml_kses( $input['gnav_sub_bg_hover'] );
	$input['gnav_color_sp'] = wp_filter_nohtml_kses( $input['gnav_color_sp'] );
	$input['gnav_bg_sp'] = wp_filter_nohtml_kses( $input['gnav_bg_sp'] );
	$input['gnav_bg_opacity_sp'] = wp_filter_nohtml_kses( $input['gnav_bg_opacity_sp'] );

  // Contact information
 	if ( ! isset( $input['contact_type'] ) ) $input['contact_type'] = null;
 	if ( ! array_key_exists( $input['contact_type'], $contact_type_options ) ) $input['contact_type'] = null;
	$input['contact_tel'] = wp_filter_nohtml_kses( $input['contact_tel'] );
 	if ( ! isset( $input['contact_tel_link'] ) ) $input['contact_tel_link'] = null;
  $input['contact_tel_link'] = ( $input['contact_tel_link'] == 1 ? 1 : 0 );
	$input['contact_btn_label'] = wp_filter_nohtml_kses( $input['contact_btn_label'] );
	$input['contact_btn_url'] = wp_filter_nohtml_kses( $input['contact_btn_url'] );
 	if ( ! isset( $input['contact_btn_target'] ) ) $input['contact_btn_target'] = null;
  $input['contact_btn_target'] = ( $input['contact_btn_target'] == 1 ? 1 : 0 );
	$input['contact_btn_color'] = wp_filter_nohtml_kses( $input['contact_btn_color'] );
	$input['contact_btn_bg'] = wp_filter_nohtml_kses( $input['contact_btn_bg'] );
	$input['contact_btn_color_hover'] = wp_filter_nohtml_kses( $input['contact_btn_color_hover'] );
	$input['contact_btn_bg_hover'] = wp_filter_nohtml_kses( $input['contact_btn_bg_hover'] );

	return $input;
}
