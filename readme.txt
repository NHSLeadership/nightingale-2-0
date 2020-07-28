=== Nightingale 2.0 ===
Contributors: tblacker
Requires at least: 5.0
Tested up to: 5.4.2
Requires PHP: 5.6
License: GPL v3 or later
License URI: https://www.gnu.org/licenses/gpl-3.0.en.html
Theme URI: https://digital.leadershipacademy.nhs.uk/digital-capabilities/websites/nightingale-theme-user-guide/
Version: 2.2.0
Stable tag: 2.2.0


== Description ==

A responsive and accessible theme for NHS organisations based on the NHSUK Frontend Library.

== Frequently Asked Questions ==

= Can I use this on any NHS website? =
Yes, the only restriction being that you need to have WordPress running first :)

= Can I use it on a non NHS website =
Yes, it is open source code and can be used anywhere. However, you may not use the NHS logo or pass your site off as an NHS organisation if you are not.

= Do you offer support? =
Yes, either through the themes support pages on WordPress, or via our GitHub project https://github.com/NHSLeadership/nightingale-2-0/

= Can I get involved? =
Yes - please do! Whether you work in the NHS or would just like to contribute, we are happy to involve the wider
community in this work and will consider any pull requests or code snippets you are happy to contribute.

= How do I customise my 404 page? =
All content on the 404 error page is widgetised. Navigate to admin > appearance > widgets and add your chosen widgets and content to the `404 page` widget.

= How does the menu system work? =
The top level navigation has NO dropdowns or expander functionality. This is by design. This means your header menu is
one level only. To show further levels, we recommend using the right (or left) hand column and adding a menu widget. You
 can either use your own custom menu, or the subpages widget included with the theme.

 = What is the subpages widget =
 The subpages widget shows pages  in the current navigation tree. When you add the widget, you can configure how this
 behaves and whether the top level page is linked etc.

== Changelog

= 2.2.0
Feature release:
 * Added default styling to Download Monitor buttons
 * Added html sitemap functionality
 * Corrected alignments on nhsblock components
 * removed search submit button drop shadow, corrected form alignment on search box
 * Corrected layout ordering in footer region
 * updated 404 page to include sitemap content for improved UI
 * Cleaned up SCSS and reduced size of output css
 * Added compatability with formidable forms plugin
 * removed horizontal scroll when hero was in use on page


= 2.1.8
Maintenance release
 * Updated styling for nhsblocks plugin to match update to nhsblocks 1.1.6
 * Removed requirement for Gutenberg plugin. Unless you have other plugins requiring Gutenberg as a plugin, we very
 strongly recommend you remove the Gutenberg plugin from your installation as it is no longer required.
 * Updated penthouse npm library
 * Fixed header flex styling
 * fixed search popup in smaller screen displays to match nhsuk functionality
 * Added in recommendation to use nightingale-companion plugin (adds performance, seo and accessibility functionality
 that is not suitable for theme packages but adds real benefit to website usage). Version 1.0.2 recommended
 * Minor tweak to criticalcss to minimise screen flicker
 * Improvements to a11y functionality
 * Added screen reader capability to care cards

= 2.1.7.2 =
Maintenance release
 * Modified hover actions on header to ensure consistency with nhsuk library
 * Tweaked LearnDash completion flag styling
 * Repaired Gravity Forms inc file to set vars correctly

= 2.1.7.1 =
Maintenance release
 * style.min.css updated (error on previous upload had min out of step with the uncompressed css)
 * Gravity form error duplication removed (when a required field is not complete for example, an error message was
 showing twice.)
 * White header option on different colours improved
 * Language modified on white header option in customiser
 * suppressed readmore action in admin
 * Header styling bought into closer alignment to nhs.uk

= 2.1.7 =
Public release
 * Removed horrid yellow background on logo hover
 * removed duplicated error messages in gravity forms
 * added styling for blocks (blocks plugin has a conditional to avoid duplication)
 * Added excerpt abilities for pages
 * added readmore link to search and archive results
 * removed zip file from git repo
 * bumped versions on gutenberg-style to ensure latest version pulled in
 * corrected copyright conditional (was echoing $organisation name outside of element)

= 2.1.6 =

