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
	$wrap_search                                = 'wrap-search';
	$search_form                                = 'search';
	$search_field                               = 'search-field';
} else {
	++$GLOBALS['nightingale_search_form_counter'];
	$searchid      = $GLOBALS['nightingale_search_form_counter'];
	$wrap_search   = 'wrap-search-' . $searchid;
	$search_form   = 'search-' . $searchid;
	$search_field  = 'search-field' . $searchid;
}

?>
<search class="nhsuk-header__search" id="<?php echo esc_attr( $wrap_search ); ?>">
	<form class="nhsuk-header__search-form" id="<?php echo esc_attr( $search_form ); ?>" action="/" method="get" novalidate>
		<div class="nhsuk-form-group">
			<label class="nhsuk-label nhsuk-u-visually-hidden" for="<?php echo esc_attr( $search_field ); ?>"><?php esc_html_e( 'Search this website', 'nightingale' ); ?></label>
			<div class="nhsuk-input-wrapper">
				<input class="nhsuk-input" id="<?php echo esc_attr( $search_field ); ?>" name="s" type="search" placeholder="<?php echo esc_attr__( 'Search', 'nightingale' ); ?>" autocomplete="off">
				<button class="nhsuk-button nhsuk-button--icon nhsuk-button--small" data-module="nhsuk-button" type="submit" aria-label="<?php echo esc_attr__( 'Search', 'nightingale' ); ?>">
					<svg class="nhsuk-icon nhsuk-icon--search" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" focusable="false" aria-hidden="true">
						<path d="m20.7 18.9-4.1-4.1a7 7 0 1 0-1.4 1.4l4 4.1a1 1 0 0 0 1.5 0c.4-.4.4-1 0-1.4ZM6 10.6a5 5 0 1 1 10 0 5 5 0 0 1-10 0Z"/>
					</svg>
				</button>
			</div>
		</div>
	</form>
</search>
