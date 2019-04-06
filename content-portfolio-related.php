<?php
/**
 * The file for displaying the related post loop beside the single post.
 * It is called via the related posts function in functions.php.
 * You can set the count via the $related_items_count variable.
 *
 * @package     Bricks
 * @link        https://themebeans.com/themes/bricks
 */

// RELATED QUERY
$related_items_count = -1;
$related             = bean_get_related_posts( $post->ID, 'portfolio_category', array( 'posts_per_page' => $related_items_count ) );
$i                   = 1;

if ( $related->post_count != 0 ) { ?>

	<div id="projects" class="projects-grid">

		<?php
		while ( $related->have_posts() ) :
			$related->the_post();
			get_template_part( 'loop-portfolio' );
			$i++;
endwhile;
		wp_reset_postdata();
		?>

	</div>

<?php
}
