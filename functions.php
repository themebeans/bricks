<?php
/**
 * Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package     Bricks
 * @link        https://themebeans.com/themes/bricks
 */

if ( ! defined( 'BRICKS_DEBUG' ) ) :
	/**
	 * Check to see if development mode is active.
	 * If set to false, the theme will load un-minified assets.
	 */
	define( 'BRICKS_DEBUG', false );
endif;

if ( ! defined( 'BRICKS_ASSET_SUFFIX' ) ) :
	/**
	 * If not set to true, let's serve minified .css and .js assets.
	 * Don't modify this, unless you know what you're doing!
	 */
	if ( ! defined( 'BRICKS_DEBUG' ) || true === BRICKS_DEBUG ) {
		define( 'BRICKS_ASSET_SUFFIX', null );
	} else {
		define( 'BRICKS_ASSET_SUFFIX', '.min' );
	}
endif;

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function bricks_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Tabor, use a find and replace
	 * to change 'bricks' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'bricks', get_parent_theme_file_path( '/languages' ) );

	/*
	 * Add default posts and comments RSS feed links to head.
	 */
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/**
	 * Filter Bricks' custom-background support argument.
	 *
	 * @param array $args {
	 *     An array of custom-background support arguments.
	 * }
	 */
	add_theme_support(
		'custom-background',
		apply_filters(
			'bricks_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'post-feat', 800, 9999, false );
	add_image_size( 'port-full', 9999, 9999, false );
	add_image_size( 'grid-feat', 9999, 200, false );
	add_image_size( 'grid-feat@2x', 9999, 400, false );
	add_image_size( 'grid-feat-mobile', 9999, 60, false );
	add_image_size( 'grid-feat-mobile@2x', 9999, 120, false );

	/*
	 * This theme uses wp_nav_menu() in the following locations.
	 */
	register_nav_menus(
		array(
			'primary-menu' => __( 'Primary Navigation', 'bricks' ),
		)
	);

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		)
	);

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support(
		'post-formats', array(
			'aside',
			'audio',
			'image',
			'gallery',
			'link',
			'quote',
			'video',
		)
	);

	/*
	 * Enable support for the WordPress default Theme Logo
	 * See: https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo', array(
			'flex-width' => true,
		)
	);

	/*
	 * Enable support for Customizer Selective Refresh.
	 * See: https://make.wordpress.org/core/2016/02/16/selective-refresh-in-the-customizer/
	 */
	add_theme_support( 'customize-selective-refresh-widgets' );

}
add_action( 'after_setup_theme', 'bricks_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function bricks_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'bricks_content_width', 800 );
}
add_action( 'after_setup_theme', 'bricks_content_width', 0 );

