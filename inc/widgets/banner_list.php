<?php

class tcdw_banner_list_widget extends WP_Widget {

  private $banner_count = 10;

  function __construct() {
    parent::__construct(
      'tcdw_banner_list_widget',// ID
      __( 'Banner list (tcd ver)', 'tcd-w' ),
      array(
        'classname' => 'tcdw_banner_list_widget',
        'description' => __('Displays banner list.', 'tcd-w')
      )
    );
  }

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {

    $options = get_design_plus_option();
    $title = apply_filters( 'widget_title', $instance['title'] );
    $output = '';
    $cnt = 0;

    for ( $i = 1; $i <= $this->banner_count; $i++ ) {
      if ( ! empty( $instance['banner_image' . $i] ) ) {
        $banner_title = trim( $instance['banner_title' . $i] );
        $banner_sub = trim( $instance['banner_sub' . $i] );
        $banner_color = $instance['banner_color' . $i];
        $banner_url = $instance['banner_url' . $i];
        $banner_target_blank = $instance['banner_target_blank' . $i];
        $banner_image = wp_get_attachment_url( $instance['banner_image' . $i] );

        if ( ! empty( $banner_image ) ) {
          
          $output .= '<li class="p-banner-list__item">';
          $output .= '<a href="' . esc_url( $banner_url ) . '" class="p-hover-effect--' . esc_attr( $options['hover_type'] ) . '"';
          if ( $banner_target_blank ) {
            $output .= ' target="_blank"';
          }
          $output .= '>';
          $output .= '<img src="' . esc_attr( $banner_image ) . '" alt="">';
          $output .= '<h3 class="p-banner-list__item-catch" style="color: ' . esc_attr( $banner_color ) . ';">' . esc_html( $banner_title );
          if ( $banner_sub ) {
            $output .= '<span class="p-banner-list__item-sub">' . esc_html( $banner_sub ) . '</span>';
          }
          $output .= '</h3></a></li>' . "\n";
        }
      }
    }

   	echo $args['before_widget'];

		if ( $title ) { 
			echo $args['before_title'] . $title . $args['after_title']; 
		}

    if ( ! $output ) return;

    echo "\n".'<ul class="p-banner-list">'."\n".$output.'</ul>'."\n";

		echo $args['after_widget'];

  }


