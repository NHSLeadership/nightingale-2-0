<?php
/**
 * Template Name: Full-Width
 *
 * The template for displaying pages with tabbed navigation at the top.
 *
 * Note: the parent page is shown under the "Overview" tab and
 * the order of the other tabs is controlled by the child pages' 'order' fields.
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
	<div class="nhsuk-grid-column-full">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>
	</div>
</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
?>
<script>
    const heroBlock = document.querySelector('.wp-block-nhsblocks-heroblock');
    if ( heroBlock.matches('.wp-block-nhsblocks-heroblock') === true ) {
        const mainContent = document.querySelector( '#maincontent' );
        const wholeDoc = document.querySelector( 'body' );
        const breadCrumb = document.querySelector( '.nhsuk-breadcrumb' );
        mainContent.prepend( heroBlock );
        wholeDoc.removeChild( breadCrumb );
        mainContent.style.paddingTop = "0";
        heroBlock.style.marginBottom = "70px";
    }
</script>

