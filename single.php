<?php
/**
 * The template for displaying all single posts.
 *
 * @package     Bricks
 * @link        https://themebeans.com/themes/bricks
 */

get_header();

// POST META
$orderby         = get_post_meta( $post->ID, '_bean_post_randomize', true );
$orderby         = ( $orderby == 'off' ) ? 'post__in' : 'rand';
$link            = get_post_meta( $post->ID, '_bean_link_url', true );
$link_title      = get_post_meta( $post->ID, '_bean_link_title', true );
$quote           = get_post_meta( $post->ID, '_bean_quote', true );
$quote_source    = get_post_meta( $post->ID, '_bean_quote_source', true );
$embed           = get_post_meta( $post->ID, '_bean_video_embed', true );
$video_embed_url = get_post_meta( $post->ID, '_bean_video_embed_url', true );

// VIEW COUNTER
bean_setPostViews( get_the_ID() );

// OPTIONAL SIDEBAR
if ( get_theme_mod( 'show_blogroll_sidebar' ) == true ) {
	if ( is_active_sidebar( 'internal-sidebar' ) ) { ?>

		<div class="primary-sidebar">
			<?php dynamic_sidebar( 'Internal Sidebar' ); } ?>
		</div><!-- END .primary-sidebar -->

<?php } ?>

<div class="primary-content
<?php
if ( get_theme_mod( 'show_blogroll_sidebar' ) == false ) {
	echo 'no-sidebar'; }
?>
">

	<?php
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
?>

				<?php get_template_part( 'loop', 'post' ); ?>

			<?php
	endwhile;
endif;
?>

</div><!-- END .primary-content -->

<?php
get_footer();
