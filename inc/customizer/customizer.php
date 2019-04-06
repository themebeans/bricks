<?php
/**
 * Theme Customizer functionality
 *
 * @package     Bricks
 * @link        https://themebeans.com/themes/bricks
 */

/**
 * Customizer.
 *
 * @param WP_Customize_Manager $wp_customize the Customizer object.
 */
function Bean_Customize_Register( $wp_customize ) {

	/**
	 * Customize.
	 */
	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	/**
	 * Remove sections and controls.
	 */
	$wp_customize->remove_section( 'background_image' );

	/**
	 * Add custom controls.
	 */
	require get_parent_theme_file_path( THEMEBEANS_CUSTOM_CONTROLS_DIR . 'class-themebeans-title-control.php' );
	require get_parent_theme_file_path( THEMEBEANS_CUSTOM_CONTROLS_DIR . 'class-themebeans-range-control.php' );
	require get_parent_theme_file_path( THEMEBEANS_CUSTOM_CONTROLS_DIR . 'class-themebeans-toggle-control.php' );

	/**
	 * Top-Level Customizer sections and panels.
	 */
	$wp_customize->add_section(
		'bricks_theme_options', array(
			'title'    => __( 'Theme Options', 'bricks' ),
			'priority' => 30,
		)
	);

	$wp_customize->add_section(
		'portfolio_settings', array(
			'title'    => __( 'Portfolio', 'bricks' ),
			'priority' => 40,
		)
	);

	$wp_customize->add_section(
		'contact_settings', array(
			'title'    => __( 'Contact', 'bricks' ),
			'priority' => 40,
		)
	);

	$wp_customize->add_section(
		'404_settings', array(
			'title'    => __( '404 & Construction', 'bricks' ),
			'priority' => 40,
		)
	);

	/**
	 * Add the site logo max-width options to the Site Identity section.
	 */
	$wp_customize->add_setting(
		'custom_logo_max_width', array(
			'default'           => '50',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		new ThemeBeans_Range_Control(
			$wp_customize, 'custom_logo_max_width', array(
				'default'     => '50',
				'type'        => 'themebeans-range',
				'label'       => esc_html__( 'Max Width', 'bricks' ),
				'description' => 'px',
				'section'     => 'title_tagline',
				'priority'    => 8,
				'input_attrs' => array(
					'min'  => 40,
					'max'  => 300,
					'step' => 2,
				),
			)
		)
	);

	/**
	 * General.
	 */
	$wp_customize->add_setting( 'blog_general', array( 'sanitize_callback' => 'esc_html' ) );

	$wp_customize->add_control(
		new ThemeBeans_Title_Control(
			$wp_customize, 'blog_general', array(
				'type'    => 'themebeans-title',
				'label'   => esc_html__( 'General', 'bricks' ),
				'section' => 'bricks_theme_options',
			)
		)
	);

	$wp_customize->add_setting(
		'hidden_sidebar', array(
			'default' => false,
			// 'transport' => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new ThemeBeans_Toggle_Control(
			$wp_customize, 'hidden_sidebar', array(
				'type'        => 'themebeans-toggle',
				'label'       => esc_html__( 'Toggle Hidden Sidebar', 'bricks' ),
				'description' => esc_html__( 'Toggle the auxillery sidebar panel, which you may then add widgets to.', 'bricks' ),
				'section'     => 'bricks_theme_options',
			)
		)
	);

	$wp_customize->add_setting( 'twitter_profile', array( 'default' => '' ) );
	$wp_customize->add_control(
		'twitter_profile',
		array(
			'label'   => __( 'Twitter Username', 'bricks' ),
			'section' => 'bricks_theme_options',
			'type'    => 'text',
		)
	);

	$wp_customize->add_setting(
		'footer_copyright', array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);

	$wp_customize->add_control(
		'footer_copyright', array(
			'type'        => 'textarea',
			'label'       => esc_html__( 'Custom Copyright', 'bricks' ),
			'description' => esc_html__( 'Add custom text to display in the site footer.', 'bricks' ),
			'section'     => 'bricks_theme_options',
		)
	);

	/**
	 * Blog.
	 */
	$wp_customize->add_setting( 'blog_title', array( 'sanitize_callback' => 'esc_html' ) );

	$wp_customize->add_control(
		new ThemeBeans_Title_Control(
			$wp_customize, 'blog_title', array(
				'type'    => 'themebeans-title',
				'label'   => esc_html__( 'Blog', 'bricks' ),
				'section' => 'bricks_theme_options',
			)
		)
	);

	$wp_customize->add_setting( 'show_tags', array( 'default' => false ) );
	$wp_customize->add_control(
		'show_tags',
		array(
			'type'    => 'checkbox',
			'label'   => __( 'Enable Tags', 'bricks' ),
			'section' => 'bricks_theme_options',
		)
	);

	$wp_customize->add_setting( 'show_blogroll_sidebar', array( 'default' => false ) );
	$wp_customize->add_control(
		'show_blogroll_sidebar',
		array(
			'type'    => 'checkbox',
			'label'   => __( 'Enable Blogroll Sidebar', 'bricks' ),
			'section' => 'bricks_theme_options',
		)
	);

	$wp_customize->add_setting( 'post_sharing', array( 'default' => false ) );
	$wp_customize->add_control(
		'post_sharing',
		array(
			'type'    => 'checkbox',
			'label'   => __( 'Enable Post Sharing', 'bricks' ),
			'section' => 'bricks_theme_options',
		)
	);

	$wp_customize->add_setting( 'portfolio_filter', array( 'default' => false ) );
	$wp_customize->add_control(
		'portfolio_filter',
		array(
			'type'    => 'checkbox',
			'label'   => __( 'Enable Filtering', 'bricks' ),
			'section' => 'portfolio_settings',
		)
	);

	$wp_customize->add_setting( 'show_portfolio_sharing', array( 'default' => false ) );
	$wp_customize->add_control(
		'show_portfolio_sharing',
		array(
			'type'    => 'checkbox',
			'label'   => __( 'Enable Single Portfolio Sharing', 'bricks' ),
			'section' => 'portfolio_settings',
		)
	);

	$wp_customize->add_setting( 'portfolio_pagination', array( 'default' => false ) );
	$wp_customize->add_control(
		'portfolio_pagination',
		array(
			'type'    => 'checkbox',
			'label'   => __( 'Enable Single Portfolio Pagination', 'bricks' ),
			'section' => 'portfolio_settings',
		)
	);

	$wp_customize->add_setting( 'slide_template_title', array( 'default' => false ) );
	$wp_customize->add_control(
		'slide_template_title',
		array(
			'type'    => 'checkbox',
			'label'   => __( 'Enable Fullwidth/Slider Template Titles', 'bricks' ),
			'section' => 'portfolio_settings',
		)
	);

	/**
	 * Add the site logo max-width options to the Site Identity section.
	 */
	$wp_customize->add_setting(
		'type_slider_grid_thumb', array(
			'default'           => '80',
			// 'transport'         => 'postMessage',
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		new ThemeBeans_Range_Control(
			$wp_customize, 'type_slider_grid_thumb', array(
				'default'     => '80',
				'type'        => 'themebeans-range',
				'label'       => esc_html__( 'Grid Size', 'bricks' ),
				'description' => 'px',
				'section'     => 'portfolio_settings',
				'input_attrs' => array(
					'min'  => 50,
					'max'  => 200,
					'step' => 1,
				),
			)
		)
	);

	$wp_customize->add_setting( 'portfolio_posts_count', array( 'default' => '' ) );
	$wp_customize->add_control(
		'portfolio_posts_count',
		array(
			'label'   => __( 'Portfolio Count', 'bricks' ),
			'section' => 'portfolio_settings',
			'type'    => 'text',
		)
	);

	$wp_customize->add_setting( 'portfolio_page_selector' );
	$wp_customize->add_control(
		'portfolio_page_selector', array(
			'settings'       => 'portfolio_page_selector',
			'label'          => __( 'Select Portfolio Page', 'bricks' ),
			'section'        => 'portfolio_settings',
			'type'           => 'select',
			'type'           => 'dropdown-pages',
			'allow_addition' => true,
		)
	);

	$wp_customize->add_setting( 'portfolio_loop_orderby', array( 'default' => 'date' ) );
	$wp_customize->add_control(
		'portfolio_loop_orderby',
		array(
			'type'    => 'select',
			'label'   => __( 'Portfolio Template Loop', 'bricks' ),
			'section' => 'portfolio_settings',
			'choices' => array(
				'date'       => __( 'Most Recent', 'bricks' ),
				'view_count' => __( 'Most Popular', 'bricks' ),
				'menu_order' => __( 'Sort Order', 'bricks' ),
			),
		)
	);

	$wp_customize->add_setting( 'portfolio_more_loop', array( 'default' => 'more' ) );
	$wp_customize->add_control(
		'portfolio_more_loop',
		array(
			'type'    => 'select',
			'label'   => __( 'Portfolio Single Loop', 'bricks' ),
			'section' => 'portfolio_settings',
			'choices' => array(
				'none'    => 'None',
				'more'    => 'All Posts',
				'related' => 'Related Posts',
			),
		)
	);

	$wp_customize->add_setting( 'bean_contact_form', array( 'default' => false ) );
	$wp_customize->add_control(
		'bean_contact_form',
		array(
			'type'    => 'checkbox',
			'label'   => 'Enable Contact Form',
			'section' => 'contact_settings',
		)
	);

	$wp_customize->add_setting( 'admin_custom_email', array( 'default' => '' ) );
	$wp_customize->add_control(
		'admin_custom_email',
		array(
			'label'   => __( 'Contact Form Email', 'bricks' ),
			'section' => 'contact_settings',
			'type'    => 'text',
		)
	);

	$wp_customize->add_setting( 'contact_button_text', array( 'default' => '' ) );
	$wp_customize->add_control(
		'contact_button_text',
		array(
			'label'   => __( 'Contact Button Text', 'bricks' ),
			'section' => 'contact_settings',
			'type'    => 'text',
		)
	);

	$wp_customize->add_setting( 'construction-img-upload', array() );
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize, 'construction-img-upload', array(
				'label'    => __( 'Construction Custom Image', 'bricks' ),
				'section'  => '404_settings',
				'settings' => 'construction-img-upload',
			)
		)
	);

	$wp_customize->add_setting( '404-img-upload', array() );
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize, '404-img-upload', array(
				'label'    => __( '404 Custom Image', 'bricks' ),
				'section'  => '404_settings',
				'settings' => '404-img-upload',
			)
		)
	);

	$wp_customize->add_setting( 'error_text', array( 'default' => '' ) );
	$wp_customize->add_control(
		'error_text',
		array(
			'label'   => __( '404 Text', 'bricks' ),
			'section' => '404_settings',
			'type'    => 'text',
		)
	);

	/**
	 * Colors.
	 */
	$wp_customize->add_setting(
		'theme_accent_color', array(
			'default' => '#7BB7C6',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'theme_accent_color', array(
				'label'    => __( 'Accent Color', 'bricks' ),
				'section'  => 'colors',
				'settings' => 'theme_accent_color',
			)
		)
	);

	$wp_customize->add_setting( 'portfolio_css_filter', array( 'default' => 'grayscale' ) );
	$wp_customize->add_control(
		'portfolio_css_filter',
		array(
			'type'    => 'select',
			'label'   => __( 'Portfolio CSS3 Filter', 'bricks' ),
			'section' => 'colors',
			'choices' => array(
				'none'       => 'None',
				'grayscale'  => 'Black & White',
				'sepia'      => 'Sepia Tone',
				'saturation' => 'High Saturation',
			),
		)
	);
}
add_action( 'customize_register', 'Bean_Customize_Register' );

/**
 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
 */
function bricks_customize_preview_js() {
	wp_enqueue_script( 'bricks-customize-preview', get_theme_file_uri( '/assets/js/admin/customize-preview' . BRICKS_ASSET_SUFFIX . '.js' ), array( 'customize-preview' ), '@@pkg.version', true );
}
add_action( 'customize_preview_init', 'bricks_customize_preview_js' );

/**
 * Load dynamic logic for the customizer controls area.
 */
function bricks_customize_controls_js() {
	wp_enqueue_script( 'bricks-customize-controls', get_theme_file_uri( '/assets/js/admin/customize-controls' . BRICKS_ASSET_SUFFIX . '.js' ), array( 'customize-controls' ), '@@pkg.version', true );
}
add_action( 'customize_controls_enqueue_scripts', 'bricks_customize_controls_js' );
