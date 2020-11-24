<?php
/**
 * BuddyBoss - Members Home
 *
 * @since BuddyPress   1.0.0
 * @version 3.0.0
 */


$bp                    = buddypress();
$grid_class            = '';
$user_full_template    = '';
$bp_nouveau_appearance = bp_get_option('bp_nouveau_appearance');
$profile_cover_width   = nightingale_buddyboss_theme_get_option( 'buddyboss_profile_cover_width' );

if ( !bp_is_user_front() && ! empty( $bp->template_message ) && ! empty( $bp->template_message_type ) && $bp->template_message_type == 'bp-sitewide-notice' ) {
	bp_nouveau_template_notices();
}

if( !bp_is_user_settings() && !bp_is_user_messages() && !bp_is_user_notifications() && !bp_is_user_profile_edit() && !bp_is_user_change_avatar() && !bp_is_user_change_cover_image() ) {
	$grid_class = 'bb-grid';
}

if ( bp_is_user_messages() || bp_is_user_settings() || bp_is_user_notifications() || bp_is_user_profile_edit() || bp_is_user_change_avatar() || bp_is_user_change_cover_image() ) {
	$user_full_template = 'bp-fullwidth-wrap';
}
?>

	<?php bp_nouveau_member_hook( 'before', 'home_content' ); ?>

	<div id="item-header" role="complementary" data-bp-item-id="<?php echo esc_attr( bp_displayed_user_id() ); ?>" data-bp-item-component="members" class="users-header single-headers">

		<?php bp_nouveau_member_header_template_part(); ?>

	</div><!-- #item-header -->

	<?php if ( isset($bp_nouveau_appearance['user_nav_display']) && $bp_nouveau_appearance['user_nav_display'] &&  is_active_sidebar( 'profile' ) && !bp_is_user_settings() && !bp_is_user_messages() && !bp_is_user_notifications() && !bp_is_user_profile_edit() && !bp_is_user_change_avatar() && !bp_is_user_change_cover_image() && $profile_cover_width != 'default' ) {
		$grid_class = '';
		?>
		<div class="bb-grid bb-user-nav-display-wrap">
			<div class="bp-wrap-outer">
	<?php } ?>

	<div class="bp-wrap <?php echo $user_full_template; ?>">
		<?php if ( ! bp_nouveau_is_object_nav_in_sidebar() && ! bp_is_user_messages() && ! bp_is_user_settings() && ! bp_is_user_notifications() && ! bp_is_user_profile_edit() && ! bp_is_user_change_avatar() && ! bp_is_user_change_cover_image() ) : ?>

			<?php bp_get_template_part( 'members/single/parts/item-nav' ); ?>

		<?php endif; ?>

		<div class="bb-profile-grid <?php echo $grid_class; ?>">
			<div id="item-body" class="item-body">
				<div class="item-body-inner">
					<?php bp_nouveau_member_template_part(); ?>
				</div>
			</div><!-- #item-body -->

			<?php
			if ( ( !isset($bp_nouveau_appearance['user_nav_display']) || !$bp_nouveau_appearance['user_nav_display'] ) && is_active_sidebar('user_activity') && bp_is_user_activity() ) {

				ob_start();
				dynamic_sidebar('user_activity' );
				$sidebar = ob_get_clean();  // get the contents of the buffer and turn it off.
				if ( trim( $sidebar ) ) { ?>
					<div id="user-activity" class="widget-area" role="complementary">
						<div class="bb-sticky-sidebar">
							<?php dynamic_sidebar( 'user_activity' ); ?>
						</div>
					</div><?php
				}
			}

			if ( ( !isset($bp_nouveau_appearance['user_nav_display']) || !$bp_nouveau_appearance['user_nav_display'] ) && is_active_sidebar( 'profile' ) && !bp_is_user_settings() && !bp_is_user_messages() && !bp_is_user_notifications() && !bp_is_user_profile_edit() && !bp_is_user_change_avatar() && !bp_is_user_change_cover_image() && !bp_is_user_front() && $profile_cover_width == 'full' ) {

			    ob_start();
	            dynamic_sidebar('profile' );
	            $sidebar = ob_get_clean();  // get the contents of the buffer and turn it off.
				if ( trim( $sidebar ) ) { ?>
					<div id="secondary" class="widget-area sm-grid-1-1 no-padding-top" role="complementary">
						<div class="bb-sticky-sidebar">
							<?php dynamic_sidebar( 'profile' ); ?>
						</div>
					</div>
					<?php
				}
			}
			?>
		</div>

	</div><!-- // .bp-wrap -->

	<?php if ( isset($bp_nouveau_appearance['user_nav_display']) && $bp_nouveau_appearance['user_nav_display'] &&  is_active_sidebar( 'profile' ) && !bp_is_user_settings() && !bp_is_user_messages() && !bp_is_user_notifications() && !bp_is_user_profile_edit() && !bp_is_user_change_avatar() && !bp_is_user_change_cover_image() && !bp_is_user_front() && $profile_cover_width != 'default' ) { ?>
			</div>

			<?php
			ob_start();
			dynamic_sidebar('profile' );
			$sidebar = ob_get_clean();  // get the contents of the buffer and turn it off.
			if ( trim( $sidebar ) ) {
				?>
				<div id="secondary" class="widget-area sm-grid-1-1 no-padding-top" role="complementary">
					<div class="bb-sticky-sidebar">
						<?php dynamic_sidebar( 'profile' ); ?>
					</div>
				</div>
				<?php
			}
			?>

		</div>
	<?php } ?>

	<?php bp_nouveau_member_hook( 'after', 'home_content' ); ?>
