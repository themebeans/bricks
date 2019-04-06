<?php
/**
 * The template for displaying posts in the audio post format.
 *
 * @package     Bricks
 * @link        https://themebeans.com/themes/bricks
 */

?>
<div class="entry-media">

	<?php if ( ( function_exists( 'has_post_thumbnail' ) ) && ( has_post_thumbnail() ) ) { ?>
		<?php the_post_thumbnail( 'post-feat' ); ?>
	<?php } ?>

	<?php bean_audio( $post->ID ); ?>

</div>
