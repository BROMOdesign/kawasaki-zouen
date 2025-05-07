<?php
$options = get_design_plus_option();

$news_label = $options['news_breadcrumb'] ? $options['news_breadcrumb'] : __( 'News', 'tcd-w' );
$staff_label = $options['staff_breadcrumb'] ? $options['staff_breadcrumb'] : __( 'Staff', 'tcd-w' );
$style_label = $options['style_breadcrumb'] ? $options['style_breadcrumb'] : __( 'Style', 'tcd-w' );

$breadcrumb_items = array( 
  array( 
    'name' => 'HOME', 
    'url' => get_home_url( null, '/' ) 
  )
);
if ( is_home() ) {
  $breadcrumb_items[] = array( 'name' => __( 'Blog', 'tcd-w' ) );
} elseif ( is_category() ) {
  $breadcrumb_items[] = array( 'name' => single_cat_title( '', false ) );
} elseif ( is_tag() ) {
  $breadcrumb_items[] = array( 'name' => single_tag_title( '', false ) );
} elseif ( is_author() ) {
  $breadcrumb_items[] = array( 'name' => get_the_author() );
} elseif ( is_year() ) {
  $breadcrumb_items[] = array( 'name' => get_the_time( __( 'Y', 'tcd-w' ) ) );
} elseif ( is_month() ) {
  $breadcrumb_items[] = array( 'name' => get_the_time( __( 'F, Y', 'tcd-w' ) ) );
} elseif ( is_day() ) {
  $breadcrumb_items[] = array( 'name' => get_the_time( __( 'F jS, Y', 'tcd-w' ) ) );
} elseif ( is_search() ) {
  $breadcrumb_items[] = array( 'name' => __( 'Search result', 'tcd-w' ) );
} elseif ( is_404() ) {
  $breadcrumb_items[] = array( 'name' => __( 'Sorry, but you are looking for something that isn\'t here.', 'tcd-w' ) );
} elseif ( is_singular( 'post' ) ) {
  $breadcrumb_items[] = array( 'name' => __( 'Blog', 'tcd-w' ), 'url' => get_post_type_archive_link( 'post' ) );
} elseif ( is_post_type_archive( 'news' ) ) {
  $breadcrumb_items[] = array( 'name' => $news_label );
} elseif ( is_singular( 'news' ) ) {
  $breadcrumb_items[] = array( 'name' => $news_label, 'url' => get_post_type_archive_link( 'news' ) );
} elseif ( is_post_type_archive( 'staff' ) ) {
  $breadcrumb_items[] = array( 'name' => $staff_label );
} elseif ( is_singular( 'staff' ) ) {
  $breadcrumb_items[] = array( 'name' => $staff_label, 'url' => get_post_type_archive_link( 'staff' ) );
} elseif ( is_post_type_archive( 'style' ) ) {
  $breadcrumb_items[] = array( 'name' => $style_label );
} elseif ( is_singular( 'style' ) ) {
  $breadcrumb_items[] = array( 'name' => $style_label, 'url' => get_post_type_archive_link( 'style' ) );
} elseif ( is_tax() ) {
  $breadcrumb_items[] = array( 'name' => single_term_title( '', false ) );
}

if ( is_page() || is_single() ) {
  $breadcrumb_items[] = array( 'name' => strip_tags( get_the_title() ) );
}

// Render
echo '<ul class="p-breadcrumb c-breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">' . "\n";
for ( $i = 0, $len = count( $breadcrumb_items ); $i < $len; $i++ ) {

  // Add an a tag
  if ( $len - 1 !== $i ) {

    if ( 0 === $i ) {
      echo '<li class="p-breadcrumb__item c-breadcrumb__item c-breadcrumb__item--home" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">' . "\n";
    } else {
      echo '<li class="p-breadcrumb__item c-breadcrumb__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">' . "\n";
    }
    echo '<a href="' . esc_url( $breadcrumb_items[$i]['url'] ) . '" itemprop="item">' . "\n";
    echo '<span itemprop="name">' . esc_html( $breadcrumb_items[$i]['name'] ) . '</span>' . "\n";
    echo '</a>' . "\n";
    echo '<meta itemprop="position" content="' . ( $i + 1 ) .  '">' . "\n";
    echo '</li>' . "\n";

  } else {
    echo '<li class="p-breadcrumb__item c-breadcrumb__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">' . esc_html( $breadcrumb_items[$i]['name'] ) . '</span><meta itemprop="position" content="' . ( $i + 1 ) .  '"></li>' . "\n";
  }
}
echo '</ul>' . "\n";
