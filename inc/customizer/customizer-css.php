<?php
/**
 * Enqueues front-end CSS for Customizer options.
 *
 * @package     Bricks
 * @link        https://themebeans.com/themes/bricks
 */

/**
 * Set the Custom CSS via Customizer options.
 */
function bricks_customizer_css() {
	$thumb_size         = get_theme_mod( 'type_slider_grid_thumb', '80' );
	$theme_accent_color = get_theme_mod( 'theme_accent_color', '#7BB7C6' );
	$site_logo_width    = get_theme_mod( 'custom_logo_max_width', '50' );
	$css_filter_style   = get_theme_mod( 'portfolio_css_filter' );

	$css =
	'
	body .custom-logo-link img.custom-logo {
		width: ' . esc_attr( $site_logo_width ) . 'px;
	}

	p a,
	.widget a:hover,
	.widget_bean_tweets a,
	.cats,
	h1 a:hover,
	.current-menu-item a,
	.top-pagination a:hover,
	.author-tag,
	.a-link:hover,
	.project-filter span:hover,
	.index-pagination a.current,
	.logo a h1:hover,
	.entry-meta a:hover,
	.pagination a:hover,
	header ul li a:hover,
	footer ul li a:hover,
	.single-price .price,
	.entry-title a:hover,
	.comment-meta a:hover,
	h2.entry-title a:hover,
	.comment-author a:hover,
	.products li h2 a:hover,
	.entry-link a.link:hover,
	.team-content h3 a:hover,
	.site-description a:hover,
	.bean-tabs > li.active > a,
	.mobile-project-filter span.sort:hover,
	.bean-panel-title > a:hover,
	.bean-tabs > li.active > a:hover,
	.bean-tabs > li.active > a:focus,
	.single-product ul.tabs li.active a,
	.single-portfolio .sidebar-right a.url,
	.archives-list ul li a:hover,
	header ul > .sfHover > a.sf-with-ul,
	.widget_bean_tweets .button,
	header .sub-menu li a:hover,
	.widget_bean_tweets .button:hover,
	.more-link:hover,
	header .sub-menu li.current-menu-item a:hover,
	.hidden-sidebar-inner .main-menu a:hover,
	.post .entry-meta a:hover,
	.page .entry-meta a:hover,
	.hidden-sidebar-inner .sub-menu li a:hover,
	.hidden-sidebar-inner .sub-menu li.current-menu-item a:hover,
	.entry-content .wp-playlist-dark .wp-playlist-playing .wp-playlist-caption,
	.entry-content .wp-playlist-light .wp-playlist-playing .wp-playlist-caption,
	.entry-content .wp-playlist-dark .wp-playlist-playing .wp-playlist-item-title,
	.entry-content .wp-playlist-light .wp-playlist-playing .wp-playlist-item-title { color:' . $theme_accent_color . '!important; }

	.new-tag,
	.bean-btn,
	.type-team,
	.btn:hover,
	#place_order,
	.button:hover,
	nav a h1:hover,
	.tagcloud a,
	div.jp-play-bar,
	.vert-align:hover,
	.pagination a:hover,
	.edd_checkout a:hover,
	div.jp-volume-bar-value,
	.avatar-list li a.active,
	.dark_style .pagination a,
	.btn[type="submit"]:hover,
	input[type="reset"]:hover,
	input[type="button"]:hover,
	#edd-purchase-button:hover,
	input[type="submit"]:hover,
	.button[type="submit"]:hover,
	#mobile-filter li a.active,
	.bean-shot,
	.flickr_badge_image,
	.widget .buttons .checkout.button,
	.side-menu .sidebar-btn .menu-icon,
	.dark_style .sidebar-btn .menu-icon,
	input[type=submit].edd-submit.button,
	.comment-form-rating p.stars a.active,
	.hidden-sidebar.sidebar.dark .tagcloud a,
	.comment-form-rating p.stars a.active:hover,
	.subscribe .mailbag-wrap input[type="submit"]:hover,
	.entry-content .mejs-controls .mejs-time-rail span.mejs-time-current { background-color:' . $theme_accent_color . '; }

	.entry-content .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current { background:' . $theme_accent_color . '; }

	p a,
	.entry-title a:hover,
	.pagination a:hover,
	.widget a:hover,
	cite a:hover,
	.more-link:hover,
	.widget_bean_tweets .button:hover,
	abbr:hover, acronym:hover, ins:hover,
	.widget_bean_tweets li a,
	.mobile-project-filter span.sort:hover { border-color:' . $theme_accent_color . '!important; }

	.bean-btn { border: 1px solid ' . $theme_accent_color . '!important; }

	.bean-quote,
	.mailbag-wrap input[type="submit"],
	.instagram_badge_image,
	.bean500px_badge_image,
	.dark_style.side-menu .sidebar-btn .menu-icon:hover { background-color:' . $theme_accent_color . '!important; }

	.projects-grid .project img { max-height: ' . $thumb_size . 'px; }
	';

	if ( $css_filter_style ) {
		switch ( $css_filter_style ) {
			case 'none':
				break;
			case 'grayscale':
				$css .= '.projects-grid:hover .project.loaded { filter: url("data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\'><filter id=\'grayscale\'><feColorMatrix type=\'matrix\' values=\'0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0 0 0 1 0\'/></filter></svg>#grayscale"); filter:gray; -webkit-filter:grayscale(100%);-moz-filter: grayscale(100%);-o-filter: grayscale(100%);}';
				$css .= '.projects-grid:hover .project.loaded:hover { filter: url(""); filter:none; -webkit-filter:grayscale(0);-moz-filter: grayscale(0);-o-filter: grayscale(0);}';
				break;
			case 'sepia':
				$css .= '#projects .project { -webkit-filter: sepia(50%); }';
				break;
			case 'saturation':
				$css .= '#projects .project { -webkit-filter: saturate(150%); }';
				break;
		}
	}

	// Minify.
	if ( function_exists( 'themebeans_minify_css' ) ) {
		$css = themebeans_minify_css( $css );
	}

	return wp_strip_all_tags( $css );
}

/**
 * Enqueue the Customizer styles on the front-end.
 */
function bricks_customizer_styles() {
	wp_add_inline_style( 'bricks-style', bricks_customizer_css() );
}
add_action( 'wp_enqueue_scripts', 'bricks_customizer_styles' );
