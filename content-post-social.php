<?php
/**
 * The template for displaying the post sharing.
 *
 * @package     Bricks
 * @link        https://themebeans.com/themes/bricks
 */

$feat_image      = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
$twitter_profile = get_theme_mod( 'twitter_profile' );

if ( ! post_password_required() ) { // START PASSWORD PROTECTED ?>

	<div class="social">
		<strong><?php esc_html_e( 'Share', 'bricks' ); ?><span class="share-icon"></span></strong>
		<a href="http://twitter.com/share?text=<?php the_title_attribute(); ?> <?php
		if ( $twitter_profile != '' ) {
			echo 'via @' . $twitter_profile . ''; }
?>
" target="_blank" class="twitter"><?php esc_html_e( 'Tweet', 'bricks' ); ?></a>
		<a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank" class="facebook even"><?php esc_html_e( 'Share', 'bricks' ); ?></a>
		<a href="http://pinterest.com/pin/create/bookmarklet/?media=<?php echo esc_html( $feat_image ); ?>&url=<?php the_permalink(); ?>&is_video=false&description=<?php the_title_attribute(); ?>" class="pinterest"><?php esc_html_e( 'Pin', 'bricks' ); ?></a>
	</div><!-- END .social -->

<?php
}
