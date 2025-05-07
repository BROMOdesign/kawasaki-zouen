<?php 
/*
 * Manage style tab
 */

// Add default values
add_filter( 'before_getting_design_plus_option', 'add_style_dp_default_options' );

//  Add label of style tab
add_action( 'tcd_tab_labels', 'add_style_tab_label' );

// Add HTML of style tab
add_action( 'tcd_tab_panel', 'add_style_tab_panel' );

// Register sanitize function
add_filter( 'theme_options_validate', 'add_style_theme_options_validate' );

function add_style_dp_default_options( $dp_default_options ) {

  // Page header
	$dp_default_options['style_ph_title'] = 'Style';
	$dp_default_options['style_ph_title_font_size'] = 32;
	$dp_default_options['style_ph_title_color'] = '#ffffff';
	$dp_default_options['style_ph_sub'] = __( 'Style', 'tcd-w' );
	$dp_default_options['style_ph_sub_font_size'] = 12;
	$dp_default_options['style_ph_sub_color'] = '#ffffff';
	$dp_default_options['style_ph_title_bg'] = '#111111';
	$dp_default_options['style_ph_desc'] = __( 'Here is the description. Here is the description. Here is the description.', 'tcd-w' );
	$dp_default_options['style_ph_desc_color'] = '#ffffff';
	$dp_default_options['style_ph_desc_bg'] = '#b7aa9d';
  $dp_default_options['style_ph_target'] = 1;

  // Style category
  for ( $i = 1; $i <= 6; $i++ ) {
    $dp_default_options['style_cat' . $i] = '';
    $dp_default_options['style_cat_label' . $i] = '';
  }

  // Archive page
  $dp_default_options['style_search_title'] = 'Style Search';
  $dp_default_options['style_search_sub_title'] = __( 'Hair style search', 'tcd-w' ); // TODO
  for ( $i = 1; $i <= 6; $i++ ) {
    $dp_default_options['style_search_use_tax' . $i] = '';
    //$dp_default_options['style_search_tax_label' . $i ] = '';
  }
  $dp_default_options['style_search_use_staff'] = '';
  $dp_default_options['style_search_headline_color'] = '#ffffff';
  $dp_default_options['style_search_headline_bg'] = '#b7aa9d';
  $dp_default_options['style_search_btn_label'] = __( 'Search style', 'tcd-w' ); // TODO
  //$dp_default_options['style_search_staff_label'] = '';

  // Single page
  $dp_default_options['style_headline_color'] = '#ffffff';
  $dp_default_options['style_headline_bg'] = '#b7aa9d';
  $dp_default_options['style_author_headline'] = __( 'Person in charge', 'tcd-w' );
  $dp_default_options['style_related_cat'] = '';

  // Display
  $dp_default_options['style_breadcrumb'] = __( 'Style', 'tcd-w' );
  $dp_default_options['style_slug'] = 'style';

	return $dp_default_options;
}

function add_style_tab_label( $tab_labels ) {
	$tab_labels['style'] = __( 'Style', 'tcd-w' );
	return $tab_labels;
}

