<div class="l-secondary">
<?php
$sidebar = '';

if ( is_front_page() ) {
  $sidebar = 'front_widget';
} elseif ( is_post_type_archive( 'news' ) || is_singular( 'news' ) ) {
  $sidebar = 'news_widget';
} elseif ( is_post_type_archive( 'staff' ) || is_singular( 'staff' ) ) {
  $sidebar = 'staff_widget';
} elseif ( is_post_type_archive( 'style' ) || is_singular( 'style' ) ) {
  $sidebar = 'style_widget';
} elseif ( is_page() ) {
  $sidebar = 'page_widget';
} else {
  $sidebar = 'blog_widget';
}

if ( is_mobile() ) {
  $sidebar .= '_sp';
}

if ( is_active_sidebar( $sidebar ) ) {
  dynamic_sidebar( $sidebar );
} elseif ( is_active_sidebar( 'common_widget' ) ) {
  dynamic_sidebar( 'common_widget' );
}
?>
    </div>	
    
