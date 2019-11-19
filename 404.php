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
	<div id="primary" class="nhsuk-width-container">
		<main id="maincontent" class="nhsuk-main-wrapper">
			<div class="nhsuk-grid-row">
				<div class="nhsuk-grid-column-full">
					<section class="error-404 not-found">
						<div class="page-content">
							<?php
							get_search_form();
							dynamic_sidebar( '404-error' );
							?>
						</div><!-- .page-content -->
					</section><!-- .error-404 -->
				</div>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_footer();
