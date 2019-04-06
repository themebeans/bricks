<?php
/**
 * The file for displaying the related portfolio loop below the portfolio single.
 * It is called via the related posts function in functions.php.
 * You can set the count via the $related_items_count variable.
 *
 * @package     Bricks
 * @link        https://themebeans.com/themes/bricks
 */

wp_reset_query();

// SETTING UP META
$portfolio_date        = get_post_meta( $post->ID, '_bean_portfolio_date', true );
$portfolio_url         = get_post_meta( $post->ID, '_bean_portfolio_url', true );
$portfolio_url_name    = get_post_meta( $post->ID, '_bean_portfolio_url_name', true );
$portfolio_client      = get_post_meta( $post->ID, '_bean_portfolio_client', true );
$portfolio_role        = get_post_meta( $post->ID, '_bean_portfolio_role', true );
$portfolio_cats        = get_post_meta( $post->ID, '_bean_portfolio_cats', true );
$portfolio_tags        = get_post_meta( $post->ID, '_bean_portfolio_tags', true );
$portfolio_custom_meta = get_post_meta( $post->ID, '_bean_portfolio_custom_meta', true );
?>

<div class="entry-meta">

	<?php if ( $portfolio_date == 'on' ) { ?>
		<p class="published">
			<strong><?php esc_html_e( 'Date:', 'bricks' ); ?></strong>
			<?php the_time( 'M Y' ); ?></li>
		</p>
	<?php } ?>


	<?php if ( $portfolio_client ) { // DISPLAY CLIENT ?>
		<p class="client">
			<strong><?php esc_html_e( 'Client:', 'bricks' ); ?></strong>
			<?php echo esc_html( $portfolio_client ); ?>
		</p>
	<?php } ?>

	<?php if ( $portfolio_role ) { // DISPLAY CLIENT ?>
		<p class="role">
			<strong><?php esc_html_e( 'Role:', 'bricks' ); ?></strong>
			<?php echo esc_html( $portfolio_role ); ?>
		</p>
	<?php } ?>

	<?php if ( $portfolio_url ) { // DISPLAY CLIENT ?>
		<p class="url">
			<strong><?php esc_html_e( 'URL:', 'bricks' ); ?></strong>
			<?php if ( $portfolio_url_name ) { // DISPLAY PORTFOLIO URL ?>
				<a href="<?php echo esc_url( $portfolio_url ); ?>" target="blank"><?php echo esc_html( $portfolio_url_name ); ?></a>
			<?php } else { ?>
				<a href="<?php echo esc_url( $portfolio_url ); ?>" target="blank"><?php echo esc_html( $portfolio_url ); ?></a>
			<?php } // IF NO URL ?>
		</p>
	<?php } ?>

	<?php if ( $portfolio_cats == 'on' ) { // DISPLAY TAGS ?>
		<?php $terms = get_the_terms( $post->ID, 'portfolio_category' ); ?>
		<?php if ( $terms && ! is_wp_error( $terms ) ) : ?>
			<p class="category">
				<strong><?php esc_html_e( 'In:', 'bricks' ); ?></strong>
				<?php the_terms( $post->ID, 'portfolio_category', '', ', ', '' ); ?>
			</p>
		<?php endif; ?>
	<?php } ?>

	<?php if ( $portfolio_tags == 'on' ) { // DISPLAY CATEGORY ?>
		<p class="tags">
			<strong><?php esc_html_e( 'Tags:', 'bricks' ); ?></strong>
			<?php the_terms( $post->ID, 'portfolio_tag', '', '', '' ); ?>
		</p>
	<?php } ?>

	<?php if ( $portfolio_custom_meta == 'on' ) { // DISPLAY CATEGORY ?>
		<?php the_meta(); ?>
	<?php } ?>

	<?php if ( get_theme_mod( 'show_portfolio_sharing' ) == true ) { ?>
		<?php get_template_part( 'content', 'post-social' ); ?>
	<?php } ?>

</div><!-- END .entry-meta-->
