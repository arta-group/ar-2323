<?php

class FS_Arta_Product_Review_Walker extends Walker_Comment
{
	public function start_lvl ( &$output, $depth = 0, $args = array() )
	{
		$GLOBALS[ 'comment_depth' ] = $depth + 1;
		switch ( $args[ 'style' ] )
		{
			case 'div':
				break;
			case 'ol':
				$output .= '<ol class="my-1 pr-2 lg-pr-5">' . "\n";
				break;
			case 'ul':
			default:
				$output .= '<ul class="my-1 pr-2 lg-pr-5">' . "\n";
				break;
		}
	}

	public function end_lvl ( &$output, $depth = 0, $args = array() )
	{
		$GLOBALS[ 'comment_depth' ] = $depth + 1;
		switch ( $args[ 'style' ] )
		{
			case 'div':
				break;
			case 'ol':
				$output .= "</ol><!-- .children -->\n";
				break;
			case 'ul':
			default:
				$output .= "</ul><!-- .children -->\n";
				break;
		}
	}

	public function start_el ( &$output, $comment, $depth = 0, $args = array(), $id = 0 )
	{
		$depth ++;
		$GLOBALS[ 'comment_depth' ] = $depth;
		$GLOBALS[ 'comment' ]       = $comment;
		if ( ! empty( $args[ 'callback' ] ) )
		{
			ob_start();
			call_user_func( $args[ 'callback' ], $comment, $args, $depth );
			$output .= ob_get_clean();

			return;
		}
		if ( ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) && $args[ 'short_ping' ] )
		{
			ob_start();
			$this->ping( $comment, $depth, $args );
			$output .= ob_get_clean();
		}
		elseif ( 'html5' === $args[ 'format' ] )
		{
			ob_start();
			$this->html5_comment( $comment, $depth, $args );
			$output .= ob_get_clean();
		}
		else
		{
			ob_start();
			$this->comment( $comment, $depth, $args );
			$output .= ob_get_clean();
		}
	}

	protected function html5_comment ( $comment, $depth, $args )
	{
		$tag = ( 'div' === $args[ 'style' ] ) ? 'div' : 'li';
		ob_start();
		?>
		<<?php echo $tag; ?>>
		<div id="comment-<?php echo $comment->comment_ID; ?>" class="bg-white flex flex-row pt-4/3 pb-3/2  relative rounded-xs<?php echo $comment->user_id > 0 ? ' border-primary-1000' : ''; ?>">
			<?php echo get_avatar( $comment->comment_author_email, 40, '', '', array( 'class' => 'object-fit object-center w-5 h-5 md-w-7/8 md-h-7/8 rounded-full flex-shrink-0 ml-2 md-ml-4/1' ) ); ?>
			<div class="flex flex-col flex-1">
				<div class="flex flex-col lg-flex-row lg-items-center justify-between mb-2">
					<span class="text-base leading-2/2 text-black-600 ml-2 font-bold<?php echo $comment->user_id > 0 ? ' text-primary-1100' : ''; ?>">
						<?php
						$user = get_userdata( $comment->user_id );
						if ( empty( $user->first_name ) && empty( $user->last_name ) )
							echo 'کاربر مهمان';
						else
							echo $user->first_name . ' ' . $user->last_name;
						?>
					</span>
					<div class="flex items-center">
						<?php
						$rate = get_comment_meta( $comment->comment_ID, 'rating', true );
						if ( ! $rate )
							$rate = 0;

						if ( $depth == 1 )
						{
							?>
							<ul class="flex items-center space-x-reverse space-x-0/5 text-gray-400 ml-2/3 comment-rating">
								<?php
								echo str_repeat( '<li class="icon-empty-star leading-1/4 text-1/4"></li>', 5 - $rate );
								echo str_repeat( '<li class="icon-filled-star leading-1/4 text-1/4 text-secondary-main"></li>', $rate );
								?>
							</ul>
							<?php
						}
						echo sprintf( '<span class="text-base leading-2/2 text-gray-500 flex items-center ml-0 mr-auto"><span class="custom-hidden-m lg-block">%s</span>&nbsp;%s</span>', 'در تاریخ:', get_comment_date( 'j F Y' ) );
						?>
					</div>
				</div>
				<p class="text-base leading-2/2 text-black-600 -mr-6 lg-mr-0 text-justify lg-text-right"><?php echo $comment->comment_content; ?></p>
				<?php
				if ( $comment->comment_approved == '0' )
				{
					?>
					<p class="comment-awaiting-moderation">
						دیدگاه شما پس از بررسی در سایت قرار می گیرد </p>
					<?php
				}
				?>
			</div>
		</div>        </<?php echo $tag; ?>>
		<?php
		$output = ob_get_contents();
		ob_end_clean();
		echo $output;
	}

	public function end_el ( &$output, $comment, $depth = 0, $args = array() )
	{
		if ( ! empty( $args[ 'end-callback' ] ) )
		{
			ob_start();
			call_user_func( $args[ 'end-callback' ], $comment, $args, $depth );
			$output .= ob_get_clean();

			return;
		}
		if ( 'div' == $args[ 'style' ] )
			$output .= "</div>";
		else
			$output .= "</li>";
	}
}
