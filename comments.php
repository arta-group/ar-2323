<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FOUR SIDES
 */

if ( post_password_required() )
	return;
?>
<section class="pb-3 lg-pb-6 px-2 md-px-3 lg-px-0">
	<div class="border-b border-border flex items-center justify-between">
		<?php section_title( "دیدگاه های کاربران" ); ?>
		<p class="custom-hidden-m md-block text-gray-400 text-base leading-2/2">
			<?php
			$count = get_comments_number();
			if ( $count > 0 )
				echo sprintf( '%d دیدگاه ثبت شده است . در بحث‌‌ پیرامون این مقاله شرکت کنید', $count );
			else
				echo 'اولین نفری باشید که دیدگاه خود را ثبت می کند.';
			?>
		</p>
	</div>
	<div id="comments" class="comments-area mt-4/4 mb-5/8">
		<?php
		if ( have_comments() )
		{
			the_comments_navigation();
			?>
			<ul class="comment-list">
				<?php
				wp_list_comments( [
					'style'      => 'ul',
					'short_ping' => true,
				] );
				?>
			</ul>
			<?php
			the_comments_navigation();

			if ( ! comments_open() )
				echo '<p class="no-comments">' . esc_html__( 'Comments are closed.', 'webstudio' ) . '</p>';
		}

		$fields = array(
			'author' => '<div><div class="comment-form-author"><label for="author">نام<span class="required">*</span></label><input type="text" id="author" name="author" required="required" value ="' . esc_attr( $commenter[ 'comment_author' ] ) . '"></div>',
//			'email'  => '<div class="comment-form-email"><label for="email">ایمیل</label><input type="email" id="email" name="email" value="' . esc_attr( $commenter[ 'comment_author_email' ] ) . '"></div>',
			'url'    => '<div class="comment-form-url"><label for="url">وب سابت</label><input type="url" id="url" name="url" value="' . esc_attr( $commenter[ 'comment_author_url' ] ) . '"></div></div>'
		);

		$args = array(
			'class_form'           => '',
			'comment_notes_before' => '<div class="comment-notes">نشانی ایمیل شما منتشر نخواهد شد. فیلدهای موردنیاز با <span class="required">*</span> مشخص شده اند.</div>',
			'class_submit'         => '',
			'submit_field'         => '<div class="form-submit">%1$s %2$s</div>',
			'label_submit'         => 'ارسال دیدگاه',
			'comment_field'        => '<div class="comment-form-comment"><label for="comment">دیدگاه</label><textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" required="required"></textarea></div>',
			'fields'               => apply_filters( 'comment_form_default_fields', $fields )
		);

		comment_form( $args );
		?>
	</div>
</section>
