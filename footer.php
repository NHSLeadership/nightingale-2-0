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

<footer class="nhsuk-footer" id="nhsuk-footer" role="contentinfo">
	<div class="nhsuk-width-container">
		<?php if ( is_active_sidebar( 'footer-region' ) ) : ?>
			<div id="nhsuk-footer-widgets" class="nhsuk-footer__widgets widget-area" role="complementary">
				<?php dynamic_sidebar( 'footer-region' ); ?>
			</div>
			<?php
		endif;
		?>
		<div class="nhsuk-footer__meta">
			<h2 class="nhsuk-u-visually-hidden"><?php esc_html_e( 'Support links', 'nightingale' ); ?></h2>
			<?php
			get_template_part( 'partials/footernav' );
			get_template_part( 'partials/footer-copyright' );
			?>
		</div>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
