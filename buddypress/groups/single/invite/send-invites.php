<?php
/**
 * BuddyBoss - Groups Send Invites
 *
 * @since BuddyBoss 1.2.3
 */

?>
<?php
if ( ! bp_is_group_creation_step( 'group-invites' ) ) {
	bp_get_template_part( 'groups/single/parts/invite-subnav' );
}
?>
<div id="group-invites-container" class="nhsuk-grid-column-full">
	<div class="bb-groups-invites-left nhsuk-grid-column-two-thirds">



			<div class="group-invites-search" role="search">
				<div class="bp-search">
					<form action="" method="get" id="group_invites_search_form" class="nhsuk-search" data-bp-search="group-invites">
						<label for="group_invites_search" class="bp-screen-reader-text"><?php bp_nouveau_search_default_text( __( 'Search Members', 'nightingale' ), false ); ?></label>
						<input type="search" class="nhsuk-input" id="group_invites_search" placeholder="<?php esc_attr_e( 'Search Members', 'nightingale' ); ?>"/>
                        <button class="nhsuk-search__submit" type="submit">
                            <svg class="nhsuk-icon nhsuk-icon__search" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                                <path d="M19.71 18.29l-4.11-4.1a7 7 0 1 0-1.41 1.41l4.1 4.11a1 1 0 0 0 1.42 0 1 1 0 0 0 0-1.42zM5 10a5 5 0 1 1 5 5 5 5 0 0 1-5-5z"></path>
                            </svg>
                            <span class="nhsuk-u-visually-hidden"><?php esc_attr_e( 'Search', 'nightingale' ); ?></span>
                        </button>
					</form>
				</div>
			</div>
			<div class="group-invites-members-listing">
				<div class="bp-invites-feedback">
					<div class="bp-feedback">
						<span class="bp-icon" aria-hidden="true"></span>
						<p></p>
					</div>
				</div>
				<div class="last"></div>
				<span class="total-members-text"></span>
				<ul id="members-list" class="item-list bp-list all-members"></ul>
				<div class="bb-invites-footer">
					<a class="bb-close-invites-members button" href="#"><?php _e( 'Done', 'nightingale' ); ?></a>
				</div>
			</div>
	</div>
	<div class="bb-groups-invites-right nhsuk-grid-column-one-third">
		<form id="send_group_invite_form" class="standard-form" data-select2-id="send_group_invite_form">
			<div class="bb-groups-invites-right-top">
				<div class="bb-title-wrap">
					<h2 class="bb-title"><?php _e( 'Send Invites', 'nightingale' ); ?></h2>
					<div class="bb-more-invites-wrap"><a class="bb-add-invites nhsuk-button" href="#"><span class="bb-icons bb-icon-plus-circle"></span><?php _e( 'Select Members', 'nightingale' ); ?></a></div>
				</div>
				<div class="bp-invites-feedback nhsuk-inset-text nhsuk-inset-text--rev">
						<p><?php esc_html_e( 'Select members to invite by clicking the + button next to each member.', 'nightingale' ); ?></p>
				</div>
				<select name="group_invites_send_to[]" class="send-to-input select2-hidden-accessible" id="group-invites-send-to-input" placeholder="<?php _e( 'Type the names of one or more people','nightingale' ); ?>" autocomplete="off" multiple="" style="width: 100%" data-select2-id="group-invites-send-to-input" tabindex="-1" aria-hidden="true"></select>
			</div>
			<div class="bb-groups-invites-right-bottom">
				<div id="bp-group-invite-content">
					<textarea class="bp-faux-placeholder-label" id="send-invites-control" name="group_invite_content" rows="120" cols="150" placeholder="<?php _e( 'Customize the message of your invite.','nightingale' ); ?>"></textarea>
					<input type="hidden" id="group_invite_content_hidden" name="group_invite_content_hidden" value="">
					<div id="whats-new-toolbar">
						<div id="group-invites-new-submit" class="submit">
							<div id="bp-invites-submit-loader" class="bp-invites-submit-loader-hide">
								<i class="bb-icons bb-icon-loader animate-spin"></i>
							</div>
							<input type="submit" name="send_group_invite_button" value="<?php esc_attr_e( 'Send', 'nightingale' ); ?>" id="send_group_invite_button" class="small">
							<input type="submit" name="bp_invites_reset" value="<?php esc_attr_e( 'Cancel', 'nightingale' ); ?>" id="bp_invites_reset" class="small">
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>

