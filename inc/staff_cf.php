<?php
/*
 * Add a meta box of staff informations
 */
$staff_info_fields = array(
	array(
		'id' => 'staff_job_title',
		'title' => __( 'Job title', 'tcd-w' ),
		'type' => 'text',
		'description' => __( 'Please enter the job title for this staff.', 'tcd-w' ),
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
	),
	array(
		'id' => 'staff_twitter',
		'title' => __( 'Twitter URL', 'tcd-w' ),
		'type' => 'text',
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
	),
	array(
		'id' => 'staff_fb',
		'title' => __( 'Facebook URL', 'tcd-w' ),
		'type' => 'text',
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
	),
	array(
		'id' => 'staff_insta',
		'title' => __( 'Instagram URL', 'tcd-w' ),
		'type' => 'text',
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
	),
  array(
    'id' => 'staff_data',
    'title' => __( 'Staff data', 'tcd-w' ),
    'type' => 'repeater_table',
		'description' => __( 'If you want to use a table cell that spans two columns, please blank it\'s "Headline" cell.', 'tcd-w' ),
    //'default' => array( array( 'header' => '', 'data' => '' ) ),
    'default' => array( 'header' => array( '' ), 'data' => array( '' ) ),
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content ">',
    'header' => array( 'header' => __( 'Headline', 'tcd-w' ), 'data' => __( 'Data', 'tcd-w' ) ),
  ),
	array(
		'id' => 'staff_comment',
		'title' => __( 'Staff comments', 'tcd-w' ),
		'type' => 'textarea',
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
	),
  array(
    'id' => 'staff_work_schedule',
    'title' => __( 'Work schedule', 'tcd-w' ),
    'type' => 'repeater_table',
    'default' => array( 
      'header' => array( '', __( 'AM', 'tcd-w' ), __( 'PM', 'tcd-w' ) ),
      'mon' => array( __( 'Mon', 'tcd-w' ), '', '' ),
      'tue' => array( __( 'Tue', 'tcd-w' ), '', '' ),
      'wed' => array( __( 'Wed', 'tcd-w' ), '', '' ),
      'thu' => array( __( 'Thu', 'tcd-w' ), '', '' ),
      'fri' => array( __( 'Fri', 'tcd-w' ), '', '' ),
      'sat' => array( __( 'Sat', 'tcd-w' ), '', '' ),
      'sun' => array( __( 'Sun', 'tcd-w' ), '', '' ),
    ),
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content ">',
    'header' => array( 
      'header' => __( 'Time', 'tcd-w' ), 
      'mon' => '', 
      'tue' => '', 
      'wed' => '', 
      'thu' => '', 
      'fri' => '', 
      'sat' => '', 
      'sun' => ''
    )
  ),
	array(
		'id' => 'staff_display_work_schedule',
    'title' => __( 'Work schedule display setting', 'tcd-w' ),
		'type' => 'checkbox',
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content ">',
    'options' => array(
      array( 
        'value' => 1,
        'label' => __( 'Display work schedule', 'tcd-w' )
      )
    )
	),
	array(
		'id' => 'staff_style_list_title',
		'title' => __( 'Style list title', 'tcd-w' ),
		'description' => __( 'Please enter the title of the style list of this staff.', 'tcd-w' ),
		'type' => 'text',
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
	),
);
$staff_info_args = array(
	'id' => 'staff_info_meta_box',
	'title' => __( 'Additinonal staff information', 'tcd-w' ),
	'screen' => array( 'staff' ),
	'context' => 'normal',
	'fields' => $staff_info_fields
);
$staff_info_meta_box = new TCD_Meta_Box( $staff_info_args );

/**
 * Add a recommend image size
 */
function test( $content, $post_id ) {
  $post_type = get_post_type( $post_id );

  if ( 'staff' === $post_type ) {
    $content .= '<p>' . __( 'Recommend image size. Width:760px, Height:1030px', 'tcd-w' ) . '</p>' . "\n";
  }

  return $content;
}
add_filter( 'admin_post_thumbnail_html', 'test', 10, 2 );
