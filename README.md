# Nightingale 2.0
#### *A WordPress theme for the NHS, based on the NHS.UK frontend library.*

:exclamation: This is a pre-release version. Do not use on production sites.

## Dependencies
 - This theme requires an active WordPress install of *version 5 or higher*
 - [ACF Pro](https://www.advancedcustomfields.com/pro/) and [nhsl-wp-blocks](https://github.com/NHSLeadership/nhsl-wp-blocks) (optional) - see below
 - You will need to either be able to run `node` either locally or on your server for the Sass SCSS files to be generated
 - This theme will pull in the [NHS.UK Frontend Library](https://github.com/nhsuk/nhsuk-frontend) via `node`
 
## Installation
 - Add to your WordPress files, in the `wp-content/themes` folder
 - If you have command line access, run `npm install` then `npm run build`. This will generate CSS files via Sass (any time you edit the SCSS, you will need to rerun `npm run build`)
 - If you don't have command line access to your server, you will need to run these commands locally to generate the output CSS before uploading
 - Activate the theme 
 - To populate the site with basic elements, we suggest the following:
   - Enable the subpages widget in the sidebar. Configuration works best if you select *use parent page as title*, *show subpages*, and *enable ul for subpages*
   - Create a top menu assigned to the Main Menu region and add your default homepage. You can add extra pages later. N.B. the top menu will only show top level links, it does not display any dropdowns for sub pages (hence the need for the subpages widget in sidebar)
   - Create a footer menu assigned to the Footer Links region and add at least one link. Again this is static links only, it has no dropdown functionality
   
## Optional but recommended
This theme works best with the [nhsl-wp-blocks](https://github.com/NHSLeadership/nhsl-wp-blocks) and [ACF Pro](https://www.advancedcustomfields.com/pro/) plugins.

Generously, the NHS has been granted a nationwide license. You can currently obtain the details from `tony.blacker@leadershipacademy.nhs.uk`.

:exclamation: ACF Pro should be installed before the nhsl-wp-blocks plugin for full functionality.
 
## Please note
 - XML/RPC will be disabled on activation of the theme. If you have a specific need to re-enable XML-RPC you may do so at the bottom of `functions.php`.
  
## Progress
 - [x] Load in the NHS Frontend library
 - [x] Style header, amend markup to match expected output
 - [x] Provide zone for WordPress controlled menu
 - [x] Provide alternative header for NHS Organisations with white logo including title
 - [x] Add Hero banner (via NHSL Blocks plugin)
 - [x] Style sidebar to match contents list styling
 - [x] Pagination styling
 - [x] Footer styling and WordPress menu inclusion
 - [x] Re-style core images output
 - [x] Re-style core buttons output
 - [x] Provide multiple button styles (via NHSL-Blocks plugin)
 - [x] Style tables
 - [x] Restrict Editor colour palettes to NHS Brand guideline colours
 - [x] Search results page layout
 - [x] Template layout code
 - [x] Typographic classes
 - [x] Custom Gutenburg Blocks (via NHSL-Blocks plugin)
 - [x] Breadcrumb trail styling and addition
 - [ ] Emergency alert
 - [ ] Feedback Banner
 - [ ] Forms elements
 - [ ] Add Gravity Forms compatibility
 - [x] Composer build (including auto load NHSL Blocks plugin)
 - [x] Dependancy hint to suggest or force plugin dependancy load (for non-composer install)
 - [ ] Widgetize footer region
 - [x] Alternative navigation aid to Tabs
 - [ ] Device checks (mobile, tablet, TV etc)
 - [ ] Print layout / styling
 - [ ] Accessibility audit
 
 ## Licence
 
 The codebase is released under the [Open Government Licence 3.0](http://www.nationalarchives.gov.uk/doc/open-government-licence/version/3/), unless stated otherwise. This covers both the codebase and any sample code in the documentation. The documentation is © Crown copyright and available under the terms of the Open Government License 3.0. Please see the [National Archives](http://www.nationalarchives.gov.uk/information-management/re-using-public-sector-information/uk-government-licensing-framework/) website for more information on the Open Government Licensing Framework.
