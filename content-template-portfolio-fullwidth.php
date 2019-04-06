<?php
/**
 * The content for the fullwidth portfolio template.
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

$args = array(
	'post_type'      => 'portfolio',
	'order'          => $order,
	'orderby'        => $orderby,
	'paged'          => $paged,
	'meta_key'       => $meta_key,
	'posts_per_page' => 14,
);

query_posts( $args );
if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();

		// GENERATE TERMS FOR FILTER PORTFOLIO TEMPLATE
		$terms     = get_the_terms( $post->ID, 'portfolio_category' );
		$term_list = null;
		if ( is_array( $terms ) ) {
			foreach ( $terms as $term ) {
				$term_list .= $term->term_id;
				$term_list .= ' '; }
		}

		if ( has_post_thumbnail() ) { ?>

			<article id="post-<?php the_ID(); ?>" class="project <?php echo esc_html( $term_list ); ?>">

				<a title="<?php printf( __( 'Permanent Link to %s', 'bricks' ), get_the_title() ); ?>" href="<?php the_permalink(); ?>">

					<?php $feat_image = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ), 'port-full' ); ?>

					<img src="
					<?php
					echo get_template_directory_uri();
					echo '/assets/images/blank.gif';
?>
" data-src="<?php echo esc_html( $feat_image ); ?>" title="<?php printf( __( 'Permanent Link to %s', 'bricks' ), get_the_title() ); ?>"/>

					<noscript>
						<img src="<?php echo esc_html( $feat_image ); ?>" title="<?php printf( __( 'Permanent Link to %s', 'bricks' ), get_the_title() ); ?>"/>
					</noscript>

					<?php if ( get_theme_mod( 'slide_template_title', true ) == true ) { ?>
					<div class="overlay fadein">
						<h1><?php the_title(); ?></h1>
					</div>
				<?php } //END slide_template_title ?>

				</a>

			</article>

		<?php } //END if ( has_post_thumbnail() ) ?>

	<?php
endwhile;
endif;
