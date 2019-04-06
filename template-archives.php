<?php
/**
 * Template Name: Post Archives
 * The template for displaying the post archives template.
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

		<div class="archives-list">

			<p class="widget-title"><?php esc_html_e( 'Last 30 Posts', 'bricks' ); ?></p>

			<ul>
				<?php
				$archive_30 = get_posts( 'numberposts=30' );
				foreach ( $archive_30 as $post ) :
				?>
				<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
				<?php endforeach; ?>
			</ul>

			<p class="widget-title"><?php esc_html_e( 'Archives by Month', 'bricks' ); ?></p>

			<ul><?php wp_get_archives( 'type=monthly' ); ?></ul>

			<p class="widget-title"><?php esc_html_e( 'Archives by Category ', 'bricks' ); ?></p>

			<ul><?php wp_list_categories( 'title_li=' ); ?></ul>

		</div><!-- END .archives-list -->

		<?php
		wp_link_pages(
			array(
				'before' => '<div class="page-link"><span>' . __( 'Pages:', 'bricks' ) . '</span>',
				'after'  => '</div>',
			)
		);
		wp_reset_query();
?>

	</div><!-- END .entry-content -->

</article>

<?php
get_footer();
