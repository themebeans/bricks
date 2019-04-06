<?php
/**
 * The content for the fullscreen slider portfolio template.
 *
 * @package     Bricks
 * @link        https://themebeans.com/themes/bricks
 */

// PULL PAGINATION FROM CUSTOMIZATION
$portfolio_posts_count = get_theme_mod( 'portfolio_posts_count' );

// PULL PAGINATION FROM READING SETTINGS
$paged = 1;
if ( get_query_var( 'paged' ) ) {
	$paged = get_query_var( 'paged' );
}
if ( get_query_var( 'page' ) ) {
	$paged = get_query_var( 'page' );
}

// GET THE LOOP ORDERBY & META_KAY VARIABLES VIA THEME CUSTOMIZER
$orderby = get_theme_mod( 'portfolio_loop_orderby' );

// LOOP ORDERBY VARIABLE
if ( $orderby != '' ) {
	switch ( $orderby ) {
		case 'date':
			$order    = 'DSC';
			$orderby  = 'date';
			$meta_key = '';
			break;
		case 'rand':
			$order    = 'DSC';
			$orderby  = 'rand';
			$meta_key = '';
			break;
		case 'menu_order':
			$order    = 'ASC';
			$orderby  = 'menu_order';
			$meta_key = '';
			break;
		case 'view_count':
			$order    = 'DSC';
			$orderby  = 'meta_value_num';
			$meta_key = 'post_views_count';
			break;
	}
}
?>

<div id="slider-<?php echo esc_attr( $post->ID ); ?>" class="home-slider">

	<script type="text/javascript">
		jQuery(document).ready(function($){
			$('#slider-<?php echo esc_js( $post->ID ); ?>').superslides({
				animation: 'slide',
				pagination: true,
				play: 3000,
			});

			$('#slider-<?php echo esc_js( $post->ID ); ?>').on('animated.slides', function () {
				BackgroundCheck.refresh();
			});
		});
	</script>

	<ul class="slides-container">

		<?php
		$args = array(
			'post_type'           => 'portfolio',
			'order'               => $order,
			'orderby'             => $orderby,
			'paged'               => $paged,
			'meta_key'            => $meta_key,
			'posts_per_page'      => '15',
			'ignore_sticky_posts' => true,
		);

			$wp_query = new WP_Query( $args );
			?>

			<?php
			if ( $wp_query->have_posts() ) :
				while ( $wp_query->have_posts() ) :
					$wp_query->the_post();
?>

								<li>
									<?php the_post_thumbnail( 'port-full' ); ?>

									<?php if ( get_theme_mod( 'slide_template_title' ) == true ) { ?>
						<div class="overlay fadein">
							<a title="<?php printf( __( 'Permanent Link to %s', 'bricks' ), get_the_title() ); ?>" href="<?php the_permalink(); ?>">
								<h1><?php the_title(); ?></h1>
							</a>
						</div>
					<?php } //END slide_template_title ?>
								</li>

							<?php
			endwhile;
endif;
?>

	</ul><!-- END .slides-container -->

</div><!-- END .home-slider -->

<ul class="home-slider home-slider-mobile fadein">

	<?php
	if ( $wp_query->have_posts() ) :
		while ( $wp_query->have_posts() ) :
			$wp_query->the_post();
?>

				<li>
					<a title="<?php printf( __( 'Permanent Link to %s', 'bricks' ), get_the_title() ); ?>" href="<?php the_permalink(); ?>">

						<?php the_post_thumbnail( 'port-full' ); ?>

						<?php if ( get_theme_mod( 'slide_template_title' ) == true ) { ?>
					<div class="overlay">
						<h1><?php the_title(); ?></h1>
					</div>
				<?php } //END slide_template_title ?>

					</a>
				</li>

			<?php
	endwhile;
endif;
?>

</ul><!-- END .home-slider-mobile -->
