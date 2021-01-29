<?php
/**
 * Cookie Control tweak to move the element to the top of the DOM so users on screen readers
 * or using keyboard nav get to the content first when it is present, avoidiong a confusing
 * user experience.
 *
 * @package nightingale
 */

/**
 * Function to move the DOM element using jQuery
 */
function nightingale_cookie_footer() {
	$scriptout = "
		<script>
				const cookieBlock = document.querySelector('#cookie-notice');
				if ( ( cookieBlock ) ) { 
					matches = cookieBlock.matches ? cookieBlock.matches('#cookie-notice') : cookieBlock.msMatchesSelector('#cookie-notice');
					if ( matches === true ) {
						console.log('got to here didnt we');
						const bodyWrapper = document.querySelector( 'body' );
						const headerContent = document.querySelector( '.nhsuk-header' );
						bodyWrapper.insertBefore( cookieBlock, headerContent );
					}
				}
		</script>";

	echo $scriptout; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}
/**
 * Now run the function in the footer.
 * needs weighting of 1003 to load AFTER the cookie element has been placed in footer.
 */
add_action( 'wp_footer', 'nightingale_cookie_footer', 1003 );
