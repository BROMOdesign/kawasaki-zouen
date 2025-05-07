<?php
/**
 * Add custom columns (ID, thumbnails)
 */
function manage_columns( $columns ) {

	// Make new column array with ID column and featured image column
	$new_columns = array();

	foreach ( $columns as $column_name => $column_display_name ) {

		// Add post_id column before title column
		if ( isset( $columns['title'] ) && $column_name == 'title' ) {
			$new_columns['post_id'] = 'ID';
		}
		$new_columns[$column_name] = $column_display_name;
	}

	// Add featured image column
	$new_columns['new_post_thumb'] = __( 'Featured Image', 'tcd-w' );

	return $new_columns;
}
/*
add_filter( 'manage_post_posts_columns', 'manage_columns', 5 ); // post
add_filter( 'manage_staff_posts_columns', 'manage_columns', 5 ); // staff
add_filter( 'manage_style_posts_columns', 'manage_columns', 5 ); // style
add_filter( 'manage_page_posts_columns', 'manage_columns', 5 ); // page
*/
add_filter( 'manage_posts_columns', 'manage_columns', 5 ); // For post, page, staff, style

/**
 * Add a custom column (recommend post)
 */
function manage_post_posts_columns( $columns ) {
	$columns['recommend_post'] = __( 'Recommend post', 'tcd-w' );
	return $columns;
}
add_filter( 'manage_post_posts_columns', 'manage_post_posts_columns' ); // Only for post

/**
 * Add a custom column (menu order)
 */
function manage_staff_style_posts_columns( $columns ) {
	$columns['menu_order'] = __( 'Menu order', 'tcd-w' );
	return $columns;
}
//add_filter( 'manage_staff_posts_columns', 'manage_staff_style_posts_columns' ); // For staff
//add_filter( 'manage_style_posts_columns', 'manage_staff_style_posts_columns' ); // For style

/**
 * Output the content of custom columns (ID, featured image, recommend post)
 */
function add_column( $column_name, $post_id ) {

	switch ( $column_name ) {
		
		case 'post_id' : // ID
			echo $post_id;
			break;

		case 'new_post_thumb' : // Featured image
    	$post_thumbnail_id = get_post_thumbnail_id( $post_id );
      if ( $post_thumbnail_id ) {
        $post_thumbnail_img = wp_get_attachment_image_src( $post_thumbnail_id, 'thumbnail' );
        echo '<img width="70" src="' . esc_attr( $post_thumbnail_img[0] ) . '">';
      }
			break;

	 	case 'recommend_post' : // Recommend post
			if ( get_post_meta( $post_id, 'recommend_post1', true ) ) { _e( 'Recommend post1<br>', 'tcd-w' ); }
		  if ( get_post_meta( $post_id, 'recommend_post2', true ) ) { _e( 'Recommend post2<br>', 'tcd-w' ); }
		  if ( get_post_meta( $post_id, 'recommend_post3', true ) ) { _e( 'Recommend post3', 'tcd-w' ); }
      break;

		case 'menu_order' : // Menu order
			$post = get_post( $post_id );
			echo intval( $post->menu_order );	
			break;
	}
}
add_action( 'manage_posts_custom_column', 'add_column', 10, 2 ); // For post, staff, style
add_action( 'manage_pages_custom_column', 'add_column', 10, 2 ); // For page

/**
 * Enable sorting of the ID column
 */
function custom_quick_edit_sortable_columns( $sortable_columns ) {
	$sortable_columns['post_id'] = 'ID';
	return $sortable_columns;
}
add_filter( 'manage_edit-post_sortable_columns', 'custom_quick_edit_sortable_columns' ); // For post
add_filter( 'manage_edit-page_sortable_columns', 'custom_quick_edit_sortable_columns' ); // For page
add_filter( 'manage_edit-staff_sortable_columns', 'custom_quick_edit_sortable_columns' ); // For staff
add_filter( 'manage_edit-style_sortable_columns', 'custom_quick_edit_sortable_columns' ); // For style

// カスタムタクソノミを表示 (styleのみ)
// add_filter('manage_edit-style_columns', 'posts_columns_taxonomy', 5);
// add_action('manage_posts_custom_column', 'posts_custom_taxonomy_columns', 5, 2);
function posts_columns_taxonomy($defaults){
    $options = get_desing_plus_option();
    for ($i=1; $i <= 6 ; $i++):
      if(!empty($options['style_taxonomy'.$i])){
        $defaults['style_taxonomy'.$i] = $options['style_taxonomy_label'.$i];
      };
    endfor;
    return $defaults;
}
function posts_custom_taxonomy_columns($column_name, $id){
  $options = get_design_plus_option();
  switch ($column_name) {
    case 'style_taxonomy1':
      echo get_the_term_list( $post->ID,$options['style_taxonomy1'],'', ', ' );
      break;
    case 'style_taxonomy2':
      echo get_the_term_list( $post->ID,$options['style_taxonomy2'],'', ', ' );
      break;
    case 'style_taxonomy3':
      echo get_the_term_list( $post->ID,$options['style_taxonomy3'],'', ', ' );
      break;
    case 'style_taxonomy4':
      echo get_the_term_list( $post->ID,$options['style_taxonomy4'],'', ', ' );
      break;
    case 'style_taxonomy5':
      echo get_the_term_list( $post->ID,$options['style_taxonomy5'],'', ', ' );
      break;
    case 'style_taxonomy6':
      echo get_the_term_list( $post->ID,$options['style_taxonomy6'],'', ', ' );
      break;
  }
}
