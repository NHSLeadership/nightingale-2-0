<?php
/**
 * BP Nouveau Group's edit settings template.
 *
 * @since   BuddyPress 3.0.0
 * @version 3.1.0
 */
?>
<?php if ( bp_is_group_create() ) : ?>

    <h2 class="nhsuk-heading-l">
		<?php esc_html_e( 'Select Group Settings', 'buddyboss' ); ?>
    </h2>

<?php else : ?>

    <h2 class="nhsuk-heading-l">
		<?php esc_html_e( 'Change Group Settings', 'buddyboss' ); ?>
    </h2>

<?php endif; ?>

<div class="nhsuk-care-card group-settings-selections">
    <div class="nhsuk-care-card__heading-container">
        <h3 class="nhsuk-care-card__heading">
            <span role="text">
                <span class="nhsuk-u-visually-hidden"><?php esc_html_e( 'Change settings for', 'nightingale' ); ?></span>
                <span class="nhsuk-care-card__heading-text"><?php esc_html_e( 'Privacy Options', 'nightingale' ); ?></span>
            </span>
        </h3>
        <span class="nhsuk-care-card__arrow" aria-hidden="true"></span>
    </div>
    <div class="nhsuk-care-card__content">
        <fieldset class="nhsuk-fieldset">
            <div class="nhsuk-radios">

                <div class="nhsuk-radios__item">
                    <input class="nhsuk-radios__input" id="group-status-public" name="group-status" type="radio" value="public" <?php
					if ( 'public' === bp_get_new_group_status() || ! bp_get_new_group_status() ) {
						?>
                        checked="checked"<?php } ?> aria-describedby="public-group-description"/>
                    <label class="nhsuk-label nhsuk-radios__label" for="group-status-public">
						<?php esc_html_e( 'This is a public group', 'nightingale' ); ?>
                    </label>
                    <div class="nhsuk-hint">
                        <ul id="public-group-description">
                            <li><?php esc_html_e( 'Any site member can join this group.', 'buddyboss' ); ?></li>
                            <li><?php esc_html_e( 'This group will be listed in the groups directory and in search results.', 'buddyboss' ); ?></li>
                            <li><?php esc_html_e( 'Group content and activity will be visible to any site member.', 'buddyboss' ); ?></li>
                        </ul>
                    </div>
                </div>

                <div class="nhsuk-radios__item">
                    <input class="nhsuk-radios__input" id="group-status-private" name="group-status" type="radio" value="private" <?php
					if ( 'private' === bp_get_new_group_status() || ! bp_get_new_group_status() ) {
						?>
                        checked="checked"<?php } ?> aria-describedby="private-group-description"/>
                    <label class="nhsuk-label nhsuk-radios__label" for="group-status-private">
						<?php esc_html_e( 'This is a private group', 'nightingale' ); ?>
                    </label>
                    <div class="nhsuk-hint">
                        <ul id="private-group-description">
                            <li><?php esc_html_e( 'Only people who request membership and are accepted can join the group.', 'buddyboss' ); ?></li>
                            <li><?php esc_html_e( 'This group will be listed in the groups directory and in search results.', 'buddyboss' ); ?></li>
                            <li><?php esc_html_e( 'Group content and activity will only be visible to members of the group.', 'buddyboss' ); ?></li>
                        </ul>
                    </div>
                </div>

                <div class="nhsuk-radios__item">
                    <input class="nhsuk-radios__input" id="group-status-hidden" name="group-status" type="radio" value="hidden" <?php
					if ( 'hidden' === bp_get_new_group_status() || ! bp_get_new_group_status() ) {
						?>
                        checked="checked"<?php } ?> aria-describedby="hidden-group-description"/>
                    <label class="nhsuk-label nhsuk-radios__label" for="group-status-hidden">
						<?php esc_html_e( 'This is a hidden group', 'nightingale' ); ?>
                    </label>
                    <div class="nhsuk-hint">
                        <ul id="hidden-group-description">
                            <li><?php esc_html_e( 'Only people who are invited can join the group.', 'buddyboss' ); ?></li>
                            <li><?php esc_html_e( 'This group will not be listed in the groups directory or search results.', 'buddyboss' ); ?></li>
                            <li><?php esc_html_e( 'Group content and activity will only be visible to members of the group.', 'buddyboss' ); ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </fieldset>
    </div>
</div>


