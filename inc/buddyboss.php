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
/**
 * Group Admins Count
 */
if ( ! function_exists( 'nightingale_theme_bp_get_group_admins_count' ) ) {

	function nightingale_theme_bp_get_group_admins_count() {
		global $groups_template;
		$group = $groups_template->group;

		if ( ! empty( $group->admins ) ) {
			return sizeof( $group->admins );
		}
	}
}

/**
 * Output an HTML-formatted link for the current group in the loop.
 *
 * @since BuddyPress 2.9.0
 *
 * @param BP_Groups_Group|null $group Optional. Group object.
 *                                    Default: current group in loop.
 */
function nightingale_bp_group_link( $group = null ) {
	echo nightingale_bp_get_group_link( $group );
}
/**
 * Return an HTML-formatted link for the current group in the loop.
 *
 * @since BuddyPress 2.9.0
 *
 * @param BP_Groups_Group|null $group Optional. Group object.
 *                                    Default: current group in loop.
 * @return string
 */
function nightingale_bp_get_group_link( $group = null ) {
	global $groups_template;

	if ( empty( $group ) ) {
		$group =& $groups_template->group;
	}

	$link = sprintf(
		'<a href="%s" class="bp-group-home-link %s-home-link">%s</a>',
		esc_url( bp_get_group_permalink( $group ) ),
		esc_attr( bp_get_group_slug( $group ) ),
		esc_html( bp_get_group_name( $group ) )
	);

	/**
	 * Filters the HTML-formatted link for the current group in the loop.
	 *
	 * @since BuddyPress 2.9.0
	 *
	 * @param string          $value HTML-formatted link for the
	 *                               current group in the loop.
	 * @param BP_Groups_Group $group The current group object.
	 */
	return apply_filters( 'nightingale_bp_get_group_link', $link, $group );
}
