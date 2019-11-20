<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Nightingale
 * @copyright NHS Leadership Academy, Tony Blacker
 * @version 1.1 21st August 2019
 */

flush();
?>
</div>
</main>
</div>

<footer>
	<div class="nhsuk-footer" id="nhsuk-footer">
		<div class="nhsuk-width-container">
			<?php if ( is_active_sidebar( 'footer-region' ) ) : ?>
				<div id="nhsuk-footer-widgets" class="nhsuk-footer__widgets widget-area" role="complementary">
					<?php dynamic_sidebar( 'footer-region' ); ?>
				</div>
				<?php
			endif;
			$menu_locations = get_nav_menu_locations(); // Get our nav locations (set in our theme, usually functions.php).
			// This returns an array of menu locations ([LOCATION_NAME] = MENU_ID).
			if ( has_nav_menu( 'footer-menu' ) ) { // Check to see if there is a footer menu assigned.
				$menu_id   = $menu_locations['footer-menu']; // Get the *footer-menu* menu ID.
				$menu_item = wp_get_nav_menu_items( $menu_id );
				if ( $menu_item ) { // Get the array of wp objects, the nav items for our queried location.
					?>
					<h2 class="nhsuk-u-visually-hidden">Support links</h2>
					<ul class="nhsuk-footer__list nhsuk-footer__list--three-columns">
						<?php

						foreach ( $menu_item as $nav_item ) {

							echo '<li class="nhsuk-footer__list-item"><a class="nhsuk-footer__list-item-link" href="' . esc_url( $nav_item->url ) . '">' . esc_html( $nav_item->title ) . '</a></li>';

						}

						?>
					</ul>
					<?php
				} //end if footer menu exists
			} // end check to see if menu is assigned.
			?>
			<p class="nhsuk-footer__copyright">&copy;
				Copyright, <?php bloginfo( 'name' ); ?> <?php echo esc_attr( date( 'Y' ) ); ?></p>
		</div>
	</div>
</footer>
<!--
-- FzwfoYNPKdzf5LLgTGsAAz6xb8lqM8ObevYAW5CV9mBAbpDtfV057ndBJWDFrT7P --
-->
<?php
if ( get_theme_mod( 'feedback_on' ) === 'yes' ) {
	get_template_part( 'partials/feedback-banner' );
}
?>
<?php wp_footer(); ?>
</body>
</html>
