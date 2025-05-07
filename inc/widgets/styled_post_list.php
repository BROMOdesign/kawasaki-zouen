<?php
/**
 * Styled post list (tcd ver)
 */
class Styled_Post_List_Widget extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {

		$widget_ops = array( 
			'classname' => 'styled_post_list_widget', 
			'description' => __( 'Displays styled post list.', 'tcd-w' ) 
		);

		parent::__construct( 
			'styled_post_list1_widget', // ID
			__( 'Styled post list (tcd ver)', 'tcd-w' ), // Name
			$widget_ops 
		);

	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	function widget( $args, $instance ) {

    $options = get_design_plus_option();
		$title = apply_filters( 'widget_title', $instance['title'] );

   	echo $args['before_widget'];

		if ( $title ) { 
			echo $args['before_title'] . $title . $args['after_title']; 
		}

    if ( $instance['display1'] || $instance['display2'] ) :
  ?>
  <div class="p-tab-panel p-widget">
    <ul class="p-tab-panel__tab">
      <?php 
      for ( $i = 1; $i <= 2; $i++ ) : 
        if ( $instance['display' . $i] ) :
      ?>
      <li class="p-tab-panel__tab-item"><a href="#panel<?php echo $i; ?>"><?php echo esc_html( $instance['title' . $i] ); ?></a></li>
      <?php
        endif;
      endfor;
      ?>
    </ul>
    <?php
    for ( $i = 1; $i <= 2; $i++ ) : 

      if ( $instance['display' . $i] ) : 

        $post_order = $instance['post_order' . $i];
		    $post_order = preg_match( '/^date[\d]$/', $post_order ) ? 'date' : $post_order;
		    $order = 'date2' === $instance['post_order' . $i] ? 'ASC' : 'DESC';

        if ( 'recent_post' === $instance['post_type' . $i] ) {
          $blog_args = array(
            'post_type' => 'post',
		        'ignore_sticky_posts' => 1, 
            'posts_per_page' => $instance['post_num' . $i],
			      'orderby' => $post_order, 
			      'order' => $order
          );
        } else {
          $blog_args = array(
            'post_type' => 'post',
		        'ignore_sticky_posts' => 1, 
            'posts_per_page' => $instance['post_num' . $i],
			      'orderby' => $post_order, 
			      'order' => $order,
            'meta_key' => $instance['post_type' . $i],
            'meta_value' => 'on'
          );
        }
        $the_query = new WP_Query( $blog_args );
    ?>
    <div id="panel<?php echo $i; ?>" class="p-tab-panel__panel">
      <?php
        if ( $the_query->have_posts() ) :
          while ( $the_query->have_posts() ) :
            $the_query->the_post();
      ?>
      <article class="p-article02 u-clearfix">
        <a href="<?php the_permalink(); ?>" class="p-article02__img p-hover-effect--<?php echo esc_attr( $options['hover_type'] ); ?>">
          <?php
          if ( has_post_thumbnail() ) {
            the_post_thumbnail( 'size2' ); 
          } else {
            echo '<img src="' . get_template_directory_uri() . '/assets/images/no-image-300x300.gif" alt="">' . "\n";
          }
          ?>
        </a>
        <div class="p-article02__content">
          <h3 class="p-article02__title">
            <a href="<?php the_permalink(); ?>"><?php echo is_mobile() ? wp_trim_words( get_the_title(), 20, '...' ) : wp_trim_words( get_the_title(), 25, '...' ); ?></a>
          </h3>
          <?php if ( $instance['display_date' . $i] ) : ?>
          <time class="p-article02__date" datetime="<?php the_time( 'Y-m-d' ); ?>"><?php the_time( 'Y.m.d' ); ?></time>
          <?php endif; ?>
        </div>
      </article>
      <?php
        endwhile;
        wp_reset_postdata();
      else :
      ?>
      <article class="p-article02 u-clearfix">
        <div class="p-article02__content">
          <p class="p-article02__title p10"><?php _e( 'There is no registered post.', 'tcd-w' ); ?></p>
        </div>
      </article>
      <?php
      endif;
      ?>
    </div>
    <?php
      endif;
    endfor;
    ?>
  </div>
  <?php
  endif; 

  echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */	
  function form( $instance ) {

    $defaults['title'] = '';
    for ( $i = 1; $i <= 2; $i++ ) {
		  $defaults['display' . $i] = 0;
		  $defaults['title' . $i] = '';
		  $defaults['post_type' . $i] = 'recent_post';
		  $defaults['post_order' . $i] = 'date1';
		  $defaults['post_num' . $i] = 3;
		  $defaults['display_date' . $i] = '1';
    }
    $instance = wp_parse_args( $instance, $defaults );
  ?>
  <p>
    <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'tcd-w' ); ?>: </label>
    <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat">
  </p>
  <?php for ( $i = 1; $i <= 2; $i++ ) : ?>
  <div class="a-widget-box">
    <h4 class="a-widget-box__headline"><?php _e( 'Tab','tcd-w' ); ?><?php echo $i; ?></h4>
    <div class="a-widget-box__content">
      <label><input id="<?php echo $this->get_field_id( 'display' . $i ); ?>" name="<?php echo $this->get_field_name( 'display' . $i ); ?>" type="checkbox" value="1" <?php checked( '1', $instance['display' . $i] ); ?>> <?php printf( __( 'Display tab%d', 'tcd-w' ), $i ); ?></label>
      <p>
        <label for="<?php echo $this->get_field_id( 'title' . $i ); ?>"><?php _e( 'Title', 'tcd-w' ); ?>: </label>
        <input type="text" id="<?php echo $this->get_field_id( 'title' . $i ); ?>" name="<?php echo $this->get_field_name( 'title' . $i ); ?>" value="<?php echo $instance['title' . $i]; ?>" class="widefat">
      </p>
      <p>
        <label for="<?php echo $this->get_field_id( 'post_type' . $i ); ?>"><?php _e( 'Post type', 'tcd-w' ); ?>: </label>
        <select id="<?php echo $this->get_field_id( 'post_type' . $i ); ?>" name="<?php echo $this->get_field_name( 'post_type' . $i ); ?>" class="widefat">
  		    <option value="recent_post" <?php selected( 'recent_post', $instance['post_type' . $i] ); ?>><?php _e( 'Recent post', 'tcd-w' ); ?></option>
			    <?php for ( $j = 1; $j <= 3; $j++ ) : ?>
  		    <option value="recommend_post<?php echo $j; ?>" <?php selected( 'recommend_post' . $j, $instance['post_type' . $i] ); ?>><?php echo __( 'Recommend post', 'tcd-w' ) . $j; ?></option>
			    <?php endfor; ?>
        </select>
      </p>
      <p>
        <label for="<?php echo $this->get_field_id( 'post_order' . $i ); ?>"><?php _e( 'Post order', 'tcd-w' ); ?>: </label>
        <select id="<?php echo $this->get_field_id( 'post_order' . $i ); ?>" name="<?php echo $this->get_field_name( 'post_order' . $i ); ?>" class="widefat">
  		    <option value="date1" <?php selected( 'date1', $instance['post_order' . $i]); ?>><?php _e( 'Date (DESC)', 'tcd-w' ); ?></option>
  		    <option value="date2" <?php selected( 'date2', $instance['post_order' . $i]); ?>><?php _e( 'Date (ASC)', 'tcd-w' ); ?></option>
  		    <option value="rand" <?php selected( 'rand', $instance['post_order' . $i]); ?>><?php _e( 'Random', 'tcd-w' ); ?></option>
        </select>
      </p>
      <p><?php _e( 'Number of posts to display', 'tcd-w' ); ?>: <input type="number" min="1" step="1" id="<?php echo $this->get_field_id( 'post_num' . $i ); ?>" name="<?php echo $this->get_field_name( 'post_num' . $i ); ?>" value="<?php echo $instance['post_num' . $i]; ?>" class="tiny-text"></p>
      <p><label><input id="<?php echo $this->get_field_id( 'display_date' . $i ); ?>" name="<?php echo $this->get_field_name( 'display_date' . $i ); ?>" type="checkbox" value="1" <?php checked( '1', $instance['display_date' . $i] ); ?>> <?php _e( 'Display date', 'tcd-w' ); ?></label></p>
    </div>
  </div>
  <?php
    endfor; 
	}
  
	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	function update( $new_instance, $old_instance ) {
    for ( $i = 1; $i <= 2; $i++ ) {
      if ( ! isset( $new_instance['display' . $i] ) ) $new_instance['display' . $i] = null;
      $new_instance['display' . $i] = '1' === $new_instance['display' . $i] ? '1' : null; 
      if ( ! isset( $new_instance['display_date' . $i] ) ) $new_instance['display_date' . $i] = null;
      $new_instance['display_date' . $i] = '1' === $new_instance['display_date' . $i] ? '1' : null; 
      $new_instance['title' . $i] = strip_tags( $new_instance['title' . $i] );
    }
		return $new_instance;
	}
}

/**
 * Register Styled_Post_List_Widget widget
 */
function register_styled_post_list_widget() {
	register_widget( 'Styled_Post_List_Widget' );
}
add_action( 'widgets_init', 'register_styled_post_list_widget' );
