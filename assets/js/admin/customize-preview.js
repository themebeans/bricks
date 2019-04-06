/**
 * This file adds some LIVE to the Theme Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. This javascript will grab settings from customizer controls, and
 * then make any necessary changes to the page using jQuery.
 */

( function( $ ) {

	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		});
	});

	wp.customize( 'custom_logo', function( value ) {
		value.bind( function( to ) {

			if ( to ) {

				$( 'h1.site-title' ).css({
					clip: 'rect(1px, 1px, 1px, 1px)',
					position: 'absolute'
				});

			} else {

				// Give it a few ms to remove the image before we show the title back.
				setTimeout( function() {
					$( 'h1.site-title' ).css({
						clip: 'auto',
						position: 'relative'
					});

					$( 'h1.site-title' ).removeClass( 'hidden' );
				}, 900 );
			}
		} );
	} );

	wp.customize( 'custom_logo_max_width', function( value ) {
		value.bind( function( to ) {
			var style, el;

			style = '<style class="custom_logo_max_width">@media (min-width: 600px) { body .custom-logo-link img.custom-logo { width: ' + to + 'px; } }</style>';

			el =  $( '.custom_logo_max_width' );

			if ( el.length ) {
				el.replaceWith( style );
			} else {
				$( 'head' ).append( style );
			}
		} );
	} );

	wp.customize( 'hidden_sidebar', function( value ) {
		value.bind( function( to ) {

			if ( true === to ) {

				$( '#nav-toggle' ).css({
					clip: 'auto',
					position: 'relative'
				});

				$( '#nav-toggle' ).removeClass( 'hidden' );

			} else {

				$( '#nav-toggle' ).css({
					clip: 'rect(1px, 1px, 1px, 1px)',
					position: 'absolute'
				});
			}
		});
	});

} )( jQuery );
