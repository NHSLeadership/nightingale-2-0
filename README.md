# Nightingale 2.2.0
<img src="https://img.shields.io/badge/nightingale-v2.2.0-blue"> <a href="https://github.com/nhsuk/nhsuk-frontend
"><img src="https://img.shields.io/badge/nhsuk--frontend-v3.1.0-blue"></a> <a href="https://www.gnu.org/licenses/gpl-3.0.en.html"><img src="https://img.shields.io/badge/license-GPL%20(%3E%3D3)-green"></a> <a href="https://wordpress.org"><img src="https://img.shields.io/badge/WordPress-v5%20%2B-lightgrey"></a> <img src="https://img.shields.io/badge/php-5.6%2B-red"> <img src="https://img.shields.io/badge/pull%20requests-welcome-blueviolet"> <a href="https://wordpress.org/themes/nightingale"><img src="https://img.shields.io/badge/theme%20install-WP%20repo-lightgrey"></a>

#### *A WordPress theme for the NHS, based on the NHS.UK frontend library.*

:exclamation: 2.1.8 - This release removes the requirement for Gutenberg as a standalone plugin, and we strongly
 advise that unless you need the Gutenberg plugin for other functionality you remove the plugin. The NHSBlocks plugin
  no longer requires Gutenberg, instead using the core version included with WordPress, which in turn improves the
   stability of the whole ecosystem.
   
:exclamation: 2.1.0 - For WP theme review compliance, certain elements have been modified in this release. Performance tweaks, the NHS logo being displayed by default and the Frutiger font have all been removed. Please be
 aware of this before updating, and recognise you may need to modify your customiser settings after upgrade to keep
  your site looking the same
  
:exclamation: Updates to 2.0.7 will make the header region revert to standard wordpress values. If updating your theme, please pay particular attention to the site identity and header regions of the theme customiser before making your site live.

:exclamation: This is a production ready release, with the caveat that any issues should be reported as an issue on 
this repo for quick action. 
`Feedback is positively encouraged,
 please see how to get involved below`
 
### Frutiger Font ###
The Frutiger font is specified for use on NHS web properties, but is only licensed for sites ending .nhs.uk - if your
 site is both an NHS property and is on the correct domain, you can add this back in by making your own child theme
  and adding in the below font declarations to a .scss file.
  ```@font-face {
  font-family: 'Frutiger W01';
  font-display: swap;
  font-style: normal;
  font-weight: 400;
  src: url('https://assets.nhs.uk/fonts/FrutigerLTW01-55Roman.eot?#iefix');
  src: url('https://assets.nhs.uk/fonts/FrutigerLTW01-55Roman.eot?#iefix') format('eot'),
       url('https://assets.nhs.uk/fonts/FrutigerLTW01-55Roman.woff2') format('woff2'),
       url('https://assets.nhs.uk/fonts/FrutigerLTW01-55Roman.woff') format('woff'),
       url('https://assets.nhs.uk/fonts/FrutigerLTW01-55Roman.ttf') format('truetype'),
       url('https://assets.nhs.uk/fonts/FrutigerLTW01-55Roman.svg#7def0e34-f28d-434f-b2ec-472bde847115') format('svg');
}
@font-face {
  font-family: 'Frutiger W01';
  font-display: swap;
  font-style: normal;
  font-weight: 600;
  src: url('https://assets.nhs.uk/fonts/FrutigerLTW01-65Bold.eot?#iefix');
  src: url('https://assets.nhs.uk/fonts/FrutigerLTW01-65Bold.eot?#iefix') format('eot'),
       url('https://assets.nhs.uk/fonts/FrutigerLTW01-65Bold.woff2') format('woff2'),
       url('https://assets.nhs.uk/fonts/FrutigerLTW01-65Bold.woff') format('woff'),
       url('https://assets.nhs.uk/fonts/FrutigerLTW01-65Bold.ttf') format('truetype'),
       url('https://assets.nhs.uk/fonts/FrutigerLTW01-65Bold.svg#eae74276-dd78-47e4-9b27-dac81c3411ca') format('svg');
}
```
  
## Dependencies
 - This theme requires an active WordPress install of *version 5 or higher*
 - *optional* For any editing of the theme (in particular the css files) we strongly advise you to use the NPM 
 installation route detailed in `Optional Settings` below.
 
