<?php
/**
 * View: Day View Type separator
 *
 * @package nightingale
 *
 * @version 4.9.11
 */

use Tribe\Events\Views\V2\Utils;
use Tribe__Date_Utils as Dates;

$should_have_type_separator = Utils\Separators::should_have_type( $this->get( 'events' ), $event );

if ( ! $should_have_type_separator ) {
	return;
}

$separator_text = '';

if ( 'all_day' === $event->timeslot ) {
	$separator_text = __( 'All Day', 'nightingale' );
} elseif ( 'multiday' === $event->timeslot ) {
	$separator_text = __( 'Ongoing', 'nightingale' );
}
?>
<div class="tribe-events-calendar-day__type-separator">
	<span class="tribe-events-calendar-day__type-separator-text tribe-common-h7 tribe-common-h6--min-medium tribe-common-h--alt">
		<?php echo esc_html( $separator_text ); ?>
	</span>
</div>
