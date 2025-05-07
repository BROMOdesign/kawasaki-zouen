<?php
$options = get_design_plus_option();
$title_tag = is_single() ? 'div' : 'h1';

if ( is_post_type_archive( 'news' ) || is_singular( 'news' ) ) {
  $title = $options['news_ph_title'];
  $title_font_size = $options['news_ph_title_font_size'];
  $title_color = $options['news_ph_title_color'];
  $sub = $options['news_ph_sub'];
  $sub_font_size = $options['news_ph_sub_font_size'];
  $sub_color = $options['news_ph_sub_color'];
  $title_bg = $options['news_ph_title_bg'];
  $desc = $options['news_ph_desc'];
  $desc_color = $options['news_ph_desc_color'];
  $desc_bg = $options['news_ph_desc_bg'];
} elseif ( is_post_type_archive( 'staff' ) || is_singular( 'staff' ) ) {
  $title = $options['staff_ph_title'];
  $title_font_size = $options['staff_ph_title_font_size'];
  $title_color = $options['staff_ph_title_color'];
  $sub = $options['staff_ph_sub'];
  $sub_font_size = $options['staff_ph_sub_font_size'];
  $sub_color = $options['staff_ph_sub_color'];
  $title_bg = $options['staff_ph_title_bg'];
  $desc = $options['staff_ph_desc'];
  $desc_color = $options['staff_ph_desc_color'];
  $desc_bg = $options['staff_ph_desc_bg'];
} elseif ( is_post_type_archive( 'style' ) || is_singular( 'style' ) || is_tax() ) {
  $title = $options['style_ph_title'];
  $title_font_size = $options['style_ph_title_font_size'];
  $title_color = $options['style_ph_title_color'];
  $sub = $options['style_ph_sub'];
  $sub_font_size = $options['style_ph_sub_font_size'];
  $sub_color = $options['style_ph_sub_color'];
  $title_bg = $options['style_ph_title_bg'];
  $desc = $options['style_ph_desc'];
  $desc_color = $options['style_ph_desc_color'];
  $desc_bg = $options['style_ph_desc_bg'];
} elseif ( is_404() ) {
  $title = $options['404_ph_title'];
  $title_font_size = $options['404_ph_title_font_size'];
  $title_color = $options['404_ph_title_color'];
  $sub = $options['404_ph_sub'];
  $sub_font_size = $options['404_ph_sub_font_size'];
  $sub_color = $options['404_ph_sub_color'];
  $title_bg = $options['404_ph_title_bg'];
  $desc = $options['404_ph_desc'];
  $desc_color = $options['404_ph_desc_color'];
  $desc_bg = $options['404_ph_desc_bg'];
} elseif ( is_page() ) {
  $title = $post->ph_title;
  $title_font_size = $post->ph_title_font_size;
  $title_color = $post->ph_title_color;
  $sub = $post->ph_sub;
  $sub_font_size = $post->ph_sub_font_size;
  $sub_color = $post->ph_sub_color;
  $title_bg = $post->ph_title_bg;
  $desc = $post->ph_desc;
  $desc_color = $post->ph_desc_color;
  $desc_bg = $post->ph_desc_bg;
} else {
  $title = $options['ph_title'];
  $title_font_size = $options['ph_title_font_size'];
  $title_color = $options['ph_title_color'];
  $sub = $options['ph_sub'];
  $sub_font_size = $options['ph_sub_font_size'];
  $sub_color = $options['ph_sub_color'];
  $title_bg = $options['ph_title_bg'];
  $desc = $options['ph_desc'];
  $desc_color = $options['ph_desc_color'];
  $desc_bg = $options['ph_desc_bg'];
}
?>
<header class="p-page-header" style="background: <?php echo esc_attr( $desc_bg ); ?>;">
  <div class="p-page-header__inner l-inner">
    <<?php echo $title_tag; ?> class="p-page-header__title" style="background: <?php echo esc_attr( $title_bg ); ?>; color: <?php echo esc_attr( $title_color ); ?>; font-size: <?php echo esc_attr( $title_font_size ); ?>px;"><?php echo esc_html( $title ); ?><span class="p-page-header__sub" style="color: <?php echo esc_attr( $sub_color ); ?>; font-size: <?php echo esc_attr( $sub_font_size ); ?>px;"><?php echo esc_html( $sub ); ?></span></<?php echo $title_tag; ?>>
    <?php if ( $desc ) : ?>
    <p class="p-page-header__desc" style="color: <?php echo esc_attr( $desc_color ); ?>;"><?php echo esc_html( $desc ); ?></p>
    <?php endif; ?>
  </div>
</header>
