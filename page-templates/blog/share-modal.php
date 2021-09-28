<?php
$share_link = get_the_permalink();
?>
<div id="share-modal" class="share-popup-bg fixed inset-0 z-60 transform scale-0">
	<div class="relative h-full w-full">
		<div class="modal-bg bg-gray-dark opacity-25 absolute inset-0"></div>
		<div class="absolute top-half left-half transform -translate-x-1/2 -translate-y-1/2 bg-white rounded-xs w-11/12 md-w-8/12 lg-w-auto px-3 md-px-7 lg-px-10 py-5 share-popup transform scale-0 transition-transform duration-200 ease-linear">
			<div class="relative">
				<div class="flex flex-col">
					<h4 class="text-3 text-gray-700 font-bold leading-2/4 text-center mt-3 lg-mt-0 mb-4 lg-mb-7">اشتراک گذاری</h4>
					<ul class="flex flex-row items-center justify-center mb-3 lg-mb-6">
						<li class="ml-2 md-ml-4/5">
							<a href="https://api.whatsapp.com/send?text=<?php the_title_attribute(); ?>" data-action="share/whatsapp/share" target="_blank" rel="nofollow">
								<img class="object-fit object-center w-4 h-4" src="<?php echo get_stylesheet_directory_uri() . "/assets/img/png/whatsapp.png"; ?>" alt=""/>
							</a>
						</li>
						<li class="ml-2 md-ml-4/5">
							<a href="https://www.linkedin.com/cws/share?url=<?php echo $share_link; ?>" target="_blank" rel="nofollow">
								<img class="object-fit object-center w-4 h-4" src="<?php echo get_stylesheet_directory_uri() . "/assets/img/png/linkedin.png"; ?>" alt=""/>
							</a>
						</li>
						<li class="ml-2 md-ml-4/5">
							<a href="https://t.me/share/url?url=<?php echo $share_link; ?>&text=<?php the_title_attribute(); ?>" target="_blank" rel="nofollow">
								<img class="object-fit object-center w-4 h-4" src="<?php echo get_stylesheet_directory_uri() . "/assets/img/png/telegram.png"; ?>" alt=""/>
							</a>
						</li>
						<li class="ml-2 md-ml-4/5">
							<a href="https://twitter.com/share?text=<?php the_title_attribute(); ?>&url=<?php echo $share_link; ?>" target="_blank" rel="nofollow">
								<img class="object-fit object-center w-4 h-4" src="<?php echo get_stylesheet_directory_uri() . "/assets/img/png/twitter.png"; ?>" alt=""/>
							</a>
						</li>
						<li>
							<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $share_link; ?>" target="_blank" rel="nofollow">
								<img class="object-fit object-center w-4 h-4" src="<?php echo get_stylesheet_directory_uri() . "/assets/img/png/facebook.png"; ?>" alt=""/>
							</a>
						</li>
					</ul>
					<p class="text-black-700 text-sm leading-2 pb-1/2">یا لینک را کپی کنید:</p>
					<input value="<?php echo $share_link; ?>" readonly class="text-black-700 dir-ltr w-full lg-w-40 text-center text-medium border border-gray-300 rounded-xs leading-2 py-1 px-1/3 share-input text-left">

					<div class="flex flex-row items-center  justify-between pt-2">
						<p class="hidden confirm-alert text-black-700 text-center text-base rounded-xs leading-2 p-1/3 text-white bg-success-light">آدرس در کلیپ بورد کپی شد</p>
						<a href="#" class="text-1/7 leading-2/8 bg-secondary-main px-2 py-1 rounded-xs text-gray-main ml-0 mr-auto share-copy">کپی</a>
					</div>
				</div>
				<div class="icon-close-alt text-3 absolute top-0 left-0 md--ml-4 lg--ml-7 -mt-2 close-share text-gray-500 cursor-pointer"></div>
			</div>
		</div>
	</div>
</div>