/**
 * Register widget areas.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function bricks_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Sidebar', 'bricks' ),
			'description'   => __( 'Widget area for the primary sidebar.', 'bricks' ),
			'id'            => 'internal-sidebar',
			'before_widget' => '<div class="widget post %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<p class="widget-title">',
			'after_title'   => '</p>',
		)
	);

	if ( true === get_theme_mod( 'hidden_sidebar' ) ) {
		register_sidebar(
			array(
				'name'          => __( 'Hidden Sidebar', 'bricks' ),
				'description'   => __( 'Widget area for the hidden sidebar.', 'bricks' ),
				'id'            => 'hidden-sidebar',
				'before_widget' => '<div class="widget %2$s clearfix">',
				'after_widget'  => '</div>',
				'before_title'  => '<p class="widget-title">',
				'after_title'   => '</p>',
			)
		);
	}

	register_sidebar(
		array(
			'name'          => __( 'Contact Sidebar', 'bricks' ),
			'description'   => __( 'Widget area for the primary sidebar.', 'bricks' ),
			'id'            => 'contact-sidebar',
			'before_widget' => '<div class="widget post %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<p class="widget-title">',
			'after_title'   => '</p>',
		)
	);
}
add_action( 'widgets_init', 'bricks_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function bricks_scripts() {

	// Load theme styles.
	if ( is_child_theme() ) {
		wp_enqueue_style( 'bricks-style', get_parent_theme_file_uri( '/style' . BRICKS_ASSET_SUFFIX . '.css' ), false, '@@pkg.version' );
		wp_enqueue_style( 'bricks-child-style', get_theme_file_uri( '/style.css' ), false, '@@pkg.version', 'all' );
	} else {
		wp_enqueue_style( 'bricks-style', get_theme_file_uri( '/style' . BRICKS_ASSET_SUFFIX . '.css' ), false, '@@pkg.version' );
	}

	/**
	 * Now let's check the same for the scripts.
	 */
	if ( BRICKS_DEBUG ) {

		// Vendor scripts.
		wp_enqueue_script( 'bricks-unveil', get_theme_file_uri( '/assets/js/vendors/unveil.js' ), array( 'jquery' ), '@@pkg.version', true );
		wp_enqueue_script( 'bricks-fitvids', get_theme_file_uri( '/assets/js/vendors/fitvids.js' ), array( 'jquery' ), '@@pkg.version', true );

		// Custom scripts.
		wp_enqueue_script( 'bricks-libraries', get_theme_file_uri( '/assets/js/custom/custom-libraries.js' ), array( 'jquery' ), '@@pkg.version', true );
		wp_enqueue_script( 'bricks-global', get_theme_file_uri( '/assets/js/custom/global.js' ), array( 'jquery' ), '@@pkg.version', true );

		$translation_handle = 'bricks-navigation'; // Variable for wp_localize_script.

	} else {
		wp_enqueue_script( 'bricks-vendors-min', get_theme_file_uri( '/assets/js/vendors.min.js' ), array( 'jquery' ), '@@pkg.version', true );
		wp_enqueue_script( 'bricks-custom-min', get_theme_file_uri( '/assets/js/custom.min.js' ), array( 'jquery' ), '@@pkg.version', true );

		$translation_handle = 'bricks-custom-min'; // Variable for wp_localize_script for minified javascript.
	}

	// Load the standard WordPress comments reply javascript.
	if ( is_singular( 'post' ) && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Localization.
	wp_localize_script( $translation_handle, 'WP_TEMPLATE_DIRECTORY_URI', array( 0 => get_template_directory_uri() ) );
}
add_action( 'wp_enqueue_scripts', 'bricks_scripts' );

/**
 * Enqueue JavaScript for post meta.
 *
 * @param int $hook Hook suffix for the current admin page.
 */
function bricks_metaboxes_script( $hook ) {

	// Return early if Gutenberg is deployed.
	if ( function_exists( 'register_block_type' ) ) {
		return;
	}

	// Only enqueue this script on edit screens.
	if ( 'edit.php' !== $hook && 'post.php' !== $hook && 'post-new.php' !== $hook ) {
		return;
	}

	wp_enqueue_script( 'bricks-metaboxes', get_parent_theme_file_uri( '/assets/js/admin/metaboxes.js' ), array( 'jquery' ), '@@pkg.version', true );
	wp_enqueue_style( 'bricks-metaboxes', get_parent_theme_file_uri( '/assets/css/metaboxes.css' ), false, '@@pkg.version', 'all' );
}
add_action( 'admin_enqueue_scripts', 'bricks_metaboxes_script' );

if ( ! function_exists( 'bean_picturefill' ) ) {
	function bean_picturefill( $post_id ) {
		$feat_image           = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'grid-feat' );
		$feat_image_mobile    = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'grid-feat-mobile' );
		$feat_image_2x        = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'grid-feat@2x' );
		$feat_image_2x_mobile = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'grid-feat-mobile@2x' );

		echo '<span data-picture data-alt="' . get_the_title( $post_id ) . '">';
			echo '<span data-src="' . esc_html( $feat_image[0] ) . '"></span>';
			echo '<span data-src="' . esc_html( $feat_image_mobile[0] ) . '" data-media="(max-width: 414px)"></span>';
			echo '<span data-src="' . esc_html( $feat_image_2x[0] ) . '" data-media="(max-width: 414px, -webkit-min-device-pixel-ratio: 2),(min--moz-device-pixel-ratio: 2),(-o-min-device-pixel-ratio: 2/1),(min-device-pixel-ratio: 2),(min-resolution: 192dpi),(min-resolution: 2dppx)"></span>';
			echo '<noscript><img src="' . esc_html( $feat_image[0] ) . '" alt="' . get_the_title( $post_id ) . '"></noscript>';
		echo '</span>';

	} //END function bean_picturefill()
} //END if( !function_exists( 'bean_picturefill' ) )

