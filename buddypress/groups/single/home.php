<?php
/**
 * BuddyBoss - Groups Home
 *
 * @since BuddyPress 3.0.0
 * @version 3.0.0
 */

$bp_nouveau_appearance = bp_get_option('bp_nouveau_appearance');
$group_cover_width = nightingale_buddyboss_theme_get_option( 'buddyboss_group_cover_width' );

if ( bp_has_groups() ) :
	while ( bp_groups() ) :
		bp_the_group();
	?>

		<?php bp_nouveau_group_hook( 'before', 'home_content' ); ?>

		<div id="item-header" role="complementary" data-bp-item-id="<?php bp_group_id(); ?>" data-bp-item-component="groups" class="groups-header single-headers">

			<?php bp_nouveau_group_header_template_part(); ?>

		</div><!-- #item-header -->

		<?php if ( ( isset($bp_nouveau_appearance['group_nav_display']) && $bp_nouveau_appearance['group_nav_display'] ) && is_active_sidebar( 'group' ) && $group_cover_width != 'default' ) { ?>
			<div class="bb-grid bb-user-nav-display-wrap">
				<div class="bp-wrap-outer">
		<?php } ?>

		<div class="bp-wrap">

			<?php if ( ! bp_nouveau_is_object_nav_in_sidebar() ) : ?>

				<?php bp_get_template_part( 'groups/single/parts/item-nav' ); ?>

			<?php endif; ?>

			<div class="bb-profile-grid bb-grid">
				<div id="item-body" class="item-body">
					<?php bp_nouveau_group_template_part(); ?>
				</div>

				<?php if ( ( !isset($bp_nouveau_appearance['group_nav_display']) || !$bp_nouveau_appearance['group_nav_display'] ) && is_active_sidebar( 'group_activity' ) && bp_is_group_activity() ) { ?>
					<div id="group-activity" class="widget-area sm-grid-1-1" role="complementary">
						<div class="bb-sticky-sidebar">
							<?php dynamic_sidebar( 'group_activity' ); ?>
						</div>
					</div>
				<?php } ?>

				<?php if ( ( !isset($bp_nouveau_appearance['group_nav_display']) || !$bp_nouveau_appearance['group_nav_display'] ) && is_active_sidebar( 'group' ) && $group_cover_width == 'full' ) { ?>
					<div id="secondary" class="widget-area sm-grid-1-1 no-padding-top" role="complementary">
						<div class="bb-sticky-sidebar">
							<?php dynamic_sidebar( 'group' ); ?>
						</div>
					</div>
				<?php } ?>
			</div>

		</div><!-- // .bp-wrap -->

		<?php if ( ( isset($bp_nouveau_appearance['group_nav_display']) && $bp_nouveau_appearance['group_nav_display'] ) && is_active_sidebar( 'group' ) && $group_cover_width != 'default' ) { ?>
				</div>
				<div id="secondary" class="widget-area sm-grid-1-1 no-padding-top" role="complementary">
					<div class="bb-sticky-sidebar">
						<?php dynamic_sidebar( 'group' ); ?>
					</div>
				</div>
			</div>
		<?php } ?>

		<?php bp_nouveau_group_hook( 'after', 'home_content' ); ?>

	<?php endwhile; ?>

<?php
endif;
