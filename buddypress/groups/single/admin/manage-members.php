<?php
/**
 * BP Nouveau Group's manage members template.
 *
 * @since   BuddyPress 3.0.0
 * @version 3.1.0
 */
?>

<h2 class="bp-screen-title <?php if ( bp_is_group_create() ) {
	echo esc_attr( 'creation-step-name' );
} ?>">
	<?php esc_html_e( 'Manage Group Members', 'nightingale' ); ?>
</h2>

<p class="bp-help-text"><?php printf( __( 'Manage group members; promote to %s, co-%s, or demote or ban.', 'nightingale' ), strtolower( get_group_role_label( bp_get_current_group_id(), 'moderator_plural_label_name' ) ), strtolower( get_group_role_label( bp_get_current_group_id(), 'organizer_plural_label_name' ) ) ); ?></p>
<div class="nhsuk-card">
    <div class="nhsuk-card__content">
        <h3 class="nhsuk-card__heading">
			<?php echo esc_html( get_group_role_label( bp_get_current_group_id(), 'organizer_plural_label_name' ), 'nightingale' ); ?>
        </h3>
        <div class="nhsuk-card__description">
            <p>
				<?php printf( __( '%s have total control over the contents and settings of a group. That includes all the abilities of %s, as well as the ability to turn group forums on or off, change group status from public to private, change the group photo,  manage group %s, and delete the group.', 'nightingale' ), get_group_role_label( bp_get_current_group_id(), 'organizer_plural_label_name' ), strtolower( get_group_role_label( bp_get_current_group_id(), 'moderator_plural_label_name' ) ), strtolower( get_group_role_label( bp_get_current_group_id(), 'member_plural_label_name' ) ) ); ?>
            </p>
			<?php if ( bp_has_members( '&include=' . bp_group_admin_ids() ) ) : ?>
                <table class="nhsuk-table">
                    <thead role="rowgroup" class="nhsuk-table__head">
                    <tr role="row">
                        <th role="columnheader" class="" scope="col">
							<?php esc_html_e( 'User', 'nightingale' ); ?>
                        </th>
                        <th role="columnheader" class="" scope="col">
							<?php esc_html_e( 'Actions', 'nightingale' ); ?>
                        </th>
                    </tr>
                    </thead>
                    <tbody class="nhsuk-table__body">
					<?php while ( bp_members() ) : bp_the_member(); ?>
                        <tr role="row" class="nhsuk-table__row">
                            <td class="nhsuk-table__cell usernames">
								<?php echo bp_core_fetch_avatar( array( 'item_id' => bp_get_member_user_id(), 'type' => 'thumb', 'alt' => '', ) ); ?>
                                <br />
                                <a href="<?php bp_member_permalink(); ?>"> <?php bp_member_name(); ?></a>
                            </td>

							<?php if ( count( bp_group_admin_ids( false, 'array' ) ) > 1 ) : ?>

                                <td class="nhsuk-table__cell">
                                    <a class="button confirm admin-demote-to-member" href="<?php bp_group_member_demote_link( bp_get_member_user_id() ); ?>"><?php printf( __( 'Demote to regular %s', 'nightingale' ), strtolower( get_group_role_label( bp_get_current_group_id(), 'member_singular_label_name' ) ) ); ?></a>
                                </td>

							<?php endif; ?>

                        </tr>
					<?php endwhile; ?>

                    </tbody>
                </table>


			<?php endif; ?>
        </div>
    </div>
</div>

