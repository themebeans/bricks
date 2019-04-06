<?php
/**
 * The file is for creating the blog post type meta.
 * Meta output is defined on the page editor.
 * Corresponding meta functions are located in framework/metaboxes.php
 *
 * @package     Bricks
 * @link        https://themebeans.com/themes/bricks
 */

function bean_metabox_post() {

	$prefix = '_bean_';

	$meta_box = array(
		'id'       => 'bean-meta-box-audio',
		'title'    => __( 'Audio Post Format Settings', 'bricks' ),
		'page'     => 'post',
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
			array(
				'name' => __( 'MP3 File URL:', 'bricks' ),
				'desc' => __( 'Upload or link to an MP3 file.', 'bricks' ),
				'id'   => $prefix . 'audio_mp3',
				'type' => 'file',
				'std'  => '',
			),
		),
	);
	bean_add_meta_box( $meta_box );

	$meta_box = array(
		'id'       => 'bean-meta-box-image',
		'title'    => __( 'Post Media Uploader', 'bricks' ),
		'page'     => 'post',
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
			array(
				'name' => 'Gallery Images:',
				'desc' => 'Upload images here for your gallery post. Once uploaded, drag & drop to reorder.',
				'id'   => $prefix . 'post_upload_images',
				'type' => 'images',
				'std'  => __( 'Browse & Upload', 'bricks' ),
			),
		),
	);
	bean_add_meta_box( $meta_box );

	$meta_box = array(
		'id'       => 'bean-meta-box-gallery',
		'title'    => __( 'Gallery Post Format Settings', 'bricks' ),
		'page'     => 'post',
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
				'name' => __( 'Randomize Gallery:', 'bricks' ),
				'id'   => $prefix . 'post_randomize',
				'type' => 'checkbox',
				'desc' => __( 'Randomize the gallery on page load.', 'bricks' ),
				'std'  => false,
			),
		),
	);
	bean_add_meta_box( $meta_box );

	$meta_box = array(
		'id'       => 'bean-meta-box-link',
		'title'    => __( 'Link Post Format Settings', 'bricks' ),
		'page'     => 'post',
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
			array(
				'name' => __( 'Link URL:', 'bricks' ),
				'desc' => __( 'ex: http://themebeans.com', 'bricks' ),
				'id'   => $prefix . 'link_url',
				'type' => 'text',
				'std'  => 'http://',
			),
		),

	);
	bean_add_meta_box( $meta_box );

	$meta_box = array(
		'id'       => 'bean-meta-box-quote',
		'title'    => __( 'Quote Post Format Settings', 'bricks' ),
		'page'     => 'post',
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
			array(
				'name' => __( 'Quote Text:', 'bricks' ),
				'desc' => __( 'Insert your quote into this textarea.', 'bricks' ),
				'id'   => $prefix . 'quote',
				'type' => 'textarea',
				'std'  => '',
			),
			array(
				'name' => __( 'Quote Source:', 'bricks' ),
				'desc' => __( 'Who said the quote above?', 'bricks' ),
				'id'   => $prefix . 'quote_source',
				'type' => 'text',
				'std'  => '',
			),
		),

	);
	bean_add_meta_box( $meta_box );

	$meta_box = array(
		'id'       => 'bean-meta-box-video',
		'title'    => __( 'Video Post Format Settings', 'bricks' ),
		'page'     => 'post',
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
			array(
				'name' => __( 'Embeded Code:', 'bricks' ),
				'desc' => __( 'Include your video embed code here.', 'bricks' ),
				'id'   => $prefix . 'video_embed',
				'type' => 'textarea',
				'std'  => '',
			),
			array(
				'name' => __( 'Embeded Video URL:', 'bricks' ),
				'desc' => __( 'The direct URL to your embedded video.', 'bricks' ),
				'id'   => $prefix . 'video_embed_url',
				'type' => 'text',
				'std'  => '',
			),
		),
	);
	bean_add_meta_box( $meta_box );
}
add_action( 'add_meta_boxes', 'bean_metabox_post' );