Gravity Forms changes:
 * Duplicated titles for radios, checkboxes, sections and html blocks all removed.
 * Radios are now selectable by clicking text
 * Keyboard navigation fixed
 * Button styling corrected (prev/next were inverted colours)
 * Progress bar bought into nhsuk styling
 * Address fields corrected (values were being lost when navigating to / from)
 * Form description changed from small class to nhsuk-hint to make more readable

Colour switcher changes:
 * colour switching styles removed into their own page-colours.scss file
 * Page specific colours brought into same routine
 * inline style removed, all styles now loaded in standalone css
 * colours apply to all inner blocks, menus and content automatically
 * colours applied top gravity elements where relevant

Header element changes:
 * transactional title drops to below logo on ipad / mobile view to prevent clashes with menu button
 * menu button and menu expander (on mobile) corrected so positions where it should when search disabled
 * Search opens in correct way on mobile view and is actually usable now.
 * Menu on mobile has white background for readability
 * Menu hover on desktop view is darker shade of selected colour.

Other changes:
 * excerpts corrected in admin view
 * 404 search form corrected on mobile view
 * LearnDash tweaks to improve display and consistency
 * breadcrumbs tidied up on search pages and 404 page
 * nhsuk-frontend updated to 3.1.0

= 2.1.5 =
 * admin panel experience massively improved (please ensure you also update nhsblocks plugin - see above to get maximum
 benefit)
 * Added filters to enable post author, post date and post thumbnail to be suppressed on individual post pages
 * learndash styling improvements
 * menu button floating issues resolved in mobile view
 * Frutiger font stubborn remnants removed.
 * Search and input boxes styling bought into alignment with nhsuk styling principles
 * Weird shadow removed from header buttons
 * Search results page now shows in nice panels and looks a lot more akin to the rest of the site display
= 2.1.4 =
 * nhsuk frontend called in using new nhsuk-replacement.scss (previously there were duplicate calls to a file making the
  output css contain duplicates and also bypassing my removal of the frutiger font loading)
 * textdomain corrected
 * readmore function completely removed along with any references to it.

= 2.1.3 =
 * Readmore function in template-functions.php now returns null. 99% certain this is now deprecated and can be removed,
 but for safety left in with a zero return.
 * Padding on grid boxes amended
 * nhsuk.js de-minified for easier inspection of what is included / being called
 * NHS Frontend library upgraded to 3.0.3
 * Internationalisation added back in (in potential)
 * wp_open_body function added to header.php for better alignment with other wp functionality

= 2.1.2 =
 * Removed margin 0 on full width - this was causing text to crash the frame in mobile view.
 * Corrected some minor styling issues with learndash css
 * Corrected hover color from warm-yellow to focus-color for consistency
 * Added filter to copyright to pick up organisation name if defined.
 * Updated theme to reflect compatability with wp 5.4

= 2.1.1 =

= 2.1.0 =
Removed for theme review compliance:
 * Performance optimisations and code standard changes. These have been removed as are considered plugin options. These
 will be added to a companion plugin at a later date.
 * All references to assets.nhs.uk - the font that was originally bundled (Frutiger) is only licensed for use on nhs.uk
   domains. If you are able to use Frutiger, you will need to add the relevant css to your customiser css section. For a
   WordPress release it was not appropriate to include it bundled.
 * All dev files. These are now in our github repo version only. The WP theme version is only the files required topower
  the theme. If you would like to be involved in developing the theme you are more than welcome, but please download the
   full repo from github to get the full upline files (such as node_files)

Added in better translation options by ensuring all strings are translatable.
Fixed search button operation on mobile.
Added better sanitising routines for customiser scripts.

= 2.0.8 =
Additional customiser options and refined display output:
 * Header Links modified to point to default home page rather than /
 * Search form and default fonts modified to be more consistent with NHSUK design pattern
 * Logo cleaned up to ensure correct display on both blue and white background
 * Improved ease of using child themes
 * Improved layout for pages with pagebreaks in them
 * Added organisation name to customiser - allowing browser title to differ from logo title
 * archive pages restyled to match www.nhs.uk layout patterns
 * Page Navigation overhauled
 * Keyboard and voice navigation improvements
 * Added plugin compatibility to The Events Calendar
 * Added plugin compatibility with Google Tag Manager (GTM) plugin
 * Added page specific colour selector
 * Added distinct sidebar for blog sections
 * Sidebar widgets restyled for cleaner look and feel
 * Sidebar can be moved to either left or right, or disabled.
 * NHSUK frontend library updated to 3.0.3
 * Gallery styling improved and bought in to line with NHSUK look and feel
 * SCSS reworked to always take colours from upstream library, easier maintainability.

