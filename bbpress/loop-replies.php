<?php

/**
 * Replies Loop
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<?php do_action( 'bbp_template_before_replies_loop' ); ?>

<ul id="topic-<?php bbp_topic_id(); ?>-replies" class="bs-item-list bs-forums-items bs-single-forum-list bb-single-reply-list list-view">

	<?php
	if ( ! empty( bbp_get_topic_id() ) ) {
		?>
        <li class="bs-item-wrap bs-header-item align-items-center no-hover-effect">

            <div class="item flex-1">
                <div class="item-title">
                    <h1 class="bb-reply-topic-title"><?php echo bbp_get_reply_topic_title( bbp_get_reply_id() ); ?></h1>

					<?php if ( ! bbp_show_lead_topic() && is_user_logged_in() ) : ?>
                        <div class="bb-topic-states push-right">
                        	<!-- 
								/**
								 * Checked bbp_get_topic_close_link() is empty or not
								 */
                        	 -->
                        	<?php if ( !empty( bbp_get_topic_close_link() ) ) { ?> 
								<?php if ( bbp_is_topic_open() ) { ?>
	                                <span data-balloon-pos="up" data-balloon="<?php _e( 'Close', 'buddyboss-theme' ); ?>"><i
	                                            class="bb-topic-status open"><?php echo bbp_get_topic_close_link(); ?></i></span>
								<?php } else { ?>
	                                <span data-balloon-pos="up" data-balloon="<?php _e( 'Open', 'buddyboss-theme' ); ?>"><i
	                                            class="bb-topic-status closed"><?php echo bbp_get_topic_close_link(); ?></i></span>
								<?php } ?>
							<?php } ?>
							<!-- 
								/**
								 * Checked bbp_get_topic_stick_link() is empty or not
								 */
                        	 -->
							<?php
							if ( ! bbp_is_topic_super_sticky( bbp_get_topic_id() ) && !empty( bbp_get_topic_stick_link() ) ) {
								if ( bbp_is_topic_sticky() ) { ?>
                                <span data-balloon-pos="up" data-balloon="<?php _e( 'Unstick', 'buddyboss-theme' ); ?>">
                                    <i class="bb-topic-status bb-sticky sticky"><?php echo bbp_get_topic_stick_link(); ?></i>
                                    </span><?php
								} else { ?>
                                <span data-balloon-pos="up" data-balloon="<?php _e( 'Sticky', 'buddyboss-theme' ); ?>">
                                    <i class="bb-topic-status bb-sticky unsticky"><?php echo bbp_get_topic_stick_link(); ?></i>
                                    </span><?php
								}
							}
							 
							/**
							 * Checked bbp_get_topic_stick_link() is empty or not
							 */
                        	
							if ( !empty( bbp_get_topic_stick_link() ) ) {
								if ( bbp_is_topic_super_sticky( bbp_get_topic_id() ) ) { ?>
	                            <span data-balloon-pos="up" data-balloon="<?php _e( 'Unstick', 'buddyboss-theme' ); ?>"><i
	                                        class="bb-topic-status bb-super-sticky super-sticky"><?php echo bbp_get_topic_stick_link(); ?></i>
	                                </span><?php
								} elseif ( ! bbp_is_topic_sticky() ) { ?>
	                            <span data-balloon-pos="up"
	                                  data-balloon="<?php _e( 'Super Sticky', 'buddyboss-theme' ); ?>"><i
	                                        class="bb-topic-status bb-super-sticky super-sticky unsticky"><?php echo bbp_get_topic_stick_link(); ?></i>
	                                </span><?php
								}
							}
							?>

							<?php
							$is_fav = bbp_is_user_favorite( get_current_user_id(), bbp_get_topic_id() );
							if ( $is_fav ) { ?>
                            <span class="bb-favorite-wrap" data-balloon-pos="up"
                                  data-balloon="<?php _e( 'Unfavorite', 'buddyboss-theme' ); ?>"
                                  data-unfav="<?php _e( 'Unfavorite', 'buddyboss-theme' ); ?>"
                                  data-fav="<?php _e( 'Favorite', 'buddyboss-theme' ); ?>"><i
                                        class="bb-topic-status bb-favorite-status favorited"><?php bbp_user_favorites_link(); ?></i>
                                </span><?php
							} else { ?>
                            <span class="bb-favorite-wrap" data-balloon-pos="up"
                                  data-balloon="<?php _e( 'Favorite', 'buddyboss-theme' ); ?>"
                                  data-unfav="<?php _e( 'Unfavorite', 'buddyboss-theme' ); ?>"
                                  data-fav="<?php _e( 'Favorite', 'buddyboss-theme' ); ?>"><i
                                        class="bb-topic-status bb-favorite-status unfavorited"><?php bbp_user_favorites_link(); ?></i>
                                </span><?php
							} ?>
                        </div>
					<?php endif; ?>
                </div>

                <div class="item-meta">
				<span class="bs-replied">
					<span class="bbp-topic-freshness-author"><?php bbp_author_link( array( 'post_id' => bbp_get_topic_last_active_id(), 'size' => 1 ) ); ?></span> <?php _e( 'updated', 'buddyboss-theme' ); ?> <?php bbp_topic_freshness_link(); ?>
				</span>
                    <span class="bs-voices-wrap">
					<?php
					$topic_id    = bbp_get_topic_id();
					$voice_count = bbp_get_topic_voice_count( $topic_id );
					$voice_text  = $voice_count > 1 ? __( 'Members', 'buddyboss-theme' ) : __( 'Member', 'buddyboss-theme' );

					$topic_reply_count = bbp_get_topic_reply_count( $topic_id );
					$topic_post_count  = bbp_get_topic_post_count( $topic_id );
					$reply_count       = bbp_get_topic_replies_link( $topic_id );
					$topic_reply_text  = '';
					?>
                        <span class="bs-voices"><?php bbp_topic_voice_count(); ?> <?php echo $voice_text; ?></span>
					<span class="bs-separator">&middot;</span>
					<span class="bs-replies"><?php
						if ( bbp_show_lead_topic() ) {
							bbp_topic_reply_count( $topic_id );
							$topic_reply_text = $topic_reply_count > 1 ? __( 'Replies', 'buddyboss-theme' ) : __( 'Reply', 'buddyboss-theme' );
						} else {
							bbp_topic_post_count( $topic_id );
							$topic_reply_text = $topic_post_count > 1 ? __( 'Posts', 'buddyboss-theme' ) : __( 'Post', 'buddyboss-theme' );
						}
						?>

						<?php echo $topic_reply_text; ?>
					</span>
				</span>

					<?php if ( ! empty( bbp_get_topic_forum_title() ) ) { ?>
                        <div class="action bs-forums-meta flex align-items-center">
						<span class="color bs-meta-item"
                              style="background: <?php echo color2rgba( textToColor( bbp_get_topic_forum_title() ), 0.6 ); ?>">
							<a href="<?php bbp_forum_permalink( bbp_get_topic_forum_id() ); ?>"><?php echo bbp_get_topic_forum_title();; ?></a>
						</span>
                        </div>
					<?php } ?>
                </div>
	            <?php
	            $terms = bbp_get_form_topic_tags();
	            if ( $terms && bbp_allow_topic_tags() ) {
		            $tags_arr = explode( ', ', $terms );
		            $html     = '';
		            foreach ( $tags_arr as $tag ) {
			            $html .= '<li><a href="' . bbp_get_topic_tag_link( $tag ) . '">' . $tag . '</a></li>';
					}
				?>
					<div class="item-tags">
						<i class="bb-icon-tag"></i>
						<ul>
							<?php echo rtrim( $html, ',' ); ?>
						</ul>
					</div>
				<?php
	            } else {
		            ?>
                    <div class="item-tags" style="display: none;">
                        <i class="bb-icon-tag"></i>
                    </div>
		            <?php
                }
	            ?>
            </div>
        </li><!-- .bbp-header -->
		<?php
	}

	if ( bbp_thread_replies() ) : ?>
		<?php bbp_list_replies(); ?>
	<?php else : ?>
		<?php while ( bbp_replies() ) : bbp_the_reply(); ?>
            <li><?php bbp_get_template_part( 'loop', 'single-reply' ); ?></li>
		<?php endwhile; ?>
	<?php endif; ?>

</ul><!-- #topic-<?php bbp_topic_id(); ?>-replies -->

<?php do_action( 'bbp_template_after_replies_loop' ); ?>
