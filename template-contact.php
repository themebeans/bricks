<?php
/**
 * Template Name: Contact
 * The template for displaying the contact template.
 *
 * @package     Bricks
 * @link        https://themebeans.com/themes/bricks
 */

get_header();

// PAGE META
$page_title  = get_post_meta( $post->ID, '_bean_page_title', true );
$page_layout = get_post_meta( $post->ID, '_bean_page_layout', true );

// CONTACT CODE
if ( isset( $_POST['submitted'] ) ) {
	if ( trim( $_POST['contactName'] ) === '' ) {
		$hasError = true;
	} else {
		$name = trim( $_POST['contactName'] );
	}

	if ( trim( $_POST['email'] ) === '' ) {
		$hasError = true;
	} elseif ( ! is_email( trim( $_POST['email'] ) ) ) {
		$hasError = true;
	} else {
		$email = trim( $_POST['email'] );
	}

	if ( trim( $_POST['comments'] ) === '' ) {
		$hasError = true;
	} else {
		if ( function_exists( 'stripslashes' ) ) {
			$comments = stripslashes( trim( $_POST['comments'] ) );
		} else {
			$comments = trim( $_POST['comments'] );
		}
	}

		do_action( 'bean_after_contactform_errors' );

	if ( ! isset( $hasError ) ) {

		$site_name    = get_bloginfo( 'name' );
		$contactEmail = get_theme_mod( 'admin_custom_email' );

		if ( ! isset( $contactEmail ) || ( $contactEmail == '' ) ) {
			$contactEmail = get_option( 'admin_email' );
		}

		$subject_content = '[' . $site_name . ' Contact Form]';
		$subject         = apply_filters( 'bean_contactform_emailsubject', $subject_content );

		$body_content = "Name: $name \n\nEmail: $email \n\nMessage: $comments";
		$body         = apply_filters( 'bean_contactform_emailbody', $body_content );

		$headers = 'Reply-To: ' . $email;
		/*
		By default, this form will send from wordpress@yourdomain.com in order to work with
		a number of web hosts' anti-spam measures. If you want the from field to be the
		user sending the email, please uncomment the following line of code.
		*/
		// $headers = 'From: '.$name.' <'.$email.'>' . "\r\n" . 'Reply-To: ' . $email;
		wp_mail( $contactEmail, $subject, $body, $headers );
		$emailSent = true;
	}
}

if ( $page_layout === 'right' ) { ?>

	<div class="primary-sidebar">
		<?php dynamic_sidebar( 'internal-sidebar' ); ?>
	</div><!-- END .primary-sidebar -->

<?php } ?>

<article id="post-<?php the_ID(); ?>" class="primary-content
									<?php
									echo esc_html( $page_layout );
									if ( $page_layout != 'right' ) {
										echo ' no-sidebar'; }
	?>
	">

	<?php if ( ( function_exists( 'has_post_thumbnail' ) ) && ( has_post_thumbnail() ) ) { ?>

		<div class="entry-media">
			<?php the_post_thumbnail( 'post-feat' ); ?>
		</div><!-- END .entry-media -->

	<?php } //END if ( (function_exists('has_post_thumbnail')) ?>

	<div class="entry-content">

		<div class="contact-content">

			<?php
			if ( $page_title == 'on' ) {
?>
<h1 class="entry-title"><?php the_title( '' ); ?></h1><?php } ?>

			<?php
			while ( have_posts() ) :
				the_post();
				the_content();
endwhile; // THE LOOP
?>

			<?php
			wp_link_pages(
				array(
					'before' => '<div class="page-link"><span>' . __( 'Pages:', 'bricks' ) . '</span>',
					'after'  => '</div>',
				)
			);
			?>

			<?php
			if ( $page_layout === 'full' ) {
				dynamic_sidebar( 'Contact Sidebar' ); }
				?>

		</div><!-- END .contact-content -->

		<?php if ( get_theme_mod( 'bean_contact_form' ) == true ) { // IF CONTACT FORM IS TRUE VIA CUSTOMIZER ?>

			<?php $required = '<span class="required">*</span>'; ?>

			<form action="<?php the_permalink(); ?>" id="BeanForm" method="post">

				<?php if ( isset( $emailSent ) && $emailSent == true ) { ?>

					<div class="contact-alert success">

						<?php echo apply_filters( 'bean_contactform_success_msg', esc_html__( 'Your message was sent. Thanks.', 'bricks' ) ); ?>

					</div><!-- END .alert alert-success -->

				<?php } // END SUCCESS ALERT ?>

				<?php if ( isset( $hasError ) || isset( $captchaError ) ) { ?>

					<div class="contact-alert fail">

						<?php echo apply_filters( 'bean_contactform_error_msg', esc_html__( 'An error occured. Try again.', 'bricks' ) ); ?>

					</div><!-- END .alert alert-success -->

				<?php } // END FAIL ALERT ?>

				<ul class="bean-contactform">

					<li class="name">
						<label for="contactName">
						<?php
						_e( 'Name', 'bricks' );
						echo esc_html( $required;
?>
</label>
						<input type="text" name="contactName" id="contactName" value="
						<?php
						if ( isset( $_POST['contactName'] ) ) {
							echo $_POST['contactName'];}
?>
" class="required requiredField" />
					</li>

					<?php do_action( 'bean_after_contactform_namefield' ); ?>

					<li class="email">
						<label for="email">
						<?php
						_e( 'Email', 'bricks' );
						echo $required;
?>
</label>
						<input type="text" name="email" id="email" value="
						<?php
						if ( isset( $_POST['email'] ) ) {
							echo $_POST['email'];}
?>
" class="required requiredField email" />
					</li>

					<?php do_action( 'bean_after_contactform_emailfield' ); ?>

					<li class="textarea"><label for="commentsText">
					<?php
					_e( 'Message', 'bricks' );
					echo $required;
?>
</label>
						<textarea name="comments" id="commentsText" rows="20" cols="30" class="required requiredField">
						<?php
						if ( isset( $_POST['comments'] ) ) {
							if ( function_exists( 'stripslashes' ) ) {
								echo stripslashes( $_POST['comments'] );
							} else {
								echo $_POST['comments']; }
						}
?>
</textarea>
					</li>

					<?php do_action( 'bean_after_contactform_allfields' ); ?>

					<li class="submit">
						<input type="hidden" name="submitted" id="submitted" value="true" />
						<button type="submit" class="button"><?php echo get_theme_mod( 'contact_button_text', 'Send Message', 'bricks' ); ?></button>
					</li>

					<?php do_action( 'bean_after_contactform_submit' ); ?>

				</ul>

			</form><!-- END #BeanForm -->

		<?php } // END if( get_theme_mod( 'bean_contact_form' ) == true ) ?>

	</div><!-- END .entry-content -->

</article>

<?php
get_footer();
