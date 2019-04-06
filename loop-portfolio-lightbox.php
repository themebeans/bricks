<?php
/**
 * The template for displaying the portfolio loop.
 *
 * @package     Bricks
 * @link        https://themebeans.com/themes/bricks
 */

// GENERATE TERMS FOR FILTER PORTFOLIO TEMPLATE
$terms     = get_the_terms( $post->ID, 'portfolio_category' );
$term_list = null;
if ( is_array( $terms ) ) {
	foreach ( $terms as $term ) {
		$term_list .= $term->term_id;
		$term_list .= ' '; }
} ?>

<?php if ( has_post_thumbnail() ) { ?>

	<article id="post-<?php the_ID(); ?>" class="mix project <?php echo esc_html( $term_list ); ?>">

		<?php bean_gallery( $post->ID, '', 'port-grid-lightbox', '', true ); ?>

	</article>

<?php
} //END if ( has_post_thumbnail )
