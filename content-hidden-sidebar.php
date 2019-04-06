<div id="hidden-sidebar" class="hidden-sidebar">

	<a href="" class="sidebar-close" title="<?php esc_html_e( 'Close', 'bricks' ); ?>"></a>

	<div class="hidden-sidebar-inner">

		<div class="widget mobile-navigation">

			<nav class="nav primary">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary-menu',
						'container'      => '',
						'menu_id'        => 'primary-menu',
						'menu_class'     => 'main-menu',
					)
				);
				?>
			</nav>

		</div><!-- END .widget -->

		<?php dynamic_sidebar( 'hidden-sidebar' ); ?>

		<div class="widget copyright">

			<p>&copy; <?php echo date( 'Y' ); ?> <a href="<?php echo home_url(); ?>" title="<?php echo bloginfo( 'name' ); ?>" rel="home"><?php bloginfo( $name ); ?></a>
				<span>
					<?php
					if ( get_theme_mod( 'footer_copyright' ) ) {
						echo get_theme_mod( 'footer_copyright' );
					} else {
						echo ' by <a href="https://themebeans.com">ThemeBeans</a>';
					}
					?>
				</span>
			</p>

		</div><!-- END .copyright -->

	</div><!-- END .hidden-sidebar-inner -->

</div><!-- END .hidden-sidebar -->
