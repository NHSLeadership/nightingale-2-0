<?php
/**
 * BP Nouveau Group's edit details template.
 *
 * @since BuddyPress 3.0.0
 * @version 3.1.0
 */
?>
<?php if ( bp_is_group_create() ) : ?>

	<h2 class="nhsuk-heading-l">
		<?php esc_html_e( 'Enter Group Name &amp; Description', 'buddyboss' ); ?>
	</h2>

<?php else : ?>

	<h2 class="nhsuk-heading-l">
		<?php esc_html_e( 'Edit Group Name &amp; Description', 'buddyboss' ); ?>
	</h2>

<?php endif; ?>
<div class="nhsuk-form-group">
    <label class="nhsuk-label" for="group-name">
	    <?php esc_html_e( 'Group Name (required)', 'nightingale' ); ?>
    </label>
    <input class="nhsuk-input" id="group-name" name="group-name" type="text" value="<?php bp_is_group_create() ? bp_new_group_name() : bp_group_name(); ?>" aria-required="true" />
</div>
<div class="nhsuk-form-group">
    <label class="nhsuk-label" for="group-desc">
	    <?php esc_html_e( 'Group Description', 'nightingale' ); ?>
    </label>
    <textarea class="nhsuk-textarea" id="group-desc" name="group-desc" aria-required="true"><?php bp_is_group_create() ? bp_new_group_description() : bp_group_description_editable(); ?></textarea>
</div>
