<?php
/**
 * Block: RSVP
 * Form Cancel Button
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/tickets/v2/rsvp/form/fields/cancel.php
 *
 * See more documentation about our Blocks Editor templating system.
 *
 * @package Nightingale
 * @copyright NHS Leadership Academy, Tony Blacker
 * @version 1.0 18th February 2022
 */

?>
<button
	class="nhsuk-button--reverse tribe-common-h7 tribe-tickets__rsvp-form-button tribe-tickets__rsvp-form-button--cancel"
	type="reset"
>
	<?php esc_html_e( 'Cancel', 'nightingale' ); ?>
</button>
