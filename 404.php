<?php
/**
 * The template for displaying the 404 error page
 * This page is set automatically, not through the use of a template
 *
 * @package     Bricks
 * @link        https://themebeans.com/themes/bricks
 */

get_header(); ?>

	<div class="error-logo">
		<a href="<?php echo home_url(); ?>" title="<?php echo bloginfo( 'name' ); ?>" rel="home">
		<?php if ( get_theme_mod( '404-img-upload' ) ) { ?>
			<img src="<?php echo get_theme_mod( '404-img-upload' ); ?>"/>
		<?php } else { ?>
			<img src="
			<?php
			echo get_template_directory_uri();
			echo '/assets/images/404.png';
?>
">
		<?php } ?>
		</a>
	</div><!-- END .error-logo -->

	<p><?php echo get_theme_mod( 'error_text' ); ?><br/><?php esc_html_e( 'Head ', 'bricks' ); ?><a href="javascript:javascript:history.go(-1)"><?php esc_html_e( 'back', 'bricks' ); ?></a><?php esc_html_e( ' or go on ', 'bricks' ); ?><a href="<?php echo home_url(); ?>"><?php esc_html_e( 'home', 'bricks' ); ?></a></p>

<?php
get_footer();
