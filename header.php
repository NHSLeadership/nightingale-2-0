<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Nightingale_2.0
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <script src="<?php echo get_bloginfo('template_directory'); ?>/node_modules/nhsuk-frontend/dist/nhsuk.min.js"
            defer></script>
    <link href="<?php echo get_bloginfo('template_directory'); ?>/style.css" rel="stylesheet">
    <link rel="apple-touch-icon" href="<?php echo get_bloginfo('template_directory');
    ?>/node_modules/nhsuk-frontend/assets/favicons/apple-touch-icon.png">
    <link rel="icon" href="<?php echo get_bloginfo('template_directory');
    ?>/node_modules/nhsuk-frontend/assets/favicons/favicon.png">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="page" class="site">
    <a class="skip-link screen-reader-text"
       href="#content"><?php esc_html_e('Skip to content', 'nightingale-2-0'); ?></a>

    <header class="nhsuk-header nhsuk-header--transactional" role="banner">
        <div class="nhsuk-width-container nhsuk-header__container">
            <!-- to be made a toggleable area, thinking white stripe with organisation logo...?
        <div
        class="nhsuk-header__logo">
            <a class="nhsuk-header__link" href="/" aria-label="NHS homepage">
                <?php
            the_custom_logo();
            $nightingale_2_0_description = get_bloginfo('description', 'display');
            ?>
            </a>
        </div> --!>

            <div class="nhsuk-header__logo">
                <a class="nhsuk-header__link" href="/" aria-label="NHS homepage">
                    <svg class="nhsuk-logo nhsuk-logo--white" xmlns="http://www.w3.org/2000/svg" role="presentation"
                         focusable="false" viewBox="0 0 40 16">
                        <path fill="#fff" d="M0 0h40v16H0z"></path>
                        <path fill="#005eb8"
                              d="M3.9 1.5h4.4l2.6 9h.1l1.8-9h3.3l-2.8 13H9l-2.7-9h-.1l-1.8 9H1.1M17.3 1.5h3.6l-1 4.9h4L25 1.5h3.5l-2.7 13h-3.5l1.1-5.6h-4.1l-1.2 5.6h-3.4M37.7 4.4c-.7-.3-1.6-.6-2.9-.6-1.4 0-2.5.2-2.5 1.3 0 1.8 5.1 1.2 5.1 5.1 0 3.6-3.3 4.5-6.4 4.5-1.3 0-2.9-.3-4-.7l.8-2.7c.7.4 2.1.7 3.2.7s2.8-.2 2.8-1.5c0-2.1-5.1-1.3-5.1-5 0-3.4 2.9-4.4 5.8-4.4 1.6 0 3.1.2 4 .6"></path>
                        <image src="https://assets.nhs.uk/images/nhs-logo.png" xlink:href=""></image>
                    </svg>
                </a>
            </div>
            <div class="nhsuk-header__transactional-service-name">
                <a class="nhsuk-header__transactional-service-name--link" href="/"><?php bloginfo('name'); ?></a>
            </div>
            <div class="nhsuk-header__content" id="content-header">

                <div class="nhsuk-header__menu">
                    <button class="nhsuk-header__menu-toggle" id="toggle-menu" aria-controls="header-navigation"
                            aria-label="Open menu">Menu
                    </button>
                </div>

                <div class="nhsuk-header__search">
                    <?php get_search_form(); ?>
                </div>

            </div>

        </div>

        <nav class="nhsuk-header__navigation" id="header-navigation" role="navigation" aria-label="Primary navigation"
             aria-labelledby="label-navigation">
            <p class="nhsuk-header__navigation-title"><span id="label-navigation">Menu</span>
                <button class="nhsuk-header__navigation-close" id="close-menu">
                    <svg class="nhsuk-icon nhsuk-icon__close" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                         aria-hidden="true" focusable="false">
                        <path d="M13.41 12l5.3-5.29a1 1 0 1 0-1.42-1.42L12 10.59l-5.29-5.3a1 1 0 0 0-1.42 1.42l5.3 5.29-5.3 5.29a1 1 0 0 0 0 1.42 1 1 0 0 0 1.42 0l5.29-5.3 5.29 5.3a1 1 0 0 0 1.42 0 1 1 0 0 0 0-1.42z"></path>
                    </svg>
                    <span class="nhsuk-u-visually-hidden">Close menu</span>
                </button>
            </p>
            <?php wp_nav_menu(array(
                'theme_location' => 'main-menu',
                'menu_class' => 'nhsuk-header__navigation-list',
                'walker' => new Walker_Nightingale_Menu(),
                'container' => false,
                'depth' => 0  // limit menu depth (otherwise login button goes astray)
            ));
            ?>

        </nav>

    </header>

    <div id="content" class="site-content">
        <?php nightingale_breadcrumb() ?>

        <?php // add in hero image section
        /* Removed old way of doing hero image
if ( is_singular() and has_post_thumbnail( $post->ID ))
    {
        $featured_id = get_the_post_thumbnail('full');
echo '<section class="nhsuk-hero nhsuk-hero--image nhsuk-hero--image-description" style="background-image: url(\''
. get_the_post_thumbnail_url() . '\');">
<div class="nhsuk-hero__overlay">
  <div class="nhsuk-width-container">
    <div class="nhsuk-grid-row">
      <div class="nhsuk-grid-column-two-thirds">
        <div class="nhsuk-hero-content">
          <h1 class="nhsuk-u-margin-bottom-3">'.get_the_title($featured_id).'</h1>
          <p class="nhsuk-body-l nhsuk-u-margin-bottom-0">'.get_the_post_thumbnail_caption($featured_id).'</p>
          <span class="nhsuk-hero__arrow" aria-hidden="true"></span>
        </div>
      </div>
    </div>
  </div>
</div>
</section><p></p>';
    }
        */
        if (is_singular()) {
            include_once('wp-content/plugins/nhsl-blocks/blocks/content-hero.php');
        }
        //end hero image section

        ?>
