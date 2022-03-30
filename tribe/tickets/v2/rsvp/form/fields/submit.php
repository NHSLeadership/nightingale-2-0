<?php
/**
 * Block: RSVP
 * Form Submit Button
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/tickets/v2/rsvp/form/fields/submit.php
 *
 * See more documentation about our Blocks Editor templating system.
 *
 * @package Nightingale
 * @copyright NHS Leadership Academy, Tony Blacker
 * @version 1.0 18th February 2022
 */

?>
<button
	class="nhsuk-button tribe-common-c-btn tribe-tickets__rsvp-form-button"
	type="submit"
>
	<?php esc_html_e( 'Finish', 'nightingale' ); ?>
</button>
