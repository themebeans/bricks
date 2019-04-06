<?php
/**
 * The template for displaying Search Results pages
 *
 * @package     Bricks
 * @link        https://themebeans.com/themes/bricks
 */

get_header();

// OPTIONAL SIDEBAR
if ( get_theme_mod( 'show_blogroll_sidebar' ) == true and is_active_sidebar( 'internal-sidebar' ) ) { ?>

		<?php $sidebar = true; ?>

		<div class="primary-sidebar">
			<?php dynamic_sidebar( 'internal-sidebar' ); ?>
		</div><!-- END .sidebar -->

<?php
} else {
	$sidebar == false;
}
?>

<div class="primary-content
<?php
if ( $sidebar == false ) {
	echo 'no-sidebar'; }
?>
">


	<?php if ( have_posts() ) { ?>

		<article class="post search-header">

			<?php get_search_form(); ?>

		</article>


		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				get_template_part( 'loop-post' ); // PULL LOOP-POST.PHP
		endwhile;
endif;
		?>

		<?php echo bean_index_pagination(); ?>

	<?php } else { ?>

		<article class="post search-header">

			<p class="widget-title"><?php printf( __( 'Nothing Found', 'bricks' ) ); ?></p>

			<p><?php printf( __( 'Sorry, but we didn&#39;t find anything for "%s". Please try searching again.', 'bricks' ), get_search_query() ); ?></p>

			<?php get_search_form(); ?>

		</article>

	<?php } //END else ?>

</div><!-- END .primary-content -->

<?php
get_footer();
