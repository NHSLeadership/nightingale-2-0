<?php
	$layout = buddyboss_theme_get_option( 'bbpress_forums_item_layout' );
	$layout_class = '';
	$grid_class = 'lg-grid-1-3';

	if( $layout == 'cover' && bbp_is_forum_archive() && is_archive() ) {
		$grid_class = 'lg-grid-1-4';
	}

	if( $layout == 'cover' ) {
		$layout_class = 'bs-forum-details';
	}
?>

<li class="sm-grid-1-2 md-grid-1-2 lg-grid-1-3 <?php echo $grid_class; ?>">
	<div class="bb-cover-list-item">
		<a href="<?php bbp_forum_permalink(); ?>" class="bb-cover-wrap" title="<?php bbp_forum_title(); ?>">
			<?php echo bbp_get_forum_thumbnail_image( bbp_get_forum_id(), 'large', 'full' ); ?>
		</a>

		<div class="bs-card-forum-details <?php echo $layout_class; ?>">
			<div class="bs-sec-header">
				<?php do_action( 'bbp_theme_before_forum_title' ); ?>
				<h3><a class="bbp-forum-title" href="<?php bbp_forum_permalink(); ?>"><?php bbp_forum_title(); ?></a></h3>
				<?php do_action( 'bbp_theme_after_forum_title' ); ?>
			</div>

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
						'show_topic_count'  => false,
						'show_reply_count'  => false,
					);

				bbp_list_forums($r);

				do_action( 'bbp_theme_after_forum_sub_forums' ); ?></div>

			<?php if( $layout != 'cover' ) { ?>
				<div class="bs-timestamp">
					<?php do_action( 'bbp_theme_before_forum_freshness_link' ); ?>
					<?php bbp_forum_freshness_link(); ?>
					<?php do_action( 'bbp_theme_after_forum_freshness_link' ); ?>
				</div>
			<?php } ?>
		</div>
	</div>
</li>
