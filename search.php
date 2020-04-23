<?php
/**
 * The search results page
 * This is the template file to display search results.
 * It is used to display a a list of pages / posts matching a search query.
 * Each result is presented in its own promo panel at 1/3 width.
 * The sidebar is intentionally disabled on this view, regardless of site settings.
 *
 * @link      https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @package   Nightingale
 * @copyright NHS Leadership Academy, Tony Blacker
 * @version   1.0 23rd March 2020
 */

get_header();
?>

	<div id="primary" class="clear">
		<header>
			<h1 class="nhsuk-heading-xl">
				<?php
				/* translators: %s: search term */
				printf( esc_html__( 'Search Results for: %s', 'nightingale' ), '<span>' . get_search_query() . '</span>' );
				?>
			</h1>
		</header>
		<div class="index">
			<?php
			if ( have_posts() ) :
				?>
				<div class="nhsuk-grid-row nhsuk-promo-group">
					<?php
					/* Start the Loop */
					while ( have_posts() ) :
						the_post();
						?>
						<div class="nhsuk-grid-column-one-third nhsuk-promo-group__item">
							<div class="nhsuk-promo">
								<a class="nhsuk-promo__link-wrapper" href="<?php the_permalink(); ?>">
									<?php
									if ( has_post_thumbnail() ) :
										the_post_thumbnail( 'thumbnail', [ 'class' => 'nhsuk-promo__img' ] );
									else :
										$fallback = get_theme_mod( 'blog_fallback' );
										if ( $fallback ) {
											echo wp_get_attachment_image( $fallback, 'thumbnail', false, [ 'class' => 'nhsuk-promo__img' ] );
										}
									endif;
									?>
									<div class="nhsuk-promo__content">
										<?php the_title( '<h2 class="nhsuk-promo__heading">', '</h2>' ); ?>
										<?php do_action( 'nightingale_before_archive_content' ); ?>
										<?php the_excerpt(); ?>
										<?php do_action( 'nightingale_after_archive_content' ); ?>
									</div>
								</a>
							</div>
						</div>
						<?php
					endwhile;
					?>
				</div><!-- #nhsuk-panel-group nhsuk-grid-column-full -->
				<?php
				nightingale_archive_pagination();
				else :
					get_template_part( 'template-parts/content', 'none' );
			endif;
				?>
		</div>
	</div><!-- #primary -->
<?php
get_footer();
