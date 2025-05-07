<?php
/*
 * Add a meta box of page header
 */
$ph_fields = array(
	array(
		'id' => 'ph_title',
		'title' => __( 'Title', 'tcd-w' ),
		'type' => 'text',
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
	),
	array(
		'id' => 'ph_title_font_size',
		'title' => __( 'Font size of title', 'tcd-w' ),
		'type' => 'number',
    'unit' => 'px',
    'default' => 34,
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
	),
	array(
		'id' => 'ph_title_color',
		'title' => __( 'Font color of title', 'tcd-w' ),
		'type' => 'color',
    'default' => '#ffffff',
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
	),
	array(
		'id' => 'ph_sub',
		'title' => __( 'Sub title', 'tcd-w' ),
		'type' => 'text',
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
	),
	array(
		'id' => 'ph_sub_font_size',
		'title' => __( 'Font size of sub title', 'tcd-w' ),
		'type' => 'number',
    'unit' => 'px',
    'default' => 12,
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
	),
	array(
		'id' => 'ph_sub_color',
		'title' => __( 'Font color of sub title', 'tcd-w' ),
		'type' => 'color',
    'default' => '#ffffff',
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
	),
	array(
		'id' => 'ph_title_bg',
		'title' => __( 'Background color of title and sub title', 'tcd-w' ),
		'type' => 'color',
    'default' => '#000000',
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
	),
	array(
		'id' => 'ph_desc',
		'title' => __( 'Description', 'tcd-w' ),
		'type' => 'textarea',
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
	),
	array(
		'id' => 'ph_desc_bg',
		'title' => __( 'Background color of description', 'tcd-w' ),
		'type' => 'color',
    'default' => '#b7aa9d',
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
	),
);
$ph_args = array(
	'id' => 'ph_meta_box',
	'title' => __( 'Page header settings', 'tcd-w' ),
	'screen' => array( 'page' ),
	'context' => 'normal',
	'fields' => $ph_fields
);
$ph_meta_box = new TCD_Meta_Box( $ph_args );
