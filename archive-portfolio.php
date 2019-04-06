<?php
/**
 * The template for displaying the default portfolio archive view
 *
 * Used to display archive-type pages for portfolio posts.
 * If you'd like to further customize these taxonomy views, you may create a
 * new template file for each specific one. This file has taxonomy-portfolio_category.php
 * and taxonomy-portfolio_tag.php pointing to it.
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
