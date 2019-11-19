<?php
/**
 * Customise the login page
 *
 * @package Nightingale
 * @copyright NHS Leadership Acadenightingale, Tony Blacker
 * @version 1.0 22nd October 2019
 * @param https://codex.wordpress.org/Customizing_the_Login_Form
 */

/**
 * Add in a bit of extra css for the login logo wrapper.
 */
function nightingale_login_logo() { ?>
	<style type="text/css">
		.nhsuk-header__search-wrap, .nhsuk-breadcrumb, #login h1 {
			display: none !important;
		}
		.nhsuk-main-wrapper {
			padding-top: 0 !important;
		}
	</style>
	<?php
}
add_action( 'login_enqueue_scripts', 'nightingale_login_logo' );

/**
 * Get the url for any user submitted URL
 *
 * @return string|void url
 */
function nightingale_login_logo_url() {
	return home_url();
}
add_filter( 'login_headerurl', 'nightingale_login_logo_url' );

/**
 * Add in extra divs around the header output.
 */
function nightingale_login_header_styler() {
	get_template_part( 'header' );
	echo '<div id="content" class="nhsuk-width-container nhsuk-width-container--full">
			<main class="nhsuk-main-wrapper nhsuk-main-wrapper--no-padding" id="maincontent">
				<div id="contentinner" class="nhsuk-width-container">
					<div id="primary" class="nhsuk-grid-row">
						<div class="nhsuk-grid-column-full-width">
							<div class="nhsuk-panel-with-label">
								<h3 class="nhsuk-panel-with-label__label">Login</h3>';
}
add_action( 'login_header', 'nightingale_login_header_styler' );


/**
 * Add in Nightingale Footer div closures.
 */
function nightingale_login_footer_styler() {
	echo '					</div>
						</div>
					</div>
				</div>
			</main>
		  </div>';
	get_template_part( 'footer' );
}
add_action( 'login_footer', 'nightingale_login_footer_styler' );
