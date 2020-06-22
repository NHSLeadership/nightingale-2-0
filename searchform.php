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
	$autocomplete                               = 'id=autocomplete-container';
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

?>
<button class="nhsuk-header__search-toggle" <?php echo esc_attr( $toggle_search ); ?> aria-controls="search" aria-label="Open search" aria-expanded="false">
	<svg class="nhsuk-icon nhsuk-icon__search" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
		<path d="M19.71 18.29l-4.11-4.1a7 7 0 1 0-1.41 1.41l4.1 4.11a1 1 0 0 0 1.42 0 1 1 0 0 0 0-1.42zM5 10a5 5 0 1 1 5 5 5 5 0 0 1-5-5z"></path>
	</svg>
	<span class="nhsuk-u-visually-hidden"><?php echo esc_html__( 'Search', 'nightingale' ); ?></span>
</button>
<div class="nhsuk-header__search-wrap" <?php echo esc_attr( $wrap_search ); ?>>
	<form class="nhsuk-header__search-form" <?php echo esc_attr( $search_form ); ?> action="/" method="get" role="search">
		<label class="nhsuk-u-visually-hidden" for="<?php echo esc_attr( $search_field ); ?>"><?php esc_html_e( 'Search this website', 'nightingale' ); ?></label>
		<div class="autocomplete-container" <?php echo esc_attr( $autocomplete ); ?>></div>
		<input class="nhsuk-search__input" id="<?php echo esc_attr( $search_field ); ?>" name="s" type="search" placeholder="<?php echo esc_attr__( 'Search', 'nightingale' ); ?>" autocomplete="off">
		<button class="nhsuk-search__submit" type="submit">
			<svg class="nhsuk-icon nhsuk-icon__search" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
				<path d="M19.71 18.29l-4.11-4.1a7 7 0 1 0-1.41 1.41l4.1 4.11a1 1 0 0 0 1.42 0 1 1 0 0 0 0-1.42zM5 10a5 5 0 1 1 5 5 5 5 0 0 1-5-5z"></path>
			</svg>
			<span class="nhsuk-u-visually-hidden"><?php esc_html_e( 'Search', 'nightingale' ); ?></span>
		</button>
		<button class="nhsuk-search__close" <?php echo esc_attr( $close_search ); ?>>
			<svg class="nhsuk-icon nhsuk-icon__close" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
				<path d="M13.41 12l5.3-5.29a1 1 0 1 0-1.42-1.42L12 10.59l-5.29-5.3a1 1 0 0 0-1.42 1.42l5.3 5.29-5.3 5.29a1 1 0 0 0 0 1.42 1 1 0 0 0 1.42 0l5.29-5.3 5.29 5.3a1 1 0 0 0 1.42 0 1 1 0 0 0 0-1.42z"></path>
			</svg>
			<span class="nhsuk-u-visually-hidden"><?php esc_html_e( 'Close Search', 'nightingale' ); ?></span>
		</button>
	</form>
</div>
