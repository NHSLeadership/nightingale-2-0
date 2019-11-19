<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Nightingale
 * @copyright NHS Leadership Academy, Tony Blacker
 * @version 1.1 21st August 2019
 */

if ( ! function_exists( 'nightingale_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function nightingale_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		echo '<span class="nhsuk-u-visually-hidden">Posted on: </span>' . $time_string . ' '; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'nightingale_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function nightingale_posted_by() {

		echo '<span class="nhsuk-u-visually-hidden">Posted by: </span><a class="url fn n" 
 href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a>&nbsp;-&nbsp;'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'nightingale_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function nightingale_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'nightingale' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<p class="cat-links">' . esc_html__( 'Posted in %1$s', 'nightingale' ) . '</p>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'nightingale' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<p class="tags-links">' . esc_html__( 'Tagged %1$s', 'nightingale' ) . '</p>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<p class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'nightingale' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</p>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <p class="screen-reader-text">%s</p>', 'nightingale' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<p class="edit-link">',
			'</p>'
		);
	}
endif;

if ( ! function_exists( 'nightingale_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function nightingale_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<fig class="nhsuk-image">
				<?php the_post_thumbnail( 'thumbnail', array( 'class' => 'nhsuk-image__img' ) ); ?>
			</fig><!-- .post-thumbnail -->

		<?php else : ?>

			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
				the_post_thumbnail(
					'post-thumbnail',
					array(
						'alt' => the_title_attribute(
							array(
								'echo' => false,
							)
						),
					)
				);
				?>
			</a>
			<?php
		endif; // End is_singular().
	}
endif;

/**
 * Display Comments.
 *
 * @param integer $comment Comment ID.
 * @param array   $args the variables to alter the comment with.
 * @param integer $depth the depth of the comment reply.
 */
function nightingale_comment_display( $comment, $args, $depth ) {
	if ( 'div' === $args['style'] ) {
		$tag       = 'div';
		$add_below = 'comment';
	} else {
		$tag       = 'li';
		$add_below = 'div-comment';
	}
	?>
	<<?php echo $tag; ?> <?php echo comment_class( 'nhsuk-list-panel__item' ); ?> id="comment-<?php echo comment_ID(); ?>">
	<?php
	if ( 'div' !== $args['style'] ) {
		?>
		<div id="div-comment-<?php comment_ID(); ?>" class="comment-body">
		<?php
	}
	?>

	<div class="comment_body_comment"><?php comment_text(); ?></div>
	<div class="comment-avatar">
		<?php
		echo ( 0 !== $args['avatar_size'] ) ? get_avatar( $comment, $args['avatar_size'] ) : '';
		?>
	</div>
	<div class="comment-author vcard">
		<?php
		/* translators: s: link to author */
		printf( __( '<cite class="fn">%s</cite>', 'nightingale' ), get_comment_author_link() );
		?>
		<div class="comment-meta commentmetadata">
			<?php
			echo '<a href="' . esc_attr( get_comment_link( $comment->comment_ID ) ) . '">';
			/* translators: 1: date, 2: time */
			printf(
				'%1$s',
				esc_html( get_comment_date() )
			);
			?>
			</a>
		</div>
	</div>
	<?php
	if ( '0' === $comment->comment_approved ) {
		echo '<em class="comment-awaiting-moderation">' . esc_html( _e( 'Your comment is awaiting moderation.', 'nightingale' ) ) . '</em><br/>';
	}

	echo '<div class="reply">';
	comment_reply_link(
		array_merge(
			$args,
			array(
				'add_below' => $add_below,
				'depth'     => $depth,
				'max_depth' => $args['max_depth'],
			)
		)
	);
	edit_comment_link( nightingale_edit_icon(), '  ', '' );
	echo '</div>';
	if ( 'div' !== $args['style'] ) :
		echo '</div>';
	endif;
}

/**
 * Create an icon for replies
 *
 * @return string rendered svg.
 */
function nightingale_reply_icon() {
	return '<svg class="comment-reply" viewBox="0 0 20 20">
							<path d="M14.999,8.543c0,0.229-0.188,0.417-0.416,0.417H5.417C5.187,8.959,5,8.772,5,8.543s0.188-0.417,0.417-0.417h9.167C14.812,8.126,14.999,8.314,14.999,8.543 M12.037,10.213H5.417C5.187,10.213,5,10.4,5,10.63c0,0.229,0.188,0.416,0.417,0.416h6.621c0.229,0,0.416-0.188,0.416-0.416C12.453,10.4,12.266,10.213,12.037,10.213 M14.583,6.046H5.417C5.187,6.046,5,6.233,5,6.463c0,0.229,0.188,0.417,0.417,0.417h9.167c0.229,0,0.416-0.188,0.416-0.417C14.999,6.233,14.812,6.046,14.583,6.046 M17.916,3.542v10c0,0.229-0.188,0.417-0.417,0.417H9.373l-2.829,2.796c-0.117,0.116-0.71,0.297-0.71-0.296v-2.5H2.5c-0.229,0-0.417-0.188-0.417-0.417v-10c0-0.229,0.188-0.417,0.417-0.417h15C17.729,3.126,17.916,3.313,17.916,3.542 M17.083,3.959H2.917v9.167H6.25c0.229,0,0.417,0.187,0.417,0.416v1.919l2.242-2.215c0.079-0.077,0.184-0.12,0.294-0.12h7.881V3.959z"></path>
						</svg> Reply';
}

/**
 * Create an icon for editing.
 */
function nightingale_edit_icon() {
	return '<svg class="comment-edit" viewBox="0 0 20 20">
							<path d="M19.404,6.65l-5.998-5.996c-0.292-0.292-0.765-0.292-1.056,0l-2.22,2.22l-8.311,8.313l-0.003,0.001v0.003l-0.161,0.161c-0.114,0.112-0.187,0.258-0.21,0.417l-1.059,7.051c-0.035,0.233,0.044,0.47,0.21,0.639c0.143,0.14,0.333,0.219,0.528,0.219c0.038,0,0.073-0.003,0.111-0.009l7.054-1.055c0.158-0.025,0.306-0.098,0.417-0.211l8.478-8.476l2.22-2.22C19.695,7.414,19.695,6.941,19.404,6.65z M8.341,16.656l-0.989-0.99l7.258-7.258l0.989,0.99L8.341,16.656z M2.332,15.919l0.411-2.748l4.143,4.143l-2.748,0.41L2.332,15.919z M13.554,7.351L6.296,14.61l-0.849-0.848l7.259-7.258l0.423,0.424L13.554,7.351zM10.658,4.457l0.992,0.99l-7.259,7.258L3.4,11.715L10.658,4.457z M16.656,8.342l-1.517-1.517V6.823h-0.003l-0.951-0.951l-2.471-2.471l1.164-1.164l4.942,4.94L16.656,8.342z"></path>
						</svg> Edit';
}

/**
 * Change the reply text to include an SVG.
 *
 * @param string $link HTML of original link.
 *
 * @return mixed $link rendered output.
 */
function nightingale_comment_reply_text( $link ) {
	$link = str_replace( 'Reply', nightingale_reply_icon(), $link );

	return $link;
}

add_filter( 'comment_reply_link', 'nightingale_comment_reply_text' );
