<?php

/**
 * Search Loop - Single Forum
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<div class="bs-item-wrap">
	<div class="flex flex-1">
		<div class="item-avatar bb-item-avatar-wrap">
			<?php echo bbp_get_author_link( array( 'post_id' => bbp_get_forum_id(),'type' => 'avatar', 'size' => '180' ) ); ?>
		</div>

		<div class="item">
			<div class="item-title">
				<?php do_action( 'bbp_theme_before_forum_title' ); ?>
				<a class="bbp-topic-permalink" href="<?php bbp_forum_permalink(); ?>"><?php bbp_forum_title(); ?></a>
				<?php do_action( 'bbp_theme_after_forum_title' ); ?>
			</div>

			<div class="item-meta bb-reply-meta">
				<i class="bb-icon-reply"></i>
				<div>
					<span class="bs-replied">
						<?php $forum = bbp_get_forum( bbp_get_forum_id());  ?>
						<span class="bbp-forum-post-date">
							<?php echo bbp_get_author_link( array( 'post_id' => bbp_get_forum_id(),'type' => 'name' ) ); ?>
							<?php printf( __( 'created %s', 'buddyboss-theme' ), bbp_get_time_since($forum->post_date) ); ?>
						</span>
					</span>
				</div>
			</div>
		</div>
	</div>
</div>
