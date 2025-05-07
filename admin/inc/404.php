<?php 
/*
 * Manage 404 tab
 */

// Add default values
add_filter( 'before_getting_design_plus_option', 'add_404_dp_default_options' );

// Add label of 404 tab
add_action( 'tcd_tab_labels', 'add_404_tab_label' );

// Add HTML of 404 tab
add_action( 'tcd_tab_panel', 'add_404_tab_panel' );

// Register sanitize function
add_filter( 'theme_options_validate', 'add_404_theme_options_validate' );

function add_404_dp_default_options( $dp_default_options ) {

  // Page header
	$dp_default_options['404_ph_title'] = '404';
	$dp_default_options['404_ph_title_font_size'] = 32;
	$dp_default_options['404_ph_title_color'] = '#ffffff';
	$dp_default_options['404_ph_sub'] = 'Not Found';
	$dp_default_options['404_ph_sub_font_size'] = 12;
	$dp_default_options['404_ph_sub_color'] = '#ffffff';
	$dp_default_options['404_ph_title_bg'] = '#111111';
	$dp_default_options['404_ph_desc'] = '';
	$dp_default_options['404_ph_desc_color'] = '#ffffff';
	$dp_default_options['404_ph_desc_bg'] = '#b7aa9d';

	return $dp_default_options;
}

function add_404_tab_label( $tab_labels ) {
	$tab_labels['404'] = __( '404 page', 'tcd-w' );
	return $tab_labels;
}

function add_404_tab_panel( $options ) {

	global $dp_default_options;
?>
<div id="tab-content-404">
	<?php // Page header ?>
	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Page header settings', 'tcd-w' ); ?></h3>
    <h4 class="theme_option_headline2"><?php _e( 'Title', 'tcd-w' ); ?></h4>
    <input type="text" class="regular-text" name="dp_options[404_ph_title]" value="<?php echo esc_attr( $options['404_ph_title'] ); ?>">
    <p><label><?php _e( 'Font size', 'tcd-w' ); ?> <input type="number" class="tiny-text" name="dp_options[404_ph_title_font_size]" value="<?php echo esc_attr( $options['404_ph_title_font_size'] ); ?>" min="1" step="1"> px</label></p>
    <p><label><?php _e( 'Font color', 'tcd-w' ); ?> <input type="text" class="c-color-picker" name="dp_options[404_ph_title_color]" value="<?php echo esc_attr( $options['404_ph_title_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['404_ph_title_color'] ); ?>"></label></p>
    <h4 class="theme_option_headline2"><?php _e( 'Sub title', 'tcd-w' ); ?></h4>
    <input type="text" class="regular-text" name="dp_options[404_ph_sub]" value="<?php echo esc_attr( $options['404_ph_sub'] ); ?>">
    <p><label><?php _e( 'Font size', 'tcd-w' ); ?> <input type="number" class="tiny-text" name="dp_options[404_ph_sub_font_size]" value="<?php echo esc_attr( $options['404_ph_sub_font_size'] ); ?>" min="1" step="1"> px</label></p>
    <p><label><?php _e( 'Font color', 'tcd-w' ); ?> <input type="text" class="c-color-picker" name="dp_options[404_ph_sub_color]" value="<?php echo esc_attr( $options['404_ph_sub_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['404_ph_sub_color'] ); ?>"></label></p>
    <h4 class="theme_option_headline2"><?php _e( 'Background color of title and sub title', 'tcd-w' ); ?></h4>
    <input type="text" class="c-color-picker" name="dp_options[404_ph_title_bg]" value="<?php echo esc_attr( $options['404_ph_title_bg'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['404_ph_title_bg'] ); ?>"></label></p>
    <h4 class="theme_option_headline2"><?php _e( 'Description', 'tcd-w' ); ?></h4>
    <textarea class="large-text" name="dp_options[404_ph_desc]"><?php echo esc_textarea( $options['404_ph_desc'] ); ?></textarea>
    <p><label><?php _e( 'Font color', 'tcd-w' ); ?> <input type="text" class="c-color-picker" name="dp_options[404_ph_desc_color]" value="<?php echo esc_attr( $options['404_ph_desc_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['404_ph_desc_color'] ); ?>"></label></p>
    <h4 class="theme_option_headline2"><?php _e( 'Background color of description', 'tcd-w' ); ?></h4>
    <input type="text" class="c-color-picker" name="dp_options[404_ph_desc_bg]" value="<?php echo esc_attr( $options['404_ph_desc_bg'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['404_ph_desc_bg'] ); ?>"></label></p>
    <input type="submit" class="button-ml ajax_button" value="<?php echo _e( 'Save Changes', 'tcd-w' ); ?>">
	</div>
</div><!-- END #tab-content4 -->
<?php
}

function add_404_theme_options_validate( $input ) {

 	// Page header
 	$input['404_ph_title'] = wp_filter_nohtml_kses( $input['404_ph_title'] );
 	$input['404_ph_title_font_size'] = wp_filter_nohtml_kses( $input['404_ph_title_font_size'] );
 	$input['404_ph_title_color'] = wp_filter_nohtml_kses( $input['404_ph_title_color'] );
 	$input['404_ph_sub'] = wp_filter_nohtml_kses( $input['404_ph_sub'] );
 	$input['404_ph_sub_font_size'] = wp_filter_nohtml_kses( $input['404_ph_sub_font_size'] );
 	$input['404_ph_sub_color'] = wp_filter_nohtml_kses( $input['404_ph_sub_color'] );
 	$input['404_ph_title_bg'] = wp_filter_nohtml_kses( $input['404_ph_title_bg'] );
 	$input['404_ph_desc'] = wp_filter_nohtml_kses( $input['404_ph_desc'] );
 	$input['404_ph_desc_color'] = wp_filter_nohtml_kses( $input['404_ph_desc_color'] );
 	$input['404_ph_desc_bg'] = wp_filter_nohtml_kses( $input['404_ph_desc_bg'] );

	return $input;
}
