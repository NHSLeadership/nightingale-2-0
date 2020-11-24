<?php
/**
 * BuddyBoss - Groups Pending Invites
 *
 * @since BuddyBoss 1.2.3
 */

?>
<div id="group-invites-container">
	<?php bp_get_template_part( 'groups/single/parts/invite-subnav' ); ?>
	<div class="group-invites-column">
		<h2 class="bb-title"><?php _e( 'Pending Invites', 'buddyboss' ); ?></h2>
		<div class="subnav-filters group-subnav-filters bp-invites-filters">
			<div>
				<div class="group-invites-search" role="search">
					<div class="bp-search">
						<form action="" method="get" id="group_invites_search_form" class="nhsuk-search" data-bp-search="group-invites">
							<label for="group_invites_search" class="bp-screen-reader-text"><?php bp_nouveau_search_default_text( __( 'Search Members', 'buddyboss' ), false ); ?></label>
							<input type="search" id="group_invites_search" class="nhsuk-input" placeholder="<?php esc_attr_e( 'Search Members', 'buddyboss' ); ?>"/>
                            <button class="nhsuk-search__submit" type="submit">
                                <svg class="nhsuk-icon nhsuk-icon__search" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                                    <path d="M19.71 18.29l-4.11-4.1a7 7 0 1 0-1.41 1.41l4.1 4.11a1 1 0 0 0 1.42 0 1 1 0 0 0 0-1.42zM5 10a5 5 0 1 1 5 5 5 5 0 0 1-5-5z"></path>
                                </svg>
                                <span class="nhsuk-u-visually-hidden"><?php esc_attr_e( 'Search', 'nightingale' ); ?></span>
                            </button>
						</form>
					</div>
				</div>
				<div class="last"></div>
			</div>
		</div>

		<div class="bp-invites-feedback" style="display: none;">
			<div class="bp-invites-feedback">
				<div class="bp-feedback loading">
					<span class="bp-icon" aria-hidden="true"></span>
					<p><?php esc_html_e( 'Loading Members. Please Wait.', 'buddyboss' ); ?></p>
				</div>
			</div>
		</div>

		<div id="bp-pending-invites-loader" class="bp-pending-invites-loader-hide">
			<i class="dashicons dashicons-update animate-spin"></i>
		</div>

		<div class="members bp-invites-content">
			<ul id="members-list" class="item-list bp-list"></ul>
		</div>


	</div>
</div>

