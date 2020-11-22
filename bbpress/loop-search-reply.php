<div class="bs-item-wrap">
	<div class="flex flex-1">
		<div class="item-avatar bb-item-avatar-wrap">
			<?php echo bbp_get_reply_author_link( array( 'size' => '180' ) ); ?>
		</div>

		<div class="item">
			<div class="item-title">
				<a class="bbp-topic-permalink" href="<?php bbp_reply_url(); ?>"><?php bbp_topic_title( bbp_get_reply_topic_id() ); ?></a>
			</div>

			<div class="item-meta bb-reply-meta">
				<i class="bb-icon-reply"></i>
				<div>
					<span class="bs-replied">
						<span class="bbp-topic-freshness-author"><?php bbp_author_link( array( 'post_id' => bbp_get_reply_id(), 'size' => 1 ) ); ?></span> <?php _e('replied', 'buddyboss-theme'); ?> <?php bbp_reply_post_date(); ?>
					</span>
				</div>
			</div>
		</div>
	</div>
</div>
