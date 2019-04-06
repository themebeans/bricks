<?php
/**
 * The file is for creating the page post type meta.
 * Meta output is defined on the page editor.
 * Corresponding meta functions are located in framework/metaboxes.php
 *
 * @package     Bricks
 * @link        https://themebeans.com/themes/bricks
 */

function bean_metabox_page() {

	$prefix = '_bean_';

	$meta_box = array(
		'id'       => 'page-meta',
		'title'    => __( 'Page Meta Settings', 'bricks' ),
		'page'     => 'page',
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
			array(
				'name' => 'Display Page Title:',
				'id'   => $prefix . 'page_title',
				'type' => 'checkbox',
				'desc' => 'Select to display the page title above the main entry content.',
				'std'  => true,
			),
			array(
				'name'    => __( 'Page Layout:', 'bricks' ),
				'desc'    => __( 'Select your page layout.', 'bricks' ),
				'id'      => $prefix . 'page_layout',
				'type'    => 'radio',
				'std'     => 'std',
				'options' => array(
					'std'   => __( 'Standard', 'bricks' ),
					'full'  => __( 'Fullwidth', 'bricks' ),
					'right' => __( 'Sidebar', 'bricks' ),
				),
			),
		),
	);
	bean_add_meta_box( $meta_box );
}
add_action( 'add_meta_boxes', 'bean_metabox_page' );
