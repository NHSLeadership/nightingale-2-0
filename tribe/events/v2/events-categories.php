<?php
$event_cats = get_the_terms( get_the_id(), 'tribe_events_cat' );
$icons = nightingale_events_icons();

$length = count( $event_cats );

?>

<div class="event-categories">

	<?php echo $icons['tag']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>

	<ul>
		<?php foreach ( $event_cats as $key => $tribecat):?>

			<li><?php echo esc_html( $tribecat->name) ; ?><?php if( $length -1 != $key ): echo ', '; endif;?> </li>

		<?php endforeach; ?>
	</ul>

</div>
