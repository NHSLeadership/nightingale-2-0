<?php
/**
 * Account links in the header (name, role, log in / log out).
 *
 * Controlled by the Customizer setting "Account links in header".
 *
 * @package Nightingale
 * @copyright NHS Leadership Academy
 * @version 3.0.0
 */

$header_account = get_theme_mod( 'header_account', 'off' );

if ( 'off' === $header_account || ( 'logged_in' === $header_account && ! is_user_logged_in() ) ) {
	return;
}

// Send people back to the page they were on.
$current_url = isset( $_SERVER['REQUEST_URI'] ) ? esc_url_raw( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : home_url( '/' );

$account_items = array();

if ( is_user_logged_in() ) {
	$account_user = wp_get_current_user();

	$account_items[] = array(
		'text' => $account_user->display_name,
		'href' => get_edit_profile_url( $account_user->ID ),
		'icon' => true,
	);

	$account_role = ! empty( $account_user->roles ) ? reset( $account_user->roles ) : '';
	$all_roles    = wp_roles()->roles;
	if ( $account_role && isset( $all_roles[ $account_role ]['name'] ) ) {
		$account_items[] = array(
			'text' => translate_user_role( $all_roles[ $account_role ]['name'] ),
		);
	}

	$account_items[] = array(
		'text' => __( 'Log out', 'nightingale' ),
		'href' => wp_logout_url( $current_url ),
	);
} else {
	$account_items[] = array(
		'text' => __( 'Log in', 'nightingale' ),
		'href' => wp_login_url( $current_url ),
		'icon' => true,
	);
}

/**
 * Filter the account items shown in the header.
 *
 * Each item is an array with 'text', and optional 'href' and 'icon' (true shows the user icon).
 *
 * @param array $account_items Account items.
 */
$account_items = apply_filters( 'nightingale_header_account_items', $account_items );

if ( empty( $account_items ) || ! is_array( $account_items ) ) {
	return;
}
?>
<nav class="nhsuk-header__account" aria-label="<?php esc_attr_e( 'Account', 'nightingale' ); ?>">
	<ul class="nhsuk-header__account-list">
		<?php
		foreach ( $account_items as $account_item ) :
			if ( empty( $account_item['text'] ) ) {
				continue;
			}
			$account_icon = '';
			if ( ! empty( $account_item['icon'] ) ) {
				$account_icon = '<svg class="nhsuk-icon nhsuk-icon--user" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" focusable="false" aria-hidden="true"><path d="M12 1a11 11 0 1 1 0 22 11 11 0 0 1 0-22Zm0 2a9 9 0 0 0-5 16.5V18a4 4 0 0 1 4-4h2a4 4 0 0 1 4 4v1.5A9 9 0 0 0 12 3Zm0 3a3.5 3.5 0 1 1-3.5 3.5A3.4 3.4 0 0 1 12 6Z"/></svg>';
			}
			?>
			<li class="nhsuk-header__account-item">
				<?php if ( ! empty( $account_item['href'] ) ) : ?>
					<a class="nhsuk-header__account-link" href="<?php echo esc_url( $account_item['href'] ); ?>">
						<?php echo $account_icon; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?>
						<?php echo esc_html( $account_item['text'] ); ?>
					</a>
				<?php else : ?>
					<?php echo $account_icon; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?>
					<?php echo esc_html( $account_item['text'] ); ?>
				<?php endif; ?>
			</li>
		<?php endforeach; ?>
	</ul>
</nav>