function add_style_tab_panel( $options ) {
	global $dp_default_options;

  for ( $i = 1; $i <= 6; $i++ ) {
    if ( isset( $options['style_cat' . $i] ) && $options['style_cat' . $i] ) {
      $style_related_cat_options[$options['style_cat' . $i]] = array(
        'value' => $options['style_cat' . $i],
        'label' => $options['style_cat_label' . $i]
      );
    }
  }
?>
<div id="tab-content-style" class="tab-content">
	<?php // Page header ?>
	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Page header settings', 'tcd-w' ); ?><?php _e( '(archive and single page)', 'tcd-w' ); ?></h3>
    <h4 class="theme_option_headline2"><?php _e( 'Title', 'tcd-w' ); ?></h4>
    <input type="text" class="regular-text" name="dp_options[style_ph_title]" value="<?php echo esc_attr( $options['style_ph_title'] ); ?>">
    <p><label><?php _e( 'Font size', 'tcd-w' ); ?> <input type="number" class="tiny-text" name="dp_options[style_ph_title_font_size]" value="<?php echo esc_attr( $options['style_ph_title_font_size'] ); ?>" min="1" step="1"> px</label></p>
    <p><label><?php _e( 'Font color', 'tcd-w' ); ?> <input type="text" class="c-color-picker" name="dp_options[style_ph_title_color]" value="<?php echo esc_attr( $options['style_ph_title_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['style_ph_title_color'] ); ?>"></label></p>
    <h4 class="theme_option_headline2"><?php _e( 'Sub title', 'tcd-w' ); ?></h4>
    <input type="text" class="regular-text" name="dp_options[style_ph_sub]" value="<?php echo esc_attr( $options['style_ph_sub'] ); ?>">
    <p><label><?php _e( 'Font size', 'tcd-w' ); ?> <input type="number" class="tiny-text" name="dp_options[style_ph_sub_font_size]" value="<?php echo esc_attr( $options['style_ph_sub_font_size'] ); ?>" min="1" step="1"> px</label></p>
    <p><label><?php _e( 'Font color', 'tcd-w' ); ?> <input type="text" class="c-color-picker" name="dp_options[style_ph_sub_color]" value="<?php echo esc_attr( $options['style_ph_sub_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['style_ph_sub_color'] ); ?>"></label></p>
    <h4 class="theme_option_headline2"><?php _e( 'Background color of title and sub title', 'tcd-w' ); ?></h4>
    <input type="text" class="c-color-picker" name="dp_options[style_ph_title_bg]" value="<?php echo esc_attr( $options['style_ph_title_bg'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['style_ph_title_bg'] ); ?>"></label></p>
    <h4 class="theme_option_headline2"><?php _e( 'Description', 'tcd-w' ); ?></h4>
    <textarea class="large-text" name="dp_options[style_ph_desc]"><?php echo esc_textarea( $options['style_ph_desc'] ); ?></textarea>
    <p><label><?php _e( 'Font color', 'tcd-w' ); ?> <input type="text" class="c-color-picker" name="dp_options[style_ph_desc_color]" value="<?php echo esc_attr( $options['style_ph_desc_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['style_ph_desc_color'] ); ?>"></label></p>
    <h4 class="theme_option_headline2"><?php _e( 'Background color of description', 'tcd-w' ); ?></h4>
    <input type="text" class="c-color-picker" name="dp_options[style_ph_desc_bg]" value="<?php echo esc_attr( $options['style_ph_desc_bg'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['style_ph_desc_bg'] ); ?>"></label></p>
    <input type="submit" class="button-ml ajax_button" value="<?php echo _e( 'Save Changes', 'tcd-w' ); ?>">
	</div>
	<?php // Style category ?>
	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Style category settings', 'tcd-w' ); ?></h3>
    <?php for ( $i = 1; $i <= 6; $i++ ) : ?>
    <div class="sub_box cf">
    	<h3 class="theme_option_subbox_headline"><?php _e( 'Category', 'tcd-w' ); ?><?php echo $i; ?></h3>
    	<div class="sub_box_content">
    		<h4 class="theme_option_headline2"><?php _e( 'Name', 'tcd-w' ); ?></h4>
        <input type="text" name="dp_options[style_cat_label<?php echo $i; ?>]" value="<?php echo esc_attr( $options['style_cat_label' . $i] ); ?>" class="regular-text">
    		<h4 class="theme_option_headline2"><?php _e( 'Slug', 'tcd-w' ); ?></h4>
        <p><?php _e( 'It is used in URL. You can use lowercase letters and the underscore character, and not be more than 32 characters long.', 'tcd-w' ); ?></p>
        <input type="text" name="dp_options[style_cat<?php echo $i; ?>]" value="<?php echo esc_attr( $options['style_cat' . $i] ); ?>" class="regular-tex style-cat" maxlength="32">
        <input type="submit" class="button-ml ajax_button" value="<?php echo _e( 'Save Changes', 'tcd-w' ); ?>">
      </div>
    </div>
    <?php endfor; ?>
    <input type="submit" class="button-ml ajax_button" value="<?php echo _e( 'Save Changes', 'tcd-w' ); ?>">
  </div>
  <?php // Archive page ?>
	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Search settings', 'tcd-w' ); ?></h3>
    <h4 class="theme_option_headline2"><?php _e( 'Title', 'tcd-w' ); ?></h4>
    <input type="text" name="dp_options[style_search_title]" value="<?php echo esc_attr( $options['style_search_title'] ); ?>" class="regular-text">
    <h4 class="theme_option_headline2"><?php _e( 'Sub title', 'tcd-w' ); ?></h4>
    <input type="text" name="dp_options[style_search_sub_title]" value="<?php echo esc_attr( $options['style_search_sub_title'] ); ?>" class="regular-text">
    <h4 class="theme_option_headline2"><?php _e( 'Search criteria', 'tcd-w' ); ?></h4>
    <p><?php _e( 'Please select search criteria to use.', 'tcd-w' ); ?></p>
    <p><?php _e( 'Note: please reload this page right after registering style category.', 'tcd-w' ); ?></p>
    <?php
    for ( $i = 1; $i <= 6; $i++ ) : 
      if ( $options['style_cat' . $i] ) :
    ?>
    <p><label><input type="checkbox" name="dp_options[style_search_use_tax<?php echo $i; ?>]" value="1" <?php checked( 1, $options['style_search_use_tax' . $i] ); ?>><?php printf( __( 'Use "%s"', 'tcd-w' ), esc_html( $options['style_cat_label' . $i] ) ); ?></label></p>
    <?php
      endif; 
    endfor; 
    ?>
    <p><label><input type="checkbox" name="dp_options[style_search_use_staff]" value="1" <?php checked( 1, $options['style_search_use_staff'] ); ?>><?php _e( 'Use "Staff"', 'tcd-w' ); ?></label></p>
    <p><label for="style_search_headline_color"><?php _e( 'Font color of headline', 'tcd-w' ); ?></label> <input type="text" class="c-color-picker" name="dp_options[style_search_headline_color]" value="<?php echo esc_attr( $options['style_search_headline_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['style_search_headline_color'] ); ?>" id="style_search_headline_color"></p>
    <p><label for="style_search_headline_bg"><?php _e( 'Background color of headline', 'tcd-w' ); ?></label> <input type="text" class="c-color-picker" name="dp_options[style_search_headline_bg]" value="<?php echo esc_attr( $options['style_search_headline_bg'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['style_search_headline_bg'] ); ?>" id="style_search_headline_bg"></p>
    <h4 class="theme_option_headline2"><?php _e( 'Button label', 'tcd-w' ); ?></h4>
    <input type="text" name="dp_options[style_search_btn_label]" value="<?php echo esc_attr( $options['style_search_btn_label'] ); ?>" class="regular-text">
    <h4 class="theme_option_headline2"><?php _e( 'Setting of link target for search result', 'tcd-w' ); ?></h4>
    <p><label><input name="dp_options[style_ph_target]" type="checkbox" value="1" <?php checked( 1, $options['style_ph_target'] ); ?>><?php _e( 'Open link in new window', 'tcd-w' ); ?></label></p>
    <input type="submit" class="button-ml ajax_button" value="<?php echo _e( 'Save Changes', 'tcd-w' ); ?>">
  </div>
  <?php // Single page ?>
	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Single page settings', 'tcd-w' ); ?></h3>
    <h4 class="theme_option_headline2"><?php _e( 'Headline settings', 'tcd-w' ); ?></h4>
    <p><label for="style_headline_color"><?php _e( 'Font color', 'tcd-w' ); ?></label> <input type="text" name="dp_options[style_headline_color]" value="<?php echo esc_attr( $options['style_headline_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['style_headline_color'] ); ?>" class="c-color-picker" id="style_headline_color"></p> 
    <p><label for="style_headline_bg"><?php _e( 'Background color', 'tcd-w' ); ?></label> <input type="text" name="dp_options[style_headline_bg]" value="<?php echo esc_attr( $options['style_headline_bg'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['style_headline_bg'] ); ?>" class="c-color-picker" id="style_headline_bg"></p> 
    <h4 class="theme_option_headline2"><?php _e( 'Style author settings', 'tcd-w' ); ?></h4>
    <p><?php _e( 'Headline', 'tcd-w' ); ?> <input type="text" name="dp_options[style_author_headline]" class="regular-text" value="<?php echo esc_attr( $options['style_author_headline'] ); ?>"></p>
    <h4 class="theme_option_headline2"><?php _e( 'Related styles settings', 'tcd-w' ); ?></h4>
    <p><?php _e( 'Please select a style category to display related styles.', 'tcd-w' ); ?></p>
    <p><?php _e( 'Note: please reload this page right after registering style category.', 'tcd-w' ); ?></p>
    <select name="dp_options[style_related_cat]">
      <option><?php _e( '— Select —', 'tcd-w' ); ?></option>
      <?php foreach( $style_related_cat_options as $option ) : ?>
      <option value="<?php echo esc_attr( $option['value'] ); ?>" <?php selected( $option['value'], $options['style_related_cat'] ); ?>><?php echo esc_html( $option['label'] ); ?></option>
      <?php endforeach; ?>
    </select>
    <input type="submit" class="button-ml ajax_button" value="<?php echo _e( 'Save Changes', 'tcd-w' ); ?>">
  </div>
  <?php // Display ?>
	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Display settings', 'tcd-w' ); ?></h3>
		<h4 class="theme_option_headline2"><?php _e( 'Breadcrumb settings', 'tcd-w' ); ?></h4>
		<p><?php _e( 'It is used in the breadcrumb navigation. If it is not registerd, "Style" is displayed instead.', 'tcd-w' ); ?></p>
		<p><input type="text" name="dp_options[style_breadcrumb]" value="<?php echo esc_attr( $options['style_breadcrumb'] ); ?>"></p>
    <h4 class="theme_option_headline2"><?php _e( 'Slug settings', 'tcd-w' ); ?></h4>
		<p><?php _e( 'It is used in URL. You can use only alphanumeric. If it is not registerd, "style" is used instead.', 'tcd-w' ); ?></p>
		<p><?php _e( 'Note: if you want to change the slug, change permalinks from "Plain".', 'tcd-w' ); ?></p>
		<p><?php _e( 'Note: after changing the slug, you need to go to "Permalink Settings" and click "Save Changes".', 'tcd-w' ); ?></p>
		<p><input type="text" name="dp_options[style_slug]" value="<?php echo esc_attr( $options['style_slug'] ); ?>"></p>
    <input type="submit" class="button-ml ajax_button" value="<?php echo _e( 'Save Changes', 'tcd-w' ); ?>">
  </div>
</div><!-- END #tab-content4 -->
<?php
}