<div class="nhsuk-care-card group-settings-selections">
    <div class="nhsuk-care-card__heading-container">
        <h3 class="nhsuk-care-card__heading">
            <span role="text">
                <span class="nhsuk-u-visually-hidden"><?php esc_html_e( 'Change settings for', 'nightingale' ); ?></span>
                <span class="nhsuk-care-card__heading-text"><?php esc_html_e( 'Group Invitations', 'nightingale' ); ?></span>
            </span>
        </h3>
        <span class="nhsuk-care-card__arrow" aria-hidden="true"></span>
    </div>
    <div class="nhsuk-care-card__content">
        <fieldset class="nhsuk-fieldset">

            <legend class="nhsuk-fieldset__legend nhsuk-fieldset__legend--m">
                <h1 class="nhsuk-fieldset__heading">
					<?php esc_html_e( 'Which members of this group are allowed to invite others?', 'nightingale' ); ?>
                </h1>
            </legend>
            <div class="nhsuk-radios">

                <div class="nhsuk-radios__item">
                    <input class="nhsuk-radios__input" id="group-invite-status-members" name="group-invite-status" type="radio" value="members" <?php bp_group_show_invite_status_setting( 'members' ); ?>/>
                    <label class="nhsuk-label nhsuk-radios__label" for="group-invite-status-members">
						<?php esc_html_e( 'All group members', 'nightingale' ); ?>
                    </label>
                </div>

                <div class="nhsuk-radios__item">
                    <input class="nhsuk-radios__input" id="group-invite-status-mods" name="group-invite-status" type="radio" value="mods" <?php bp_group_show_invite_status_setting( 'mods' ); ?>/>
                    <label class="nhsuk-label nhsuk-radios__label" for="group-invite-status-mods">
						<?php esc_html_e( 'Organisers and Moderators only', 'nightingale' ); ?>
                    </label>
                </div>

                <div class="nhsuk-radios__item">
                    <input class="nhsuk-radios__input" id="group-invite-status-admins" name="group-invite-status" type="radio" value="admins" <?php bp_group_show_invite_status_setting( 'admins' ); ?>/>
                    <label class="nhsuk-label nhsuk-radios__label" for="group-invite-status-admins">
						<?php esc_html_e( 'Organisers only', 'nightingale' ); ?>
                    </label>
                </div>
            </div>
        </fieldset>
    </div>
</div>

<div class="nhsuk-care-card group-settings-selections">
    <div class="nhsuk-care-card__heading-container">
        <h3 class="nhsuk-care-card__heading">
            <span role="text">
                <span class="nhsuk-u-visually-hidden"><?php esc_html_e( 'Change settings for', 'nightingale' ); ?></span>
                <span class="nhsuk-care-card__heading-text"><?php esc_html_e( 'Activity Feeds', 'nightingale' ); ?></span>
            </span>
        </h3>
        <span class="nhsuk-care-card__arrow" aria-hidden="true"></span>
    </div>
    <div class="nhsuk-care-card__content">
        <fieldset class="nhsuk-fieldset">
            <legend class="nhsuk-fieldset__legend nhsuk-fieldset__legend--m">
                <h1 class="nhsuk-fieldset__heading">
					<?php esc_html_e( 'Which members of this group are allowed to post into the activity feed?', 'nightingale' ); ?>
                </h1>
            </legend>
            <div class="nhsuk-radios">

                <div class="nhsuk-radios__item">
                    <input class="nhsuk-radios__input" id="group-activity-feed-status-members" name="group-activity-feed-status" type="radio" value="members" <?php bp_group_show_activity_feed_status_setting( 'members' ); ?> />
                    <label class="nhsuk-label nhsuk-radios__label" for="group-activity-feed-status-members">
						<?php esc_html_e( 'All group members', 'nightingale' ); ?>
                    </label>
                </div>

                <div class="nhsuk-radios__item">
                    <input class="nhsuk-radios__input" id="group-activity-feed-status-mods" name="group-activity-feed-status" type="radio" value="mods" <?php bp_group_show_activity_feed_status_setting( 'mods' ); ?> />
                    <label class="nhsuk-label nhsuk-radios__label" for="group-activity-feed-status-mods">
						<?php esc_html_e( 'Organisers and moderators only', 'nightingale' ); ?>
                    </label>
                </div>

                <div class="nhsuk-radios__item">
                    <input class="nhsuk-radios__input" id="group-activity-feed-status-admins" name="group-activity-feed-status" type="radio" value="admins" <?php bp_group_show_activity_feed_status_setting( 'admins' ); ?> />
                    <label class="nhsuk-label nhsuk-radios__label" for="group-activity-feed-status-admins">
						<?php esc_html_e( 'Organisers only', 'nightingale' ); ?>
                    </label>
                </div>
        </fieldset>
    </div>
