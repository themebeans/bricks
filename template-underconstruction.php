<?php
/**
 * Template Name: Under Construction
 * The template for displaying the under construction page template.
 *
 * @package     Bricks
 * @link        https://themebeans.com/themes/bricks
 */

get_header(); ?>


	<div class="construction-logo">
		<?php if ( get_theme_mod( 'construction-img-upload' ) ) { ?>
			<img src="<?php echo get_theme_mod( 'construction-img-upload' ); ?>"/>
		<?php } else { ?>
			<img src="
			<?php
			echo get_template_directory_uri();
			echo '/assets/images/construction.png';
?>
">
		<?php } ?>
	</div><!-- END .construction-logo -->

	<?php
	while ( have_posts() ) :
		the_post();
		the_content();
endwhile;
?>

<?php
get_footer();
