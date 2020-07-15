<?php
/**
 * Template Name: Sitemap Page
 *
 * The template for displaying a HTML sitemap for the website.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Nightingale
 * @copyright NHS Leadership Academy, Tony Blacker
 * @version 1.1 21st August 2019
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
