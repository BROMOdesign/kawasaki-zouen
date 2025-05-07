<?php 
/*
 * Manage staff tab
 */

// Add default values
add_filter( 'before_getting_design_plus_option', 'add_staff_dp_default_options' );

//  Add label of staff tab
add_action( 'tcd_tab_labels', 'add_staff_tab_label' );

// Add HTML of staff tab
add_action( 'tcd_tab_panel', 'add_staff_tab_panel' );

// Register sanitize function
add_filter( 'theme_options_validate', 'add_staff_theme_options_validate' );

function add_staff_dp_default_options( $dp_default_options ) {

  // Page header
	$dp_default_options['staff_ph_title'] = 'Staff';
	$dp_default_options['staff_ph_title_font_size'] = 32;
	$dp_default_options['staff_ph_title_color'] = '#ffffff';
	$dp_default_options['staff_ph_sub'] = __( 'Staff', 'tcd-w' );
	$dp_default_options['staff_ph_sub_font_size'] = 12;
	$dp_default_options['staff_ph_sub_color'] = '#ffffff';
	$dp_default_options['staff_ph_title_bg'] = '#111111';
	$dp_default_options['staff_ph_desc'] = __( 'Here is the description. Here is the description. Here is the description.', 'tcd-w' );
	$dp_default_options['staff_ph_desc_color'] = '#ffffff';
	$dp_default_options['staff_ph_desc_bg'] = '#b7aa9d';

  // Single page
  $dp_default_options['staff_display_blog'] = 0;
  $dp_default_options['staff_headline_color'] = '#ffffff';
  $dp_default_options['staff_headline_bg'] = '#b7aa9d';

  // Display
  $dp_default_options['staff_breadcrumb'] = __( 'Staff', 'tcd-w' );
  $dp_default_options['staff_slug'] = 'staff';

	return $dp_default_options;
}

function add_staff_tab_label( $tab_labels ) {
	$tab_labels['staff'] = __( 'Staff', 'tcd-w' );
	return $tab_labels;
}

