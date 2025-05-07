<?php
$options = get_design_plus_option();
$blog_slider_args = array(
  'post_status' => 'publish',
  'post_type' => 'post',
  'orderby' => 'rand'
);
if ( 'recent_post' !== $options['footer_blog_slider_type'] ) {
  $blog_slider_args['meta_key'] = $options['footer_blog_slider_type'];
  $blog_slider_args['meta_value'] = 'on';
}
$the_query = new WP_Query( $blog_slider_args );
$footer_nav_args = array(
  'fallback_cb' => '', // Hide the menu area if the footer menu is not registered
  'menu_class' => 'p-footer-nav',
  'items_wrap' => '<ul class="%2$s">%3$s</ul>',
  'theme_location' => 'footer'
);
?>
<footer class="l-footer">
  <?php if ( $the_query->have_posts() ) : ?>
  <div class="p-blog-slider">
    <div id="js-blog-slider__inner" class="p-blog-slider__inner l-inner">
      <?php
      while ( $the_query->have_posts() ) : 
         $the_query->the_post();
      ?>
      <article class="p-article03 p-blog-slider__item">
        <a href="<?php the_permalink(); ?>" class="p-article03__img p-hover-effect--<?php echo esc_attr( $options['hover_type'] ); ?>">
          <?php
          if ( has_post_thumbnail() ) {
            the_post_thumbnail( 'size2' );
          } else {
            echo '<img src="' . get_template_directory_uri() . '/assets/images/no-image-300x300.gif" alt="">' . "\n";
          }
          ?>
        </a>
        <h2 class="p-article03__title">
          <a href="<?php the_permalink(); ?>"><?php echo is_mobile() ? wp_trim_words( get_the_title(), 25, '...' ) : wp_trim_words( get_the_title(), 30, '...' ); ?></a>
        </h2>
      </article>
      <?php
      endwhile;
      wp_reset_postdata();
      ?>
    </div>
  </div>
  <?php endif; ?>
  <?php wp_nav_menu( $footer_nav_args ); ?>
  <div class="l-footer__info">
    <div class="l-footer__info-inner l-inner">
      <div class="l-footer__logo c-logo<?php if ( $options['footer_logo_image_retina'] ) { echo ' c-logo--retina'; } ?>">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
          <?php
          if ( 'type1' === $options['footer_use_logo_image'] ) {
            bloginfo( 'name' );
          } else {
            echo '<img src="' . esc_attr( wp_get_attachment_url( $options['footer_logo_image'] ) ) . '" alt="' . get_bloginfo( 'name' ) . '">' . "\n";
          }
          ?>
        </a>
      </div>
      <p class="l-footer__address p-address"><?php echo nl2br( esc_html( $options['footer_company_address'] ) ); ?></p>
			<ul class="p-social-nav">
        <?php if ( $options['show_rss'] ) : ?>
			  <li class="p-social-nav__item p-social-nav__item--rss">
				  <a href="<?php bloginfo( 'rss2_url' ); ?>" target="_blank"></a>
			  </li>
        <?php endif; ?>
        <?php if ( $options['twitter_url'] ) : ?>
			  <li class="p-social-nav__item p-social-nav__item--twitter">
				  <a href="<?php echo esc_url( $options['twitter_url'] ); ?>" target="_blank"></a>
			  </li>
        <?php endif; ?>
        <?php if ( $options['facebook_url'] ) : ?>
			  <li class="p-social-nav__item p-social-nav__item--facebook">
				  <a href="<?php echo esc_url( $options['facebook_url'] ); ?>" target="_blank"></a>
			  </li>
        <?php endif; ?>
        <?php if ( $options['insta_url'] ) : ?>
        <li class="p-social-nav__item p-social-nav__item--instagram">
				  <a href="<?php echo esc_url( $options['insta_url'] ); ?>" target="_blank"></a>
			  </li>
        <?php endif; ?>
		  </ul>
      <?php if ( wp_is_mobile() ) : ?>
      <div class="l-footer__contact">
        <?php get_template_part( 'template-parts/contact-info' ); ?>
      </div>
      <?php endif; ?>
    </div>
  </div>
  <p class="p-copyright">
    <small>Copyright &copy; <?php bloginfo( 'name' ); ?> All Rights Reserved.</small>
  </p>
  <div id="js-pagetop" class="p-pagetop"><a href="#"></a></div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
