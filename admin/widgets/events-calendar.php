<?php
class SportsPress_Widget_Events_Calendar extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'widget_calendar widget_sp_events_calendar', 'description' => __( 'A calendar of events.', 'sportspress' ) );
		parent::__construct('sp_events_calendar', __( 'SportsPress Events Calendar', 'sportspress' ), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
		$id = empty($instance['id']) ? null : $instance['id'];
		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;
		echo '<div id="calendar_wrap">';
		echo sportspress_events_calendar( $id );
		echo '</div>';
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['id'] = intval($new_instance['id']);

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'id' => null ) );
		$title = strip_tags($instance['title']);
		$id = intval($instance['id']);
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'sportspress' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('id'); ?>"><?php printf( __( 'Select %s:', 'sportspress' ), __( 'Calendar', 'sportspress' ) ); ?></label>
		<?php
		$args = array(
			'post_type' => 'sp_calendar',
			'show_option_all' => __( 'All', 'sportspress' ),
			'name' => $this->get_field_name('id'),
			'id' => $this->get_field_id('id'),
			'selected' => $id,
			'values' => 'ID',
			'class' => 'widefat',
		);
		if ( ! sportspress_dropdown_pages( $args ) ):
			sportspress_post_adder( 'sp_calendar', __( 'Add New', 'sportspress' ) );
		endif;
		?>
		</p>
<?php
	}
}
add_action( 'widgets_init', create_function( '', 'return register_widget( "SportsPress_Widget_Events_Calendar" );' ) );