</div>

<?php if ( bp_is_active( 'media' ) && bp_is_group_media_support_enabled() ) : ?>

    <div class="nhsuk-care-card group-settings-selections">
        <div class="nhsuk-care-card__heading-container">
            <h3 class="nhsuk-care-card__heading">
            <span role="text">
                <span class="nhsuk-u-visually-hidden"><?php esc_html_e( 'Change settings for', 'nightingale' ); ?></span>
                <span class="nhsuk-care-card__heading-text"><?php esc_html_e( 'Group Photos', 'nightingale' ); ?></span>
            </span>
            </h3>
            <span class="nhsuk-care-card__arrow" aria-hidden="true"></span>
        </div>
        <div class="nhsuk-care-card__content">
            <fieldset class="nhsuk-fieldset">
                <legend class="nhsuk-fieldset__legend nhsuk-fieldset__legend--m">
                    <h1 class="nhsuk-fieldset__heading">
						<?php esc_html_e( 'Which members of this group are allowed to manage photos?', 'nightingale' ); ?>
                    </h1>
                </legend>
                <div class="nhsuk-radios">

                    <div class="nhsuk-radios__item">
                        <input class="nhsuk-radios__input" id="group-media-status-members" name="group-media-status" type="radio" value="members" <?php bp_group_show_media_status_setting( 'members' ); ?> />
                        <label class="nhsuk-label nhsuk-radios__label" for="group-media-status-members">
							<?php esc_html_e( 'All group members', 'nightingale' ); ?>
                        </label>
                    </div>

                    <div class="nhsuk-radios__item">
                        <input class="nhsuk-radios__input" id="group-media-status-mods" name="group-media-status" type="radio" value="mods" <?php bp_group_show_media_status_setting( 'mods' ); ?> />
                        <label class="nhsuk-label nhsuk-radios__label" for="group-media-status-mods">
							<?php esc_html_e( 'Organisers and moderators only', 'nightingale' ); ?>
                        </label>
                    </div>

                    <div class="nhsuk-radios__item">
                        <input class="nhsuk-radios__input" id="group-media-status-admins" name="group-media-status" type="radio" value="admins" <?php bp_group_show_media_status_setting( 'admins' ); ?> />
                        <label class="nhsuk-label nhsuk-radios__label" for="group-media-status-admins">
							<?php esc_html_e( 'Organisers only', 'nightingale' ); ?>
                        </label>
                    </div>
            </fieldset>
        </div>
    </div>
    </div>


<?php endif; ?>

<?php if ( bp_is_active( 'media' ) && bp_is_group_albums_support_enabled() ) : ?>

    <div class="nhsuk-care-card group-settings-selections">
        <div class="nhsuk-care-card__heading-container">
            <h3 class="nhsuk-care-card__heading">
            <span role="text">
                <span class="nhsuk-u-visually-hidden"><?php esc_html_e( 'Change settings for', 'nightingale' ); ?></span>
                <span class="nhsuk-care-card__heading-text"><?php esc_html_e( 'Group Albums', 'nightingale' ); ?></span>
            </span>
            </h3>
            <span class="nhsuk-care-card__arrow" aria-hidden="true"></span>
        </div>
        <div class="nhsuk-care-card__content">
            <fieldset class="nhsuk-fieldset">
                <legend class="nhsuk-fieldset__legend nhsuk-fieldset__legend--m">
                    <h1 class="nhsuk-fieldset__heading">
						<?php esc_html_e( 'Which members of this group are allowed to manage albums?', 'nightingale' ); ?>
                    </h1>
                </legend>
                <div class="nhsuk-radios">

                    <div class="nhsuk-radios__item">
                        <input class="nhsuk-radios__input" id="group-albums-status-members" name="group-album-status" type="radio" value="members" <?php bp_group_show_albums_status_setting( 'members' ); ?> />
                        <label class="nhsuk-label nhsuk-radios__label" for="group-albums-status-members">
							<?php esc_html_e( 'All group members', 'nightingale' ); ?>
                        </label>
                    </div>

                    <div class="nhsuk-radios__item">
                        <input class="nhsuk-radios__input" id="group-albums-status-mods" name="group-album-status" type="radio" value="mods" <?php bp_group_show_albums_status_setting( 'mods' ); ?> />
                        <label class="nhsuk-label nhsuk-radios__label" for="group-album-status-mods">
							<?php esc_html_e( 'Organisers and moderators only', 'nightingale' ); ?>
                        </label>
                    </div>

                    <div class="nhsuk-radios__item">
                        <input class="nhsuk-radios__input" id="group-albums-status-admins" name="group-album-status" type="radio" value="admins" <?php bp_group_show_albums_status_setting( 'admins' ); ?> />
                        <label class="nhsuk-label nhsuk-radios__label" for="group-albums-status-admins">
							<?php esc_html_e( 'Organisers only', 'nightingale' ); ?>
                        </label>
                    </div>
            </fieldset>
        </div>
    </div>
    </div>


