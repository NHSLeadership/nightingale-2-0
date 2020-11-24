<?php
/**
 * BuddyBoss - Activity Feed (Single Item)
 *
 * This template is used by activity-loop.php and AJAX functions to show
 * each activity.
 *
 * @since BuddyPress 3.0.0
 * @version 3.0.0
 */

bp_nouveau_activity_hook( 'before', 'entry' ); ?>

<li class="div-comment nhsuk-list-panel__item" id="activity-<?php bp_activity_id(); ?>" data-bp-activity-id="<?php bp_activity_id(); ?>" data-bp-timestamp="<?php bp_nouveau_activity_timestamp(); ?>">


	<div class="comment-body">
		<?php if ( bp_nouveau_activity_has_content() ) : ?>
			<div class="comment_body_comment"><?php bp_nouveau_activity_content(); ?></div>
		<?php endif; ?>

		<?php
        if ( function_exists( 'bp_nouveau_activity_state' ) ) {
            bp_nouveau_activity_state();
        }
        ?>
	</div>
    <div class="comment-author vcard">
        <div class="activity-avatar item-avatar">
            <a href="<?php bp_activity_user_link(); ?>"><?php bp_activity_avatar( array( 'type' => 'full' ) ); ?></a>
        </div>

        <div class="comment-meta commentmetadata">
			<?php bp_activity_action('no_timestamp=true'); ?>
            <span class="nhsuk-body-s"><a href="<?php echo esc_url( bp_activity_get_permalink( bp_get_activity_id() ) ); ?>"><?php echo bp_core_time_since( bp_get_activity_date_recorded() ); ?></a></span>
        </div>
    </div>

	<?php bp_nouveau_activity_entry_buttons(); ?>

	<?php bp_nouveau_activity_hook( 'before', 'entry_comments' ); ?>

	<?php if ( bp_activity_get_comment_count() || ( is_user_logged_in() && ( bp_activity_can_comment() || bp_is_single_activity() ) ) ) : ?>

		<div class="reply">

			<?php bp_activity_comments(); ?>

			<?php bp_nouveau_activity_comment_form(); ?>

		</div>

	<?php endif; ?>

	<?php bp_nouveau_activity_hook( 'after', 'entry_comments' ); ?>

</li>

<?php
bp_nouveau_activity_hook( 'after', 'entry' );
