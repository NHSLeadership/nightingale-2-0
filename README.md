# Nightingale 2.0
#### *A WordPress theme for the NHS, based on the NHS.UK frontend library.*

:exclamation: This is a Release Candidate version. Do not use on production sites. `Feedback is positively encouraged,
 please see how to get involved below`

## Dependencies
 - This theme requires an active WordPress install of *version 5 or higher*
 - [Gutenberg](https://en-gb.wordpress.org/plugins/gutenberg/) - this will auto install on theme activation and is a 
 requirement. This extends the native Gutenberg WP functionality to include latest developments.
 - *optional* For any editing of the theme (in particular the css files) we strongly advise you to use the NPM 
 installation route detailed in `Optional Settings` below.
 
## Installation
 - Add to your WordPress files, in the `wp-content/themes` folder
 - Activate the theme
   - You will be prompted to install the Gutenberg plugin. Please do so and activate it. 
   - You will be advised to install Cookie Notice plugin (see `Optional Settings` section below)
 - To populate the site with basic elements, we suggest the following:
   - Enable the subpages widget in the sidebar. Configuration works best if you select *use parent page as title*, *show subpages*, and *enable ul for subpages*
   - Create a top menu assigned to the Main Menu region and add your default homepage. You can add extra pages later. N.B. the top menu will only show top level links, it does not display any dropdowns for sub pages (hence the need for the subpages widget in sidebar)
   - Create a footer menu assigned to the Footer Links region and add at least one link. Again this is static links only, it has no dropdown functionality
 
## Optional Settings
 - `Cookie Notice plugin` - This adds a cookie notice banner to your site. You can modify the text that displays, and
  this gives your users an easy to use way of opting out of cookies. This, however, is an implied consent approach to
   cookies. If you wish to have an informed consent route to cookie adoption, you will need an alternative solution.
 - If you wish to edit the styles and/or blocks, You will need to either be able to run `node` either 
    locally or on your server for the Sass SCSS files to be generated. In the nightingale-2-0 folder, after installing 
    node using `npm install`, run `npm run build` to compile your css. In the nightingale-2-0/nhsblocks folder, after 
    running `npm  install`, you can generate the ES6 required to recompile your Gutenberg blocks using `npm run build`
    - This theme will pull in the [NHS.UK Frontend Library](https://github.com/nhsuk/nhsuk-frontend) via `node` if you 
   install using the optional commands above
      
## Feedback / Improvement / Development
 - If you see any issues, faults or have suggestions for improvements, please add them as issues to our Git 
 repository so we can action them.
 - If you have developed improvements, please consider giving back to the Open Source community by submitting them as
  pull requests to this repository
  
  
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
 - [x] Native Gutenberg blocks (phase 2 to replace NHSL_Blocks quickfix)
 - [x] Breadcrumb trail styling and addition
 - [x] Emergency alert
 - [x] Feedback Banner
 - [x] Forms elements
 - [ ] Add Gravity Forms compatibility
 - [x] Add theme update routine [possible route here](https://wpmayor
 .com/how-to-integrate-wordpress-plugin-update-notifications-into-your-commercial-plugin/)
 - [x] Composer build (including auto load NHSL Blocks plugin)
 - [x] Dependancy hint to suggest or force plugin dependancy load (for non-composer install)
 - [x] Widgetize footer region
 - [x] Alternative navigation aid to Tabs
 - [x] Device checks (mobile, tablet, TV etc)
 - [x] Print layout / styling
 - [ ] Accessibility audit
 
 ## Licence
 
 The codebase is released under the [Open Government Licence 3.0](http://www.nationalarchives.gov.uk/doc/open-government-licence/version/3/), unless stated otherwise. This covers both the codebase and any sample code in the documentation. The documentation is © Crown copyright and available under the terms of the Open Government License 3.0. Please see the [National Archives](http://www.nationalarchives.gov.uk/information-management/re-using-public-sector-information/uk-government-licensing-framework/) website for more information on the Open Government Licensing Framework.
