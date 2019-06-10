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
            <ul>
                <li class="nhsuk-global-footer__logo">
                <a href="/" class="global-footer__link">
                    <svg class="nhsuk-logo" xmlns="http://www.w3.org/2000/svg" role="img" aria-hidden="true">
                        <g fill-rule="nonzero" fill="none">
                            <path fill="#FFF" d="M0 39.842h98.203V0H0z"></path>
                            <path fill="#0058AD" d="M9.548 3.817H20.16l6.52 22.08h.09l4.465-22.08h8.021l-6.74 31.84H21.939l-6.65-22.032h-.09l-4.424 22.031H2.754l6.794-31.84M42.4 3.817h8.518l-2.502 12.18h10.069l2.508-12.18h8.519l-6.61 31.84h-8.518l2.826-13.638H47.135L44.31 35.656h-8.518L42.4 3.816M91.93 11.025c-1.64-.773-3.873-1.457-7.016-1.457-3.37 0-6.106.498-6.106 3.056 0 4.512 12.35 2.828 12.35 12.499 0 8.802-8.16 11.085-15.54 11.085-3.281 0-7.065-.78-9.842-1.648l2.006-6.477c1.682 1.096 5.058 1.827 7.835 1.827 2.646 0 6.789-.503 6.789-3.786 0-5.111-12.35-3.194-12.35-12.176 0-8.214 7.202-10.676 14.176-10.676 3.92 0 7.608.413 9.75 1.413l-2.052 6.34"></path>
                        </g>
                    </svg>
                </a>
                </li>
                <?php
                global $post;
                $thePostID = $post->ID;
                $menu = wp_get_nav_menu_object( 'Footer Links' );
                $menu_items = wp_get_nav_menu_items( $menu->term_id );
                ?>
                    <?php foreach ( (array) $menu_items as $key => $menu_item ) { ?>
                        <li class="nhsuk-footer__list-item<?php if($thePostID == $menu_item->object_id) echo ' active'; ?>">
                            <a class="nhsuk-footer__list-item-link" href="<?php echo $menu_item->url; ?>"><?php echo $menu_item->title; ?></a>
                        </li>
                    <?php } ?>

            <p class="nhsuk-footer__copyright">&copy; Crown copyright, NHS</p>
        </div>
    </div>
</footer>
</div>

<?php wp_footer(); ?>
</div>
</body>
</html>
