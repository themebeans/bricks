<?php
/**
 * The template for displaying posts in the Video post format.
 *
 * @package     Bricks
 * @link        https://themebeans.com/themes/bricks
 */

$embed           = get_post_meta( $post->ID, '_bean_video_embed', true );
$video_embed_url = get_post_meta( $post->ID, '_bean_video_embed_url', true );
$feat_image      = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
?>

<div class="entry-media">

	<?php
	if ( $video_embed_url ) {
		if ( ( function_exists( 'has_post_thumbnail' ) ) && ( has_post_thumbnail() ) ) {
			echo '<a class="lightbox fancybox.iframe" href="' . esc_url( $video_embed_url ) . '">';
				echo '<span class="lightbox-play"></span>';
				echo '<img src=' . $feat_image . '>';
			echo '</a>';
		} else {
			if ( is_user_logged_in() ) {
			?>
				<div class="notice"><?php esc_html_e( 'Please upload a featured image for this lightbox post', 'bricks' ); ?></div>
			<?php
			}
		}
	} else {
		if ( $embed ) {
			echo stripslashes( htmlspecialchars_decode( $embed ) );
		}
	}
	?>

</div><!-- END .entry-media -->
