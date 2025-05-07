<?php
/*
 * Add a meta box of style informations
 */

$staff_args = array(
  'posts_per_page' => -1,
  'post_type' => 'staff',
  'post_status' => 'publish'
);

$staff_posts = get_posts( $staff_args );

$staff_id_options = array();
foreach ( $staff_posts as $staff_post ) {
  $staff_id_options[] = array(
    'value' => $staff_post->ID,
    'label' => $staff_post->post_title
  );
}

for ( $i = 1; $i <= 4; $i++ ) {
	$style_info_fields[] = array(
		'id' => 'slider' . $i . '_image',
		'title' => __( 'Image for Slider', 'tcd-w' ) . $i,
		'type' => 'image',
		'description' => __( 'Recommend image size. Width:760px, Height:1030px', 'tcd-w' ),
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
	);
} 

$style_info_fields[] = array(
  'id' => 'style_data',
  'title' => __( 'Style data', 'tcd-w' ),
	'description' => __( 'If you want to use a table cell that spans two columns, please blank it\'s "Headline" cell.', 'tcd-w' ),
  'type' => 'repeater_table',
  //'default' => array( array( 'header' => '', 'data' => '' ) ),
  'default' => array( 'header' => array( '' ), 'data' => array( '' ) ),
  'header' => array( 'header' => __( 'Headline', 'tcd-w' ), 'data' => __( 'Data', 'tcd-w' ) ),
	'before_field' => '<dl class="ml_custom_fields">',
	'after_field' => '</dd></dl>',
	'before_title' => '<dt class="label">',
	'after_title' => '</dt><dd class="content ">'
);

$style_info_fields[] = array(
	'id' => 'style_point',
	'title' => __( 'Point of this style', 'tcd-w' ),
	'type' => 'textarea',
	'before_field' => '<dl class="ml_custom_fields">',
	'after_field' => '</dd></dl>',
	'before_title' => '<dt class="label">',
	'after_title' => '</dt><dd class="content">'
);

$style_info_fields[] = array(
	'id' => 'staff_id',
	'title' => __( 'The ID of stylist', 'tcd-w' ),
	'type' => 'select',
	'description' => __( 'Select the staff involved in this style.', 'tcd-w' ),
	'before_field' => '<dl class="ml_custom_fields">',
	'after_field' => '</dd></dl>',
	'before_title' => '<dt class="label">',
	'after_title' => '</dt><dd class="content">',
  'options' => $staff_id_options
);

$style_info_args = array(
	'id' => 'style_info_meta_box',
	'title' => __( 'Additinonal style information', 'tcd-w' ),
	'screen' => array( 'style' ),
	'context' => 'normal',
	'fields' => $style_info_fields
); 

$style_info_meta_box = new TCD_Meta_Box( $style_info_args );
