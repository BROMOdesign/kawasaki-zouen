<?php
/*
 * Add a meta box of blog author
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

$blog_pagenation_type_options = array(
  'type1' => array( 'value' => 'type1', 'label' => __( 'Page numbers', 'tcd-w' ) ),
  'type2' => array( 'value' => 'type2', 'label' => __( 'Read more button', 'tcd-w' ) ),
  'type3' => array( 'value' => 'type3', 'label' => __( 'Use theme options settings', 'tcd-w' ) )
);

$blog_fields = array(
  array(
  	'id' => 'staff_id',
	  'title' => __( 'Author informations', 'tcd-w' ),
  	'type' => 'select',
  	'description' => __( 'Please select the staff who wrote this post.', 'tcd-w' ),
    'options' => $staff_id_options,
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
  ),
  array(
  	'id' => 'pagenation_type',
	  'title' => __( 'Pagenation settings', 'tcd-w' ),
  	'type' => 'select',
  	'description' => __( 'Please select the pagenation type.', 'tcd-w' ),
    'options' => $blog_pagenation_type_options,
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">',
    'default' => 'type3'
  )
);

$blog_args = array(
	'id' => 'blog_meta_box',
	'title' => __( 'Post settings', 'tcd-w' ),
	'screen' => array( 'post' ),
	'context' => 'normal',
	'fields' => $blog_fields
); 

$blog_meta_box = new TCD_Meta_Box( $blog_args );
