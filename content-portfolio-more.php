<?php
/**
 * The file for displaying the more portfolio loop below the portfolio single.
 * It is called via the single-portfolio.php.
 *
 * @package     Bricks
 * @link        https://themebeans.com/themes/bricks
 */

$args = array(
	'post_type'      => 'portfolio',
	'order'          => 'DSC',
	'orderby'        => 'rand',
	'posts_per_page' => '50',
	'post__not_in'   => array( $post->ID ),
);

?>

<div id="projects" class="projects-grid">

		<?php
		query_posts( $args );
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				get_template_part( 'loop-portfolio' );
			 endwhile;
endif;
		wp_reset_query();
		?>

 </div><!-- END .projects-grid -->