function add_style_theme_options_validate( $input ) {

  $options = get_design_plus_option();

  $style_related_cat_options = array();
  for ( $i = 1; $i <= 6; $i++ ) {
    if ( isset( $options['style_cat' . $i] ) && $options['style_cat' . $i] ) {
      $style_related_cat_options[$options['style_cat' . $i]] = array(
        'value' => $options['style_cat' . $i],
        'label' => $options['style_cat_label' . $i]
      );
    }
  }

  // Page header
 	$input['style_ph_title'] = wp_filter_nohtml_kses( $input['style_ph_title'] );
 	$input['style_ph_title_font_size'] = wp_filter_nohtml_kses( $input['style_ph_title_font_size'] );
 	$input['style_ph_title_color'] = wp_filter_nohtml_kses( $input['style_ph_title_color'] );
 	$input['style_ph_sub'] = wp_filter_nohtml_kses( $input['style_ph_sub'] );
 	$input['style_ph_sub_font_size'] = wp_filter_nohtml_kses( $input['style_ph_sub_font_size'] );
 	$input['style_ph_sub_color'] = wp_filter_nohtml_kses( $input['style_ph_sub_color'] );
 	$input['style_ph_title_bg'] = wp_filter_nohtml_kses( $input['style_ph_title_bg'] );
 	$input['style_ph_desc'] = wp_filter_nohtml_kses( $input['style_ph_desc'] );
 	$input['style_ph_desc_color'] = wp_filter_nohtml_kses( $input['style_ph_desc_color'] );
 	$input['style_ph_desc_bg'] = wp_filter_nohtml_kses( $input['style_ph_desc_bg'] );

  // Style category
  for ( $i = 1; $i <= 6; $i++ ) {
 	  $input['style_cat' . $i] = wp_filter_nohtml_kses( $input['style_cat' . $i] );
 	  $input['style_cat_label' . $i] = wp_filter_nohtml_kses( $input['style_cat_label' . $i] );
  }

  // Archive page
 	$input['style_search_title'] = wp_filter_nohtml_kses( $input['style_search_title'] );
 	$input['style_search_sub_title'] = wp_filter_nohtml_kses( $input['style_search_sub_title'] );
  for ( $i = 1; $i <= 6; $i++ ) {
 	  if ( ! isset( $input['style_search_use_tax' . $i] ) ) $input['style_search_use_tax' . $i] = null;
    $input['style_search_use_tax' . $i] = ( $input['style_search_use_tax' . $i] == 1 ? 1 : 0 );
 	  //$input['style_search_tax_label' . $i] = wp_filter_nohtml_kses( $input['style_search_tax_label' . $i] );
  }
 	if ( ! isset( $input['style_search_use_staff'] ) ) $input['style_search_use_staff'] = null;
  $input['style_search_use_staff'] = ( $input['style_search_use_staff'] == 1 ? 1 : 0 );
 	//$input['style_search_staff_label'] = wp_filter_nohtml_kses( $input['style_search_staff_label'] );
 	$input['style_search_headline_color'] = wp_filter_nohtml_kses( $input['style_search_headline_color'] );
 	$input['style_search_headline_bg'] = wp_filter_nohtml_kses( $input['style_search_headline_bg'] );
 	$input['style_search_btn_label'] = wp_filter_nohtml_kses( $input['style_search_btn_label'] );
  if ( ! isset( $input['style_ph_target'] ) ) $input['style_ph_target'] = null;
  $input['style_ph_target'] = ( $input['style_ph_target'] == 1 ? 1 : 0 );

  // Single page
 	$input['style_headline_color'] = wp_filter_nohtml_kses( $input['style_headline_color'] );
 	$input['style_headline_bg'] = wp_filter_nohtml_kses( $input['style_headline_bg'] );
 	$input['style_author_headline'] = wp_filter_nohtml_kses( $input['style_author_headline'] );
  if ( ! isset( $input['style_related_cat'] ) ) $input['style_related_cat'] = null;
  if ( ! array_key_exists( $input['style_related_cat'], $style_related_cat_options ) ) $input['style_related_cat'] = null;

  // Display
 	$input['style_breadcrumb'] = wp_filter_nohtml_kses( $input['style_breadcrumb'] );
 	$input['style_slug'] = wp_filter_nohtml_kses( $input['style_slug'] );

	return $input;
}