## Installation
 - Add to your WordPress files, in the `wp-content/themes` folder
 - Activate the theme
   - ~~You will be prompted to install the Gutenberg plugin. Please do so and activate it~~. 
   - You will be prompted to install the NHS Blocks plugin. Please do so and activate it. This adds pre-configured
    components to your page/post editing pages to keep within the NHSUK design framework.
   - You will be prompted to install the Nightingale Companion plugin. Please do so and activate it. This adds
    important performance and functionality improvements.
   - ~~You will be advised to install Cookie Notice plugin (see `Optional Settings` section below)~~
 - To populate the site with basic elements, we suggest the following:
   - Enable the subpages widget in the sidebar. Configuration works best if you select *use parent page as title*, *show subpages*, and *enable ul for subpages*
   - Create a top menu assigned to the Main Menu region and add your default homepage. You can add extra pages later. N.B. the top menu will only show top level links, it does not display any dropdowns for sub pages (hence the need for the subpages widget in sidebar)
   - Create a footer menu assigned to the Footer Links region and add at least one link. Again this is static links only, it has no dropdown functionality
 - Userguide for theme customiser and options is available at https://digital.leadershipacademy.nhs.uk/digital-capabilities/websites/nightingale-theme-user-guide/
 
## Optional Settings
 - This theme will suggest you pull in the [NHS.UK Frontend Library](https://github.com/nhsuk/nhsuk-frontend) via 
    `node` if you install using the optional commands above for local development of the theme itself.
    
      
## Feedback / Improvement / Development
 - If you see any issues, faults or have suggestions for improvements, please add them as issues to our Git 
 repository so we can action them.
 - If you have developed improvements, please consider giving back to the Open Source community by submitting them as
  pull requests to this repository
  
## Developing this theme's styling output
##### if you are developing this theme locally, any style changes you make will need to be reflected in the output
To accomplish this, you will need to take the following steps:
 - Install npm locally `npm install`
 - Compile the css from all the downstream libraries and local files `npm run build`
 - Compress the css output `npm run compress`
 - Regenerate the critical css `npm run critical`

Alternatively, if you only wish to modify minimal css for a single site, you can use the Custom CSS section within the theme customiser section.
   
## Please note
 - XML/RPC is still enabled - this is a WordPress default, but will trigger National Cyber Security Centre monitoring alerts. To disable XML-RPC you can add:
```add_filter('xmlrpc_enabled', '__return_false');```
To your themes functions.php file, or if your hosting permits you can disable/block it at server level.

## Compatability with plugins / WordPress extensions
This theme has been extended to style the following plugins automatically:
 - [x] Gravity Forms
 - [x] Most Gravity Perks extensions (please let us know if you are using a GP extension that is not correctly styled)
 - [x] Formidable Forms
 - [x] LearnDash - please use the latest version of LD and use the LD30 theme with no primary, secondary or tertiary colours defined
 - [x] Download Monitor
 - [x] The Events Calendar
 - [x] WP HTML Email
  
## Progress
 - [x] Load in the NHS Frontend library
 - [x] Style header, amend markup to match expected output
 - [x] Provide zone for WordPress controlled menu (Customizer)
 - [x] Provide alternative header for NHS Organisations with white logo including title
 - [x] Style sidebar to match contents list styling
 - [x] Pagination styling
 - [x] Footer styling and WordPress menu inclusion
 - [x] Re-style core images output
 - [x] Re-style core buttons output
 - [x] Provide multiple button styles (via NHSBlocks plugin)
 - [x] Style tables
 - [x] Restrict Editor colour palettes to NHS Brand guideline colours
 - [x] Search results page layout
 - [x] Template layout code
 - [x] Typographic classes
 - [x] Breadcrumb trail styling and addition
 - [x] Forms elements
 - [x] Add Gravity Forms compatibility
 - [x] Add LearnDash compatibility
 - [x] Add WP HTML Emails compatibility
 - [x] Add The Events Calendar compatability
 - [x] Add theme update routine
 - [x] Composer build (including auto load NHSL Blocks plugin)
 - [x] Dependancy hint to suggest or force plugin dependancy load (for non-composer install)
 - [x] Widgetize footer region
 - [x] Widgetize 404 page
 - [x] Alternative navigation aid to Tabs
 - [x] Device checks (mobile, tablet, TV etc)
 - [x] Print layout / styling
 - [x] Accessibility audit
 
 Deprecated / Removed
 
 - [x] Emergency alert - (moved to Nightingale-Companion plugin)
 - [x] Feedback Banner - Removed (plugin functionality rather than presentation)
 - [x] Custom Gutenburg Blocks (moved to NHSBlocks plugin)
 - [x] Native Gutenberg blocks (moved to NHSBlocks)
 - [x] Add Hero banner (moved to NHSBlocks plugin)
 - [x] Performance Improvements (moved to Nightingale-Companion plugin)
 
 ## Licence
 
 The codebase is released under the [GNU General Public License v3.0](https://www.gnu.org/licenses/gpl-3.0.en.html
 ), unless stated otherwise. The upstream NHS Frontend Library is released under the MIT license, for details please see [NHSUK Frontend](https://github.com/nhsuk/nhsuk-frontend). The documentation is © Crown copyright and available under the terms of the Open Government License 3.0. Please see the [National Archives](http://www.nationalarchives.gov.uk/information-management/re-using-public-sector-information/uk-government-licensing-framework/) website for more information on the Open Government Licensing Framework.
