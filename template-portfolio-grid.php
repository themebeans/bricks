<?php
/**
 * Template Name: Portfolio Grid
 * The template for displaying the portfolio layout.
 *
 * @package     Bricks
 * @link        https://themebeans.com/themes/bricks
 */

get_header(); ?>

<div id="projects" class="projects-grid">

	<?php get_template_part( 'content', 'portfolio' ); // PULL CONTENT-PORTFOLIO.PHP ?>

</div><!-- END .projects-grid -->

<?php
get_footer();
