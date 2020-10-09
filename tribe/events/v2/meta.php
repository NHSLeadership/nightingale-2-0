<?php
/**
 * Renders meta fields in the ticket form
 *
 * Override this template in your own theme by creating a file at:
 *
 *     [your-theme]/tribe-events/meta.php
 *
 * @version 4.6
 *
 */
die('meta');
$meta = Tribe__Tickets_Plus__Main::instance()->meta();
$meta_fields = $meta->get_meta_fields_by_ticket( $ticket->ID );
?>
<tr class="tribe-event-tickets-plus-meta" id="tribe-event-tickets-plus-meta-<?php echo esc_attr( $ticket->ID ); ?>" data-ticket-id="<?php echo esc_attr( $ticket->ID ); ?>">
	<td colspan="4">
		<p class="tribe-event-tickets-meta-required-message">
			<?php esc_html_e( 'Please fill in all required fields', 'event-tickets-plus' ); ?>
		</p>
		<div class="tribe-event-tickets-plus-meta-fields" id="tribe-event-tickets-plus-meta-fields-<?php echo esc_attr( $ticket->ID ); ?>"></div>
		<script class="tribe-event-tickets-plus-meta-fields-tpl" id="tribe-event-tickets-plus-meta-fields-tpl-<?php echo esc_attr( $ticket->ID ); ?>" type="text/template">
			<div class="tribe-event-tickets-plus-meta-attendee">
				<header><?php esc_html_e( 'Attendee', 'event-tickets-plus' ); ?></header>
				<?php
				foreach ( $meta_fields as $field ) {
					echo $field->render();
				}
				?>
			</div>
		</script>
	</td>
</tr>