function add_staff_tab_panel( $options ) {

	global $dp_default_options;
?>
<div id="tab-content-staff">
	<?php // Page header ?>
	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Page header settings', 'tcd-w' ); ?><?php _e( '(archive and single page)', 'tcd-w' ); ?></h3>
    <h4 class="theme_option_headline2"><?php _e( 'Title', 'tcd-w' ); ?></h4>
    <input type="text" class="regular-text" name="dp_options[staff_ph_title]" value="<?php echo esc_attr( $options['staff_ph_title'] ); ?>">
    <p><label><?php _e( 'Font size', 'tcd-w' ); ?> <input type="number" class="tiny-text" name="dp_options[staff_ph_title_font_size]" value="<?php echo esc_attr( $options['staff_ph_title_font_size'] ); ?>" min="1" step="1"> px</label></p>
    <p><label><?php _e( 'Font color', 'tcd-w' ); ?> <input type="text" class="c-color-picker" name="dp_options[staff_ph_title_color]" value="<?php echo esc_attr( $options['staff_ph_title_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['staff_ph_title_color'] ); ?>"></label></p>
    <h4 class="theme_option_headline2"><?php _e( 'Sub title', 'tcd-w' ); ?></h4>
    <input type="text" class="regular-text" name="dp_options[staff_ph_sub]" value="<?php echo esc_attr( $options['staff_ph_sub'] ); ?>">
    <p><label><?php _e( 'Font size', 'tcd-w' ); ?> <input type="number" class="tiny-text" name="dp_options[staff_ph_sub_font_size]" value="<?php echo esc_attr( $options['staff_ph_sub_font_size'] ); ?>" min="1" step="1"> px</label></p>
    <p><label><?php _e( 'Font color', 'tcd-w' ); ?> <input type="text" class="c-color-picker" name="dp_options[staff_ph_sub_color]" value="<?php echo esc_attr( $options['staff_ph_sub_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['staff_ph_sub_color'] ); ?>"></label></p>
    <h4 class="theme_option_headline2"><?php _e( 'Background color of title and sub title', 'tcd-w' ); ?></h4>
    <input type="text" class="c-color-picker" name="dp_options[staff_ph_title_bg]" value="<?php echo esc_attr( $options['staff_ph_title_bg'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['staff_ph_title_bg'] ); ?>"></label></p>
    <h4 class="theme_option_headline2"><?php _e( 'Description', 'tcd-w' ); ?></h4>
    <textarea class="large-text" name="dp_options[staff_ph_desc]"><?php echo esc_textarea( $options['staff_ph_desc'] ); ?></textarea>
    <p><label><?php _e( 'Font color', 'tcd-w' ); ?> <input type="text" class="c-color-picker" name="dp_options[staff_ph_desc_color]" value="<?php echo esc_attr( $options['staff_ph_desc_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['staff_ph_desc_color'] ); ?>"></label></p>
    <h4 class="theme_option_headline2"><?php _e( 'Background color of description', 'tcd-w' ); ?></h4>
    <input type="text" class="c-color-picker" name="dp_options[staff_ph_desc_bg]" value="<?php echo esc_attr( $options['staff_ph_desc_bg'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['staff_ph_desc_bg'] ); ?>"></label></p>
    <input type="submit" class="button-ml ajax_button" value="<?php echo _e( 'Save Changes', 'tcd-w' ); ?>">
	</div>
  <?php // Single page ?>
	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Single page settings', 'tcd-w' ); ?></h3>
    <ul>
      <li><label><input type="checkbox" name="dp_options[staff_display_blog]" value="1" <?php checked( 1, $options['staff_display_blog'] ); ?>> <?php _e( 'Display blog list of the staff', 'tcd-w' ); ?></label></li>
    </ul>
    <h4 class="theme_option_headline2"><?php _e( 'Table settings', 'tcd-w' ); ?></h4>
    <p><label for="staff_headline_color"><?php _e( 'Font color of title', 'tcd-w' ); ?></label> <input type="text" name="dp_options[staff_headline_color]" value="<?php echo esc_attr( $options['staff_headline_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['staff_headline_color'] ); ?>" class="c-color-picker" id="staff_headline_color"></p> 
    <p><label for="staff_headline_bg"><?php _e( 'Background color of title', 'tcd-w' ); ?></label> <input type="text" name="dp_options[staff_headline_bg]" value="<?php echo esc_attr( $options['staff_headline_bg'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['staff_headline_bg'] ); ?>" class="c-color-picker" id="staff_headline_bg"></p> 
    <input type="submit" class="button-ml ajax_button" value="<?php echo _e( 'Save Changes', 'tcd-w' ); ?>">
  </div>
	<?php // Display ?>
  <div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Display settings', 'tcd-w' ); ?></h3>
		<h4 class="theme_option_headline2"><?php _e( 'Breadcrumb settings', 'tcd-w' ); ?></h4>
		<p><?php _e( 'It is used in the breadcrumb navigation. If it is not registerd, "Staff" is displayed instead.', 'tcd-w' ); ?></p>
		<p><input type="text" name="dp_options[staff_breadcrumb]" value="<?php echo esc_attr( $options['staff_breadcrumb'] ); ?>"></p>
    <h4 class="theme_option_headline2"><?php _e( 'Slug settings', 'tcd-w' ); ?></h4>
		<p><?php _e( 'It is used in URL. You can use only alphanumeric. If it is not registerd, "staff" is used instead.', 'tcd-w' ); ?></p>
		<p><?php _e( 'Note: if you want to change the slug, change permalinks from "Plain".', 'tcd-w' ); ?></p>
		<p><?php _e( 'Note: after changing the slug, you need to go to "Permalink Settings" and click "Save Changes".', 'tcd-w' ); ?></p>
		<p><input type="text" name="dp_options[staff_slug]" value="<?php echo esc_attr( $options['staff_slug'] ); ?>"></p>
    <input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
	</div>
</div><!-- END #tab-content4 -->
<?php
}

function add_staff_theme_options_validate( $input ) {

 	// Page header
 	$input['staff_ph_title'] = wp_filter_nohtml_kses( $input['staff_ph_title'] );
 	$input['staff_ph_title_font_size'] = wp_filter_nohtml_kses( $input['staff_ph_title_font_size'] );
 	$input['staff_ph_title_color'] = wp_filter_nohtml_kses( $input['staff_ph_title_color'] );
 	$input['staff_ph_sub'] = wp_filter_nohtml_kses( $input['staff_ph_sub'] );
 	$input['staff_ph_sub_font_size'] = wp_filter_nohtml_kses( $input['staff_ph_sub_font_size'] );
 	$input['staff_ph_sub_color'] = wp_filter_nohtml_kses( $input['staff_ph_sub_color'] );
 	$input['staff_ph_title_bg'] = wp_filter_nohtml_kses( $input['staff_ph_title_bg'] );
 	$input['staff_ph_desc'] = wp_filter_nohtml_kses( $input['staff_ph_desc'] );
 	$input['staff_ph_desc_color'] = wp_filter_nohtml_kses( $input['staff_ph_desc_color'] );
 	$input['staff_ph_desc_bg'] = wp_filter_nohtml_kses( $input['staff_ph_desc_bg'] );

  // Single page
	if ( ! isset( $input['staff_display_blog'] ) ) $input['staff_display_blog'] = null;
  $input['staff_display_blog'] = ( $input['staff_display_blog'] == 1 ? 1 : 0 );
 	$input['staff_headline_color'] = wp_filter_nohtml_kses( $input['staff_headline_color'] );
 	$input['staff_headline_bg'] = wp_filter_nohtml_kses( $input['staff_headline_bg'] );

  // Display
 	$input['staff_breadcrumb'] = wp_filter_nohtml_kses( $input['staff_breadcrumb'] );
 	$input['staff_slug'] = wp_filter_nohtml_kses( $input['staff_slug'] );

	return $input;
}
