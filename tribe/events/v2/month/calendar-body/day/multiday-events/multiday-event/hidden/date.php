<?php
/**
 * View: Month View - Single Multiday Event Hidden Date
 *
 * @package nightingale
 *
 * @since 5.1.1
 *
 * @var WP_Post $event The event post object with properties added by the `tribe_get_event` function.
 *
 * @see tribe_get_event() For the format of the event object.
 *
 * @version 5.1.1
 */

use Tribe__Date_Utils as Dates;
?>
<time
	datetime="<?php echo esc_attr( $event->dates->start->format( Dates::DBDATEFORMAT ) ); ?>"
	class="tribe-common-a11y-visual-hide"
>
	<?php echo esc_attr( $event->dates->start->format( Dates::DBDATEFORMAT ) ); ?>
</time>
