<?php
/**
 * The template for displaying the default searchform whenever it is called in the theme.
 *
 * @package     Bricks
 * @link        https://themebeans.com/themes/bricks
 */
	?>

<form method="get" id="searchform" class="searchform" action="<?php echo home_url(); ?>/">
	<input type="text" name="s" id="s" value="<?php esc_html_e( 'Search...', 'bricks' ); ?>" onfocus="if(this.value=='<?php esc_html_e( 'Search...', 'bricks' ); ?>')this.value='';" onblur="if(this.value=='')this.value='<?php esc_html_e( 'Search...', 'bricks' ); ?>';" />
</form><!-- END #searchform -->
