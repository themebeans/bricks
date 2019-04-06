<?php
/**
 * The template for displaying the portfolio singular page.
 *
 * @package     Bricks
 * @link        https://themebeans.com/themes/bricks
 */

get_header();

// META
$gallery_layout       = get_post_meta( $post->ID, '_bean_gallery_layout', true );
$portfolio_type_audio = get_post_meta( $post->ID, '_bean_portfolio_type_audio', true );
$portfolio_type_video = get_post_meta( $post->ID, '_bean_portfolio_type_video', true );

// VIEW COUNTER
bean_setPostViews( get_the_ID() ); ?>

<?php
if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
?>

		<article id="post-<?php the_ID(); ?>" <?php post_class( $gallery_layout ); ?>>

			<div class="primary-sidebar">

			<h1 class="entry-title"><?php the_title(); ?></h1>

			<div class="entry-content">
				<?php the_content(); ?>
			</div><!-- END .entry-content-->

			<?php if ( ! post_password_required() ) { ?>
				<?php get_template_part( 'content', 'portfolio-meta' ); ?>
			<?php } //END if ( !post_password_required() ) ?>

			</div><!-- END .primary-sidebar -->

			<div class="primary-content">

			<?php get_template_part( 'content', 'portfolio-media' ); ?>

			<?php if ( ! post_password_required() ) { ?>

				<?php
				$more_loop = get_theme_mod( 'portfolio_more_loop' );

				if ( $more_loop != '' ) {
					switch ( $more_loop ) {
						case 'related':
							$terms = get_the_terms( $post->ID, 'portfolio_category' );
							if ( $terms && ! is_wp_error( $terms ) ) :
								get_template_part( 'content', 'portfolio-related' );
								endif;

							break;
						case 'more':
							get_template_part( 'content', 'portfolio-more' );
							break;
					}
				}
				?>

			<?php } //END if ( !post_password_required() ) ?>

			</div><!-- END .primary-content -->

		</article>

	<?php
endwhile;
endif;

get_footer();
