<?php
/**
 * BP Object search form
 *
 * @since 3.0.0
 * @version 3.1.0
 */
?>

<div class="<?php bp_nouveau_search_container_class(); ?>" data-bp-search="<?php bp_nouveau_search_object_data_attr() ;?>">

    <button class="nhsuk-header__search-toggle" id="toggle-search" aria-controls="<?php bp_nouveau_search_selector_id( 'search-form' ); ?>" aria-label="Open search">
        <svg class="nhsuk-icon nhsuk-icon__search" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
            <path d="M19.71 18.29l-4.11-4.1a7 7 0 1 0-1.41 1.41l4.1 4.11a1 1 0 0 0 1.42 0 1 1 0 0 0 0-1.42zM5 10a5 5 0 1 1 5 5 5 5 0 0 1-5-5z"></path>
        </svg>
        <span class="nhsuk-u-visually-hidden">Search</span>
    </button>
    <div class="nhsuk-header__search-wrap" id="wrap-search">
        <form action="" method="get" class="nhsuk-header__search-form" id="<?php bp_nouveau_search_selector_id( 'search-form' ); ?>" autocomplete="off">
            <div class="autocomplete-container">
                <div class="autocomplete__wrapper">
                    <label class="nhsuk-u-visually-hidden" for="<?php bp_nouveau_search_selector_id( 'search' ); ?>">Search the NHS website</label>
                    <input class="nhsuk-search__input" id="<?php bp_nouveau_search_selector_id( 'search' ); ?>" name="<?php bp_nouveau_search_selector_name(); ?>" type="search"  placeholder="<?php bp_nouveau_search_default_text(); ?>" autocomplete="off" />
                    <button id="<?php bp_nouveau_search_selector_id( 'search-submit' ); ?>" class="nhsuk-search__submit" type="submit">
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
                </div>
            </div>
        </form>
    </div>
</div>
