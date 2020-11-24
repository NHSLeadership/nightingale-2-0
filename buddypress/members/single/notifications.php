<?php
/**
 * BuddyBoss - Users Notifications
 *
 * @since BuddyPress 3.0.0
 * @version 3.0.0
 */
?>

<header class="entry-header notifications-header flex">
	<h1 class="entry-title flex-1"><?php esc_html_e( 'Notifications', 'nightingale'); ?></h1>
	<?php bp_get_template_part( 'members/single/parts/item-subnav' ); ?>
	<?php bp_get_template_part( 'common/search-and-filters-bar' ); ?>
</header>

<?php
switch ( bp_current_action() ) :

	case 'unread':
	case 'read':
	?>

		<div id="notifications-user-list" class="notifications dir-list" data-bp-list="notifications">
			<div id="bp-ajax-loader"><?php bp_nouveau_user_feedback( 'member-notifications-loading' ); ?></div>
		</div>

		<?php
		break;

	// Any other actions.
	default:
		bp_get_template_part( 'members/single/plugins' );
		break;
endswitch;