= 2.0.7 =
 * Updated bundled resources license documentation
 * Made TGM Plugin Activation notices dismissable
 * Renamed functions in inc/custom_colours.php to have nightingale_ prefix
 * 404 page layout revised and text added to make the page more useful.
 * Sidebar lists (including Subpages widget) made more obvious what is intended.
 * Sidebar calendar styling adjusted to fit into region.
 * Native sidebar navigation widget restrictions removed.
 * Logic for titles on archive and latest posts page reworked.
 * Floats clears after content added and more consistent.
 * "Leave a comment" styled to match other footer links below posts.
 * Added readmore to posts list pages to ensure link is included even on posts without a title
 * Featured image width reset to actual size with a max instead of a forced 100% width.
 * Pingbacks and trackbacks added in to comments display
 * Print output cleaned up significantly, all edit and action links removed. Fonts cleaned up.
 * Header customiser cleaned up
 * Logo modified so NHS logo is optional
 * Site name and tagline used instead of custom variables
 * Removed:
    * Retina images functionality
    * GA functionality (Added recommended plugin instead)
    * Emergency Alert header addin - this was removed from upstream NHSUK Frontend library so legacy code
    * Feedback Alert footer addin - functional rather than presentational. Plugin territory.
    * unused jquery.min.js
    * .pot translation file
    * empty node_modules folder (auto generates if user locally installs node)
    * wp-html-email folder and contents
    * performance optimisations to admin pages. Apparently admin is outside theme scope. Even when editing content.
    * assets/js/editor.js - content moved into nhsblocks plugin
    * NHSBlocks styling - reduces conflicts and allows plugin to have full control on display

= 2.0.6 =
 * Optimised critical path css to remove load flicker. Amended Screenshot to follow WP best practices. Updated readme.md instructions for github repo.

= 2.0.5 =
 * Updated nhsuk-frontend upstream library. Added compatability to WP 5.3. Refactored breadcrumb and header areas to allow for organisational and transactional header styles.

= 2.0.4 =
 * Added in full LearnDash compatability. Added basic email template for plugin WP_HTML_Email.

= 2.0.3 =
 * Reworked 404 page. All content for 404 output can now be determined via widgetised area (404 widget).

= 2.0.2 =
 * Header region reworked. There are now Customiser options for disabling search box and site title as well as inversion

= 2.0.1 =
 * Add in nhsblocks plugin to TGM plugin install routine

= 2.0.0 =
 * Initial work on theme, standardised and tested for accessibility and optimised for performance.

== Upgrade Notice ==

= 2.1.7.1 =
 * Please upgrade to 2.1.7.1 as previous release had incorrect style.min.css included, and this release also fixes white
  header variant when a different base colour is selected

 == Copyright ==

 Nightingale theme, copyright NHS Leadership Academy 2019 - 2020. Nightingale is distributed under the terms of the GNU
 GPL v3

 Nightingale bundles the following third party resources:

 *  nhsuk frontend library. Copyright NHS Digital 2020. License: MIT Source: https://nhsuk.github.io/nhsuk-frontend/

 * instantpage.js - Copyright 2019 Alexandre Dieulot. License: https://instant.page/license Source: https://instant.page

 * LoadCSS - Copyright 2017 Filament Group, Inc. License: MIT License. Source: https://github.com/filamentgroup/loadCSS

 * Underscores - Copyright 2012-2017 Automattic Inc. License: GNU GPL v2. Source: https://github.com/Automattic/_s

 * SubPages Widget - Copyright 2018 Bill Erickson. License GNU GPL v2. Source: http://www.billerickson.net

 * TGM Plugin Activation - Copyright 2011 Thomas Griffin. License GNU GPL v2. Source: http://tgmpluginactivation.com/

== Resources ==

 * Screenshot - Copyright 2019 NHS Leadership Academy. License GNU GPL v3.

 * assets/cross.svg, assets/pixel_trans.svg, assets/pixel_trans_mini.png, assets/tick.svg, nhsuk-frontend css library -
 Copyright 2020 NHS Digital. License MIT
