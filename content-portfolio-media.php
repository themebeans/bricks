<?php
/**
 * The file is for displaying the single portfolio media
 * It is called via single-portfolio.php
 *
 * @package     Bricks
 * @link        https://themebeans.com/themes/bricks
 */

$portfolio_type_gallery = get_post_meta( $post->ID, '_bean_portfolio_type_gallery', true );
$portfolio_type_audio   = get_post_meta( $post->ID, '_bean_portfolio_type_audio', true );
$portfolio_type_video   = get_post_meta( $post->ID, '_bean_portfolio_type_video', true );
$gallery_layout         = get_post_meta( $post->ID, '_bean_gallery_layout', true );
$orderby                = get_post_meta( $post->ID, '_bean_portfolio_randomize', true );
$orderby                = ( $orderby == 'off' ) ? 'post__in' : 'rand';
$audio_mp3              = get_post_meta( $post->ID, '_bean_audio_mp3', true );
$embed                  = get_post_meta( $post->ID, '_bean_portfolio_embed_code', true );
$embed2                 = get_post_meta( $post->ID, '_bean_portfolio_embed_code_2', true );
$embed3                 = get_post_meta( $post->ID, '_bean_portfolio_embed_code_3', true );
$embed4                 = get_post_meta( $post->ID, '_bean_portfolio_embed_code_4', true );


if ( ! post_password_required() ) {

	if ( $portfolio_type_audio == 'on' ) {
		if ( $audio_mp3 ) {

			bean_audio( $post->ID );

		}
	}

	if ( $portfolio_type_gallery == 'on' ) {
		bean_gallery( $post->ID, 'port-full', $gallery_layout, $orderby, true );
	}

	if ( $portfolio_type_video == 'on' ) {
		if ( $embed ) {
			echo '<div class="video-frame">';
				echo stripslashes( htmlspecialchars_decode( $embed ) );
			echo '</div>';

		} //END if($embed)

		if ( $embed2 ) {
			echo '<div class="video-frame">';
				echo stripslashes( htmlspecialchars_decode( $embed2 ) );
			echo '</div>';

		} //END if($embed2)

		if ( $embed3 ) {
			echo '<div class="video-frame">';
				echo stripslashes( htmlspecialchars_decode( $embed3 ) );
			echo '</div>';

		} //END if($embed3)

		if ( $embed4 ) {
			echo '<div class="video-frame">';
				echo stripslashes( htmlspecialchars_decode( $embed4 ) );
			echo '</div>';

		}
	}
}
