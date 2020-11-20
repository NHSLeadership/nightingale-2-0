<?php
/**
 * The sidebar containing the BuddyPress widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package BuddyBoss_Theme
 */

global $bp;
$profile_cover_width = nightingale_buddyboss_theme_get_option( 'buddyboss_profile_cover_width' );
$group_cover_width = nightingale_buddyboss_theme_get_option( 'buddyboss_group_cover_width' );

if ( function_exists( 'bp_is_active' ) ) {
	?>

	<?php if ( bp_is_current_component( 'activity' ) && !bp_is_user() ) : ?>

		<?php if( is_active_sidebar( 'activity_left' ) ) { ?>
			<div id="secondary" class="widget-area sm-grid-1-1 sidebar-left" role="complementary">
				<div class="bb-sticky-sidebar">
					<?php dynamic_sidebar( 'activity_left' ); ?>
				</div>
			</div>
		<?php } ?>

		<?php if( is_active_sidebar( 'activity_right' ) ) { ?>
			<div id="secondary-right" class="widget-area sm-grid-1-1 sidebar-right" role="complementary">
				<div class="bb-sticky-sidebar">
					<?php dynamic_sidebar( 'activity_right' ); ?>
				</div>
			</div>
		<?php } ?>

	<?php elseif ( is_active_sidebar( 'forums' ) && bp_is_current_component( 'forums' ) && !bp_is_user() ) : ?>

		<div id="secondary" class="widget-area sm-grid-1-1" role="complementary">
			<?php dynamic_sidebar( 'forums' ); ?>
		</div>

	<?php elseif ( function_exists( 'bp_disable_advanced_profile_search' ) && ( is_active_sidebar( 'members' ) || !bp_disable_advanced_profile_search() ) && bp_is_current_component( 'members' ) && !bp_is_user() ) : ?>

		<div id="secondary" class="widget-area sm-grid-1-1" role="complementary">
			<?php do_action( THEME_HOOK_PREFIX . 'before_members_widgets' ); ?>
			<?php dynamic_sidebar( 'members' ); ?>
		</div>

	<?php elseif ( is_active_sidebar('profile') && bp_is_user() && !bp_is_user_settings() && !bp_is_user_messages() && !bp_is_user_notifications() && !bp_is_user_profile_edit() && !bp_is_user_change_avatar() && !bp_is_user_change_cover_image() && !bp_is_user_front() && $profile_cover_width != 'full' ) :

            ob_start();
            dynamic_sidebar('profile' );
            $sidebar = ob_get_clean();  // get the contents of the buffer and turn it off.
            if ( $sidebar ) { ?>
                <div id="secondary" class="widget-area sm-grid-1-1 profile-widget-area" role="complementary">
                    <div class="bb-sticky-sidebar">
			            <?php dynamic_sidebar( 'profile' ); ?>
                    </div>
                </div>
	            <?php
            }
            ?>

	<?php elseif ( is_active_sidebar( 'groups' ) && bp_is_current_component( 'groups' ) && !bp_is_group() && !bp_is_user() ) : ?>

		<div id="secondary" class="widget-area sm-grid-1-1" role="complementary">
			<?php dynamic_sidebar( 'groups' ); ?>
		</div>

	<?php elseif ( is_active_sidebar( 'group' ) && bp_is_group() && $group_cover_width != 'full' ) : ?>

		<div id="secondary" class="widget-area sm-grid-1-1" role="complementary">
			<div class="bb-sticky-sidebar">
				<?php dynamic_sidebar( 'group' ); ?>
			</div>
		</div>

	<?php
	endif;
}