<?php endif; ?>

<?php if ( bp_is_active( 'media' ) && bp_is_group_document_support_enabled() ) : ?>

    <div class="nhsuk-care-card group-settings-selections">
        <div class="nhsuk-care-card__heading-container">
            <h3 class="nhsuk-care-card__heading">
            <span role="text">
                <span class="nhsuk-u-visually-hidden"><?php esc_html_e( 'Change settings for', 'nightingale' ); ?></span>
                <span class="nhsuk-care-card__heading-text"><?php esc_html_e( 'Group Documents', 'nightingale' ); ?></span>
            </span>
            </h3>
            <span class="nhsuk-care-card__arrow" aria-hidden="true"></span>
        </div>
        <div class="nhsuk-care-card__content">
            <fieldset class="nhsuk-fieldset">
                <legend class="nhsuk-fieldset__legend nhsuk-fieldset__legend--m">
                    <h1 class="nhsuk-fieldset__heading">
						<?php esc_html_e( 'Which members of this group are allowed to manage documents?', 'nightingale' ); ?>
                    </h1>
                </legend>
                <div class="nhsuk-radios">

                    <div class="nhsuk-radios__item">
                        <input class="nhsuk-radios__input" id="group-documents-status-members" name="group-document-status" type="radio" value="members" <?php bp_group_show_document_status_setting( 'members' ); ?> />
                        <label class="nhsuk-label nhsuk-radios__label" for="group-documents-status-members">
							<?php esc_html_e( 'All group members', 'nightingale' ); ?>
                        </label>
                    </div>

                    <div class="nhsuk-radios__item">
                        <input class="nhsuk-radios__input" id="group-documents-status-mods" name="group-document-status" type="radio" value="mods" <?php bp_group_show_document_status_setting( 'mods' ); ?> />
                        <label class="nhsuk-label nhsuk-radios__label" for="group-documents-status-mods">
							<?php esc_html_e( 'Organisers and moderators only', 'nightingale' ); ?>
                        </label>
                    </div>

                    <div class="nhsuk-radios__item">
                        <input class="nhsuk-radios__input" id="group-documents-status-admins" name="group-document-status" type="radio" value="admins" <?php bp_group_show_document_status_setting( 'admins' ); ?> />
                        <label class="nhsuk-label nhsuk-radios__label" for="group-documents-status-admins">
							<?php esc_html_e( 'Organisers only', 'nightingale' ); ?>
                        </label>
                    </div>
            </fieldset>
        </div>
    </div>
    </div>

<?php endif; ?>

