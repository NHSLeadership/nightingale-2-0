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


</div>
<div class="rd">
    <footer role="contentinfo">
        <div class="nhsuk-global-footer" id="nhsuk-footer">

            <div class="nhsuk-width-container">
                     <?php wp_nav_menu( array( 'theme_location' => 'footer-menu' ) ); ?>
                    <?php
                   /* global $post;
                    $thePostID = $post->ID;
                    if ($menu = wp_get_nav_menu_object('Footer Links')):
                        $menu_items = wp_get_nav_menu_items($menu->term_id);
                        ?>
                        <?php foreach ((array)$menu_items as $key => $menu_item) { ?>
                        <li class="nhsuk-footer__list-item<?php if ($thePostID == $menu_item->object_id) echo ' active'; ?>">
                            <a class="nhsuk-footer__list-item-link"
                               href="<?php echo $menu_item->url; ?>"><?php echo $menu_item->title; ?></a>
                        </li>
                    <?php }
                    endif;
                   */
                   ?>

                <p class="nhsuk-footer__copyright">&copy; Copyright, <?php bloginfo('name'); ?> <?php echo date("Y"); ?></p>
            </div>
        </div>
    </footer>
</div>

<?php wp_footer(); ?>
</div>
</body>
</html>
