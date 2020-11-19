<?php
/**
 * Block: RSVP ARi
 * Form Email
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/tickets/v2/rsvp/ari/form/fields/email.php
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
 * Set the default value for the email on the RSVP form.
 *
 * @param string
 * @param Tribe__Tickets__Editor__Template $this
 *
 * @since 4.9
 */
$email = apply_filters( 'tribe_tickets_rsvp_form_email', '', $this );

?>
<div class="tribe-common-b1 tribe-common-b2--min-medium tribe-tickets__form-field tribe-tickets__form-field--required nhsuk-form-group">
	<label
		class="nhsuk-label"
		for="tribe-tickets-rsvp-email-<?php echo esc_attr( $rsvp->ID ); ?>"
	>
		<?php esc_html_e( 'Email', 'nightingale' ); ?><span class="screen-reader-text"><?php esc_html_e( 'required', 'nightingale' ); ?></span>
		<span class="tribe-required nhsuk-tag nhsuk-tag--yellow" aria-hidden="true" role="presentation">*</span>
	</label>
	<input
		type="email"
		class="nhsuk-input"
		name="tribe_tickets[<?php echo esc_attr( absint( $rsvp->ID ) ); ?>][attendees][0][email]"
		id="tribe-tickets-rsvp-email-<?php echo esc_attr( $rsvp->ID ); ?>"
		value="<?php echo esc_attr( $email ); ?>"
		required
		placeholder="<?php esc_attr_e( 'your@email.com', 'nightingale' ); ?>"
	>
</div>
