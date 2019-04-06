<?php
/**
 * This file contains the media functions for the theme (Gallery, Audio, Video).
 *
 * @package     Bricks
 * @link        https://themebeans.com/themes/bricks
 */

if ( ! function_exists( 'bean_gallery' ) ) {
	function bean_gallery( $postid, $imagesize = '', $layout = '', $orderby = '', $single = false ) {
		$thumb_ID         = get_post_thumbnail_id( $postid );
		$image_ids_raw    = get_post_meta( $postid, '_bean_image_ids', true );
		$slide_item_count = get_post_meta( $postid, '_bean_slide_item_count', true );
		$slide_autoheight = get_post_meta( $postid, '_bean_slide_autoheight', true );
		$slide_speed      = get_post_meta( $postid, '_bean_slide_speed', true );
		$slide_autoplay   = get_post_meta( $postid, '_bean_slide_autoplay', true );

		if ( $image_ids_raw != '' ) {
			$image_ids   = explode( ',', $image_ids_raw );
			$post_parent = null;
		} else {
			$image_ids   = '';
			$post_parent = $postid;
		}

		// PULL THE IMAGE ATTACHMENTS
		$args        = array(
			'exclude'        => $thumb_ID,
			'include'        => $image_ids,
			'numberposts'    => -1,
			'orderby'        => $orderby,
			'order'          => 'ASC',
			'post_type'      => 'attachment',
			'post_parent'    => $post_parent,
			'post_mime_type' => 'image',
			'post_status'    => null,
		);
		$attachments = get_posts( $args );

		// IF THE FUNCTION'S LAYOUT IS CALLING FOR THE SLIDER
		if ( $layout == 'slider' ) {
			// TRANSFER META FOR TRUE/FALSE SLIDE VALUES
			if ( $slide_item_count == '1' ) {
				$singleItem = 'true';
			} else {
				$singleItem = 'false';
			}

			if ( $slide_autoheight == 'on' ) {
				$slide_autoheight = 'true';
			} else {
				$slide_autoheight = 'false';
			}

			if ( $slide_autoplay == 'on' ) {
				$slide_autoplay = '3500';
			} else {
				$slide_autoplay = 'false';
			}

			if ( ! $slide_speed ) {
				$slide_speed = '500';
			}

			if ( ! $slide_item_count ) {
				$slide_item_count = 'true';
				$singleItem       = 'true';
				$slide_autoheight = 'true';
			}

			?>

			<script type="text/javascript">
				jQuery(document).ready(function($){
					$("#slider-<?php echo esc_js( $postid ); ?>").owlCarousel({
						items: <?php echo esc_js( $slide_item_count ); ?>,
						autoPlay : <?php echo esc_js( $slide_autoplay ); ?>,
						stopOnHover : true,
						navigation:false,
						paginationSpeed : <?php echo esc_js( $slide_speed ); ?>,
						goToFirstSpeed : <?php echo esc_js( $slide_speed ); ?>,
						slideSpeed : <?php echo esc_js( $slide_speed ); ?>,
						singleItem : <?php echo esc_js( $singleItem ); ?>,
						autoHeight : <?php echo esc_js( $slide_autoheight ); ?>,

						<?php if ( $orderby == 'rand' ) { ?>
							beforeInit : function(elem){
								random(elem);
							}
						<?php } ?>
					});

					$("#slider-<?php echo esc_js( $postid ); ?> .owl-item img").click(function(){
						$("#slider-<?php echo esc_js( $postid ); ?>").trigger('owl.next');
					})

					<?php if ( $orderby == 'rand' ) { ?>
					function random(owlSelector){
							owlSelector.children().sort(function(){
							return Math.round(Math.random()) - 0.5;
						}).each(function(){
							$(this).appendTo(owlSelector);
						});
					}
					<?php } ?>
				});
			</script>

			<div id="slider-<?php echo esc_attr( $postid ); ?>" class="post-slider">
					<?php
					if ( ! empty( $attachments ) ) {
						$i = 0;
						foreach ( $attachments as $attachment ) {
							$src     = wp_get_attachment_image_src( $attachment->ID, $imagesize );
							$caption = $attachment->post_excerpt;
							$caption = ( $caption ) ? "<div class='bean-image-caption'>$caption</div>" : '';
							$alt     = ( ! empty( $attachment->post_content ) ) ? $attachment->post_content : $attachment->post_title;
							echo "<div>$caption<img height='$src[2]' src='$src[0]' alt='$alt'/></div>";
						}
					}
					?>
			</div><!-- END .post-slider -->

			<?php if ( is_singular( 'portfolio' ) ) { ?>

				<ul class="home-slider home-slider-mobile fadein">

					<?php
					if ( ! empty( $attachments ) ) {
						$i = 0;
						foreach ( $attachments as $attachment ) {
							$src     = wp_get_attachment_image_src( $attachment->ID, $imagesize );
							$caption = $attachment->post_excerpt;
							$caption = ( $caption ) ? "<div class='bean-image-caption'>$caption</div>" : '';
							$alt     = ( ! empty( $attachment->post_content ) ) ? $attachment->post_content : $attachment->post_title;
							echo "<li><img height='$src[2]' src='$src[0]' alt='$alt'/>$caption</li>";
						}
					}
					?>

				</ul><!-- END .home-slider-mobile -->

			<?php } //END is_singular('portfolio') ?>

		<?php
		} // END if( $layout == 'slider' )

		// IF THE FUNCTION'S LAYOUT IS CALLING FOR THE STANDARD PORTFOLIO SINGLE
		if ( $layout == 'stacked' ) {
		?>

		   <ul class="stacked">

				<?php
				if ( ! empty( $attachments ) ) {
					foreach ( $attachments as $attachment ) {
						$caption = $attachment->post_excerpt;
						$caption = ( $caption ) ? "<div class='bean-image-caption'>$caption</div>" : '';
						$alt     = ( ! empty( $attachment->post_content ) ) ? $attachment->post_content : $attachment->post_title;
						$src     = wp_get_attachment_image_src( $attachment->ID, $imagesize );
						?>

						<li><?php echo "<img height='$src[2]' width='$src[1]' src='$src[0]' alt='$alt' />$caption"; ?></li>

				<?php
					} //END foreach( $attachments as $attachment )
				} else {

					$caption            = $attachment->post_excerpt;
						$caption        = ( $caption ) ? "<div class='bean-image-caption'>$caption</div>" : '';
						$alt            = ( ! empty( $attachment->post_content ) ) ? $attachment->post_content : $attachment->post_title;
						$feat_image_url = wp_get_attachment_url( get_post_thumbnail_id( $postid ) );
					?>

					<li><?php echo "<img src='$feat_image_url' alt='$alt' />$caption"; ?></li>

							<?php
				} // END if( !empty($attachments) )
			?>
		</ul>

		<?php
		} // END if( $layout == 'std-portfolio-single' )

		 // IF THE FUNCTION'S LAYOUT IS CALLING FOR THE STANDARD PORTFOLIO SINGLE
		if ( $layout == 'portfolio-lightbox' ) {
			?>

			   <ul class="stacked">

					<?php
					if ( ! empty( $attachments ) ) {
						$i = 1;

						foreach ( $attachments as $attachment ) {
							$hidden = ( $i != 1 ) ? ' hidden' : '';

							$src           = wp_get_attachment_image_src( $attachment->ID, $imagesize );
							$src_lrg       = wp_get_attachment_image_src( $attachment->ID, 'port-full' );
							$caption       = $attachment->post_excerpt;
							$caption_front = ( $caption ) ? "<div class='bean-image-caption'>$caption</div>" : '';
							$alt           = ( ! empty( $attachment->post_content ) ) ? $attachment->post_content : $attachment->post_title;
							$src           = wp_get_attachment_image_src( $attachment->ID, 'port-full' );
							?>

							   <li><?php echo '<a href="' . $src[0] . '" class="lightbox ' . $hidden . '" title="' . htmlspecialchars( $caption ) . '" rel="' . $postid . '" alt="' . $alt . '"><span class="lightbox-image"/></span><img src="' . $src[0] . '"/></a>' . $caption_front . ''; ?></li>

						<?php
						} //END foreach( $attachments as $attachment )
					} else {

							$i      = 1;
							$hidden = ( $i != 1 ) ? ' hidden' : '';

							$feat_image_url = wp_get_attachment_url( get_post_thumbnail_id( $postid ) );
						?>

						<li><?php echo '<a href="' . $feat_image_url . '" class="lightbox ' . $hidden . '" rel="' . $postid . '"><span class="lightbox-image"/></span><img src="' . $feat_image_url . '"/></a>'; ?></li>

									<?php } // END if( !empty($attachments) ) ?>

			</ul>

		<?php
		} // END if( $layout == 'portfolio-lightbox' )

		// IF THE FUNCTION'S LAYOUT IS CALLING FOR LIGHTBOX
		if ( $layout == 'post-lightbox' ) {

			$fullwidth_media = get_post_meta( $postid, '_bean_fullwidth_media', true );

			if ( ! empty( $attachments ) ) {
				$i = 1;

				foreach ( $attachments as $attachment ) {

					$hidden = ( $i != 1 ) ? ' hidden' : '';

					$feat_image_url  = wp_get_attachment_url( get_post_thumbnail_id( $postid ) );
					$fullwidth_image = get_post_meta( $postid, '_bean_fullwidth_image', true );
					$src             = wp_get_attachment_image_src( $attachment->ID, $imagesize );
					$caption         = $attachment->post_excerpt;

					echo '<a class="lightbox ' . $hidden . '" rel="' . $postid . '" href="' . $src[0] . '" title="' . htmlspecialchars( $caption ) . '">';
						echo "<span class='lightbox-image'/> </span>";
						echo "<img src='$feat_image_url' />";
					echo '</a>';

					$i++;
				}
			} // END if( !empty($attachments) )
		} // END if( $layout == 'post-lightbox' )

		// IF THE FUNCTION'S LAYOUT IS CALLING FOR LIGHTBOX PORTFOLIO
		if ( $layout == 'port-grid-lightbox' ) {
			if ( ! empty( $attachments ) ) {
				$i = 1;

				foreach ( $attachments as $attachment ) {

					$hidden = ( $i != 1 ) ? ' hidden' : '';

					$src         = wp_get_attachment_image_src( $attachment->ID, 'port-full' );
					$caption     = $attachment->post_excerpt;
					$lb_feat_img = wp_get_attachment_image( get_post_thumbnail_id( $postid ), 'grid-feat', false, array( 'class' => $hidden ) );

					echo '<a class="lightbox ' . $hidden . ' entry-link" rel="next-image" href="' . $src[0] . '" title="' . htmlspecialchars( $caption ) . '">';
					echo esc_url( $lb_feat_img );
					echo '</a>';

					$i++;
				}
			} else {

					$feat_image_url = wp_get_attachment_url( get_post_thumbnail_id( $postid ) );
					$src            = wp_get_attachment_image_src( $attachment->ID, 'port-full' );
					$src_feat       = wp_get_attachment_image_src( $attachment->ID, 'grid-feat' );
					$caption        = $attachment->post_excerpt;

					echo '<a class="lightbox ' . $hidden . ' entry-link" rel="next-image" href="' . $src[0] . '" title="' . htmlspecialchars( $caption ) . '">';
						echo get_the_post_thumbnail( $postid, 'port-full' );
					echo '</a>';

			}// END if( !empty($attachments) )
		} // END if( $layout == 'port-grid-lightbox' )

	} // END function bean_gallery
} // END if ( !function_exists( 'bean_gallery' ) )

