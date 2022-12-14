<?php
/**
 * The search results page
 * This is the template file to display search results.
 * It is used to display a a list of pages / posts matching a search query.
 * Each result is presented in its own card at 1/3 width.
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
				<div class="nhsuk-grid-row nhsuk-card-group">
					<?php
					/* Start the Loop */
					while ( have_posts() ) :
						the_post();
						?>
						<div class="nhsuk-grid-column-one-third nhsuk-card-group__item nhsuk-postslisting">
							<div class="nhsuk-card nhsuk-card--clickable">

									<?php
									if ( has_post_thumbnail() ) :
										$image_proportion = get_theme_mod( 'blog_image_display', 'default' );
										the_post_thumbnail( $image_proportion, [ 'class' => 'nhsuk-card__img' ] );
									else :
										$fallback = get_theme_mod( 'blog_fallback' );
										if ( $fallback ) :
											echo wp_get_attachment_image( $fallback, 'thumbnail', false, [ 'class' => 'nhsuk-card__img' ] );
										endif;
									endif;
									?>
									<div class="nhsuk-card__content">
										<h2 class="nhsuk-card__heading nhsuk-heading-m">
											<a class="nhsuk-card__link" href="<?php the_permalink(); ?>">
												<?php the_title(); ?>
											</a>
										</h2>
										<?php do_action( 'nightingale_before_archive_content' ); ?>
										<p class="nhsuk-card__description">
											<?php
											$excerpt = get_the_excerpt();
											if ( ( str_contains( $excerpt, $s ) ) && ( !empty( $s ) ) ) :
												$keys    = explode( ' ', $s );
												$excerpt = preg_replace( '/(' . implode( '|', $keys ) . ')/iu', '<span class="search-terms">\0</span>', $excerpt );
											endif;
											echo $excerpt; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
											?>
										</p>
										<?php do_action( 'nightingale_after_archive_content' ); ?>
									</div>
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