<?php if ( bp_is_active( 'messages' ) && true === bp_disable_group_messages() ) : ?>

    <div class="nhsuk-care-card group-settings-selections">
        <div class="nhsuk-care-card__heading-container">
            <h3 class="nhsuk-care-card__heading">
            <span role="text">
                <span class="nhsuk-u-visually-hidden"><?php esc_html_e( 'Change settings for', 'nightingale' ); ?></span>
                <span class="nhsuk-care-card__heading-text"><?php esc_html_e( 'Group Messages', 'nightingale' ); ?></span>
            </span>
            </h3>
            <span class="nhsuk-care-card__arrow" aria-hidden="true"></span>
        </div>
        <div class="nhsuk-care-card__content">
            <fieldset class="nhsuk-fieldset">
                <legend class="nhsuk-fieldset__legend nhsuk-fieldset__legend--m">
                    <h1 class="nhsuk-fieldset__heading">
						<?php esc_html_e( 'Which members of this group are allowed to send group messages?', 'nightingale' ); ?>
                    </h1>
                </legend>
                <div class="nhsuk-radios">

                    <div class="nhsuk-radios__item">
                        <input class="nhsuk-radios__input" id="group-messages-status-members" name="group-message-status" type="radio" value="members" <?php bp_group_show_messages_status_setting( 'members' ); ?> />
                        <label class="nhsuk-label nhsuk-radios__label" for="group-messages-status-members">
							<?php esc_html_e( 'All group members', 'nightingale' ); ?>
                        </label>
                    </div>

                    <div class="nhsuk-radios__item">
                        <input class="nhsuk-radios__input" id="group-messages-status-mods" name="group-message-status" type="radio" value="mods" <?php bp_group_show_messages_status_setting( 'mods' ); ?> />
                        <label class="nhsuk-label nhsuk-radios__label" for="group-messages-status-mods">
							<?php esc_html_e( 'Organisers and moderators only', 'nightingale' ); ?>
                        </label>
                    </div>

                    <div class="nhsuk-radios__item">
                        <input class="nhsuk-radios__input" id="group-messages-status-admins" name="group-message-status" type="radio" value="admins" <?php bp_group_show_messages_status_setting( 'admins' ); ?> />
                        <label class="nhsuk-label nhsuk-radios__label" for="group-messages-status-admins">
							<?php esc_html_e( 'Organisers only', 'nightingale' ); ?>
                        </label>
                    </div>
            </fieldset>
        </div>
    </div>
    </div>

<?php endif; ?>



<?php
$group_types = bp_groups_get_group_types( array( 'show_in_create_screen' => true ), 'objects' );

// Hide Group Types if none is selected in Users > Profile Type > E.g. (Students) > Allowed Group Types meta box.
if ( false === bp_restrict_group_creation() && true === bp_member_type_enable_disable() ) {
	$get_all_registered_member_types = bp_get_active_member_types();
	if ( isset( $get_all_registered_member_types ) && ! empty( $get_all_registered_member_types ) ) {

		$current_user_member_type = bp_get_member_type( bp_loggedin_user_id() );
		if ( '' !== $current_user_member_type ) {
			$member_type_post_id = bp_member_type_post_by_type( $current_user_member_type );
			$include_group_type  = get_post_meta( $member_type_post_id, '_bp_member_type_enabled_group_type_create', true );
			if ( isset( $include_group_type ) && ! empty( $include_group_type ) && 'none' === $include_group_type[ 0 ] ) {
				$group_types = '';
			}
		}
	}
}

