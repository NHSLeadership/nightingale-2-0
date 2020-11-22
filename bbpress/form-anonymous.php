<?php

/**
 * Anonymous User
 *
 * @package BuddyBoss
 * @subpackage Theme
 */

?>

<?php if ( bbp_current_user_can_access_anonymous_user_form() ) : ?>

	<?php do_action( 'bbp_theme_before_anonymous_form' ); ?>

	<fieldset class="bbp-form bbp-form-anonymous">
		<legend><?php ( bbp_is_topic_edit() || bbp_is_reply_edit() ) ? _e( 'Author Information', 'buddyboss-theme' ) : _e( 'Your information:', 'buddyboss-theme' ); ?></legend>

		<?php do_action( 'bbp_theme_anonymous_form_extras_top' ); ?>

		<p>
			<label for="bbp_anonymous_author"><?php _e( 'Name (required):', 'buddyboss-theme' ); ?></label>
			<input type="text" id="bbp_anonymous_author"  value="<?php bbp_author_display_name(); ?>" tabindex="<?php bbp_tab_index(); ?>" size="40" name="bbp_anonymous_name" placeholder="<?php _e( 'Name (required):', 'buddyboss-theme' ); ?>" />
		</p>

		<p>
			<label for="bbp_anonymous_email"><?php _e( 'Email (will not be published) (required):', 'buddyboss-theme' ); ?></label>
			<input type="text" id="bbp_anonymous_email"   value="<?php bbp_author_email(); ?>" tabindex="<?php bbp_tab_index(); ?>" size="40" name="bbp_anonymous_email" placeholder="<?php _e( 'Email (will not be published) (required):', 'buddyboss-theme' ); ?>" />
		</p>

		<p>
			<label for="bbp_anonymous_website"><?php _e( 'Website:', 'buddyboss-theme' ); ?></label>
			<input type="text" id="bbp_anonymous_website" value="<?php bbp_author_url(); ?>" tabindex="<?php bbp_tab_index(); ?>" size="40" name="bbp_anonymous_website" placeholder="<?php _e( 'Website:', 'buddyboss-theme' ); ?>" />
		</p>

		<?php do_action( 'bbp_theme_anonymous_form_extras_bottom' ); ?>

	</fieldset>

	<?php do_action( 'bbp_theme_after_anonymous_form' ); ?>

<?php endif; ?>
