<?php
/**
 * The template for displaying search form
 *
 *
 *
 * @package Nightingale_2.0
 */
?>
<?php
//$searched = the_search_query();
if (!empty(get_search_query())) {
    $query = get_search_query();
} else {
    $query = 'Search';
}
?>
<button class="nhsuk-header__search-toggle" id="toggle-search" aria-controls="wrap-search" aria-label="Open search">
    <svg class="nhsuk-icon nhsuk-icon__search" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
        <path d="M19.71 18.29l-4.11-4.1a7 7 0 1 0-1.41 1.41l4.1 4.11a1 1 0 0 0 1.42 0 1 1 0 0 0 0-1.42zM5 10a5 5 0 1 1 5 5 5 5 0 0 1-5-5z"></path>
    </svg>
    <span class="nhsuk-u-visually-hidden">Search</span>
</button>
<div class="nhsuk-header__search-wrap" id="wrap-search">
    <form class="nhsuk-header__search-form" id="searchform" action="<?php echo home_url( '/' ); ?>" method="get"
          role="search">
        <label class="nhsuk-u-visually-hidden" for="ss">Search this NHS website</label>
        <div class="autocomplete-container" id="autocomplete-container"><div class="autocomplete__wrapper"
                                                                             role="combobox"
                                                                             aria-expanded="false"><div
                        aria-atomic="true" aria-live="polite" role="status" style="border: 0px; clip: rect(0px, 0px,
                        0px, 0px); height: 1px; margin-bottom: -1px; margin-right: -1px; overflow: hidden; padding:
                        0px; position: absolute; white-space: nowrap; width: 1px;">Type in 2 or more characters for
                    results.<span>,,</span></div><input aria-owns="search-field__listbox" autocomplete="off"
                                                        class="autocomplete__input autocomplete__input--default"
                                                        id="ss" name="s" placeholder="<?php echo $query; ?>"
                                                        type="text"><ul class="autocomplete__menu autocomplete__menu--inline autocomplete__menu--hidden" id="search-field__listbox" role="listbox" style="width: 279px; top: 92px;"></ul></div></div>

        <button class="nhsuk-search__submit" type="submit">
            <svg class="nhsuk-icon nhsuk-icon__search" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                <path d="M19.71 18.29l-4.11-4.1a7 7 0 1 0-1.41 1.41l4.1 4.11a1 1 0 0 0 1.42 0 1 1 0 0 0 0-1.42zM5 10a5 5 0 1 1 5 5 5 5 0 0 1-5-5z"></path>
            </svg>
            <span class="nhsuk-u-visually-hidden">Search</span>
        </button>
        <button class="nhsuk-search__close" id="close-search">
            <svg class="nhsuk-icon nhsuk-icon__close" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                <path d="M13.41 12l5.3-5.29a1 1 0 1 0-1.42-1.42L12 10.59l-5.29-5.3a1 1 0 0 0-1.42 1.42l5.3 5.29-5.3 5.29a1 1 0 0 0 0 1.42 1 1 0 0 0 1.42 0l5.29-5.3 5.29 5.3a1 1 0 0 0 1.42 0 1 1 0 0 0 0-1.42z"></path>
            </svg>
            <span class="nhsuk-u-visually-hidden">Close search</span>
        </button>
    </form>
</div>

