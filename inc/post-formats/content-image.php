<?php
/**
 * The template for displaying posts in the Image post format.
 *
 * @package     Bricks
 * @link        https://themebeans.com/themes/bricks
 */

$orderby = get_post_meta( $post->ID, '_bean_post_randomize', true );
$orderby = ( $orderby == 'off' ) ? 'post__in' : 'rand';
?>

<div class="entry-media">

<?php if ( ( function_exists( 'has_post_thumbnail' ) ) && ( has_post_thumbnail() ) ) { ?>

	<?php bean_gallery( $post->ID, '', 'post-lightbox', $orderby, true ); ?>

<?php
} else {
	if ( is_user_logged_in() ) {
	?>
		<div class="notice"><?php esc_html_e( 'Please upload a featured image for this lightbox post', 'bricks' ); ?></div>
	<?php
	}
}
?>

</div><!-- END .entry-media -->