if ( ! function_exists( 'bean_index_pagination' ) ) {
	function bean_index_pagination( $pages = '' ) {
		global $paged;

		if ( get_query_var( 'paged' ) ) {
			 $paged = get_query_var( 'paged' );
		} elseif ( get_query_var( 'page' ) ) {
			 $paged = get_query_var( 'page' );
		} else {
			 $paged = 1;
		}

		$output    = '';
		$prev      = $paged - 1;
		$next      = $paged + 1;
		$range     = 7; // EDIT THIS IF YOU WANT TO SHOW MORE PAGES
		$showitems = ( $range * 2 ) + 1;

		if ( $pages == '' ) {
			global $wp_query;
			$pages = $wp_query->max_num_pages;
			if ( ! $pages ) {
				$pages = 1;
			}
		}

		$method = 'get_pagenum_link';
		if ( is_single() ) {
			$method = 'bean_post_pagination_link';
		}

		$archive_nav = 'bean_post_pagination_link';

		if ( 1 != $pages ) {
			$output .= "<article class='index-pagination post'>";

			$output .= ( $paged > 2 && $paged > $range + 1 && $showitems < $pages ) ? "<a href='" . $method( 1 ) . "'></a>" : '';

			$output .= ( $paged < $pages ) ? "<a href='" . $method( $next ) . "' class='next'>Next</a>" : "<a href='" . $method( $next ) . "' class='next hidden'>Next</a>";

			for ( $i = 1; $i <= $pages; $i++ ) {
				if ( 1 != $pages && ( ! ( $i >= $paged + $range + 1 || $i <= $paged - $range - 1 ) || $pages <= $showitems ) ) {
					$output .= ( $paged == $i ) ? "<a href='" . $method( $i ) . "' class='current'>" . $i . '</a>' : "<a href='" . $method( $i ) . "' class='inactive' >" . $i . '</a>';
				}
			}

			$output .= ( $paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages ) ? "<a href='" . $method( $pages ) . "'></a>" : '';

			$output .= ( $paged > 1 ) ? "<a href='" . $method( $prev ) . "' class='prev'>Previous</a>" : "<a href='" . $method( $prev ) . "' class='prev hidden'>Previous</a>";

			$output .= "</article>\n";
		}

		return $output;
	}

	function bean_post_pagination_link( $link ) {
		$url = preg_replace( '!">$!', '', _wp_link_page( $link ) );
		$url = preg_replace( '!^<a href="!', '', $url );
		return $url;
	}
}


function bricks_blank_protected_title( $title ) {
	return '%s';
}
add_filter( 'protected_title_format', 'bricks_blank_protected_title' );

function bean_password_form() {
	global $post;
	$label = 'pwbox-' . ( empty( $post->ID ) ? rand() : $post->ID );
	$o     = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
    <p>' . __( 'To view this protected post enter the password below:', 'bricks' ) . '</p>
    <label for="' . $label . '">' . __( 'Password:' ) . ' </label><input name="post_password" id="' . $label . '" type="password" /><input type="submit" name="Submit" value="' . esc_attr__( 'Submit' ) . '" />
    </form>
    ';
	return $o;
}
add_filter( 'the_password_form', 'bean_password_form' );

function bean_getPostViews( $postID ) {
	 $count_key = 'post_views_count';
	$count      = get_post_meta( $postID, $count_key, true );

	if ( $count == '' ) {
		delete_post_meta( $postID, $count_key );
		add_post_meta( $postID, $count_key, '0' );
		return '0';
	}

	 return $count;
}

function bean_setPostViews( $postID ) {
	 $count_key = 'post_views_count';
	$count      = get_post_meta( $postID, $count_key, true );

	if ( $count == '' ) {
		$count = 0;
		delete_post_meta( $postID, $count_key );
		add_post_meta( $postID, $count_key, '0' );
	} else {
		$count++;
		update_post_meta( $postID, $count_key, $count );
	}

}//end bean_setPostViews()




