<?php
/**
 * BuddyPress Single Groups Invites Navigation
 *
 * @since BuddyBoss 1.2.3
 */
?>
<div class="nhsuk-grid-full-width">
<nav class="nhsuk-bordered-tabs-container" id="subnav" role="navigation" aria-label="<?php esc_attr_e( 'Group administration menu', 'nightingale' ); ?>">

	<?php if ( bp_nouveau_has_nav( array( 'object' => 'group_invite' ) ) ) : ?>

		<ul class="nhsuk-bordered-tabs">

			<?php
			while ( bp_nouveau_nav_items() ) :
				bp_nouveau_nav_item();
			$current = bp_nouveau_get_nav_link();
				$link        = '';
				$current_url = $actual_link = ( isset( $_SERVER[ 'HTTPS' ] ) && $_SERVER[ 'HTTPS' ] === 'on' ? "https" : "http" ) . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

				if ( strpos( $current_url, '/send-invites/' ) !== false ) {
				    if ( strpos( bp_nouveau_get_nav_link(), '/send-invites/' ) !== false ) {
					    $link = ' nhsuk-bordered-tabs-item-active-alt';
				    }
				} else if ( strpos( $current_url, '/pending-invites/' ) !== false ) {
					if ( strpos( bp_nouveau_get_nav_link(), '/pending-invites/' ) !== false ) {
						$link = ' nhsuk-bordered-tabs-item-active-alt';
					}
				}
			?>

				<li id="<?php bp_nouveau_nav_id(); ?>" class="nhsuk-bordered-tabs-item <?php echo $link; ?>">
					<a href="<?php bp_nouveau_nav_link(); ?>" class="nhsuk-bordered-tabs-link">
						<?php bp_nouveau_nav_link_text(); ?>

						<?php if ( bp_nouveau_nav_has_count() ) : ?>
							<span class="count"><?php bp_nouveau_nav_count(); ?></span>
						<?php endif; ?>
					</a>
				</li>

			<?php endwhile; ?>
			<?php if ( bp_is_active( 'friends' ) ) { ?>
                <li class="nhsuk-bordered-tabs-item bp-group-message-wrap">
                    <div class="nhsuk-checkboxes">
                        <div class="nhsuk-checkboxes__item">
                            <input id="bp-group-send-invite-switch-checkbox" class="bp-group-send-invite-switch-checkbox bb-input-switch nhsuk-checkboxes__input" type="checkbox" />
                            <label for="bp-group-send-invite-switch-checkbox" class="nhsuk-label nhsuk-checkboxes__label"><span class="select-members-text"><?php _e( 'Show Only My Connections', 'nightingale' ); ?></span></label>

                        </div>
                    </div>
                </li>
			<?php } ?>
		</ul>

	<?php endif; ?>

</nav><!-- #isubnav -->
    <div class="bb-panel-subhead">

    </div>
</div>
