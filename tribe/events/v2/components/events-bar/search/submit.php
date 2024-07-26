<?php
/**
 * View: Events Bar Search Submit Input
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/v2/components/events-bar/search/submit.php
 *
 * See more documentation about our views templating system.
 *
 * @package Nightingale
 * @copyright NHS Leadership Academy, Tony Blacker
 * @version 1.0 18th February 2022
 */

?>
	<button class="event-no-resize-button" type="submit" name="submit-bar">
		<?php
		esc_html_e( 'Find Events', 'nightingale' );
		?>
	</button>
<?php
