<?php
$options = get_design_plus_option();
if ( 'type1' === $options['header_content_type'] ) :
?>
  <div id="js-header-slider" class="p-header-slider">
    <?php
    for ( $i = 1; $i <= 5; $i++ ) : 
      if ( ! $image = $options['header_slider_img' . $i] ) continue;

      $image = is_mobile() && $options['header_slider_img_sp' . $i] ? $options['header_slider_img_sp' . $i] : $image;
      $catch = $options['header_slider_catch' . $i];
      $label = $options['header_slider_btn_label' . $i];
      $url = $options['header_slider_btn_url' . $i];
      $target = $options['header_slider_btn_target' . $i];
    ?>
    <div class="p-header-slider__item p-header-slider__item<?php echo $i; ?>" style="background-image: url(<?php echo esc_attr( wp_get_attachment_url( $image ) ); ?>);">
      <div class="p-header-slider__item-inner">
        <?php if ( $catch ) : ?>
        <h2 class="p-header-slider__item-title"><?php echo esc_html( $catch ); ?></h2>
        <?php endif; ?>
        <?php if ( $label ) : ?>
        <a class="p-header-slider__item-btn p-btn" href="<?php echo esc_url( $url ); ?>"<?php if ( $target ) { echo ' target="_blank"'; } ?>><?php echo esc_html( $label ); ?></a>
        <?php endif; ?>
      </div>
    </div>
    <?php endfor; ?>
  </div>
<?php
elseif ( 'type2' === $options['header_content_type'] ) : // Video
?>
  <?php if ( wp_is_mobile() ) : ?>
  <div id="js-header-video" class="p-header-video__img" style="background-image: url(<?php echo esc_attr( wp_get_attachment_url( $options['header_video_img'] ) ); ?>">
  <?php else : ?>
  <div id="js-header-video" class="p-header-video">
    <video autoplay loop muted>
      <source src="<?php echo esc_attr( wp_get_attachment_url( $options['header_video'] ) ); ?>">
    </video>
  <?php endif; ?>
    <div class="p-header-video__inner">
      <?php if ( $options['header_video_catch'] ) : ?>
      <h2 class="p-header-video__title"><?php echo esc_html( $options['header_video_catch'] ); ?></h2>
      <?php endif; ?>
      <?php if ( $options['header_video_btn_label'] ) : ?>
      <a class="p-header-video__btn p-btn" href="<?php echo esc_url( $options['header_video_btn_url'] ); ?>"<?php if ( $options['header_video_btn_target'] ) { echo ' target="_blank"'; } ?>><?php echo esc_html( $options['header_video_btn_label'] ); ?></a>
      <?php endif; ?>
    </div>
  </div>
<?php
else : // YouTube
?>
  <?php if ( wp_is_mobile() ) : ?>
  <div id="js-header-youtube" class="p-header-youtube__img" style="background-image: url(<?php echo esc_attr( wp_get_attachment_url( $options['header_youtube_img'] ) ); ?>">
  <?php else : ?>
  <div id="js-header-youtube" class="p-header-youtube">
    <div id="js-header-youtube__player" class="p-header-youtube__player" data-property="{videoURL:'<?php echo esc_html( $options['header_youtube_url'] ); ?>',containment:'#js-header-youtube',startAt:0,mute:true,autoPlay:true,loop:false,opacity:1,showControls:false}">
    </div>
  <?php endif; ?>
    <div class="p-header-youtube__inner">
      <?php if ( $options['header_youtube_catch'] ) : ?>
      <h2 class="p-header-youtube__title"><?php echo esc_html( $options['header_youtube_catch'] ); ?></h2>
      <?php endif; ?>
      <?php if ( $options['header_youtube_btn_label'] ) : ?>
      <a class="p-header-youtube__btn p-btn" href="<?php echo esc_url( $options['header_youtube_btn_url'] ); ?>"<?php if ( $options['header_youtube_btn_target'] ) { echo ' target="_blank"'; } ?>><?php echo esc_html( $options['header_youtube_btn_label'] ); ?></a>
      <?php endif; ?>
    </div>
  </div>
<?php
endif;

