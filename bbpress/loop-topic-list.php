<?php $class = bbp_is_topic_open() ? '' : 'closed'; ?>
<div class="nhsuk-card  <?php echo $class; ?>">
	<div class="nhsuk-card__content">
		<h3 class="nhsuk-card__heading">
			<a class="bbp-topic-permalink" href="<?php bbp_topic_permalink(); ?>"><?php bbp_topic_title(); ?></a>
		</h3>
		<div class="nhsuk-card__description">
			<p class="nhsuk-body-s comment-author"><?php echo bbp_get_topic_author_link( array( 'size' => '180' ) ); ?>

				<?php if( ! bbp_is_topic_open() ) { ?>
					<i data-balloon-pos="up" data-balloon="<?php _e('Closed', 'nightingale'); ?>" class="bb-topic-status closed"></i>
				<?php } ?>

				<?php if( bbp_is_topic_super_sticky() ) { ?>
					<i data-balloon-pos="up" data-balloon="<?php _e('Super Sticky', 'nightingale'); ?>" class="bb-topic-status super-sticky"></i>
				<?php } elseif( bbp_is_topic_sticky() ) { ?>
					<i data-balloon-pos="up" data-balloon="<?php _e('Sticky', 'nightingale'); ?>" class="bb-topic-status sticky"></i>
				<?php } ?>

				<?php if( is_user_logged_in() ) {
					$is_subscribed = bbp_is_user_subscribed_to_topic( get_current_user_id(), bbp_get_topic_id() );
					if( $is_subscribed ) { ?>
					<i data-balloon-pos="up" data-balloon="<?php _e('Subscribed', 'nightingale'); ?>" class="bb-topic-status subscribed"></i><?php
					}
				} ?></p>
			<div class="item-meta bb-reply-meta">
				<div>
                        <span class="bs-replied nhsuk-s-text">
							<span class="bbp-topic-freshness-author"><?php bbp_author_link( array( 'post_id' => bbp_get_topic_last_active_id(), 'size' => 1 ) ); ?></span> <?php _e('replied', 'nightingale'); ?> <?php bbp_topic_freshness_link(); ?>
						</span>
					<span class="bs-voices-wrap">
							<?php
							$voice_count = bbp_get_topic_voice_count( bbp_get_topic_id() );
							$voice_text = $voice_count > 1 ? __('Members', 'nightingale') : __('Member', 'nightingale');

							$topic_reply_count = bbp_get_topic_reply_count( bbp_get_topic_id() );
							$topic_post_count = bbp_get_topic_post_count( bbp_get_topic_id() );
							$topic_reply_text = '';
							?>
							<span class="bs-voices nhsuk-tag"><?php bbp_topic_voice_count(); ?> <?php echo $voice_text; ?></span>
							<span class="bs-replies nhsuk-tag nhsuk-tag--white"><?php
								if( bbp_show_lead_topic() ) {
									bbp_topic_reply_count();
									$topic_reply_text = $topic_reply_count > 1 ? __('Replies', 'nightingale') : __('Reply', 'nightingale');
								} else {
									bbp_topic_post_count();
									$topic_reply_text = $topic_post_count > 1 ? __('Replies', 'nightingale') : __('Reply', 'nightingale');
								}
								?>

								<?php echo $topic_reply_text; ?>
							</span>
						</span>
				</div>
			</div>
			<?php if( !empty( bbp_get_topic_forum_title()) ) { ?>
				<div class="action bs-forums-meta flex align-items-center">
				<span class="color bs-meta-item <?php echo ( bbp_is_single_forum() ) ? esc_attr( 'no-action' ) : ''; ?>">
                    <?php if ( bbp_is_single_forum() ) {
	                    ?> <span class="no-links"><?php echo bbp_get_topic_forum_title(); ?></span> <?php
                    } else {
	                    ?> <a href="<?php echo esc_url( bbp_get_forum_permalink( bbp_get_topic_forum_id() ) ); ?>"><?php echo bbp_get_topic_forum_title(); ?></a> <?php
                    } ?>
				</span>
				</div>
			<?php } ?>
		</div>

	</div>
</div>
