<?php
	//$layout = buddyboss_theme_get_option( 'bbpress_forums_item_layout' );
	$layout_class = '';
	$grid_class = 'lg-grid-1-3';

	/*if( $layout == 'cover' && bbp_is_forum_archive() && is_archive() ) {
		$grid_class = 'lg-grid-1-4';
	}

	if( $layout == 'cover' ) {
		$layout_class = 'bs-forum-details';
	}
	*/
?>

<div class="nhsuk-card">
    <div class="nhsuk-card__content">
        <h3 class="nhsuk-card__heading">
	        <a class="bbp-forum-title" href="<?php bbp_forum_permalink(); ?>"><?php bbp_forum_title(); ?></a>
        </h3>
		<div class="bb-cover-list-item">
			<a href="<?php bbp_forum_permalink(); ?>" class="bb-cover-wrap" title="<?php bbp_forum_title(); ?>">
				<?php echo bbp_get_forum_thumbnail_image( bbp_get_forum_id(), 'large', 'full' ); ?>
			</a>

			<div class="nhsuk-card__description">




				<div class="bb-forum-content-wrap">
					<?php do_action( 'bbp_theme_before_forum_description' ); ?>
					<div class="bb-forum-content"><?php echo wp_trim_words( bbp_get_forum_content(bbp_get_forum_id()), 18, '&hellip;' ); ?></div>
					<?php do_action( 'bbp_theme_after_forum_description' ); ?>
				</div>

				<div class="forums-meta bb-forums-meta"><?php
					do_action( 'bbp_theme_before_forum_sub_forums' );

					$r = array(
							'before'            => '',
							'after'             => '',
							'link_before'       => '<span>',
							'link_after'        => '</span>',
							'count_before'      => ' (',
							'count_after'       => ')',
							'count_sep'         => ', ',
							'separator'         => ' ',
							'forum_id'          => '',
							'show_topic_count'  => true,
							'show_reply_count'  => true,
						);

					bbp_list_forums($r);

					do_action( 'bbp_theme_after_forum_sub_forums' ); ?></div>

					<div class="nhsuk-tag nhsuk-tag--white bs-timestamp alignright">
                        <?php _e( 'Last Activity: ', 'nightingale' ); ?>
						<?php do_action( 'bbp_theme_before_forum_freshness_link' ); ?>
						<?php bbp_forum_freshness_link(); ?>
						<?php do_action( 'bbp_theme_after_forum_freshness_link' ); ?>
					</div>
			</div>
		</div>
	</div>
</div>
