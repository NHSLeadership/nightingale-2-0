<?php
/**
 * Customised Learndash native breadcrumbs output markup.
 *
 * @date         March 8th 2021
 * @version      1.0
 * @author       Tony Blacker
 * @copyright    OGL v3
 * @package      Nightingale Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( true !== nightingale_uncanny_breadcrumb_check() ) { // suppress this output if Uncanny Breadcrumbs is live.
	/**
	 * Fires before the breadcrumbs.
	 */
	do_action( 'learndash-breadcrumbs-before' ); // phpcs:ignore WordPress.NamingConventions.ValidHookName.UseUnderscores ?>

<div class="nhsuk-breadcrumb__list">
	<?php
	$breadcrumbs = learndash_get_breadcrumbs();

	/** This filter is documented in themes/ld30/includes/helpers.php */
	$keys = apply_filters(
		'learndash_breadcrumbs_keys',
		array(
			'course',
			'lesson',
			'topic',
			'current',
		)
	);

	if ( is_rtl() ) {
		$keys = array_reverse( $keys );
	};

	foreach ( $keys as $key ) :
		if ( isset( $breadcrumbs[ $key ] ) ) :
			?>
			<span class="nhsuk-breadcrumb__item"><a href="<?php echo esc_url( $breadcrumbs[ $key ]['permalink'] ); ?>"><?php echo esc_html( wp_strip_all_tags( $breadcrumbs[ $key ]['title'] ) ); ?></a> </span>
			<?php
		endif;
	endforeach;
	?>
</div> <!--/.ld-breadcrumbs-segments-->

	<?php
	/**
	 * Fires after the breadcrumbs.
	 */
	do_action( 'learndash-breadcrumbs-after' ); // phpcs:ignore WordPress.NamingConventions.ValidHookName.UseUnderscores
}
