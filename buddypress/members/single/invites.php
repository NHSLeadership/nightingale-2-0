<?php
/**
 * BuddyPress - Invites Settings
 *
 * @version 3.0.0
 */

$profile_link = trailingslashit( bp_displayed_user_domain() . bp_get_profile_slug() );
?>

<div class="bp-settings-container">
	<?php if ( bp_core_can_edit_settings() ) : ?>
		<?php bp_get_template_part( 'members/single/parts/item-subnav' ); ?>
	<?php endif; ?>
	<div class="bb-bp-invites-content">
		<?php
		switch ( bp_current_action() ) :
			case 'send-invites':
				bp_get_template_part( 'members/single/invites/send-invites' );
				break;
			case 'sent-invites':
				bp_get_template_part( 'members/single/invites/sent-invites' );
				break;
			default:
				bp_get_template_part( 'members/single/plugins' );
				break;
		endswitch;
		?>
	</div>
</div>
