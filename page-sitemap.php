<?php
/**
 * Template Name: Sitemap Page
 *
 * The template for displaying a HTML sitemap for the website.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Nightingale
 * @copyright NHS Leadership Academy
 * @license https://www.gnu.org/licenses/gpl-3.0.en.html
 * @author Chris Witham <chris.witham@leadershipacademy.nhs.uk>
 * @since 2.2.0
 * @uses template-parts/sitemap
 */

get_header();
?>

<div id="primary" class=" nhsuk-grid-row">
	<div class="nhsuk-grid-column-full full-width">

		<?php get_template_part('template-parts/sitemap'); ?>

	</div>
</div><!-- #primary -->

<?php
get_footer();
?>
