<?php
/**
 * The template for displaying the post template/grid loop.
 *
 * @package     Bricks
 * @link        https://themebeans.com/themes/bricks
 */

// FORMAT
$format = get_post_format();
if ( false === $format ) {
	$format = 'standard'; }

// META
$link  = get_post_meta( $post->ID, '_bean_link_url', true );
$terms = get_the_terms( $post->ID, 'category' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
	if ( is_sticky() ) {
		echo '<span></span>'; }
?>

	<?php
	if ( ! post_password_required() && $format != 'aside' ) {
		get_template_part( 'inc/post-formats/content', $format ); }
?>

	<div class="entry-meta">

		<?php if ( is_singular() ) { ?>
			<p class="by">
				<strong><?php esc_html_e( 'By:', 'bricks' ); ?></strong>
				<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a>
			</p>
		<?php } ?>

			<p class="published">
				<strong><?php esc_html_e( 'Date:', 'bricks' ); ?></strong>
				<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'bricks' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_time( get_option( 'date_format' ) ); ?></a>
			</p>

		<?php if ( is_singular() ) { ?>

			<?php if ( $terms && ! is_wp_error( $terms ) ) : ?>
				<p class="category">
					<strong><?php esc_html_e( 'Category:', 'bricks' ); ?></strong>
					<?php the_terms( $post->ID, 'category', '', ', ', '' ); ?>
				</p>
			<?php endif; ?>

			<?php if ( get_theme_mod( 'show_tags' ) == true && has_tag() ) { ?>
				<p class="tags">
					<strong><?php esc_html_e( 'Tags:', 'bricks' ); ?></strong>
					<?php echo the_tags( '', '', '' ); ?>
				</p>
			<?php } ?>

			<?php if ( get_theme_mod( 'post_sharing' ) == true ) { ?>
				<?php get_template_part( 'content', 'post-social' ); ?>
			<?php } ?>

		<?php } //END is_singular() ?>

	</div><!-- END .entry-meta -->

	<div class="entry-content">

		<?php if ( $format == 'link' ) { // IF LINK FORMAT, USE THE LINK INSERTED IN LEUI OF THE PERMALINK ?>

			<?php if ( is_singular() ) { ?>
				<h1 class="entry-title">
					<a target="blank" href="<?php echo esc_url( $link ); ?>"><?php the_title(); ?></a><span class="icon-link"></span>
				</h1><!-- END .entry-title -->
			<?php } else { ?>
				<h2 class="entry-title">
					<a target="blank" href="<?php echo esc_url( $link ); ?>"><?php the_title(); ?></a><span class="icon-link"></span>
				</h2><!-- END .entry-title -->
			<?php } ?>

		<?php
} elseif ( $format == 'aside' or $format == 'quote' ) {
	// NO TITLE FOR THE ASIDE POST FORMAT
} else {
		?>

			<?php if ( is_singular() ) { ?>
				<h1 class="entry-title">
					<?php the_title(); ?>
				</h1><!-- END .entry-title -->
			<?php } else { ?>
				<h2 class="entry-title">
					<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'bricks' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
				</h2><!-- END .entry-title -->
			<?php } ?>

		<?php } //END if( $format == 'link') ?>

		<?php edit_post_link( __( '[Edit]', 'bricks' ), '', '' ); ?>

		<?php the_content( __( '<span>Continue Reading</span>', 'bricks' ) ); ?>

		<?php if ( is_singular() ) { ?>

			<?php
			wp_link_pages(
				array(
					'before'         => '<p><strong>' . __( 'Pages:', 'bricks' ) . '</strong> ',
					'after'          => '</p>',
					'next_or_number' => 'number',
				)
			);
			?>

			<?php comments_template( '', true ); ?>

		<?php } //END is_singular() ?>

	</div><!-- END .entry-content -->

</article>
