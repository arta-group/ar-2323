<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package FOUR SIDES
 */

if ( ! function_exists( 'fs_posted_on' ) )
{
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function fs_posted_on ()
	{
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) )
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';

		$time_string = sprintf( $time_string, esc_attr( get_the_date( DATE_W3C ) ), esc_html( get_the_date() ), esc_attr( get_the_modified_date( DATE_W3C ) ), esc_html( get_the_modified_date() ) );

		$posted_on = sprintf( /* translators: %s: post date. */ esc_html_x( 'Posted on %s', 'post date', 'webstudio' ), '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>' );

		echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

if ( ! function_exists( 'fs_posted_by' ) )
{
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function fs_posted_by ()
	{
		$byline = sprintf( /* translators: %s: post author. */ esc_html_x( 'by %s', 'post author', 'webstudio' ), '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>' );

		echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

if ( ! function_exists( 'fs_entry_footer' ) )
{
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function fs_entry_footer ()
	{
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() )
		{
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'webstudio' ) );
			if ( $categories_list )
			{
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'webstudio' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'webstudio' ) );
			if ( $tags_list )
			{
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'webstudio' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) )
		{
			echo '<span class="comments-link">';
			comments_popup_link( sprintf( wp_kses( /* translators: %s: post title */ __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'webstudio' ), [ 'span' => [ 'class' => [] ] ] ), wp_kses_post( get_the_title() ) ) );
			echo '</span>';
		}

		edit_post_link( sprintf( wp_kses( /* translators: %s: Name of current post. Only visible to screen readers */ __( 'Edit <span class="screen-reader-text">%s</span>', 'webstudio' ), [ 'span' => [ 'class' => [] ] ] ), wp_kses_post( get_the_title() ) ), '<span class="edit-link">', '</span>' );
	}
}

if ( ! function_exists( 'fs_post_thumbnail' ) )
{
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function fs_post_thumbnail ()
	{
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() )
			return;

		if ( is_singular() )
		{
			?>
			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->
			<?php
		}
		else
		{
			?>
			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php the_post_thumbnail( 'post-thumbnail', [ 'alt' => the_title_attribute( [ 'echo' => false ] ) ] ); ?>
			</a>
			<?php
		} // End is_singular().
	}
}

if ( ! function_exists( 'wp_body_open' ) )
{
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function wp_body_open ()
	{
		do_action( 'wp_body_open' );
	}
}

if ( ! function_exists( 'fs_add_css_class_to_li' ) )
{
	function fs_add_css_class_to_li ( $classes, $item, $args )
	{
		if ( isset( $args->add_li_class ) )
			$classes[] = $args->add_li_class;

		return $classes;
	}

	add_filter( 'nav_menu_css_class', 'fs_add_css_class_to_li', 1, 3 );
}

if ( ! function_exists( 'fs_add_css_class_to_link' ) )
{
	function fs_add_css_class_to_link ( $item_output, $item, $depth, $args )
	{
		if ( $args->theme_location == 'header-menu' )
		{
			$class       = "pt-1 pb-1/5 pr-1/3 block";
			$item_output = preg_replace( '/<a /', '<a class="' . $class . '"', $item_output, 1 );
		}

		return $item_output;
	}

	add_filter( 'walker_nav_menu_start_el', 'fs_add_css_class_to_link', 10, 4 );
}

function fs_rearrange_comment_field ( $fields )
{
	$comment_field = $fields[ 'comment' ];
	$cookies_field = $fields[ 'cookies' ];
	unset( $fields[ 'comment' ] );
	unset( $fields[ 'cookies' ] );
	$fields[ 'comment' ] = $comment_field;
	$fields[ 'cookies' ] = $cookies_field;

	return $fields;
}

add_filter( 'comment_form_fields', 'fs_rearrange_comment_field' );

function fs_comment_form_change_cookies_consent ( $fields )
{
	$commenter           = wp_get_current_commenter();
	$consent             = empty( $commenter[ 'comment_author_email' ] ) ? '' : ' checked="checked"';
	$fields[ 'cookies' ] = '<div class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $consent . ' />' . '<label for="wp-comment-cookies-consent"> ذخیره نام و ایمیل من در مرورگر برای زمانی که دوباره دیدگاهی می‌نویسم.</label></div>';

	return $fields;
}

add_filter( 'comment_form_default_fields', 'fs_comment_form_change_cookies_consent' );

// Remove comment time
function fs_remove_comment_time ( $date, $d, $comment )
{
	return '';
}

add_filter( 'get_comment_time', 'fs_remove_comment_time', 10, 3 );

function fs_comment_author ( $author, $comment_id, $comment )
{
	if ( $comment )
	{
		$user_id = $comment->user_id;
		if ( $user_id > 0 )
		{
			$user = get_userdata( $user_id );
			if ( empty( $user->first_name ) && empty( $user->last_name ) )
				$author = 'کاربر مهمان';
			else
				$author = $user->first_name . ' ' . $user->last_name;
		}
	}

	return $author;
}

add_filter( 'get_comment_author', 'fs_comment_author', 10, 3 );

function ws_remove_website_field ( $fields )
{
	if ( isset( $fields[ 'url' ] ) )
		unset( $fields[ 'url' ] );

	return $fields;
}

add_filter( 'comment_form_default_fields', 'ws_remove_website_field' );