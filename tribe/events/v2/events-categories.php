<?php
/**
 *
 * Events categories text display
 *
 * @package Nightingale
 * @copyright NHS Leadership Academy, Tony Blacker
 * @version 1.0 18th February 2020
 */

$event_cats = get_the_terms( get_the_id(), 'tribe_events_cat' );
$icons      = nightingale_events_icons();

$length = $event_cats ? count( $event_cats ) : null;

?>

<?php if ( $event_cats ) : ?>

	<div class="event-categories">

	<?php echo $icons['tag']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>

		<ul>
			<?php foreach ( $event_cats as $key => $tribecat ) : ?>

				<li>
					<?php
					echo esc_html( $tribecat->name );
					if ( $length - 1 !== $key ) :
						echo ', ';
					endif;
					?>
				</li>

			<?php endforeach; ?>
		</ul>

	</div>

<?php endif; ?>
