<?php
/**
 * The feedback banner region for our theme
 *
 * This is the template that displays the feedback banner region
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * @link https://nhsuk.github.io/nhsuk-frontend/components/feedback-banner/index.html
 *
 * @package Nightingale
 * @copyright NHS Leadership Academy, Tony Blacker
 * @version 1.1 21st August 2019
 */

?>
<div class="nhsuk-feedback-banner" id="nhsuk-feedback-banner" style="display: block;">
	<div class="nhsuk-width-container">
		<div class="nhsuk-grid-row">
			<div class="nhsuk-grid-column-full">
				<div class="nhsuk-feedback-banner__content">
					<h2 class="nhsuk-feedback-banner__heading">
						<?php echo esc_html( get_theme_mod( 'feedback_banner_heading' ) ); ?>
					</h2>
					<p class="nhsuk-feedback-banner__message"><?php echo esc_html( get_theme_mod( 'feedback_banner_content' ) ); ?>
						<a class="nhsuk-u-nowrap" href="<?php echo esc_url( get_theme_mod( 'feedback_banner_link' ) ); ?>"><?php echo esc_html( get_theme_mod( 'feedback_banner_link_title' ) ); ?></a>
					</p>
					<button class="nhsuk-feedback-banner__close" id="nhsuk-feedback-banner-close" type="button">
						Close<span class="nhsuk-u-visually-hidden"> feedback invite</span></button>
				</div>
			</div>
		</div>
	</div>
</div>