  // Widget Control Panel //
  function form($instance) {
    $defaults = array( 'title' => '' );
    for($i = 1; $i <= $this->banner_count; $i++) {
      $defaults['banner_title'.$i] = '';
      $defaults['banner_sub'.$i] = '';
      $defaults['banner_color'.$i] = '#000000';
      $defaults['banner_url'.$i] = '';
      $defaults['banner_image'.$i] = '';
      $defaults['banner_target_blank'.$i] = 0;
    }
    $instance = wp_parse_args( (array) $instance, $defaults );
?>
  <p>
   <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'tcd-w'); ?></label>
   <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" class="widefat" />
  </p>
  <?php for ( $i = 1; $i <= $this->banner_count; $i++ ) : ?>
  <div class="a-widget-box">
    <h4 class="a-widget-box__headline"><?php _e( 'Banner','tcd-w' ); ?><?php echo $i; ?></h4>
    <div class="a-widget-box__content">
      <h5 class="a-widget-box__sub-headline">
        <label for="<?php echo $this->get_field_id( 'banner_title' . $i ); ?>"><?php _e( 'Banner title:', 'tcd-w' ); ?></label>
      </h5>
      <p><input type="text" id="<?php echo $this->get_field_id( 'banner_title' . $i ); ?>" name="<?php echo $this->get_field_name( 'banner_title' . $i ); ?>" value="<?php echo $instance['banner_title' . $i]; ?>" class="widefat"></p>
      <h5 class="a-widget-box__sub-headline">
        <label for="<?php echo $this->get_field_id( 'banner_sub' . $i ); ?>"><?php _e( 'Banner sub title:', 'tcd-w' ); ?></label>
      </h5>
      <p><input type="text" id="<?php echo $this->get_field_id( 'banner_sub' . $i ); ?>" name="<?php echo $this->get_field_name( 'banner_sub' . $i ); ?>" value="<?php echo $instance['banner_sub' . $i]; ?>" class="widefat"></p>
      <h5 class="a-widget-box__sub-headline">
        <label for="<?php echo $this->get_field_id( 'banner_color' . $i ); ?>"><?php _e( 'Banner font color:', 'tcd-w' ); ?></label>
      </h5>
      <p><input type="text" id="<?php echo $this->get_field_id( 'banner_color' . $i ); ?>" name="<?php echo $this->get_field_name( 'banner_color' . $i ); ?>" value="<?php echo esc_html( $instance['banner_color' . $i] ); ?>" class="w-color-picker" data-default-color="#000000"></p>
      <h5 class="a-widget-box__sub-headline">
        <label for="<?php echo $this->get_field_id( 'banner_url' . $i ); ?>"><?php _e( 'Banner url:', 'tcd-w' ); ?></label>
      </h5>
      <p><input type="text" id="<?php echo $this->get_field_id( 'banner_url' . $i ); ?>" name="<?php echo $this->get_field_name( 'banner_url' . $i ); ?>" value="<?php echo $instance['banner_url' . $i]; ?>" class="widefat"></p>
      <input type="hidden" name="<?php echo $this->get_field_name( 'banner_target_blank' . $i ); ?>" value="0">
      <p><label><input id="<?php echo $this->get_field_id( 'banner_target_blank' . $i ); ?>" name="<?php echo $this->get_field_name( 'banner_target_blank' . $i ); ?>" type="checkbox" value="1" <?php checked( '1', $instance['banner_target_blank' . $i] ); ?>> <?php _e( 'Open link in new window', 'tcd-w' ); ?></label></p>
      <h5 class="a-widget-box__sub-headline">
        <label for="<?php echo $this->get_field_id( 'banner_image' . $i ); ?>"><?php _e( 'Banner image:', 'tcd-w' ); ?></label>
      </h5>
      <div class="a-widget-box__upload cf cf_media_field hide-if-no-js <?php echo $this->get_field_id( 'banner_image' . $i ); ?>">
        <input type="hidden" value="<?php echo $instance['banner_image' . $i]; ?>" id="<?php echo $this->get_field_id( 'banner_image' . $i ); ?>" name="<?php echo $this->get_field_name( 'banner_image' . $i ); ?>" class="cf_media_id">
        <div class="preview_field"><?php if ( $instance['banner_image' . $i] ) { echo wp_get_attachment_image( $instance['banner_image' . $i], 'medium' ); } ?></div>
        <div class="button_area">
          <input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
          <input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $instance['banner_image' . $i] ) { echo 'hidden'; } ?>">
        </div>
      </div>
      <p class="description"><?php _e( 'Recommend image size. Width:600px, Height:280px', 'tcd-w' ); ?></p>
    </div>
  </div>
  <?php endfor; ?>
<?php
  }

  // Update Settings //
  function update($new_instance, $old_instance) {

    $new_instance['title'] = strip_tags( $new_instance['title'] );

    for($i = 1; $i <= $this->banner_count; $i++) {
      $new_instance['banner_title' . $i] = strip_tags( $new_instance['banner_title' . $i] );
      $new_instance['banner_sub' . $i] = strip_tags( $new_instance['banner_sub' . $i] );
      $new_instance['banner_color' . $i] = strip_tags( $new_instance['banner_color' . $i] );
      $new_instance['banner_url' . $i] = strip_tags( $new_instance['banner_url' . $i] );
      if ( ! isset( $new_instance['banner_target_blank' . $i] ) ) $new_instance['banner_target_blank' . $i] = null;
      $new_instance['banner_target_blank' . $i] = '1' === $new_instance['banner_target_blank' . $i] ? '1' : null; 
      $new_instance['banner_image' . $i] = strip_tags( $new_instance['banner_image' . $i] );
    }
    return $new_instance;
  }
}

// register tcdw_banner_list_widget widget
function register_tcdw_banner_list_widget() {
	register_widget( 'tcdw_banner_list_widget' );
}
add_action( 'widgets_init', 'register_tcdw_banner_list_widget' );

