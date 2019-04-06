<?php
/**
 *  The template for displaying all pages
 *
 *  This is the template that displays all pages by default.
 *  Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @package     Bricks
 * @link        https://themebeans.com/themes/bricks
 */
get_header();

// PAGE META
$page_title  = get_post_meta( $post->ID, '_bean_page_title', true );
$page_layout = get_post_meta( $post->ID, '_bean_page_layout', true );

if ( $page_layout === 'right' ) { ?>

	<div class="primary-sidebar">
		<?php dynamic_sidebar( 'internal-sidebar' ); ?>
	</div><!-- END .primary-sidebar -->

<?php } ?>

<article id="post-<?php the_ID(); ?>" class="primary-content
									<?php
									echo esc_html( $page_layout );
									if ( $page_layout != 'right' ) {
										echo ' no-sidebar'; }
?>
">

	<?php if ( ( function_exists( 'has_post_thumbnail' ) ) && ( has_post_thumbnail() ) ) { ?>

		<div class="entry-media">
			<?php the_post_thumbnail( 'port-full' ); ?>
		</div><!-- END .entry-media -->

	<?php } //END if ( (function_exists('has_post_thumbnail')) ?>

	<div class="entry-content">

		<?php
		if ( $page_title == 'on' ) {
?>
<h1 class="entry-title"><?php the_title(); ?></h1><?php } ?>

		<?php
		while ( have_posts() ) :
			the_post();
			the_content();
endwhile; // THE LOOP
?>

		<?php
		wp_link_pages(
			array(
				'before' => '<div class="page-link"><span>' . __( 'Pages:', 'bricks' ) . '</span>',
				'after'  => '</div>',
			)
		);
?>

	</div><!-- END .entry-content -->

</article>

<?php
get_footer();
