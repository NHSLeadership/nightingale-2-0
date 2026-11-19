<?php
/**
 * Things to do once after the theme is updated to a new version.
 *
 * - Clear page caches, so visitors do not get old saved pages that use the
 *   previous theme markup and CSS.
 * - Tell admins who use a child theme to check it after a major update.
 *
 * @package Nightingale
 */

defined( 'ABSPATH' ) || exit;

/**
 * Get the version of the parent Nightingale theme.
 *
 * @return string
 */
function nightingale_theme_version() {
	return (string) wp_get_theme( get_template() )->get( 'Version' );
}

/**
 * Run once when the theme version changes (update by dashboard, FTP or deploy).
 */
function nightingale_maybe_run_update_tasks() {
	$current = nightingale_theme_version();
	// Versions before 3.0.0 did not save this option, so a missing value means an older version.
	$previous = (string) get_option( 'nightingale_theme_version', '0' );

	if ( ! $current || $previous === $current ) {
		return;
	}

	update_option( 'nightingale_theme_version', $current, true );

	nightingale_clear_page_caches();

	if ( version_compare( $previous, '3.0.0', '<' ) && version_compare( $current, '3.0.0', '>=' ) ) {
		update_option( 'nightingale_show_v3_child_theme_notice', 1, false );
	}

	/**
	 * Fires once after the Nightingale theme version changes.
	 *
	 * @param string $current  New theme version.
	 * @param string $previous Previous theme version, or '0' if unknown (before 3.0.0).
	 */
	do_action( 'nightingale_theme_updated', $current, $previous );
}
add_action( 'init', 'nightingale_maybe_run_update_tasks', 99 );

/**
 * Run one cache-clearing call. Any error is caught and logged, so a broken
 * cache plugin can never stop the site from loading.
 *
 * @param callable $callback Function that clears a cache.
 */
function nightingale_safe_cache_call( $callback ) {
	try {
		call_user_func( $callback );
	} catch ( Throwable $e ) {
		if ( defined( 'WP_DEBUG_LOG' ) && WP_DEBUG_LOG ) {
			error_log( 'Nightingale: cache clear failed: ' . $e->getMessage() ); // phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_error_log
		}
	}
}

/**
 * Clear the object cache and page caches of popular caching plugins and hosts.
 * Each call only runs if that plugin or host is present.
 */
function nightingale_clear_page_caches() {
	$calls = array( 'wp_cache_flush' );

	// WP Rocket, W3 Total Cache, WP Super Cache, SiteGround Speed Optimizer.
	foreach ( array( 'rocket_clean_domain', 'rocket_clean_minify', 'w3tc_flush_all', 'wp_cache_clear_cache', 'sg_cachepress_purge_cache' ) as $fn ) {
		if ( function_exists( $fn ) ) {
			$calls[] = $fn;
		}
	}
	// WP Fastest Cache.
	if ( function_exists( 'wpfc_clear_all_cache' ) ) {
		$calls[] = function () {
			wpfc_clear_all_cache( true );
		};
	}
	// Autoptimize.
	if ( class_exists( 'autoptimizeCache' ) && method_exists( 'autoptimizeCache', 'clearall' ) ) {
		$calls[] = array( 'autoptimizeCache', 'clearall' );
	}
	// WP Engine.
	if ( class_exists( 'WpeCommon' ) ) {
		foreach ( array( 'purge_memcached', 'purge_varnish_cache' ) as $method ) {
			if ( method_exists( 'WpeCommon', $method ) ) {
				$calls[] = array( 'WpeCommon', $method );
			}
		}
	}
	// Plugins that clear their cache through an action: LiteSpeed, Breeze, Cache Enabler, Hummingbird, Super Page Cache for Cloudflare.
	foreach ( array( 'litespeed_purge_all', 'breeze_clear_all_cache', 'cache_enabler_clear_complete_cache', 'wphb_clear_page_cache', 'swcfpc_purge_cache' ) as $action ) {
		$calls[] = function () use ( $action ) {
			do_action( $action );
		};
	}

	foreach ( $calls as $callback ) {
		nightingale_safe_cache_call( $callback );
	}
}

/**
 * Show a one-time notice to admins of sites that use a child theme after the 3.0 update.
 */
function nightingale_v3_child_theme_notice() {
	if ( ! is_child_theme() || ! current_user_can( 'switch_themes' ) || ! get_option( 'nightingale_show_v3_child_theme_notice' ) ) {
		return;
	}

	$dismiss_url = wp_nonce_url( add_query_arg( 'nightingale_dismiss_v3_notice', '1' ), 'nightingale_dismiss_v3_notice' );

	printf(
		'<div class="notice notice-warning"><p><strong>%1$s</strong> %2$s</p><p>%3$s <a href="%4$s" target="_blank" rel="noopener noreferrer">%5$s</a></p><p><a href="%6$s">%7$s</a></p></div>',
		esc_html__( 'Nightingale 3.0 is a big update.', 'nightingale' ),
		esc_html__( 'Your site uses a child theme. Please check that your pages still look correct, especially the header, footer and any custom styles.', 'nightingale' ),
		esc_html__( 'If something looks wrong, first clear your site and hosting cache. If it is still wrong, you can go back to Nightingale 2.7.17 while you update your child theme:', 'nightingale' ),
		esc_url( 'https://github.com/NHSLeadership/nightingale-2-0/releases' ),
		esc_html__( 'previous versions', 'nightingale' ),
		esc_url( $dismiss_url ),
		esc_html__( 'I have checked, hide this message', 'nightingale' )
	);
}
add_action( 'admin_notices', 'nightingale_v3_child_theme_notice' );

/**
 * Hide the child theme notice for everyone once an admin dismisses it.
 */
function nightingale_dismiss_v3_child_theme_notice() {
	if ( ! isset( $_GET['nightingale_dismiss_v3_notice'] ) || ! current_user_can( 'switch_themes' ) ) {
		return;
	}
	check_admin_referer( 'nightingale_dismiss_v3_notice' );
	delete_option( 'nightingale_show_v3_child_theme_notice' );
	wp_safe_redirect( remove_query_arg( array( 'nightingale_dismiss_v3_notice', '_wpnonce' ) ) );
	exit;
}
add_action( 'admin_init', 'nightingale_dismiss_v3_child_theme_notice' );
