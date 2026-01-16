<?php
/**
 * Enqueue scripts
 */
function search_style_scripts() {

  if ( is_post_type_archive( 'style' ) ) {
    wp_enqueue_script( 'beauty-style-search', get_template_directory_uri() . '/assets/js/style-search.min.js', array( 'jquery' ), version_num(), true ); 
    wp_localize_script( 'beauty-style-search', 'search', array( 'ajax_loader_path' => get_template_directory_uri() . '/assets/images/ajax-loader.gif', 'ajaxurl' => admin_url( 'admin-ajax.php' ), 'nonce' => wp_create_nonce( 'style-search-nonce' ), 'error_message' => __( 'Error was occurred. Please retry again.', 'tcd-w' ) ) );
  }

}
add_action( 'wp_enqueue_scripts', 'search_style_scripts' );

/**
 * Search style list
 */
function search_style_list() {

	$options = get_design_plus_option();

	// Check nonce
	check_ajax_referer( 'style-search-nonce', 'security' );

	parse_str( $_POST['form_data'], $data );

	// Get style cat term_id array from $data['search_cat' . $i]
	for ( $i = 1; $i <= 6; $i++ ) { 
  	if ( $options['style_search_use_tax' . $i] && isset( $data['search_cat' . $i] ) ) { 
    	${"search_cat$i"} = array_map( 'intval', (array) $data['search_cat' . $i] );
  	} else {
    	${"search_cat$i"} = array();
  	}
	}

	// Get staff id array from $data['search_staff']
	if ( $options['style_search_use_staff'] && isset( $data['search_staff'] ) ) { 
  	$search_staff = array_map( 'intval', (array) $data['search_staff'] );  
	} else {
  	$search_staff = array();
	}	

	$args = array(
  	'post_type' => 'style',
  	'post_status' => 'publish',
  	'posts_per_page' => -1, 
  	'orderby' => array( 'menu_order' => 'ASC', 'date' => 'DESC' ) 
	);

	for ( $i = 1; $i <= 6; $i++ ) {
  	if ( $options['style_cat' . $i] && ${"search_cat$i"} ) {
   	 $args['tax_query'][] = array(
    	  'taxonomy' => sanitize_key( $options['style_cat' . $i] ),
      	'field' => 'term_id',
      	'terms' => ${"search_cat$i"},
      	'compare' => 'IN'
    	);
  	}
	}
	if ( isset( $args['tax_query'] ) ) {
  	$args['tax_query']['relation'] = 'AND';
	}

	if ( $search_staff ) {
  	$args['meta_query'][] = array(
    	'key' => 'staff_id',
    	'value' => $search_staff,
    	'compare' => 'IN'
  	);
	}

	$the_query = new WP_Query( $args );
  

  if ( $the_query->have_posts() ) {

    $output = '<ul class="p-style-list">' . "\n";

    while ( $the_query->have_posts() ) {
      $the_query->the_post();

      // Add style list item
      $output .= '<li class="p-style-list__item">';
      if($options['style_ph_target']){
        $output .= '<a href="' . get_the_permalink( $post->ID ) . '" class="p-style-list__item-img p-hover-effect--' . esc_attr( $options['hover_type'] ) . '" target="_blank">';
      }else{
        $output .= '<a href="' . get_the_permalink( $post->ID ) . '" class="p-style-list__item-img p-hover-effect--' . esc_attr( $options['hover_type'] ) . '">';
      }

      if ( has_post_thumbnail() ) {
        $output .= get_the_post_thumbnail( $post->ID, 'size4' );
      } else {
        $output .= '<img src="' . get_template_directory_uri() . '/assets/images/no-image-370x500.gif" alt="">';
      }

      $output .= '</a></li>' . "\n";
    }
    wp_reset_postdata();

  } else {
    $output .= '<p class="u-center">施工例が見つかりませんでした。</p>' . "\n";
  }

  $output .= '</ul>' . "\n";

  $json_data = array(
    'html' => $output
  );

  $json_data = json_encode( $json_data );

  header('Content-type:application/json;charset=utf-8');
  echo $json_data;

	die();
}
add_action( 'wp_ajax_search_style_list', 'search_style_list' );
add_action( 'wp_ajax_nopriv_search_style_list', 'search_style_list' );
