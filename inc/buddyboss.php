<?php

/**
 * Get BuddyBoss related theme options
 *
 * @param string $id Option ID.
 * @param string $param Option type.
 * @param bool   $default default value.
 *
 * @return $output False on failure, Option.
 */
if ( !function_exists( 'nightingale_buddyboss_theme_get_option' ) ) {

	function nightingale_buddyboss_theme_get_option( $id, $param = null, $default = false ) {

		global $nightingale_buddyboss_theme_options;

		/* Check if options are set */
		if ( !isset( $nightingale_buddyboss_theme_options ) ) {
			$nightingale_buddyboss_theme_options = get_option( 'theme_mods_nightingale', array() );
		}

		/* Check if array subscript exist in options */
		if ( empty( $nightingale_buddyboss_theme_options[ $id ] ) ) {
			if ( array_key_exists( $id, $nightingale_buddyboss_theme_options ) ) {
				return false;
			} else {
				// Return true if default passed to true and key not exists into the buddyboss_theme_options array.
				return ( $default ) ? true : false;
			}
		}

		/**
		 * If $param exists,  then
		 * 1. It should be 'string'.
		 * 2. '$nightingale_buddyboss_theme_options[ $id ]' should be array.
		 * 3. '$param' array key exists.
		 */
		if ( !empty( $param ) && is_string( $param ) && (!is_array( $nightingale_buddyboss_theme_options[ $id ] ) || !array_key_exists( $param, $nightingale_buddyboss_theme_options[ $id ] ) ) ) {
			return false;
		}

		return empty( $param ) ? $nightingale_buddyboss_theme_options[ $id ] : $nightingale_buddyboss_theme_options[ $id ][ $param ];
	}
}

///////////////////////////////////////////////////////////////////////////////
// Check if BuddyPress is installed
//////////////////////////////////////////////////////////////////////////////
if ( function_exists( 'bp_is_active' ) ) {
	global $blog_id, $current_blog;
	if ( is_multisite() ) {
//check if multiblog
		if ( defined( 'BP_ENABLE_MULTIBLOG' ) && BP_ENABLE_MULTIBLOG ) {
			$bp_active = 'true';
		} elseif ( defined( 'BP_ROOT_BLOG' ) && BP_ROOT_BLOG == $current_blog->blog_id ) {
			$bp_active = 'true';
		} elseif ( defined( 'BP_ROOT_BLOG' ) && ( $blog_id != 1 ) ) {
			$bp_active = 'false';
		}
	} else {
		$bp_active = 'true';
	}
} else {
	$bp_active = 'false';
}
