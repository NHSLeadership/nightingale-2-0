<?php
/**
 * Template part for displaying posts
 *
 * @link      https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @package   Nightingale
 * @copyright NHS Leadership Academy, Tony Blacker
 * @version   2.0 January 2020
 */

if ( is_single() ) :
	// if is single show existing template.
	get_template_part( 'template-parts/content' );

else :
	if ( ! isset( $parent_template_part ) ) {
		$parent_template_part = 'none';
	}
	$sidebar = ( 'true' === get_theme_mod( 'blog_sidebar' ) );
	?>

	<div class="
	<?php
	if ( 'latest-posts' === $parent_template_part ) {
		if ( 'grid' === $post_layout ) {
			if ( 4 === $columns ) {
				echo 'nhsuk-grid-column-one-quarter ';
			} elseif ( 2 === $columns ) {
				echo 'nhsuk-grid-column-one-half ';
			} else {
				echo 'nhsuk-grid-column-one-third ';
			}
		} else { // single rows layout.
			echo 'nhsuk-grid-column-full ';
		}
	} else {
		if ( $sidebar ) :
			echo 'nhsuk-grid-column-one-half ';
		else :
			echo 'nhsuk-grid-column-one-third ';
		endif;
	}
	?>
	nhsuk-card-group__item nhsuk-postslisting">
		<div class="nhsuk-card nhsuk-card--clickable">


				<?php
				if ( ( 'latest-posts' !== $parent_template_part ) || ( ( 'latest-posts' === $parent_template_part ) && ( 0 !== $display_featured_image ) ) ) {
					if ( has_post_thumbnail() ) :

						$tribe_thumbnail_class = '';
						if ( get_post_type() === 'tribe_events' ) :
							$tribe_thumbnail_class = 'tribe_events_thumbnail';
						endif;
						$image_proportion = get_theme_mod( 'blog_image_display', 'default' );
						the_post_thumbnail( $image_proportion, [ 'class' => 'nhsuk-card__img ' . $tribe_thumbnail_class ] );

					else :

						$fallback = get_theme_mod( 'blog_fallback' );

						if ( $fallback ) {
							echo wp_get_attachment_image( $fallback, 'thumbnail', false, [ 'class' => 'nhsuk-card__img' ] );
						}

					endif;
				}
				?>

				<div class="nhsuk-card__content">
					<h2 class="nhsuk-card__heading nhsuk-heading-m">
						<?php
						the_title();
						// If event add date for screen readers.
						if ( get_post_type() === 'tribe_events' ) {
							$event_date = strtotime( $post->start_date );
							$event_date = date( 'd M Y', $event_date );
							echo '<span class="nhsuk-u-visually-hidden">(' . esc_html( $event_date ) . ')</span>';
						}
						?>
					</h2>

					<?php
					if ( ( 'latest-posts' === $parent_template_part ) && ( 0 !== $display_author ) ) {
						echo '<span class="wp-block-latest-posts__post-author nhsuk_post_author">' . get_the_author() . '</span>';
					}
					if ( ( 'latest-posts' === $parent_template_part ) && ( 0 !== $display_post_date ) ) {
						echo '<span class="wp-block-latest-posts__post-date nhsuk_post_date">' . get_the_date() . '</span>';
					}

					do_action( 'nightingale_before_archive_content' );
					if ( 'latest-posts' === $parent_template_part ) { // this is the latest posts display with options.
						if ( 0 !== $display_post_content ) { // only do something if we actually selected to display content.
							if ( 'excerpt' === $display_full_post ) { // if we chose to display the excerpt, use the latest blocks excerpt length selection.
								add_filter(
									'excerpt_length',
									function ( $length ) use ( $excerpt_length ) {
										return $excerpt_length;
									},
									10
								);
								the_excerpt();
							} else { // otherwise, if we chose to display FULL content, then do so.
								the_content();
							}
						}
					} else { // everything that isn't the latest posts block behaves as normal.
						the_excerpt();
					}
					echo nightingale_read_more_posts( get_the_title(), get_the_permalink() ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					?>

					<?php do_action( 'nightingale_after_archive_content' ); ?>

				</div>
		</div>
	</div>

	<?php
endif;
