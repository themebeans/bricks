<?php
/**
 * The template for displaying posts in the Quote post format.
 *
 * @package     Bricks
 * @link        https://themebeans.com/themes/bricks
 */

$quote        = get_post_meta( $post->ID, '_bean_quote', true );
$quote_source = get_post_meta( $post->ID, '_bean_quote_source', true );
?>

<div class="entry-media">

	<blockquote>
		<?php echo stripslashes( esc_html( $quote ) ); ?>
		<cite><?php echo stripslashes( esc_html( $quote_source ) ); ?></cite>
	</blockquote>

</div><!-- END .entry-media -->
