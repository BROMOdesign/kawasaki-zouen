<?php
$options = get_design_plus_option();

if (is_mobile()) {
  $header_fix = $options['mobile_header_fix'];
  $is_retina = $options['sp_header_logo_image_retina'];
  $use_logo_image = $options['sp_header_use_logo_image'];
  $logo_image = $options['sp_header_logo_image'] ? wp_get_attachment_image_src($options['sp_header_logo_image'], 'full') : '';
} else {
  $header_fix = $options['header_fix'];
  $is_retina = $options['header_logo_image_retina'];
  $use_logo_image = $options['header_use_logo_image'];
  $logo_image = $options['header_logo_image'] ? wp_get_attachment_image_src($options['header_logo_image'], 'full') : '';
}
$logo_tag = is_front_page() ? 'h1' : 'div';

$args = array(
  'container' => 'nav',
  'container_id' => 'js-global-nav',
  'container_class' => 'p-global-nav',
  'menu_class' => 'p-global-nav__inner',
  'items_wrap' => '<ul class="%2$s">%3$s</ul>',
  'link_after' => '<span class="sub-menu-toggle"></span>',
  'theme_location' => 'global'
);
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="description" content="<?php seo_description(); ?>">
  <meta name="viewport" content="width=device-width">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=chat_bubble" />
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <?php do_action('tcd_before_header', $options); ?>
  <header id="js-header" class="l-header<?php if ('type2' === $header_fix) {
                                          echo ' l-header--fixed';
                                        } ?>">
    <div class="l-header__inner l-inner">
      <<?php echo $logo_tag; ?> class="l-header__logo c-logo">
        <a href="<?php echo esc_url(home_url('/')); ?>">
          <?php
          if ('type1' === $use_logo_image) {
            bloginfo('name');
          } else {
            if ($is_retina) {
              echo '<img src="' . esc_attr($logo_image[0]) . '" alt="' . get_bloginfo('name') . '" width="' . esc_attr($logo_image[1] / 2) . '" height="' . esc_attr($logo_image[2] / 2) . '">' . "\n";
            } else {
              echo '<img src="' . esc_attr($logo_image[0]) . '" alt="' . get_bloginfo('name') . '">' . "\n";
            }
          }
          ?>
        </a>
      </<?php echo $logo_tag; ?>>
      <p class="l-header__desc"><?php bloginfo('description'); ?></p>
      <?php if (! wp_is_mobile()) : ?>
        <div class="l-header__contact">
          <?php get_template_part('template-parts/contact-info'); ?>
             
        </div>
        <a href="https://lin.ee/Wk2oMn8" class="l-header__custom-link">
          <span class="material-symbols-outlined">
            chat_bubble
          </span>
          LINE
        </a>
           <?php endif; ?>

    </div>
    <a href="#" id="js-menu-btn" class="p-menu-btn c-menu-btn"></a>
    <?php wp_nav_menu($args); ?>
  </header>
  <main class="l-main">
    <?php if (! is_front_page()) : ?>
      <?php get_template_part('template-parts/breadcrumb'); ?>
      <?php get_template_part('template-parts/page-header'); ?>
      <div class="l-main__inner l-inner">
        <?php get_template_part('template-parts/breadcrumb'); ?>
        <div class="l-contents<?php if ($options['left_sidebar']) {
                                echo ' l-contents--rev';
                              } ?>">
          <div class="l-primary<?php if (is_page() && 'page-no-side.php' === get_page_template_slug($post->ID)) {
                                  echo ' l-primary--full';
                                } ?>">
          <?php endif; ?>