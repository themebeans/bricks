<?php
/**
 * The template for displaying the singular attachment page.
 *
 * @package     Bricks
 * @link        https://themebeans.com/themes/bricks
 */

get_header(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content-media">
		<?php $image_info = getimagesize( $post->guid ); ?>
		<img src="<?php echo esc_url( $post->guid ); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" <?php echo esc_html( $image_info[3] ); ?> />
	</div><!-- END .entry-content-media-->

	<div class="attachment-meta">
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<p class="published"><?php esc_html_e( 'Uploaded ', 'bricks' ); ?><?php the_time( get_option( 'date_format' ) ); ?></p>
	</div><!-- END .attachment-meta -->

</article><!-- END #post-<?php the_ID(); ?> -->

<?php
get_footer();
