<?php
/**
 * Display single product reviews (comments)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product-reviews.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.3.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( ! comments_open() )
	return;
?>
<div id="reviews" class="woocommerce-Reviews">
	<?php
	if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->get_id() ) )
	{
		if ( is_user_logged_in() )
		{
			?>
			<div id="review_form_wrapper">
				<div id="review_form">
					<div id="respond" class="comment-respond">
						<form action="<?php echo esc_attr( site_url( 'wp-comments-post.php' ) ); ?>" method="post" id="commentform" class="comment-form flex flex-col mt-1/7">
							<ul class="comment-errors"></ul>
							<div class="flex flex-col lg-flex-row items-center justify-between mb-2">
								<label for="comment" class="text-base leading-2/2 text-gray-main mb-1 lg-mb-0">دیگران را با نوشتن دیدگاه های خود برای انتخاب این محصول راهنمایی کنید.</label>
								<?php
								if ( wc_review_ratings_enabled() )
								{
									?>
									<div class="w-full lg-w-auto flex items-center">
										<p class="text-base leading-2/2 text-gray-main ml-1/7">امتیاز شما به این محصول :</p>
										<div class="rating-container">
											<input type="radio" class="rating-input" name="rating" id="star5" value="5"><label for="star5" class="rating-label"></label>
											<input type="radio" class="rating-input" name="rating" id="star4" value="4"><label for="star4" class="rating-label"></label>
											<input type="radio" class="rating-input" name="rating" id="star3" value="3"><label for="star3" class="rating-label"></label>
											<input type="radio" class="rating-input" name="rating" id="star2" value="2"><label for="star2" class="rating-label"></label>
											<input type="radio" class="rating-input" name="rating" id="star1" value="1"><label for="star1" class="rating-label"></label>
										</div>
									</div>
									<?php
								}
								?>
							</div>

							<textarea id="comment" placeholder="متن دیدگاه شما ..." name="comment" class="bg-gray-100 rounded-xs border border-border w-full h-14 py-1/8 px-2/4 text-base leading-2/2"></textarea>

							<div class="form-submit mt-2 flex flex-col lg-flex-row items-center justify-between">
								<p class="text-base leading-2/2 text-gray-main ">
									<?php echo sprintf( 'با "ثبت دیدگاه" موافقت خود را با %s در آرتا الکتریک اعلام می کنم.', '<a href="' . esc_url( site_url( 'faq' ) ) . '" class="text-primary-main">قوانین انتشار دیدگاه ها</a>' ); ?>
								</p>
								<input name="submit" type="submit" id="submit" class="submit bg-primary-main text-white py-0/9 px-2/6 rounded-xs text-base btn-effect leading-2/2 font-bold cursor-pointer" value="ثبت دیدگاه">
							</div>

							<input type="hidden" name="comment_post_ID" value="<?php echo get_the_ID(); ?>" id="comment_post_ID">
							<input type="hidden" name="comment_parent" id="comment_parent" value="0">
							<?php
							wp_comment_form_unfiltered_html_nonce();
							?>
							</p>
						</form>
					</div>
				</div>
			</div>
			<?php
		}
		else
		{
			?>

			<div id="review_form_wrapper">
				<div id="review_form">
					<div id="respond" class="comment-respond">
						<form action="<?php echo esc_attr( site_url( 'wp-comments-post.php' ) ); ?>" method="post" id="commentform" class="comment-form flex flex-col mt-1/7">
							<ul class="comment-errors"></ul>
							<div class="flex flex-col lg-flex-row items-center justify-between mb-2">
								<label for="comment" class="text-base leading-2/2 text-gray-main mb-1 lg-mb-0">دیگران را با نوشتن دیدگاه های خود برای انتخاب این محصول راهنمایی کنید.</label>
								<?php
								if ( wc_review_ratings_enabled() )
								{
									?>
									<div class="w-full lg-w-auto flex items-center">
										<p class="text-base leading-2/2 text-gray-main ml-1/7">امتیاز شما به این محصول :</p>
										<div class="rating-container">
											<input type="radio" class="rating-input" name="rating" id="star5" value="5"><label for="star5" class="rating-label"></label>
											<input type="radio" class="rating-input" name="rating" id="star4" value="4"><label for="star4" class="rating-label"></label>
											<input type="radio" class="rating-input" name="rating" id="star3" value="3"><label for="star3" class="rating-label"></label>
											<input type="radio" class="rating-input" name="rating" id="star2" value="2"><label for="star2" class="rating-label"></label>
											<input type="radio" class="rating-input" name="rating" id="star1" value="1"><label for="star1" class="rating-label"></label>
										</div>
									</div>
									<?php
								}
								?>
							</div>
                            <div class="flex flex-col lg-flex-row items-center justify-between">
                                <p class="comment-form-author flex-1 flex-shrink-0 lg-ml-1  mb-2 lg-mb-0"><label for="author">نام&nbsp;<span class="required">*</span></label><input id="author" class="bg-gray-100 rounded-xs border border-border text-base author-input" name="author" type="text" value="" size="30" required=""></p>
                                <p class="comment-form-email flex-1 flex-shrink-0 lg-mr-1"><label for="email">ایمیل&nbsp;<span class="required">*</span></label><input id="email" class="bg-gray-100 rounded-xs border border-border text-base email-input" name="email" type="email" value="" size="30" required=""></p>

                            </div>
							<textarea id="comment" placeholder="متن دیدگاه شما ..." name="comment" class="bg-gray-100 rounded-xs border border-border w-full h-14 py-1/8 px-2/4 text-base leading-2/2"></textarea>

							<div class="form-submit mt-2 flex flex-col lg-flex-row items-center justify-between">
								<p class="text-base leading-2/2 text-gray-main ">
									<?php echo sprintf( 'با "ثبت دیدگاه" موافقت خود را با %s در آرتا الکتریک اعلام می کنم.', '<a href="' . esc_url( site_url( 'faq' ) ) . '" class="text-primary-main">قوانین انتشار دیدگاه ها</a>' ); ?>
								</p>
								<input name="submit" type="submit" id="submit" class="submit bg-primary-main text-white py-0/9 px-2/6 rounded-xs text-base btn-effect leading-2/2 font-bold cursor-pointer" value="ثبت دیدگاه">
							</div>

							<input type="hidden" name="comment_post_ID" value="<?php echo get_the_ID(); ?>" id="comment_post_ID">
							<input type="hidden" name="comment_parent" id="comment_parent" value="0">
							<?php
							wp_comment_form_unfiltered_html_nonce();
							?>
							</p>
						</form>
					</div>
				</div>
			</div>

			<?php
		}
	}
	else
	{
		?>
		<p class="woocommerce-verification-required">
			<?php esc_html_e( 'Only logged in customers who have purchased this product may leave a review.', 'woocommerce' ); ?>
		</p>
		<?php
	}
	?>
	<div id="comments">
		<?php
		if ( have_comments() )
		{
			?>
			<ul class="commentlist mt-3 divide-border-bottom">
				<?php
				if ( class_exists( 'FS_Arta_Product_Review_Walker' ) )
				{
					wp_list_comments( array(
						'reverse_top_level' => true,
						'style'             => 'ul',
						'walker'            => new FS_Arta_Product_Review_Walker()
					), get_comment() );
				}
				?>
			</ul>
			<?php
			if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) )
			{
				echo '<nav class="woocommerce-pagination">';
				paginate_comments_links( apply_filters( 'woocommerce_comment_pagination_args', array(
					'prev_text' => '&larr;',
					'next_text' => '&rarr;',
					'type'      => 'list',
				) ) );
				echo '</nav>';
			}
		}
		?>
	</div>
	<div class="clear"></div>
</div>
