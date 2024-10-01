<?php
/**
 * View: Top Bar - Date Picker
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/v2/month/top-bar/datepicker.php
 *
 * See more documentation about our views templating system.
 *
 * @package nightingale
 *
 * @version 5.0.1
 *
 * @var string $now The current date and time in the `Y-m-d H:i:s` format.
 * @var string $grid_date The current calendar grid date in the `Y-m-d` format.
 * @var string $formatted_grid_date The current calendar grid date in the format specified by the "Month and
 *                                            year format" option.
 * @var string $formatted_grid_date_mobile The current calendar grid date in the format specified by the "Compact
 *                                            Date Format" option.
 * @var object $date_formats Object containing the date formats.
 * @var \DateTime $the_date The Month current date object.
 */

use Tribe__Date_Utils as Dates;

$default_date        = $now;
$selected_date_value = $this->get( [ 'bar', 'date' ], $default_date );
$datepicker_date     = Dates::build_date_object( $selected_date_value )->format( $date_formats->compact );
?>
<div class="tribe-events-c-top-bar__datepicker">
	<button
			class="nhsuk-la-datepicker tribe-common-h3 tribe-common-h--alt tribe-events-c-top-bar__datepicker-button"
			data-js="tribe-events-top-bar-datepicker-button"
			type="button"
			aria-label="<?php esc_attr_e( 'Click to toggle datepicker', 'nightingale' ); ?>"
			title="<?php esc_attr_e( 'Click to toggle datepicker', 'nightingale' ); ?>"
	>
		<time
				datetime="<?php echo esc_attr( $the_date->format( 'Y-m' ) ); ?>"
				class="tribe-events-c-top-bar__datepicker-time"
		>
			<span class="tribe-events-c-top-bar__datepicker-mobile">
				<?php echo esc_html( $formatted_grid_date_mobile ); ?>
			</span>
			<span class="tribe-events-c-top-bar__datepicker-desktop tribe-common-a11y-hidden">
				<?php echo esc_html( $formatted_grid_date ); ?>
			</span>
		</time>
		<svg class="nhsuk-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M400 64h-48V12c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v52H160V12c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v52H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48zm-6 400H54c-3.3 0-6-2.7-6-6V160h352v298c0 3.3-2.7 6-6 6z"></path></svg>
	</button>
	<label
			class="tribe-events-c-top-bar__datepicker-label tribe-common-a11y-visual-hide"
			for="tribe-events-top-bar-date"
	>
		<?php esc_html_e( 'Select date.', 'nightingale' ); ?>
	</label>
	<input
			type="text"
			class="tribe-events-c-top-bar__datepicker-input tribe-common-a11y-visual-hide"
			data-js="tribe-events-top-bar-date"
			id="tribe-events-top-bar-date"
			name="tribe-events-views[tribe-bar-date]"
			value="<?php echo esc_attr( $datepicker_date ); ?>"
			tabindex="-1"
			autocomplete="off"
			readonly="readonly"
	/>
	<div class="tribe-events-c-top-bar__datepicker-container" data-js="tribe-events-top-bar-datepicker-container"></div>
</div>
