<?php
/**
 * Block: RSVP ARi
 * Form Name
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/tickets/v2/rsvp/ari/form/fields/name.php
 *
 * See more documentation about our Blocks Editor templating system.
 *
 * @link {INSERT_ARTICLE_LINK_HERE}
 *
 * @since5.0.0
 *
 * @version5.0.0
 * @package Nightingale
 */

/**
 * Set the default Full Name for the RSVP form
 *
 * @param string
 * @param Tribe__Tickets__Editor__Template $this
 *
 * @since 4.9
 */
$name = apply_filters( 'tribe_tickets_rsvp_form_full_name', '', $this );
?>
<div class="tribe-common-b1 tribe-common-b2--min-medium tribe-tickets__form-field tribe-tickets__form-field--required nhsuk-form-group">
	<label
		class="nhsuk-label"
		for="tribe-tickets-rsvp-name-<?php echo esc_attr( $rsvp->ID ); ?>"
	>
		<?php esc_html_e( 'Name', 'nightingale' ); ?><span class="screen-reader-text"><?php esc_html_e( 'required', 'nightingale' ); ?></span>
		<span class="tribe-required" aria-hidden="true" role="presentation">*</span>
	</label>
	<input
		type="text"
		class="nhsuk-input"
		name="tribe_tickets[<?php echo esc_attr( absint( $rsvp->ID ) ); ?>][attendees][0][full_name]"
		id="tribe-tickets-rsvp-name-<?php echo esc_attr( $rsvp->ID ); ?>"
		value="<?php echo esc_attr( $name ); ?>"
		required
		placeholder="<?php esc_attr_e( 'Your Name', 'nightingale' ); ?>"
	>
</div>