<?php if ( bp_group_has_moderators() ) : ?>
    <div class="nhsuk-card">
    <div class="nhsuk-card__content">
    <h3 class="nhsuk-card__heading">
		<?php echo esc_html( get_group_role_label( bp_get_current_group_id(), 'moderator_plural_label_name' ), 'nightingale' ); ?>
    </h3>
    <div class="nhsuk-card__description">

    <p><?php printf( __( 'When a group member is promoted to be a %s of the group, the member gains the ability to edit and delete any forum discussion within the group and delete any activity feed items, excluding those posted by %s.', 'nightingale' ), strtolower( get_group_role_label( bp_get_current_group_id(), 'moderator_singular_label_name' ) ), strtolower( get_group_role_label( bp_get_current_group_id(), 'organizer_plural_label_name' ) ) ); ?></p>

	<?php if ( bp_has_members( '&include=' . bp_group_mod_ids() ) ) : ?>
        <table class="nhsuk-table">
            <thead role="rowgroup" class="nhsuk-table__head">
            <tr role="row">
                <th role="columnheader" class="" scope="col">
					<?php esc_html_e( 'User', 'nightingale' ); ?>
                </th>
                <th role="columnheader" class="" scope="col">
					<?php esc_html_e( 'Actions', 'nightingale' ); ?>
                </th>
            </tr>
            </thead>
            <tbody class="nhsuk-table__body">

			<?php while ( bp_members() ) : bp_the_member(); ?>
                <tr role="row" class="nhsuk-table__row">
                    <td class="nhsuk-table__cell usernames">
						<?php echo bp_core_fetch_avatar( array( 'item_id' => bp_get_member_user_id(), 'type' => 'thumb', 'width' => 30, 'height' => 30, 'alt' => '', ) ); ?>
                        <br />
                        <a href="<?php bp_member_permalink(); ?>"> <?php bp_member_name(); ?></a>
                    </td>

					<?php if ( count( bp_group_admin_ids( false, 'array' ) ) > 1 ) : ?>

                        <td class="nhsuk-table__cell">
                            <a href="<?php bp_group_member_promote_admin_link( array( 'user_id' => bp_get_member_user_id() ) ); ?>" class="button confirm mod-promote-to-admin"><?php printf( __( 'Promote to co-%s', 'nightingale' ), strtolower( get_group_role_label( bp_get_current_group_id(), 'organizer_singular_label_name' ) ) ); ?></a>
                            <a class="button confirm mod-demote-to-member" href="<?php bp_group_member_demote_link( bp_get_member_user_id() ); ?>"><?php printf( __( 'Demote to regular %s', 'nightingale' ), strtolower( get_group_role_label( bp_get_current_group_id(), 'member_singular_label_name' ) ) ); ?></a>
                        </td>

					<?php endif; ?>

                </tr>

			<?php endwhile; ?>

            </tbody>
        </table>
        </div>
        </div>
        </div>
	<?php endif; ?>

<?php endif ?>
<div class="nhsuk-card">
    <div class="nhsuk-card__content">
        <h3 class="nhsuk-card__heading">
			<?php echo esc_html( get_group_role_label( bp_get_current_group_id(), 'member_plural_label_name' ), 'nightingale' ); ?>
        </h3>
        <div class="nhsuk-card__description">
            <p><?php printf( __( 'When a member joins a group, he or she is assigned the %s role by default. %s are able to contribute to the group’s discussions, activity feeds, and view other group members.', 'nightingale' ), strtolower( get_group_role_label( bp_get_current_group_id(), 'member_singular_label_name' ) ), get_group_role_label( bp_get_current_group_id(), 'member_plural_label_name' ) ); ?></p>

			<?php if ( bp_group_has_members( 'per_page=15&exclude_banned=0' ) ) : ?>

			<?php if ( bp_group_member_needs_pagination() ) : ?>

				<?php bp_nouveau_pagination( 'top' ); ?>

			<?php endif; ?>
            <table class="nhsuk-table">
                <thead role="rowgroup" class="nhsuk-table__head">
                <tr role="row">
                    <th role="columnheader" class="" scope="col">
						<?php esc_html_e( 'User', 'nightingale' ); ?>
                    </th>
                    <th role="columnheader" class="" scope="col">
						<?php esc_html_e( 'Actions', 'nightingale' ); ?>
                    </th>
                </tr>
                </thead>
                <tbody class="nhsuk-table__body">
				<?php while ( bp_group_members() ) : bp_group_the_member(); ?>
                    <tr role="row" class="nhsuk-table__row">
                        <td class="nhsuk-table__cell usernames">
							<?php echo bp_core_fetch_avatar( array( 'item_id' => bp_get_member_user_id(), 'type' => 'thumb', 'alt' => '', ) ); ?>
                            <br />
                            <a href="<?php bp_member_permalink(); ?>"> <?php bp_member_name(); ?></a>
                            <span class="banned warn">
								<?php if ( bp_get_group_member_is_banned() ) : ?><?php
									/* translators: indicates a user is banned from a group, e.g. "Mike (banned)". */
									esc_html_e( '(banned)', 'nightingale' );
									?>
								<?php endif; ?>
							    </span>
                        </td>

                        <td class="nhsuk-table__cell">
							<?php bp_nouveau_groups_manage_members_buttons( array( 'container' => 'div', 'container_classes' => array( 'members-manage-buttons', 'text-links-list', ), 'parent_element' => '  ', ) ); ?>
                        </td>


                    </tr>

				<?php endwhile; ?>
                </tbody>
            </table>


			<?php
			if ( bp_group_member_needs_pagination() ) :
				bp_nouveau_pagination( 'bottom' );
			endif;
			?>
        </div>
    </div>
</div>

<?php else:

	bp_nouveau_user_feedback( 'group-manage-members-none' );

endif; ?>

