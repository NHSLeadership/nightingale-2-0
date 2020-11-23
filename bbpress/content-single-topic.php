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

		<div class="replies-content nhsuk-list-panel comments-area">
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
            </div>
		</div>

	</div>

</div>
