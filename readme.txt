=== Nightingale 2.0 ===
Contributors: tblacker
Requires at least: 5.0
Tested up to: 5.3.2
Requires PHP: 5.6
License: GPL v3 or later
License URI: https://www.gnu.org/licenses/gpl-3.0.en.html
Theme URI: https://digital.leadershipacademy.nhs.uk/digital-capabilities/websites/nightingale-theme-user-guide/
Version: 2.1.1
Stable tag: 2.1.1


== Description ==

A responsive and accessible theme for NHS organisations based on the NHSUK Frontend Library.

== Frequently Asked Questions ==

= Can I use this on any NHS website? =
Yes, the only restriction being that you need to have WordPress running first :)

= Can I use it on a non NHS website =
Yes, it is open source code and can be used anywhere. However, you may not use the NHS logo or pass your site off as an NHS organisation if you are not.

= Do you offer support? =
Yes, either through the themes support pages on WordPress, or via our GitHub project https://github.com/NHSLeadership/nightingale

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

= 2.0.7 =
 * Please upgrade to 2.0.7 for reasons

 == Copyright ==

 Nightingale theme, copyright NHS Leadership Academy 2019 - 2020. Nightingale is distributed under the terms of the GNU
 GPL v3

 Nightingale bundles the following third party resources:

 *  nhsuk frontend library. Copyright NHS Digital 2019. License: MIT Source: https://nhsuk.github.io/nhsuk-frontend/

 * instantpage.js - Copyright 2019 Alexandre Dieulot. License: https://instant.page/license Source: https://instant.page

 * LoadCSS - Copyright 2017 Filament Group, Inc. License: MIT License. Source: https://github.com/filamentgroup/loadCSS

 * Underscores - Copyright 2012-2017 Automattic Inc. License: GNU GPL v2. Source: https://github.com/Automattic/_s

 * SubPages Widget - Copyright 2018 Bill Erickson. License GNU GPL v2. Source: http://www.billerickson.net

 * TGM Plugin Activation - Copyright 2011 Thomas Griffin. License GNU GPL v2. Source: http://tgmpluginactivation.com/

== Resources ==

 * Screenshot - Copyright 2019 NHS Leadership Academy. License GNU GPL v3.

 * assets/cross.svg, assets/pixel_trans.svg, assets/pixel_trans_mini.png, assets/tick.svg, nhsuk-frontend css library -
 Copyright 2019 NHS Digital. License MIT




