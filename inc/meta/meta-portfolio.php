<?php
/**
 * The file is for creating the portfolio post type meta.
 * Meta output is defined on the portfolio single editor.
 * Corresponding meta functions are located in framework/metaboxes.php
 *
 * @package     Bricks
 * @link        https://themebeans.com/themes/bricks
 */

function bean_metabox_portfolio() {

	$prefix = '_bean_';

	$meta_box = array(
		'id'          => 'portfolio-type',
		'title'       => __( 'Portfolio Format', 'bricks' ),
		'description' => __( '', 'bricks' ),
		'page'        => 'portfolio',
		'context'     => 'side',
		'priority'    => 'core',
		'fields'      => array(
			array(
				'name' => __( 'Gallery', 'bricks' ),
				'desc' => __( '', 'bricks' ),
				'id'   => $prefix . 'portfolio_type_gallery',
				'type' => 'checkbox',
				'std'  => true,
			),
			array(
				'name' => __( 'Audio', 'bricks' ),
				'desc' => __( '', 'bricks' ),
				'id'   => $prefix . 'portfolio_type_audio',
				'type' => 'checkbox',
				'std'  => false,
			),
			array(
				'name' => __( 'Video', 'bricks' ),
				'desc' => __( '', 'bricks' ),
				'id'   => $prefix . 'portfolio_type_video',
				'type' => 'checkbox',
				'std'  => false,
			),
		),
	);
	bean_add_meta_box( $meta_box );

	$meta_box = array(
		'id'          => 'portfolio-meta',
		'title'       => __( 'Portfolio Settings', 'bricks' ),
		'description' => __( '', 'bricks' ),
		'page'        => 'portfolio',
		'context'     => 'normal',
		'priority'    => 'high',
		'fields'      => array(
			array(
				'name' => __( 'Portfolio Date:', 'bricks' ),
				'id'   => $prefix . 'portfolio_date',
				'type' => 'checkbox',
				'desc' => __( 'Display the date.', 'bricks' ),
				'std'  => true,
			),
			array(
				'name' => __( 'Portfolio Client:', 'bricks' ),
				'desc' => __( 'Display the client meta.', 'bricks' ),
				'id'   => $prefix . 'portfolio_client',
				'type' => 'text',
				'std'  => '',
			),
			array(
				'name' => __( 'Portfolio Role:', 'bricks' ),
				'id'   => $prefix . 'portfolio_role',
				'type' => 'text',
				'desc' => __( 'Your role in this project.', 'bricks' ),
				'std'  => '',
			),
			array(
				'name' => __( 'Portfolio URL:', 'bricks' ),
				'desc' => __( 'Insert a URL to link your post to.', 'bricks' ),
				'id'   => $prefix . 'portfolio_url',
				'type' => 'text',
				'std'  => '',
			),
			array(
				'name' => __( 'Portfolio URL Name:', 'bricks' ),
				'desc' => __( 'Insert a name for your URL (optional).', 'bricks' ),
				'id'   => $prefix . 'portfolio_url_name',
				'type' => 'text',
				'std'  => '',
			),
			array(
				'name' => __( 'Display Categories:', 'bricks' ),
				'id'   => $prefix . 'portfolio_cats',
				'type' => 'checkbox',
				'desc' => __( 'Display the portfolio categories.', 'bricks' ),
				'std'  => true,
			),
			array(
				'name' => __( 'Display Tags:', 'bricks' ),
				'id'   => $prefix . 'portfolio_tags',
				'type' => 'checkbox',
				'desc' => __( 'Display the portfolio tags.', 'bricks' ),
				'std'  => false,
			),
			array(
				'name' => __( 'Display Custom Meta:', 'bricks' ),
				'id'   => $prefix . 'portfolio_custom_meta',
				'type' => 'checkbox',
				'desc' => __( 'Display any custom meta fields.', 'bricks' ),
				'std'  => false,
			),
		),
	);
	bean_add_meta_box( $meta_box );

	$meta_box = array(
		'id'       => 'bean-meta-box-portfolio-images',
		'title'    => __( 'Gallery Settings', 'bricks' ),
		'page'     => 'portfolio',
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
			array(
				'name'    => __( 'Gallery Layout:', 'bricks' ),
				'desc'    => __( 'Choose which layout to display for this portfolio post.', 'bricks' ),
				'id'      => $prefix . 'gallery_layout',
				'type'    => 'select',
				'std'     => 'portfolio-lightbox',
				'options' => array(
					'stacked'            => __( 'Stacked', 'bricks' ),
					'portfolio-lightbox' => __( 'Stacked Lightbox', 'bricks' ),
					'slider'             => __( 'Slideshow', 'bricks' ),
				),
			),
			array(
				'name' => __( 'Gallery Images:', 'bricks' ),
				'desc' => __( 'Upload images here for your gallery post. Once uploaded, drag & drop to reorder.', 'bricks' ),
				'id'   => $prefix . 'portfolio_upload_images',
				'type' => 'images',
				'std'  => __( 'Browse & Upload', 'bricks' ),
			),
		),
	);
	bean_add_meta_box( $meta_box );

	$meta_box = array(
		'id'       => 'bean-meta-box-portfolio-slideshow',
		'title'    => __( 'Slideshow Settings', 'bricks' ),
		'page'     => 'portfolio',
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
			array(
				'name'    => __( 'Slide Item Count:', 'bricks' ),
				'desc'    => __( 'Select the amount of images per slide.', 'bricks' ),
				'id'      => $prefix . 'slide_item_count',
				'type'    => 'select',
				'std'     => '1',
				'options' => array(
					'1' => __( '1 Item', 'bricks' ),
					'2' => __( '2 Items', 'bricks' ),
					'3' => __( '3 Items', 'bricks' ),
				),
			),
			array(
				'name'    => __( 'Slider Speed', 'bricks' ),
				'desc'    => __( 'Select your desired slider speed in ms.', 'bricks' ),
				'id'      => $prefix . 'slide_speed',
				'type'    => 'select',
				'std'     => '250',
				'options' => array(
					'100'  => __( '100ms', 'bricks' ),
					'250'  => __( '250ms', 'bricks' ),
					'500'  => __( '500ms', 'bricks' ),
					'600'  => __( '600ms', 'bricks' ),
					'700'  => __( '700ms', 'bricks' ),
					'800'  => __( '800ms', 'bricks' ),
					'900'  => __( '900ms', 'bricks' ),
					'1000' => __( '1000ms', 'bricks' ),
				),
			),
			array(
				'name' => __( 'Enable AutoPlay', 'bricks' ),
				'id'   => $prefix . 'slide_autoplay',
				'type' => 'checkbox',
				'desc' => __( 'Activate the slider autoplay property.', 'bricks' ),
				'std'  => true,
			),
			array(
				'name' => __( 'Enable AutoHeight', 'bricks' ),
				'id'   => $prefix . 'slide_autoheight',
				'type' => 'checkbox',
				'desc' => __( 'Activate the slider autoheight property.', 'bricks' ),
				'std'  => true,
			),
			array(
				'name' => __( 'Randomize Slider:', 'bricks' ),
				'id'   => $prefix . 'post_randomize',
				'type' => 'checkbox',
				'desc' => __( 'Randomize the gallery on page load.', 'bricks' ),
				'std'  => false,
			),
		),
	);
	bean_add_meta_box( $meta_box );

	$meta_box = array(
		'id'       => 'bean-meta-box-portfolio-audio',
		'title'    => __( 'Audio Settings', 'bricks' ),
		'page'     => 'portfolio',
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
			array(
				'name' => __( 'MP3 File URL:', 'bricks' ),
				'desc' => __( '', 'bricks' ),
				'id'   => $prefix . 'audio_mp3',
				'type' => 'file',
				'std'  => '',
			),
		),
	);
	bean_add_meta_box( $meta_box );

	$meta_box = array(
		'id'       => 'bean-meta-box-portfolio-video',
		'title'    => __( 'Video Settings', 'bricks' ),
		'page'     => 'portfolio',
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
			array(
				'name' => __( 'Embed 1:', 'bricks' ),
				'desc' => __( 'Insert your embeded code here.', 'bricks' ),
				'id'   => $prefix . 'portfolio_embed_code',
				'type' => 'textarea',
				'std'  => '',
			),
			array(
				'name' => __( 'Embed 2:', 'bricks' ),
				'desc' => __( 'Insert your embeded code here.', 'bricks' ),
				'id'   => $prefix . 'portfolio_embed_code_2',
				'type' => 'textarea',
				'std'  => '',
			),
			array(
				'name' => __( 'Embed 2:', 'bricks' ),
				'desc' => __( 'Insert your embeded code here.', 'bricks' ),
				'id'   => $prefix . 'portfolio_embed_code_3',
				'type' => 'textarea',
				'std'  => '',
			),
			array(
				'name' => __( 'Embed 3:', 'bricks' ),
				'desc' => __( 'Insert your embeded code here.', 'bricks' ),
				'id'   => $prefix . 'portfolio_embed_code_4',
				'type' => 'textarea',
				'std'  => '',
			),
		),

	);
	bean_add_meta_box( $meta_box );
}
add_action( 'add_meta_boxes', 'bean_metabox_portfolio' );
