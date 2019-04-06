<?php
/**
 * The template for displaying posts in the standard post format.
 *
 * @package     Bricks
 * @link        https://themebeans.com/themes/bricks
 */

if ( ( function_exists( 'has_post_thumbnail' ) ) && ( has_post_thumbnail() ) ) { ?>

	<div class="entry-media">

		<?php if ( is_singular() ) { ?>
			<?php the_post_thumbnail( 'post-feat' ); ?>
		<?php } else { ?>
			<a title="<?php printf( __( 'Permanent Link to %s', 'bricks' ), get_the_title() ); ?>" href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'post-feat' ); ?>
			</a>
		<?php } ?>

	</div><!-- END .entry-media -->

<?php
} //END if has_post_thumbnail
