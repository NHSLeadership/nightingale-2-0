<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Nightingale
 * @copyright NHS Leadership Academy, Tony Blacker
 * @version 2.0 January 2020
 */

if ( is_single() ) :
	// if is single show existing template.
	get_template_part( 'template-parts/content' );

else :

	$sidebar = ( 'true' === get_theme_mod( 'blog_sidebar' ) );

	?>

	<div class="
	<?php
	if ( $sidebar ) :
		echo 'nhsuk-grid-column-one-half ';
	else :
		echo 'nhsuk-grid-column-one-third ';
	endif;
	?>
	nhsuk-promo-group__item">
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

<?php endif; ?>

