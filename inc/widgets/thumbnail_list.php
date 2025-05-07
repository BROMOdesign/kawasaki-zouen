<?php
/**
 * Thumbnail list (tcd ver)
 */
class tcdw_thumbnail_list_widget extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {

		$widget_ops = array( 
      'classname' => 'tcdw_thumbnail_list_widget', 
      'description' => __( 'Display thumbnail list.', 'tcd-w' ) 
		);
		parent::__construct( 
			'tcdw_thumbnail_list_widget', // ID
			__( 'Thumbnail list (tcd ver)', 'tcd-w' ), // Name
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
    $post_order = $instance['post_order'];
    $order = 'date2' === $post_order ? 'ASC' : 'DESC';

    if ( 'date1' === $post_order || 'date2' === $post_order ) { 
      $post_order = 'date'; 
    }

    remove_action('pre_get_posts', 'po_pre_get_posts', 10, 2); //スタイル、スタッフの並び替え機能を無効化
    $post_args = array(
      'post_type' => $instance['post_type'], 
      'posts_per_page' => $instance['post_num'], 
      'orderby' => $post_order, 
      'order' => $order
    );
    $the_query = new WP_Query( $post_args );
    add_action( 'pre_get_posts', 'po_pre_get_posts' ); //スタイル、スタッフの並び替え機能を有効化

   	echo $args['before_widget'];

		if ( $title ) { 
			echo $args['before_title'] . $title . $args['after_title']; 
		}

    if ( $the_query->have_posts() ) :
    ?>
    <ul class="p-thumb-list">
      <?php
      while ( $the_query->have_posts() ) :
        $the_query->the_post();
      ?>
      <li class="p-thumb-list__item">
        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="p-thumb-list__item-img p-hover-effect--<?php echo esc_attr( $options['hover_type'] ); ?>">
          <?php 
          if ( has_post_thumbnail() ) {
            the_post_thumbnail( 'size2' );
          } else {
            echo '<img src="' . get_template_directory_uri() . '/assets/images/no-image-300x300.gif alt="">' . "\n";
          }
          ?>
        </a>
      </li>
      <?php
      endwhile;
      wp_reset_postdata();
      ?>
    </ul>
    <?php else : ?>
    <p><?php _e( 'There is no registered post.', 'tcd-w' ); ?></p>
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

		$defaults = array( 
			'title' => __( 'Thumbnails', 'tcd-w' ), 
			'post_type' => 'post', 
			'post_num' => 6, 
			'post_order' => 'date1', 
		);
		$instance = wp_parse_args( $instance, $defaults );
    ?>
    <p>
      <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'tcd-w' ); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>">
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'post_type' ); ?>"><?php _e( 'Post type:', 'tcd-w' ); ?></label>
      <select id="<?php echo $this->get_field_id( 'post_type' ); ?>" name="<?php echo $this->get_field_name( 'post_type' ); ?>" class="widefat">
        <option value="post" <?php selected( 'post', $instance['post_type'] ); ?>><?php _e( 'Post', 'tcd-w' ); ?></option>
        <option value="staff" <?php selected( 'staff', $instance['post_type'] ); ?>><?php _e( 'Staff', 'tcd-w' ); ?></option>
        <option value="style" <?php selected( 'style', $instance['post_type'] ); ?>><?php _e( 'Style', 'tcd-w' ); ?></option>
      </select>
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'post_num' ); ?>"><?php _e( 'Number of post:', 'tcd-w' ); ?></label>
      <select id="<?php echo $this->get_field_id( 'post_num' ); ?>" name="<?php echo $this->get_field_name( 'post_num' ); ?>" class="widefat">
        <?php for ( $i = 3; $i <= 15; $i+= 3 ) : ?>
        <option value="<?php echo $i; ?>" <?php selected( $i, $instance['post_num'] ); ?>><?php echo $i; ?></option>
        <?php endfor; ?>
      </select>
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'post_order' ); ?>"><?php _e( 'Post order:', 'tcd-w' ); ?></label>
      <select id="<?php echo $this->get_field_id( 'post_order' ); ?>" name="<?php echo $this->get_field_name( 'post_order' ); ?>" class="widefat">
        <option value="date1" <?php selected( 'date1', $instance['post_order'] ); ?>><?php _e( 'Date (DESC)', 'tcd-w' ); ?></option>
        <option value="date2" <?php selected( 'date2', $instance['post_order']); ?>><?php _e( 'Date (ASC)', 'tcd-w'); ?></option>
        <option value="rand" <?php selected( 'rand', $instance['post_order'] ); ?>><?php _e( 'Random', 'tcd-w') ; ?></option>
      </select>
    </p>
    <?php
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
		$instance = array();
  	$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['post_num'] = $new_instance['post_num'];
		$instance['post_type'] = $new_instance['post_type'];
		$instance['post_order'] = $new_instance['post_order'];
  	return $instance;
	}

}

/**
 * Register tcdw_thumbnail_list_widget  widget
 */
function register_tcdw_thumbnail_list_widget() {
	register_widget( 'tcdw_thumbnail_list_widget' );
}
add_action( 'widgets_init', 'register_tcdw_thumbnail_list_widget' );