/*
===================================================================*/
/*
 RELATED POSTS
/*===================================================================*/
if ( ! function_exists( 'bean_get_related_posts' ) ) {
	function bean_get_related_posts( $post_id, $taxonomy, $args = array() ) {
		$terms = wp_get_object_terms( $post_id, $taxonomy );

		if ( count( $terms ) ) {
			$post      = get_post( $post_id );
			$our_terms = array();
			foreach ( $terms as $term ) {
				$our_terms[] = $term->slug;
			}

			$args  = wp_parse_args(
				$args, array(
					'post_type'    => $post->post_type,
					'post__not_in' => array( $post_id ),
					'tax_query'    => array(
						array(
							'taxonomy' => $taxonomy,
							'terms'    => $our_terms,
							'field'    => 'slug',
							'operator' => 'IN',
						),
					),
					'orderby'      => 'rand',
				)
			);
			$query = new WP_Query( $args );
			return $query;
		} else {
			return false;
		}
	} //END if ( function( 'bean_get_related_posts' ) )
} //END if ( !function_exists( 'bean_get_related_posts' ) )




/*
===================================================================*/
/*
  CUSTOM COMMENT OUTPUT
/*===================================================================*/
if ( ! function_exists( 'bean_comment' ) ) {
	function bean_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment; ?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
			<div id="comment-<?php comment_ID(); ?>" class="clearfix">

				<?php echo get_avatar( $comment, $size = '50' ); ?>

				<header class="comment-header">
					<div class="comment-author vcard">
						<?php printf( __( '<cite class="fn">%s</cite> ', 'bricks' ), get_comment_author_link() ); ?>
					</div><!-- END .comment-author.vcard -->
					<div class="comment-meta commentmetadata subtext">
						<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>"><?php printf( __( '%1$s at %2$s', 'bricks' ), get_comment_date(), get_comment_time() ); ?></a><?php edit_comment_link( __( 'Edit', 'bricks' ), ' &middot; ', '' ); ?>
											<?php
											comment_reply_link(
												array_merge(
													$args, array(
														'depth' => $depth,
														'max_depth' => $args['max_depth'],
													)
												)
											);
?>
						<?php if ( $comment->comment_approved == '0' ) : ?>
							<span class="moderation"><?php esc_html_e( 'Awaiting Moderation', 'bricks' ); ?></span>
						<?php endif; ?>
					</div><!-- END .comment-meta.commentmetadata.subtext -->
				</header>

				<div class="comment-body">
					<?php comment_text(); ?>
				</div><!-- END .comment-body -->

			</div><!-- END #comment-<?php comment_ID(); ?> -->
		</li>
		<?php
	} //END function bean_comment($comment, $args, $depth)
} //END if ( !function_exists( 'bean_comment' ) )




/*
===================================================================*/
/*
  CUSTOM PING OUTPUT
/*===================================================================*/
if ( ! function_exists( 'bean_ping' ) ) {
	function bean_ping( $comment, $args, $depth ) {
		 $GLOBALS['comment'] = $comment;
		?>

		<li id="comment-<?php comment_ID(); ?>"><?php comment_author_link(); ?>

		<?php
	} //END //function bean_ping($comment, $args, $depth)
}//END if ( !function_exists( 'bean_ping' ) )




/*
===================================================================*/
/*
  COMMENTS FORM WP 4.4 FIX
/*===================================================================*/
function bean_move_comment_field_to_bottom( $fields ) {
	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;
	return $fields;
}

add_filter( 'comment_form_fields', 'bean_move_comment_field_to_bottom' );




