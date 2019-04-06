<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package     Bricks
 * @link        https://themebeans.com/themes/bricks
 */

get_header();

$sidebar = true;

// OPTIONAL SIDEBAR
if ( get_theme_mod( 'show_blogroll_sidebar' ) == true and is_active_sidebar( 'internal-sidebar' ) ) { ?>

	<div class="primary-sidebar">
		<?php dynamic_sidebar( 'internal-sidebar' ); ?>
	</div><!-- END .primary-sidebar -->

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

	<?php
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
			get_template_part( 'loop-post' );
		endwhile;
endif;
	?>

	<?php echo bean_index_pagination(); ?>

</div><!-- END .primary-content -->

<?php
get_footer();
