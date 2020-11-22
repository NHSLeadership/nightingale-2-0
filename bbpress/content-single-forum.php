<?php

/**
 * Single Forum Content Part
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<div id="bbpress-forums" class="<?php if(bbp_is_single_forum() && bbp_has_forums()){echo 'single-with-sub-forum ';} ?>">

	<?php if ( ! empty( $post->post_parent ) && bbp_is_single_forum() && !bp_is_group_single() ) {
		$post_parent_title = '';
		if ( $post->post_parent != $post->ID ) {
			$post_parent_title = sprintf( '<a href="%s" class="bbp-breadcrumb-forum">%s</a> <span class="bb-icon-angle-right"></span> ', get_the_permalink( $post->post_parent ), get_the_title( $post->post_parent ) );
		}
		?>
        <div class="bbp-forum-child">
	        <div class="bbp-breadcrumb">
	        	<?php
	            if ( '' !== $post_parent_title ) {
	                ?><p><?php echo $post_parent_title; ?><span class="bbp-breadcrumb-current"><?php the_title(); ?></span></p><?php
	            } else {
		            the_title( '<p>' . $post_parent_title, '</p>' );
	            }
	            ?>
	        </div>
	    </div>
	<?php } ?>

	<div class="bbp-forum-buttons-wrap">
		<?php
		if( ( bp_is_group_single() || bbp_is_single_forum() ) && bbp_has_forums() && ! bbp_is_forum_category() ) { ?>
			<h3 class="bb-main-forum-title"><?php _e('Main Forum', 'buddyboss-theme'); ?></h3><?php
		}

		if ( ( !is_active_sidebar( 'forums' ) || bp_is_groups_component() ) && bbp_is_single_forum() && !bbp_is_forum_category() && ( bbp_current_user_can_access_create_topic_form() || bbp_current_user_can_access_anonymous_user_form() ) ) { ?>
			<?php bbp_forum_subscription_link(); ?>

			<div class="bbp_before_forum_new_post">
				<a href="#new-post" data-modal-id="bbp-topic-form" class="button full btn-new-topic"><i class="bb-icon-edit-square"></i> <?php _e( 'New discussion', 'buddyboss-theme' ); ?></a>
			</div><?php
		} ?>
	</div>

	<?php do_action( 'bbp_template_before_single_forum' ); ?>

	<?php if ( post_password_required() ) : ?>

		<?php bbp_get_template_part( 'form', 'protected' ); ?>

	<?php else : ?>

		<?php if ( bbp_has_forums() ) : ?>
			<?php if( bp_is_group_single() || bbp_is_single_forum() ) { ?>
				<div class="bp-group-single-forums">
					<hr>
					<h3 class="bb-sub-forum-title"><?php _e('Sub Forums', 'buddyboss-theme'); ?></h3>
			<?php } ?>

			<?php bbp_get_template_part( 'loop', 'forums' ); ?>

			<?php if( bp_is_group_single() || bbp_is_single_forum() ) { ?>
				</div>
			<?php } ?>
		<?php endif; ?>

		<?php if ( !bbp_is_forum_category() && bbp_has_topics() ) : ?>

			<?php //bbp_get_template_part( 'pagination', 'topics'    ); ?>

			<?php bbp_get_template_part( 'loop',       'topics'    ); ?>

			<?php bbp_get_template_part( 'pagination', 'topics'    ); ?>

			<?php bbp_get_template_part( 'form',       'topic'     ); ?>

		<?php elseif ( !bbp_is_forum_category() ) : ?>

			<?php bbp_get_template_part( 'feedback',   'no-topics' ); ?>

			<?php bbp_get_template_part( 'form',       'topic'     ); ?>

		<?php endif; ?>

	<?php endif; ?>

	<?php do_action( 'bbp_template_after_single_forum' ); ?>

</div>