/*
===================================================================*/
/*
  COMMENTS FORM
/*===================================================================*/
function bean_custom_form_filters( $args = array(), $post_id = null ) {
	 global $id;

	if ( null === $post_id ) {
		$post_id = $id;
	} else {
		$id = $post_id;
	}

	$commenter     = wp_get_current_commenter();
	$user          = wp_get_current_user();
	$user_identity = $user->exists() ? $user->display_name : '';

	$fields = array(

		'author' => '
		<p class="comment-form-author">
			<label for="author">' . __( 'Name', 'bricks' ) . ( '<span class="required">*</span>' ) . '</label>
			<input id="author" name="author" type="text" tabindex="2" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" required/>
		</p>',

		'email'  => '
		<p class="comment-form-email">
			<label for="email">' . __( 'Email', 'bricks' ) . ( '<span class="required">*</span>' ) . '</label>
			<input id="email" name="email" type="text" tabindex="3" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" required/>
		</p>',

		'url'    => '
		<p class="comment-form-url">
			<label for="url">' . __( 'Website', 'bricks' ) . '</label>
			<input id="url" name="url" type="text" tabindex="4" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30"/>
		</p>',
	);

	$defaults = array(
		'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
		'comment_field'        => '<p class="comment-form-comment"><textarea id="comment" name="comment" tabindex="1" cols="45" rows="8" placeholder="' . __( 'Click here to comment', 'bricks' ) . '" required></textarea></p><a href="#" id="cancel-comment">Cancel</a>',
		'',
		'must_log_in'          => '<p class="must-log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'bricks' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
		'logged_in_as'         => '<p class="logged-in-as subtext">' . sprintf( __( 'Currently logged in as <a href="%1$s">%2$s</a> / <a href="%3$s" title="Log out of this account">Logout</a>', 'bricks' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
		'comment_notes_before' => null,
		'comment_notes_after'  => null,
		'id_form'              => 'commentform',
		'id_submit'            => 'submit',
		'class_submit'         => 'submit',
		'name_submit'          => 'submit',
		'submit_field'         => '<p class="form-submit">%1$s %2$s</a>',
		'submit_button'        => '<input name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" />',
		'title_reply'          => '',
		'title_reply_to'       => __( 'Leave a Reply to %s', 'bricks' ),
		'cancel_reply_link'    => __( 'Cancel', 'bricks' ),
		'label_submit'         => __( 'Submit Comment', 'bricks' ),
	);

	return $defaults;
}
add_filter( 'comment_form_defaults', 'bean_custom_form_filters' );


if ( ! function_exists( 'bricks_pingback_header' ) ) :
	/**
	 * Add a pingback url auto-discovery header for singularly identifiable articles.
	 */
	function bricks_pingback_header() {
		if ( is_singular() && pings_open() ) {
			echo '<link rel="pingback" href="', bloginfo( 'pingback_url' ), '">';
		}
	}
	add_action( 'wp_head', 'bricks_pingback_header' );
endif;

if ( ! function_exists( 'bricks_site_logo' ) ) :
	/**
	 * Output an <img> tag of the site logo.
	 */
	function bricks_site_logo() {

		$visibility = ( has_custom_logo() ) ? ' hidden' : null;

		do_action( 'bricks_after_site_logo' );

		the_custom_logo();

		if ( ! has_custom_logo() || is_customize_preview() ) {
			printf( '<h1 class="site-title site-logo logo %1$s" itemscope itemtype="http://schema.org/Organization"><a href="%2$s" rel="home" itemprop="url">%3$s</a></h1>', esc_attr( $visibility ), esc_url( home_url( '/' ) ), esc_html( get_bloginfo( 'name' ) ) );

		}

		do_action( 'bricks_after_site_logo' );
	}

endif;

/**
 * Media.
 */
require get_theme_file_path( '/inc/media.php' );

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';
require get_template_directory() . '/inc/customizer/customizer-css.php';

/**
 * Widgets.
 */
require get_theme_file_path( '/inc/widgets/widget-portfolio.php' );
require get_theme_file_path( '/inc/widgets/widget-portfolio-menu.php' );
require get_theme_file_path( '/inc/widgets/widget-portfolio-taxonomy.php' );
require get_theme_file_path( '/inc/widgets/widget-flickr.php' );

/**
 * Metaboxes.
 */
require get_theme_file_path( '/inc/meta/metaboxes.php' );
require get_theme_file_path( '/inc/meta/meta-page.php' );
require get_theme_file_path( '/inc/meta/meta-post.php' );
require get_theme_file_path( '/inc/meta/meta-portfolio.php' );

/**
 * Admin specific functions.
 */
require get_parent_theme_file_path( '/inc/admin/init.php' );

/**
 * Disable Merlin WP.
 */
function themebeans_merlin() {}

/**
 * Disable Dashboard Doc.
 */
function themebeans_guide() {}
