<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link      https://codex.wordpress.org/Creating_an_Error_404_Page
 * @package   Nightingale
 * @copyright NHS Leadership Academy
 * @license   https://www.gnu.org/licenses/gpl-3.0.en.html
 * @author    Tony Blacker <tony.blacker@leadershipacademy.nhs.uk>, Chris Witham <chris.witham@leadershipacademy.nhs.uk>
 * @since     1.1.0
 * @since     2.2.0 includes sitemap
 * @uses      template-parts/sitemap
 */

get_header();
?>
	<div id="primary" class=" nhsuk-grid-row nhsuk-width-restrict">

		<div class="nhsuk-grid-column-full full-width">
			<section class="error-404 not-found">
				<header class="entry-header">
					<h1 class="entry-title">404 - Page not found</h1>
				</header>
				<div class="page-content">
					<div class="wp-block-nhsblocks-panel1 nhsuk-panel is-style-panel-with-label">
						<h3 class="nhsuk-panel-with-label__label"><?php echo esc_html__( 'Oops', 'nightingale' ); ?></h3>
						<div class="paneltext">
							<p><?php echo esc_html__( 'Sorry, this page can\'t be found at the moment, please use the search facility below, select an item from the contents or alternatively return to the home page', 'nightingale' ); ?></p>
							<a class="wp-block-nhsblocks-nhsbutton alignright nhsuk-button" href="<?php echo esc_attr( get_home_url() ); ?>"><?php echo esc_html__( 'Home Page', 'nightingale' ); ?></a>
							<?php
							get_search_form();
							?>
						</div>
					</div>
					<?php get_template_part( 'template-parts/sitemap' ); ?>
				</div>
				<div class="nhsuk-content__clearfix"></div>
			</section>
		</div>

		<div class="nhsuk-grid-column-full full-width">
			<?php
			dynamic_sidebar( '404-error' );
			?>
		</div>

	</div><!-- #primary -->

<?php
get_footer();
