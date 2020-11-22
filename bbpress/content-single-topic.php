<?php

/**
 * Single Topic Content Part
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<div id="bbpress-forums" class="bb-content-area bs-replies-wrapper">
	<div class="bb-grid">

		<div class="replies-content">
			<?php bbp_breadcrumb(); ?>

			<?php do_action( 'bbp_template_before_single_topic' ); ?>

			<?php if ( post_password_required() ) : ?>

				<?php bbp_get_template_part( 'form', 'protected' ); ?>

			<?php else : ?>

				<?php bbp_topic_tag_list(); ?>

				<?php if ( bbp_show_lead_topic() ) : ?>

					<?php bbp_get_template_part( 'content', 'single-topic-lead' ); ?>

				<?php endif; ?>

				<?php if ( bbp_has_replies() ) : ?>

					<?php //bbp_get_template_part( 'pagination', 'replies' ); ?>

					<?php bbp_get_template_part( 'loop',       'replies' ); ?>

					<?php bbp_get_template_part( 'pagination', 'replies' ); ?>

				<?php endif; ?>

                <p class="bb-topic-reply-link-wrap mobile-only"><?php bbp_topic_reply_link(); ?></p>
				<p class="bb-topic-subscription-link-wrap mobile-only"><?php $args = array('before' => '');
			echo bbp_get_topic_subscription_link( $args ); ?></p>

				<?php bbp_get_template_part( 'form', 'reply' ); ?>

			<?php endif; ?>

			<?php do_action( 'bbp_template_after_single_topic' ); ?>

		</div>

		<div class="bb-sm-grid bs-single-topic-sidebar">
            <div class="bs-topic-sidebar-inner">
                <div class="single-topic-sidebar-links">
        			<p class="bb-topic-reply-link-wrap"><?php bbp_topic_reply_link(); ?></p>
        			<p class="bb-topic-subscription-link-wrap"><?php $args = array('before' => '');
        			echo bbp_get_topic_subscription_link( $args ); ?></p>
                </div>

                <div class="scrubber" id="scrubber" data-key="<?php echo esc_attr( buddyboss_unique_id( 'forums_scrubber_' ) ); ?>">
                    <a href="#" class="firstpostbtn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11">
                            <path fill="none" stroke="#C8CBCF" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.44" d="M1 10l4.5-4 4.5 4M1 5l4.5-4L10 5"/>
                        </svg>
                        <?php _e( 'Original Post', 'buddyboss-theme' ); ?>
                    </a>
                    <div class="reply-timeline-container" id="reply-timeline-container">
                        <div class="handle" id="handle">
                            <span id="currentpost">0</span> <?php _e( 'of', 'buddyboss-theme' ); ?> <span id="totalposts">0</span> <?php _e( 'posts', 'buddyboss-theme' ); ?>
                            <span class="desc" id="date"><?php _e( 'June 2018', 'buddyboss-theme' ); ?></span>
                        </div>
                    </div>
                    <a href="#" class="lastpostbtn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11">
                            <path fill="none" stroke="#C8CBCF" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.44" d="M1 1l4.5 4L10 1M1 6l4.5 4L10 6"/>
                        </svg>
                        <?php _e( 'Now', 'buddyboss-theme' ); ?>
                    </a>
                </div>
            </div>
		</div>

	</div>

</div>
