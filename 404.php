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
							<div class="wp-block-nhsblocks-panel1 nhsuk-panel is-style-panel-with-label">
								<h3 class="nhsuk-panel-with-label__label"><?php echo esc_html__( 'Oops', 'nightingale' ); ?></h3>
								<div class="paneltext">
									<p><?php echo esc_html__( 'Sorry, this page can\'t be found at the moment, please use the search facility below, or alternatively return home', 'nightingale' ); ?></p>
									<a class="wp-block-nhsblocks-nhsbutton alignright nhsuk-button" href="<?php echo esc_attr( get_home_url() ); ?>"><?php echo esc_html__( 'Home Page', 'nightingale' ); ?></a>
									<?php
									get_search_form();
									?>
								</div>
							</div>
							<?php
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
