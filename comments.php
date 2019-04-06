<?php
/**
 * The template for displaying comments.
 * The area of the page that contains comments and the comment form.
 *
 * @package     Bricks
 * @link        https://themebeans.com/themes/bricks
 */

if ( post_password_required() ) {
	return;
} ?>

<div class="comments-wrap">

	<div class="row">

		<p class="comments-title"><?php comments_number( __( '0 Comments', 'bricks' ), __( '1 Comment', 'bricks' ), __( '% Comments', 'bricks' ) ); ?></p>

		<?php if ( ! comments_open() && is_page() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) { ?>

			<span class="nocomments"><?php esc_html_e( 'Comments are now closed', 'bricks' ); ?></span>

		<?php } ?>

		<?php
		if ( comments_open() ) {
			comment_form();
		}

		if ( ! comments_open() && have_comments() && ! is_page() ) :
		?>
			<span class="nocomments"><?php esc_html_e( 'Comments are now closed', 'bricks' ); ?></span>
		<?php
		endif;

		// DISPLAY COMMENTS
		if ( have_comments() ) {
		?>

			<div id="comments">

				<?php if ( ! empty( $comments_by_type['comment'] ) ) { ?>

					<div id="comments-list" class="comments">

						<?php
						// PAGINATION
						$total_pages = get_comment_pages_count();
						if ( $total_pages > 1 ) {
						?>
							<div id="comments-nav-above" class="comments-navigation">
								<div class="paginated-comments-links"><?php paginate_comments_links(); ?></div>
							</div><!-- END #comments-nav-above -->
						<?php } ?>

							<ol class="commentlist block">
								<?php wp_list_comments( 'type=comment&callback=bean_comment' ); ?>
							</ol>

						<?php
						$total_pages = get_comment_pages_count();
						if ( $total_pages > 1 ) {
						?>
							<div id="comments-nav-below" class="comments-navigation">
								<div class="paginated-comments-links"><?php paginate_comments_links(); ?></div>
							   </div><!-- END #comments-nav-below -->
						<?php } ?>

					</div><!-- END #comments-list.comments -->

				<?php } //END if ( ! empty($comments_by_type['comment']) ) ?>


				<?php if ( ! empty( $comments_by_type['pings'] ) ) { ?>

					<div id="comments-list" class="comments">
						<p class="comments-title"><?php esc_html_e( 'Trackbacks.', 'bricks' ); ?></p>

						<ol class="pinglist">
							<?php wp_list_comments( 'type=pings&callback=bean_ping' ); ?>
						</ol>
					</div><!-- END #comments-list .comments -->

				<?php } //END if ( ! empty($comments_by_type['pings']) ) ?>

			</div><!-- END #comments -->

		<?php }  //END if ( have_comments() ) ?>

	</div><!-- END .row -->

</div><!-- END #comments -->
