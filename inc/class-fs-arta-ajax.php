<?php

class FS_Arta_Ajax
{
	public function __construct ()
	{
		add_action( 'comment_post', array(
			$this,
			'ajaxify_comment'
		), 20, 2 );
	}

	public function ajaxify_comment ( $comment_id, $comment_status )
	{
		// Check if ajax request
		if ( ! empty( $_SERVER[ 'HTTP_X_REQUESTED_WITH' ] ) && strtolower( $_SERVER[ 'HTTP_X_REQUESTED_WITH' ] ) == 'xmlhttprequest' )
		{
			// notify moderator of unapproved comment
			if ( $comment_status == 0 )
			{
				wp_notify_moderator( $comment_id );
				echo 'success';
			}
			else if ( $comment_status == 1 )
			{
				echo 'success';
				$commentdata =& get_comment( $comment_ID, ARRAY_A );
				$post        =& get_post( $commentdata[ 'comment_post_ID' ] );
				if ( get_option( 'comments_notify' ) && $commentdata[ 'comment_approved' ] && $post->post_author != $commentdata[ 'user_ID' ] )
					wp_notify_postauthor( $comment_ID, $commentdata[ 'comment_type' ] );
			}
			else
				echo 'error';

			exit();
		}
	}
}

new FS_Arta_Ajax();