<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Nightingale_2.0
 */

?>

</main>
</div>

    <footer role="contentinfo">
        <div class="nhsuk-footer" id="nhsuk-footer">
            <div class="nhsuk-width-container">
                <h2 class="nhsuk-u-visually-hidden">Support links</h2>
                <ul class="nhsuk-footer__list nhsuk-footer__list--three-columns">
                     <?php //wp_nav_menu( array( 'theme_location' => 'footer-menu' ) );
                     $menuLocations = get_nav_menu_locations(); // Get our nav locations (set in our theme, usually functions.php)
                     // This returns an array of menu locations ([LOCATION_NAME] = MENU_ID);

                     $menuID = $menuLocations['footer-menu']; // Get the *footer-menu* menu ID
                     $footerNav = wp_get_nav_menu_items($menuID); // Get the array of wp objects, the nav items for our
                     // queried location
                     foreach ( $footerNav as $navItem ) {

                         echo '<li class="nhsuk-footer__list-item"><a class="nhsuk-footer__list-item-link" href="'
                             .$navItem->url.'" title="'.$navItem->title.'">'.$navItem->title.'</a></li>';

                     }
                     ?>
                </ul>
                <p class="nhsuk-footer__copyright">&copy; Copyright, <?php bloginfo('name'); ?> <?php echo date("Y"); ?></p>
            </div>
        </div>
    </footer>

<?php wp_footer(); ?>
</div>
</body>
</html>
