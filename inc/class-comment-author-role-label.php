<?php
/**
 * Add the comment author's role to the output
 *
 * @package Nightingale
 * @copyright NHS Leadership Academy, Tony Blacker
 * @version 1.0 24th October 2019
 */

if ( ! class_exists( 'Comment_Author_Role_Label' ) ) :
	/**
	 * Add User Role to Comments.
	 */
	class Comment_Author_Role_Label {
		/**
		 * Comment_Author_Role_Label constructor.
		 */
		public function __construct() {
			add_filter( 'get_comment_author', array( $this, 'nightingale_get_comment_author_role' ), 10, 3 );
			add_filter( 'get_comment_author_link', array( $this, 'nightingale_comment_author_role' ) );
		}

		/**
		 * Get the role of the author from the database
		 *
		 * @param integer $author id of the person who wrote the post / comment.
		 * @param integer $comment_id - Removed.
		 * @param integer $comment id of the individual comment being interrogated.
		 *
		 * @return mixed
		 */
		public function nightingale_get_comment_author_role( $author, $comment_id, $comment ) {
			$authoremail = get_comment_author_email( $comment );
			if ( email_exists( $authoremail ) ) {
				$commet_user_role        = get_user_by( 'email', $authoremail );
				$comment_user_role       = $commet_user_role->roles[0];
				$this->comment_user_role = ' <span class="comment-author-label comment-author-label-' . $comment_user_role . '">' . ucfirst( $comment_user_role ) . '</span>';
			} else {
				$this->comment_user_role = '';
			}

			return $author;
		}

		/**
		 * Find the author role level.
		 *
		 * @param string $author Get the details of the author.
		 *
		 * @return string $author
		 */
		public function nightingale_comment_author_role( $author ) {
			return $author .= $this->comment_user_role;
		}
	}

	new Comment_Author_Role_Label();
endif;
