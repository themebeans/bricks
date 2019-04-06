<?php
/**
 * The file for displaying the mobile portfolio filter.
 * It is called via header.php.
 *
 * @package     Bricks
 * @link        https://themebeans.com/themes/bricks
 */

// PULL CATEGORIES TO USE ON FILTER
$terms = get_terms( 'portfolio_category' );
?>

<div class="mobile-project-filter">

	 <span class="filter" data-filter="all"><?php echo __( 'All', 'bricks' ); ?></span>
														<?php
														foreach ( $terms as $term ) {
															echo '<span class="filter" data-filter=".' . $term->term_id . '">' . $term->name . '</span>';
														}
			?>
		  <span class="sort" data-sort="random"><?php echo __( 'Randomize', 'bricks' ); ?></span>

</div><!-- END .mobile-project-filter -->
