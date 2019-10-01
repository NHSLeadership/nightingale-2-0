<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Nightingale
 * @copyright NHS Leadership Academy, Tony Blacker
 * @version 1.1 21st August 2019
 */

get_header();
?>
	<section class="nhsuk-hero wp-block-nhsblocks-heroblock">
		<div class="nhsuk-width-container nhsuk-hero--border">
		    <div class="nhsuk-grid-row">
				<div class="nhsuk-grid-column-two-thirds">
					<div class="nhsuk-hero_wrapper">
						<h1 class="nhsuk-u-margin-bottom-3"><?php esc_html_e( 'Page not found', 'nightingale' ); ?></h1>
						<p class="nhsuk-body-l nhsuk-u-margin-bottom-3"><?php esc_html_e( 'It looks like nothing was found at this link.', 'nightingale' ); ?></p>
				</div>
			</div>
		</div>
	</section>
	<p></p>
	<div id="primary" class="nhsuk-width-container">
		<main id="maincontent" class="nhsuk-main-wrapper">
			<div class="nhsuk-grid-row">
				<div class="nhsuk-grid-column-full">
					<?php
					$raw_search = isset( $_SERVER['REQUEST_URI'] );

					$replacement = str_replace( '-', ' ', $raw_search );

					if ( $replacement ) {
						$query = $replacement;
					}

					?>

					<section class="error-404 not-found">

						<div class="page-content">
							<?php get_search_form();
							dynamic_sidebar( '404' ); ?>
						</div><!-- .page-content -->
					</section><!-- .error-404 -->


				</div>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
