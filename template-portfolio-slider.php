<?php
/**
 * Template Name: Portfolio Slider
 * The template for displaying the slider portfolio layout.
 *
 * @package     Bricks
 * @link        https://themebeans.com/themes/bricks
 */

get_header(); ?>

<div id="projects" class="projects-slider">

	<?php get_template_part( 'content', 'portfolio' ); // PULL CONTENT-PORTFOLIO.PHP ?>

</div><!-- END .projects-grid -->

<?php
get_footer();
