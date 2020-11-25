<?php
/**
 * BP Nouveau Group's delete group template.
 *
 * @since BuddyPress 3.0.0
 * @version 3.1.0
 */
?>
<div class="nhsuk-care-card nhsuk-care-card--urgent">
    <div class="nhsuk-care-card__heading-container">
        <h3 class="nhsuk-care-card__heading"><span role="text"><span class="nhsuk-u-visually-hidden"><?php esc_html_e( 'Be Sure before you do anything here!', 'nightingale' ); ?></span><?php esc_html_e( 'Delete this group', 'nightingale' ); ?></span></h3>
        <span class="nhsuk-care-card__arrow" aria-hidden="true"></span>
    </div>
    <div class="nhsuk-care-card__content">
        <b><?php bp_nouveau_user_feedback( 'group-delete-warning' ); ?></b>
        <div class="nhsuk-form-group">
            <div class="nhsuk-checkboxes">

                <div class="nhsuk-checkboxes__item">
                    <input class="nhsuk-checkboxes__input" name="delete-group-understand" id="delete-group-understand" type="checkbox" value="1" onclick="if(this.checked) { document.getElementById( 'delete-group-button' ).disabled = ''; } else { document.getElementById( 'delete-group-button' ).disabled = 'disabled'; }" />
                    <label class="nhsuk-label nhsuk-checkboxes__label" for="delete-group-understand">
						<?php esc_html_e( 'I understand the consequences of deleting this group.', 'nightingale' ); ?>
                    </label>
                </div>


				<?php if ( bp_is_active('forums') && bbp_get_group_forum_ids( groups_get_current_group()->id ) ): ?>
                    <div class="nhsuk-checkboxes__item">
                        <input class="nhsuk-checkboxes__input" name="delete-group-forum-understand" id="delete-group-forum-understand" value="1" type="checkbox">
                        <label class="nhsuk-label nhsuk-checkboxes__label" for="delete-group-forum-understand">
							<?php esc_html_e( 'I also want to delete the discussion forum.', 'nightingale' ); ?>
                        </label>
                    </div>
				<?php endif; ?>
            </div>
        </div>
    </div>
</div>
