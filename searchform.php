<?php
/**
 * The template for displaying search form
 *
 * @package Nightingale
 * @copyright NHS Leadership Academy, Tony Blacker
 * @version 1.1 21st August 2019
 */

if ( ! empty( get_search_query() ) ) {
	$query = get_search_query();
} else {
	$query = 'Search';
}

if ( ! isset( $GLOBALS['nightingale_search_form_counter'] ) ) {
	$GLOBALS['nightingale_search_form_counter'] = 1;
	$searchid                                   = '';
	$toggle_search                              = 'id=toggle-search';
	$wrap_search                                = 'id=wrap-search';
	$search_form                                = 'id=search';
	$search_field                               = 'search-field';
	$close_search                               = 'id=close-search';
} else {
	$GLOBALS['nightingale_search_form_counter'] ++;
	$searchid      = $GLOBALS['nightingale_search_form_counter'];
	$toggle_search = '';
	$wrap_search   = '';
	$autocomplete  = '';
	$close_search  = '';
	$search_form   = 'id=search' . $searchid . '';
	$search_field  = 'search-field' . $searchid;
}

/*
 * The nhsuk library does a call home to nhs.funnelback.co.uk to provide search suggestions from nhs.uk website.
 * We dont want that happening. Currently the only disabling is to manually rework nhsuk.js.min to remove the callback.
 * Line 1231 to line 1240 deletion seems to complete this (as of Feb 3rd 2021) of nhsuk.js, then minify this file.
 * @todo A more robust method of disabling this function. Recorded in Jira as
 * https://nhsleadership.atlassian.net/browse/DI-2912, recorded as an issue with nhsuk as
 * https://github.com/nhsuk/nhsuk-frontend/issues/568
 */
?>
<div class="nhsuk-header__search">
	<div class="nhsuk-header__search" id="wrap-search">
		<form class="nhsuk-header__search-form" <?php echo esc_attr( $search_form ); ?> id="search" action="/" method="get" role="search">
		<label class="nhsuk-u-visually-hidden" for="<?php echo esc_attr( $search_field ); ?>"><?php esc_html_e( 'Search this website', 'nightingale' ); ?></label>
			<input class="nhsuk-search__input" id="<?php echo esc_attr( $search_field ); ?>" name="s" type="search" placeholder="<?php echo esc_attr__( 'Search', 'nightingale' ); ?>" autocomplete="off">
			<button class="nhsuk-search__submit" type="submit">
				<svg class="nhsuk-icon nhsuk-icon__search" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
					aria-hidden="true" focusable="false">
					<path
						d="M19.71 18.29l-4.11-4.1a7 7 0 1 0-1.41 1.41l4.1 4.11a1 1 0 0 0 1.42 0 1 1 0 0 0 0-1.42zM5 10a5 5 0 1 1 5 5 5 5 0 0 1-5-5z">
					</path>
				</svg>
				<span class="nhsuk-u-visually-hidden"><?php echo esc_html__( 'Search', 'nightingale' ); ?></span>
			</button>
		</form>
	</div>
</div>
