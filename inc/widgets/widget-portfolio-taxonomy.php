<?php
/**
 * Widget Name: Bean Portfolio Taxonomy
 *
 * @package     Bricks
 * @link        https://themebeans.com/themes/bricks
 */

// Register widget.
add_action(
	'widgets_init', function() {
		return register_widget( 'Bean_Portfolio_Taxonomy_Widget' );
	}
);

class Bean_Portfolio_Taxonomy_Widget extends WP_Widget {
	// Constructor
	function __construct() {
		parent::__construct(
			'bean_portfolio_tax', // Base ID
			__( 'Portfolio Taxonomy', 'bricks' ), // Name
			array( 'description' => __( 'A cloud of portfolio tags or categories.', 'bricks' ) ) // Args
		);
	}

	// Display widget
	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters( 'widget_title', $instance['title'] );
		$tax   = $instance['tax'];

		// Before widget
		echo $before_widget;

		if ( $title ) {
			echo balanceTags( $before_title ) . esc_html( $title ) . balanceTags( $after_title );
		}

		// Variable
		if ( $tax != '' ) {
			switch ( $tax ) {
				case 'Portfolio Tags':
					$tax_term = 'portfolio_tag';
					break;
				case 'Portfolio Categories':
					$tax_term = 'portfolio_category';
					break;
			}
		}

		$taxonomy = $tax_term;
		$terms    = get_terms( $taxonomy );

		if ( $terms && ! is_wp_error( $terms ) ) :
		?>
			<div class="tagcloud">
				<?php foreach ( $terms as $term ) { ?>
					<a href="<?php echo get_term_link( $term->slug, $taxonomy ); ?>"><?php echo $term->name; ?></a>
				<?php } ?>
			</div>
		<?php
		endif;
		wp_reset_query();

		// After widget
		echo $after_widget;
	}

	// Update widget
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		// Strip tags
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['tax']   = $new_instance['tax'];

		return $instance;
	}

	// Display widget form
	function form( $instance ) {
		$defaults = array(
			'title' => 'Skills',
			'tax'   => 'Portfolio Categories',
		);

		$instance = wp_parse_args( (array) $instance, $defaults );
		?>

		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'bricks' ); ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'tax' ); ?>"><?php esc_html_e( 'Taxonomy:', 'bricks' ); ?></label>
		<select id="<?php echo $this->get_field_id( 'tax' ); ?>" name="<?php echo $this->get_field_name( 'tax' ); ?>" class="widefat">
			<option
			<?php
			if ( 'Portfolio Tags' == $instance['tax'] ) {
				echo 'selected="selected"';}
?>
>Portfolio Tags</option>
			<option
			<?php
			if ( 'Portfolio Categories' == $instance['tax'] ) {
				echo 'selected="selected"';}
?>
>Portfolio Categories</option>
		</select>
		</p>

	<?php
	} // END form
} // END class
