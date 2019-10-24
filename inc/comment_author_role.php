<?php
/**
 * Add the comment author's role to the output
 *
 * @package Nightingale
 * @copyright NHS Leadership Academy, Tony Blacker
 * @version 1.0 24th October 2019
 */
/**
 * Add User Role to Comments.
 */
if ( ! class_exists( 'Comment_Author_Role_Label' ) ) :
	class Comment_Author_Role_Label {
		public function __construct() {
			add_filter( 'get_comment_author', array( $this, 'get_comment_author_role' ), 10, 3 );
			add_filter( 'get_comment_author_link', array( $this, 'comment_author_role' ) );
		}
		function get_comment_author_role($author, $comment_id, $comment) {
			$authoremail = get_comment_author_email( $comment);
			if (email_exists($authoremail)) {
				$commet_user_role = get_user_by( 'email', $authoremail );
				$comment_user_role = $commet_user_role->roles[0];
				$this->comment_user_role = ' <span class="comment-author-label comment-author-label-'
				                           .$comment_user_role.'">' . ucfirst($comment_user_role) . '</span>';
			} else {
				$this->comment_user_role = '';
			}
			return $author;
		}
		function comment_author_role($author) {
			return $author .= $this->comment_user_role;
		}
	}
	new Comment_Author_Role_Label;
endif;
