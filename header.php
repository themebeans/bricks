<?php
/**
 * The header for our theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package     Bricks
 * @link        https://themebeans.com/themes/bricks
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php
	if ( function_exists( 'wp_body_open' ) ) {
		wp_body_open();
	}
	?>
	<?php
	if ( get_theme_mod( 'portfolio_filter' ) == true && is_page_template( 'template-portfolio-grid.php' ) or is_page_template( 'template-portfolio-grid-lightbox.php' ) ) {
		get_template_part( 'content', 'portfolio-filter' );
	}
	?>

	<?php if ( ! is_404() && ! is_page_template( 'template-underconstruction.php' ) ) { // HIDE THIS ON 404/UNDER CONSTRUCTION TEMPLATES ?>

		<header class="header row">

			<div class="left-side">

				<?php bricks_site_logo(); ?>

				<span class="site-description"><?php echo get_bloginfo( 'description' ); ?></span>

				<nav class="nav primary">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'primary-menu',
							'container'      => '',
							'menu_id'        => 'primary-menu',
							'menu_class'     => 'sf-menu main-menu',
						)
					);
					?>
				</nav>

			</div><!-- END .left-side -->

			<?php
			if ( get_theme_mod( 'portfolio_filter' ) == true && is_page_template( 'template-portfolio-grid.php' ) or is_page_template( 'template-portfolio-grid-lightbox.php' ) ) {
					get_template_part( 'content', 'portfolio-filter-mobile' );
			}
			?>

			<div class="right-side">

				<?php if ( is_singular( 'portfolio' ) ) { ?>

					<?php if ( get_theme_mod( 'portfolio_pagination' ) == true ) { ?>

						<div class="top-pagination">

							<?php $portfolio_page = get_theme_mod( 'portfolio_page_selector' ); ?>

							<?php if ( $portfolio_page ) { ?>
								<span class="page-portfolio">
									<a href="<?php echo get_page_link( $portfolio_page ); ?>" rel="home"><?php esc_html_e( 'Home ', 'bricks' ); ?></a>
								</span>
							<?php } ?>

							<?php if ( get_adjacent_post( false, '', true ) ) { ?>
								<span class="page-previous">
									<?php previous_post_link( '%link', __( 'Prev', 'bricks' ) ); ?>
								</span>
							<?php } ?>

							<?php if ( get_adjacent_post( false, '', false ) ) { ?>
								<span class="page-next">
									<?php next_post_link( '%link', __( 'Next', 'bricks' ) ); ?>
								</span>
							<?php } ?>

						</div><!-- END .top-pagination -->

					<?php } //END if( get_theme_mod( 'portfolio_pagination' ) ?>

				<?php } //END if ( is_singular('portfolio') ) ?>

				<?php if ( get_theme_mod( 'portfolio_filter' ) == true && is_page_template( 'template-portfolio-grid.php' ) or is_page_template( 'template-portfolio-grid-lightbox.php' ) ) { ?>
					<a id="filter-toggle" href="javascript:void(0);"
					<?php
					if ( get_theme_mod( 'hidden_sidebar' ) == false ) {
						echo 'class="no-nav-toggle"'; }
?>
></a>
				<?php } ?>

					<a id="nav-toggle" class="sidebar-btn
					<?php
					if ( get_theme_mod( 'hidden_sidebar' ) == false ) {
						echo 'no-nav-toggle'; }
?>
" href="javascript:void(0);"><span></span></a>

			</div><!-- END .right-side -->

		</header><!-- END .header -->

			<?php get_template_part( 'content', 'hidden-sidebar' ); // GET CONTENT-HIDDEN-SIDEBAR.PHP ?>
			<div class="nav-overlay"></div>

	<?php } ?>

	<div class="content-wrapper row">
