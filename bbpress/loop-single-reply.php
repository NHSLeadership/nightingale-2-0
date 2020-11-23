<?php

/**
 * Replies Loop - Single Reply
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<li id="post-<?php bbp_reply_id(); ?>" class="div-comment nhsuk-list-panel__item" data-date="<?php echo get_post_time( 'F Y', false, bbp_get_reply_id(), true ); ?>">

	<div class="comment-body">
        <div class="comment_body_comment">

		<?php do_action( 'bbp_theme_before_reply_content' ); ?>

		<?php bbp_reply_content(); ?>

		<?php do_action( 'bbp_theme_after_reply_content' ); ?>
        </div>
	</div><!-- .bbp-reply-content -->
    <div class="comment-author vcard">

        <div class="bbp-reply-author item-avatar">
			<?php $args = array('type' => 'avatar');
			echo bbp_get_reply_author_link( $args ); ?>
        </div><!-- .bbp-reply-author -->

        <div class="comment-meta commentmetadata">
            <p>
                <?php
				$args = array('type' => 'name');
				echo bbp_get_reply_author_link($args);
				?>
                <span class="bs-timestamp"><?php bbp_reply_post_date(); ?></span>
            </p

			<?php if ( bbp_is_single_user_replies() ) : ?>

                <span class="bbp-header">
				<?php esc_html_e( 'in reply to: ', 'nightingale' ); ?>
					<a class="bbp-topic-permalink" href="<?php bbp_topic_permalink( bbp_get_reply_topic_id() ); ?>"><?php bbp_topic_title( bbp_get_reply_topic_id() ); ?></a>
				</span>

			<?php endif; ?>

        </div>
    </div>
    <div class="reply">

		<?php
		/**
		 * Checked bbp_get_reply_admin_links() is empty or not if links not return then munu dropdown will not show
		 */
		if ( is_user_logged_in() && !empty( strip_tags( bbp_get_reply_admin_links() ) ) ) { ?>

        <div class="bbp-meta push-right">
            <div class="more-actions bb-reply-actions bs-dropdown-wrap align-self-center">
                <button class="nhsuk-button bs-dropdown-link bb-reply-actions-button">Reply / Manage</button>
                <ul class="bs-dropdown bb-reply-actions-dropdown" style="display: none;">
                    <li>
							<?php do_action( 'bbp_theme_before_reply_admin_links' ); ?>
							<?php bbp_reply_admin_links(); ?>
							<?php do_action( 'bbp_theme_after_reply_admin_links' ); ?>
                    </li>
                </ul>
            </div>
        </div><!-- .bbp-meta -->
		<?php } ?>

</div>
</li><!-- .reply -->
