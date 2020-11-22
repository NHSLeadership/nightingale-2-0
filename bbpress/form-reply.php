<?php

/**
 * New/Edit Reply
 *
 * @package BuddyBoss
 * @subpackage Theme
 */

?>

<?php if ( bbp_is_reply_edit() ) : ?>

<div id="bbpress-forums">

	<?php bbp_breadcrumb(); ?>

<?php endif; ?>

<?php if ( bbp_current_user_can_access_create_reply_form() ) : ?>

	<?php do_action( 'bbp_theme_before_reply_form_notices' ); ?>

	<?php if ( !bbp_is_reply_edit() && !bbp_is_topic_open() ) : ?>

		<div class="bp-feedback info">
			<span class="bp-icon" aria-hidden="true"></span>
			<p><?php _e( 'This discussion is marked as closed to new replies, however your posting capabilities still allow you to do so.', 'buddyboss-theme' ); ?></p>
		</div>

	<?php endif; ?>

	<div id="new-reply-<?php bbp_topic_id(); ?>" class="bbp-reply-form <?php if ( bbp_is_single_topic() ) { echo 'bb-modal bb-modal-box';} ?>">

		<form id="new-post" name="new-post" method="post" action="<?php bbp_is_reply_edit() ? bbp_reply_edit_url() : the_permalink(); ?>">

			<?php do_action( 'bbp_theme_before_reply_form' ); ?>

			<fieldset class="bbp-form">
				<legend>
                    <?php _e( 'Reply to:', 'buddyboss-theme' ); ?> <span id="bbp-reply-to-user"><?php printf( '%s', bbp_get_topic_author_display_name() ); ?></span>
                    <div id="bbp-reply-exerpt"></div>
                </legend>

                <div id="bbp-template-notices">
				    <?php do_action( 'bbp_template_notices' ); ?>
                </div>

				<div>

					<?php bbp_get_template_part( 'form', 'anonymous' ); ?>

					<?php do_action( 'bbp_theme_before_reply_form_content' ); ?>

					<?php bbp_the_content( array( 'context' => 'reply' ) ); ?>

					<?php do_action( 'bbp_theme_after_reply_form_content' ); ?>

					<?php if ( ! ( bbp_use_wp_editor() || current_user_can( 'unfiltered_html' ) ) ) : ?>

						<p class="form-allowed-tags">
							<label><?php _e( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes:','buddyboss-theme' ); ?></label><br />
							<code><?php bbp_allowed_tags(); ?></code>
						</p>

					<?php endif; ?>

					<?php bbp_get_template_part( 'form', 'attachments' ); ?>

					<?php if ( bbp_allow_topic_tags() && current_user_can( 'assign_topic_tags' ) ) : ?>

						<?php do_action( 'bbp_theme_before_reply_form_tags' ); ?>

                        <p class="bbp_topic_tags_wrapper">
                            <input type="hidden" value="" name="bbp_topic_tags" class="bbp_topic_tags" id="bbp_topic_tags" >
                            <select name="bbp_topic_tags_dropdown[]" class="bbp_topic_tags_dropdown" id="bbp_topic_tags_dropdown" placeholder="<?php esc_html_e( 'Type one or more tag, comma separated', 'buddyboss-theme' ); ?>" autocomplete="off" multiple="multiple" style="width: 100%" tabindex="<?php bbp_tab_index(); ?>"></select>
						</p>

						<?php do_action( 'bbp_theme_after_reply_form_tags' ); ?>

					<?php endif; ?>

                   	<?php if ( bbp_allow_revisions() && bbp_is_reply_edit() ) : ?>

                        <div class="bb-form_rev_wrapper flex">

    						<?php do_action( 'bbp_theme_before_reply_form_revisions' ); ?>

    						<fieldset class="bbp-form">
                                <div class="flex">
        							<legend>
										<input name="bbp_log_reply_edit" id="bbp_log_reply_edit" class="bs-styled-checkbox" type="checkbox" value="1" <?php bbp_form_reply_log_edit(); ?> tabindex="<?php bbp_tab_index(); ?>" />
        								<label for="bbp_log_reply_edit"><?php _e( 'Keep a log of this edit:', 'buddyboss-theme' ); ?></label>
        							</legend>

        							<div>
        								<label for="bbp_reply_edit_reason"><?php printf( __( 'Optional reason for editing:', 'buddyboss-theme' ), bbp_get_current_user_name() ); ?></label>
        								<input type="text" value="<?php bbp_form_reply_edit_reason(); ?>" tabindex="<?php bbp_tab_index(); ?>" size="40" name="bbp_reply_edit_reason" id="bbp_reply_edit_reason" placeholder="<?php _e( 'Optional reason for editing', 'buddyboss-theme' ); ?>" />
        							</div>
                                </div>
    						</fieldset>

    						<?php do_action( 'bbp_theme_after_reply_form_revisions' ); ?>

                        </div>

					<?php endif; ?>

                    <div class="bb-form-select-fields flex">

    					<?php if ( bbp_is_subscriptions_active() && !bbp_is_anonymous() && ( !bbp_is_reply_edit() || ( bbp_is_reply_edit() && !bbp_is_reply_anonymous() ) ) ) : ?>

    						<?php do_action( 'bbp_theme_before_reply_form_subscription' ); ?>

    						<div class="bb_subscriptions_active">

    							<input name="bbp_topic_subscription" id="bbp_topic_subscription" class="bs-styled-checkbox" type="checkbox" value="bbp_subscribe"<?php bbp_form_topic_subscribed(); ?> tabindex="<?php bbp_tab_index(); ?>" />

    							<?php if ( bbp_is_reply_edit() && ( bbp_get_reply_author_id() !== bbp_get_current_user_id() ) ) : ?>

    								<label for="bbp_topic_subscription"><?php _e( 'Notify the author of replies via email', 'buddyboss-theme' ); ?></label>

    							<?php else : ?>

    								<label for="bbp_topic_subscription"><?php _e( 'Notify me of replies via email', 'buddyboss-theme' ); ?></label>

    							<?php endif; ?>

    						</div>

    						<?php do_action( 'bbp_theme_after_reply_form_subscription' ); ?>

    					<?php endif; ?>


                        <?php do_action( 'bbp_theme_before_reply_form_submit_wrapper' ); ?>

    					<div class="bbp-submit-wrapper">

    						<?php do_action( 'bbp_theme_before_reply_form_submit_button' ); ?>

    						<?php bbp_cancel_reply_to_link(); ?>

                            <a href="#" id="bbp-close-btn" class="js-modal-close"><?php _e( 'Cancel', 'buddyboss-theme' ); ?></a>

    						<button type="submit" tabindex="<?php bbp_tab_index(); ?>" id="bbp_reply_submit" name="bbp_reply_submit" class="button submit small">
								<?php _e( 'Post', 'buddyboss-theme' ); ?>
								<i class="bb-icon-loader animate-spin"></i>
							</button>

    						<?php do_action( 'bbp_theme_after_reply_form_submit_button' ); ?>

    					</div>

    					<?php do_action( 'bbp_theme_after_reply_form_submit_wrapper' ); ?>

                    </div>

				</div>

				<?php bbp_reply_form_fields(); ?>

			</fieldset>

			<?php do_action( 'bbp_theme_after_reply_form' ); ?>

		</form>
	</div>

<?php elseif ( bbp_is_topic_closed() ) : ?>

	<div id="no-reply-<?php bbp_topic_id(); ?>" class="bbp-no-reply">
		<div class="bp-feedback info">
			<span class="bp-icon" aria-hidden="true"></span>
			<p><?php printf( __( 'The discussion &#8216;%s&#8217; is closed to new replies.', 'buddyboss-theme' ), bbp_get_topic_title() ); ?></p>
		</div>
	</div>

<?php elseif ( bbp_is_forum_closed( bbp_get_topic_forum_id() ) ) : ?>

	<div id="no-reply-<?php bbp_topic_id(); ?>" class="bbp-no-reply">
		<div class="bp-feedback info">
			<span class="bp-icon" aria-hidden="true"></span>
			<p><?php printf( __( 'The forum &#8216;%s&#8217; is closed to new discussions and replies.', 'buddyboss-theme' ), bbp_get_forum_title( bbp_get_topic_forum_id() ) ); ?></p>
		</div>
	</div>

<?php else : ?>

	<div id="no-reply-<?php bbp_topic_id(); ?>" class="bbp-no-reply">
		<div class="bp-feedback info">
			<span class="bp-icon" aria-hidden="true"></span>
			<p><?php is_user_logged_in() ? _e( 'You cannot reply to this discussion.', 'buddyboss-theme' ) : _e( 'Log in  to reply.', 'buddyboss-theme' ); ?></p>
		</div>
	</div>

<?php endif; ?>

<?php if ( bbp_is_reply_edit() ) : ?>

</div>

<?php endif; ?>
