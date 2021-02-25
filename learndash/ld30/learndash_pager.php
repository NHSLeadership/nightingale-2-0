<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * This file contains the code that displays the pager.
 *
 * @since 2.5.4
 *
 * @package Nightingale
 */

/**
 * Available Variables:
 * $pager_context  : (string) value defining context of pager output. For example 'course_lessons' would be the course template lessons listing.
 * $pager_results  : (array) query result details containing
 * $href_query_arg : query string parameter to use.
 * $href_val_prefix: prefix added to value. default is empty ''.
 * results<pre>Array
 * (
 *    [paged] => 1
 *    [total_items] => 30
 *    [total_pages] => 2
 * )
 */

if ( ( isset( $pager_results ) ) && ( ! empty( $pager_results ) ) ) {
	if ( ! isset( $pager_context ) ) {
		$pager_context = '';
	}
	if ( ! isset( $href_val_prefix ) ) {
		$href_val_prefix = '';
	}
	// Generic wrappers. These can be changes via the switch below.
	$wrapper_before = ' <nav role="navigation" aria-label="Pagination Navigation" class="learndash-pager learndash-pager-' . $pager_context . '"  data-nonce="' . wp_create_nonce( 'learndash-pager' ) . '">
							<ul>';
	$wrapper_after  = '      </ul>
						</nav>';

	if ( $pager_results['total_pages'] > 1 ) {
		if ( ( ! isset( $href_query_arg ) ) || ( empty( $href_query_arg ) ) ) {
			switch ( $pager_context ) {
				case 'course_lessons':
					$href_query_arg = 'ld-lesson-page';
					break;

				case 'course_lesson_topics':
					$href_query_arg = 'ld-topic-page';
					break;

				case 'profile':
					$href_query_arg = 'ld-profile-page';
					break;

				case 'course_content':
					$href_query_arg = 'ld-courseinfo-lesson-page';
					break;

				case 'course_list':
					$href_query_arg = 'ld-courseinfo-lesson-page'; // whatever we want in here.
					break;
				// These are just here to show the existing different context items.
				case 'course_info_registered':
				case 'course_info_courses':
				case 'course_info_quizzes':
				case 'course_navigation_widget':
				case 'course_navigation_admin':
				default:
					break;
			}
		}

		echo $wrapper_before; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		$pager_left_class = '';
		if ( 1 === $pager_results['paged'] ) {
			$pager_left_disabled = ' disabled="disabled" ';
			$pager_left_class    = 'disabled';
		}
		$prev_page_number     = ( $pager_results['paged'] > 1 ) ? $pager_results['paged'] - 1 : 1;
		$pager_right_disabled = '';
		$pager_right_class    = '';
		if ( $pager_results['paged'] === $pager_results['total_pages'] ) {
			$pager_right_disabled = ' disabled="disabled" ';
			$pager_right_class    = 'disabled';
		}
		?>
		<li>
			<a
			<?php if ( ( isset( $href_query_arg ) ) && ( ! empty( $href_query_arg ) ) ) { ?>
				href="<?php echo esc_html( add_query_arg( $href_query_arg, $href_val_prefix . 1 ) ); ?>"
			<?php } ?>
			data-paged="<?php echo esc_attr( $href_val_prefix ); ?>1" class="nhsuk-tag nhsuk-tag--white <?php echo esc_attr( $pager_left_class ); ?>" <?php echo esc_attr( $pager_left_disabled ); ?> title="<?php esc_attr_e( 'First Page', 'nightingale' ); ?>">
			&laquo;
			<span class="nhsuk-u-visually-hidden" aria-hidden="true">First Page</span>
			</a>
		</li>
		<?php
		$count = 0;
		while ( $count < $pager_results['total_pages'] ) {
			$count ++;
			$pager_disabled = '';
			$pager_colour   = ' nhsuk-tag--white';
			$linkit         = add_query_arg( $href_query_arg, $href_val_prefix . $count );
			$reader_alt     = 'Go to Page ';
			if ( $pager_results['paged'] === $count ) {
				$pager_disabled = 'disabled="disabled" ';
				$pager_colour   = '';
				$linkit         = '';
				$reader_alt     = 'You are currently on page ';
			}
			?>
			<li>
				<a
			<?php if ( ( isset( $href_query_arg ) ) && ( ! empty( $href_query_arg ) ) ) { ?>
				href="<?php echo esc_attr( $linkit ); ?>"
			<?php } ?>
				data-paged="<?php echo esc_attr( $href_val_prefix . $count ); ?>" class="nhsuk-tag <?php echo esc_attr( $pager_colour ); ?>" <?php echo esc_attr( $pager_disabled ); ?> aria-label="<?php esc_attr_e( 'Go to Page ', 'nightingale' ) . esc_attr( $count ); ?>">
					<span class="nhsuk-u-visually-hidden" aria-hidden="true"><?php esc_html( $reader_alt ); ?></span>
					<?php echo esc_html( $count ); ?>
				</a>
			</li>
			<?php

		}
		?>
			<li>
				<a <?php if ( ( isset( $href_query_arg ) ) && ( ! empty( $href_query_arg ) ) ) { ?>
					href="<?php echo esc_attr( add_query_arg( $href_query_arg, $href_val_prefix . $pager_results['total_pages'] ) ); ?>"
				<?php } ?> data-paged="<?php echo esc_attr( $href_val_prefix . $pager_results['total_pages'] ); ?>" class="nhsuk-tag nhsuk-tag--white <?php esc_html( $pager_right_class ); ?>" <?php echo esc_html( $pager_right_disabled ); ?> title="<?php esc_attr_e( 'Last Page', 'nightingale' ); ?>">
				&raquo;
				<span class="nhsuk-u-visually-hidden" aria-hidden="true">Last Page</span>
				</a>
			</li>
		<?php
		echo $wrapper_after; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
}