if ( ! function_exists( 'bean_audio' ) ) {
	function bean_audio( $postid ) {
		$mp3 = get_post_meta( $postid, '_bean_audio_mp3', true );
		?>

		<div id="jp_container_<?php echo esc_attr( $postid ); ?>" class="jp-audio" data-file="<?php echo esc_url( $mp3 ); ?>">
			<div id="jquery_jplayer_<?php echo esc_attr( $postid ); ?>" class="jp-jplayer">
			</div>
			<div class="jp-interface" style="display: none;">
				<ul class="jp-controls">
					<li><a href="javascript:;" class="jp-play" tabindex="1" title="Play"><span><?php esc_html_e( 'Play', 'bricks' ); ?></span></a></li>
					<li><a href="javascript:;" class="jp-pause" tabindex="1" title="Pause"><span><?php esc_html_e( 'Pause', 'bricks' ); ?></span></a></li>
				</ul><!-- END .jp-controls -->
				<div class="jp-progress">
					<div class="jp-seek-bar">
						<div class="jp-play-bar"></div>
					</div><!-- END .jp-seek-bar -->
				</div><!-- END .jp-progress -->
			</div><!-- END .jp-interface -->
		</div>

		<?php
	} // END function bean_audio($postid)
} // END if ( !function_exists( 'bean_audio' ) )
