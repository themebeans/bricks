<?php
/**
 * The template for displaying posts in the gallery post format.
 *
 * @package     Bricks
 * @link        https://themebeans.com/themes/bricks
 */

$orderby = get_post_meta( $post->ID, '_bean_post_randomize', true );
$orderby = ( $orderby == 'off' ) ? 'post__in' : 'rand';
?>

<div class="entry-media">
	<?php bean_gallery( $post->ID, '', 'slider', $orderby, true ); ?>
</div>