// Group type selection
if ( $group_types ) :
	?>
    <div class="nhsuk-care-card group-settings-selections">
        <div class="nhsuk-care-card__heading-container">
            <h3 class="nhsuk-care-card__heading">
            <span role="text">
                <span class="nhsuk-u-visually-hidden"><?php esc_html_e( 'Change settings for', 'nightingale' ); ?></span>
                <span class="nhsuk-care-card__heading-text"><?php esc_html_e( 'Group Type', 'nightingale' ); ?></span>
            </span>
            </h3>
            <span class="nhsuk-care-card__arrow" aria-hidden="true"></span>
        </div>
        <div class="nhsuk-care-card__content">
            <fieldset class="nhsuk-fieldset">
                <legend class="nhsuk-fieldset__legend nhsuk-fieldset__legend--m">
                    <h1 class="nhsuk-fieldset__heading">
						<?php esc_html_e( 'What type of group is this? (optional)', 'nightingale' ); ?>
                    </h1>
                </legend>

                <select id="bp-groups-type" class="nhsuk-select" name="group-types[]" autocomplete="off">
                    <option value="" <?php selected( '', '' ); ?>><?php _e( 'Select Group Type', 'buddyboss' ); ?></option>
					<?php foreach ( $group_types as $type ) : ?>
						<?php
						if ( false === bp_restrict_group_creation() && true === bp_member_type_enable_disable() ) {

							$get_all_registered_member_types = bp_get_active_member_types();

							if ( isset( $get_all_registered_member_types ) && ! empty( $get_all_registered_member_types ) ) {

								$current_user_member_type = bp_get_member_type( bp_loggedin_user_id() );

								if ( '' !== $current_user_member_type ) {

									$member_type_post_id = bp_member_type_post_by_type( $current_user_member_type );
									$include_group_type  = get_post_meta( $member_type_post_id, '_bp_member_type_enabled_group_type_create', true );

									if ( isset( $include_group_type ) && ! empty( $include_group_type ) ) {
										if ( in_array( $type->name, $include_group_type ) ) {
											?>
                                            <option for="<?php printf( 'group-type-%s', $type->name ); ?>" value="<?php echo esc_attr( $type->name ); ?>" <?php selected( ( true === bp_groups_has_group_type( bp_get_current_group_id(), $type->name ) ) ? $type->name : '', $type->name ); ?>><?php echo esc_html( $type->labels[ 'singular_name' ] ); ?></option>
											<?php
										}
									} else {
										?>
                                        <option for="<?php printf( 'group-type-%s', $type->name ); ?>" value="<?php echo esc_attr( $type->name ); ?>" <?php selected( ( true === bp_groups_has_group_type( bp_get_current_group_id(), $type->name ) ) ? $type->name : '', $type->name ); ?>><?php echo esc_html( $type->labels[ 'singular_name' ] ); ?></option>
										<?php
									}
								} else {
									?>
                                    <option for="<?php printf( 'group-type-%s', $type->name ); ?>" value="<?php echo esc_attr( $type->name ); ?>" <?php selected( ( true === bp_groups_has_group_type( bp_get_current_group_id(), $type->name ) ) ? $type->name : '', $type->name ); ?>><?php echo esc_html( $type->labels[ 'singular_name' ] ); ?></option>
									<?php
								}
							} else {
								?>
                                <option for="<?php printf( 'group-type-%s', $type->name ); ?>" value="<?php echo esc_attr( $type->name ); ?>" <?php selected( ( true === bp_groups_has_group_type( bp_get_current_group_id(), $type->name ) ) ? $type->name : '', $type->name ); ?>><?php echo esc_html( $type->labels[ 'singular_name' ] ); ?></option>
								<?php
							}
						} else {
							?>
                            <option for="<?php printf( 'group-type-%s', $type->name ); ?>" value="<?php echo esc_attr( $type->name ); ?>" <?php selected( ( true === bp_groups_has_group_type( bp_get_current_group_id(), $type->name ) ) ? $type->name : '', $type->name ); ?>><?php echo esc_html( $type->labels[ 'singular_name' ] ); ?></option>
							<?php
						}
						?>

					<?php endforeach; ?>
                </select>
            </fieldset>
        </div>
    </div>
    </div>

<?php endif; ?>

<?php
if ( bp_enable_group_hierarchies() ) :
	$current_parent_group_id = bp_get_parent_group_id();
	$possible_parent_groups = bp_get_possible_parent_groups();
	?>
    <div class="nhsuk-care-card group-settings-selections">
        <div class="nhsuk-care-card__heading-container">
            <h3 class="nhsuk-care-card__heading">
            <span role="text">
                <span class="nhsuk-u-visually-hidden"><?php esc_html_e( 'Change settings for', 'nightingale' ); ?></span>
                <span class="nhsuk-care-card__heading-text"><?php esc_html_e( 'Group Parent', 'nightingale' ); ?></span>
            </span>
            </h3>
            <span class="nhsuk-care-card__arrow" aria-hidden="true"></span>
        </div>
        <div class="nhsuk-care-card__content">
            <fieldset class="nhsuk-fieldset">
                <legend class="nhsuk-fieldset__legend nhsuk-fieldset__legend--m">
                    <h1 class="nhsuk-fieldset__heading">
						<?php esc_html_e( 'Which group should be the parent of this group? (optional)', 'nightingale' ); ?>
                    </h1>
                </legend>
                <select id="bp-groups-parent" class="nhsuk-select" name="bp-groups-parent" autocomplete="off">
                    <option value="0" <?php selected( 0, $current_parent_group_id ); ?>><?php _e( 'Select Parent', 'buddyboss' ); ?></option>
					<?php
					if ( $possible_parent_groups ) {

						foreach ( $possible_parent_groups as $possible_parent_group ) {
							?>
                            <option value="<?php echo $possible_parent_group->id; ?>" <?php selected( $current_parent_group_id, $possible_parent_group->id ); ?>><?php echo esc_html( $possible_parent_group->name ); ?></option>
							<?php
						}
					}
					?>
                </select>
            </fieldset>
        </div>
    </div>
    </div>
<?php endif; ?>

</div><!-- // .group-settings-selections -->
