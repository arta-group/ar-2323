<div class="pt-5/8 lg-pt-7 pb-5/7 lg-pb-5/5 flex flex-col relative">
	<div class="flex flex-col lg-flex-row">
		<div class="flex items-center lg-items-start flex-col lg-ml-13 pb-40 lg-pb-0">
			<div class="mb-1/5">
				<img class="object-fit object-center" src="<?php echo get_stylesheet_directory_uri() . "/assets/img/svg/arta-logo.svg"; ?>" width="160" height="63" alt=""/>
			</div>
			<p class="mb-3 lg-w-30 text-base leading-2/2 text-gray-600 text-center lg-text-justify">
				<?php echo nl2br( get_field( 'footer-about-us', 'option' ) ); ?>
			</p>
			<ul class="flex flex-row items-center ">
				<?php
				$instagram        = get_field( 'instagram', 'option' );
				$linkedin         = get_field( 'linkedin', 'option' );
				$support_telegram = get_field( 'support-telegram', 'option' );
				$support_whatsapp = get_field( 'support-whatsapp', 'option' );

				if ( $instagram )
				{
					?>
					<li class="w-3 h-3 rounded-full ml-1/5 flex items-center justify-center bg-white">
						<a href="<?php echo esc_url( $instagram ); ?>" rel="nofollow" class="inline-block icon-instagram text-3 leading-3 h-3 text-primary-main"></a>
					</li>
					<?php
				}

				if ( $linkedin )
				{
					?>
					<li class="w-3 h-3 rounded-full ml-1/5 flex items-center justify-center bg-white">
						<a href="<?php echo esc_url( $linkedin ); ?>" rel="nofollow" class="inline-block icon-linkedin text-3 leading-3 h-3 text-linkedin"></a>
					</li>
					<?php
				}

				if ( $support_telegram )
				{
					?>
					<li class="w-3 h-3 rounded-full ml-1/5 flex items-center justify-center bg-white">
						<a href="<?php echo esc_url( $support_telegram ); ?>" rel="nofollow" class="inline-block icon-telegram text-3 leading-3 h-3 text-telegram"></a>
					</li>
					<?php
				}

				if ( $support_whatsapp )
				{
					?>
					<li class="w-3 h-3 rounded-full ml-1/5 flex items-center justify-center bg-white">
						<a href="<?php echo esc_url( $support_whatsapp ); ?>" rel="nofollow" class="inline-block icon-whatsapp text-3 leading-3 h-3 text-whatsapp"></a>
					</li>
					<?php
				}
				?>
			</ul>
		</div>
		<div class="lg-ml-9 mb-4/9 lg-mb-0">
			<?php
			if ( has_nav_menu( 'footer-menu' ) )
			{
				?>
				<div class="text-medium leading-2/7 mb-1/4 lg-mb-3/1 text-primary-main font-bold"> اطلاعات بیشتر</div>
				<?php
				wp_nav_menu( array(
					'theme_location' => 'footer-menu',
					'menu_class'     => 'flex flex-col max-h-12 lg-max-h-unset flex-wrap text-1/5 leading-2/8 text-gray-600 has-disc pr-1/5',
					'container'      => '',
					'fallback_cb'    => 'false',
					'depth'          => 1
				) );
			}
			?>
		</div>
		<div class="flex flex-col flex-1 justify-between h-28">
			<?php
			if ( has_nav_menu( 'footer-category-menu' ) )
			{
				?>
				<div>
					<div class="text-medium leading-2/7 mb-1/4 lg-mb-3/1 text-primary-main font-bold">دسته بندی محصولات</div>
					<?php
					wp_nav_menu( array(
						'theme_location' => 'footer-category-menu',
						'menu_class'     => 'grid grid-cols-2 lg-grid-cols-3 text-1/5 leading-2/8 text-gray-600 has-disc pr-1/5',
						'container'      => '',
						'fallback_cb'    => 'false',
						'depth'          => 1
					) );
					?>
				</div>
				<?php
			}
			$form_id = get_field( 'newsletter-form-id', 'option' );
			?>
			<div class="newsletter-form">
				<?php
					if ( $form_id )
						echo do_shortcode( '[contact-form-7 id="' . $form_id . '"]' );
				?>
            </div>
			
		</div>
	</div>
	<div class="pt-18 lg-pt-6 flex flex-col lg-flex-row justify-between">
		<div class="grid grid-cols-1 md-grid-cols-2 gap-1/8 lg-gap-x-4/1 lg-gap-y-3/5 absolute md-static top-46 left-0 w-full lg-w-auto">
			<?php
			$phone      = get_field( 'phone', 'option' );
			$email      = get_field( 'email', 'option' );
			$address    = get_field( 'address', 'option' );
			$work_hours = get_field( 'work-hours', 'option' );
			if ( $phone )
			{
				?>
				<div class="flex flex-row items-center">
					<div class="h-3/2 icon-phone text-3/2 leading-3/2 text-gray-main flex items-center"></div>
					<div class="flex flex-col mr-2/5">
						<div class="text-medium  leading-2/5 font-bold text-gray-600">تلفن تماس</div>
						<a href="tel:+98<?php echo $phone; ?>" class="text-medium  leading-2/5 text-gray-600"><?php echo $phone; ?></a>
					</div>
				</div>
				<?php
			}
			if ( $email )
			{
				?>
				<div class="flex flex-row items-center">
					<div class="h-3 icon-envelope text-3 leading-3 text-gray-main flex items-center"></div>
					<div class="flex flex-col mr-2/5">
						<div class="text-medium  leading-2/5 font-bold text-gray-600">ایمیل</div>
						<a href="mailto:<?php echo $email; ?>" class="text-medium mt-0/8 leading-2/5 text-gray-600"><?php echo $email; ?></a>
					</div>
				</div>
				<?php
			}
			if ( $address )
			{
				?>
				<div class="flex flex-row items-center">
					<div class="h-3/2 icon-address text-3/2 leading-3/2 text-gray-main flex items-center"></div>
					<div class="flex flex-col mr-2/5">
						<div class="text-medium leading-2/5 font-bold text-gray-600">آدرس</div>
						<span class="text-medium mt-0/8 leading-2/5 text-gray-600 mt-0/8"><?php echo $address; ?></span>
					</div>
				</div>
				<?php
			}
			if ( $work_hours )
			{
				?>
				<div class="flex flex-row items-center">
					<div class="h-3/3 icon-clock text-3/3 leading-3/3 text-gray-main flex items-center"></div>
					<div class="flex flex-col mr-2/5">
						<div class="text-medium leading-2/5 font-bold text-gray-600">ساعت کاری</div>
						<span class="text-medium mt-0/8 leading-2/5 text-gray-600"><?php echo $work_hours; ?></span>
					</div>
				</div>
				<?php
			}
			?>
		</div>
		<div class="flex flex-col lg-flex-row flex-shrink-0">
			<div class="lg-ml-4 mb-6 lg-mb-0">
				<?php
				if ( have_rows( 'payment-gateways', 'option' ) )
				{
					?>
					<div class="mb-4 text-medium leading-13 text-gray-500 text-center lg-text-right lg-pr-2"> پرداخت از طریق درگاه</div>
					<div class="flex flex-row justify-center lg-justify-start">
						<?php
						$iteration = 1;
						while ( have_rows( 'payment-gateways', 'option' ) )
						{
							the_row();
							$image = get_sub_field( 'image' );
							?>
							<img class="object-fit object-center ml-2/5" src="<?php echo esc_url( $image[ 'url' ] ); ?>" width="<?php echo esc_attr( $image[ 'width' ] ); ?>" height="<?php echo esc_attr( $image[ 'height' ] ); ?>" alt="<?php echo esc_attr( $image[ 'alt' ] ); ?>">
							<?php
							$iteration ++;
						}
						?>
					</div>
					<?php
				}
				?>
			</div>
			<div>
				<?php
				if ( have_rows( 'permission-logos', 'option' ) )
				{
					?>
					<div class="mb-1/9 text-medium leading-13 text-center lg-text-right text-gray-500 lg-pr-2"> نمادها و مجوزها</div>
					<div class="flex flex-row justify-center lg-justify-start">
						<?php
						while ( have_rows( 'permission-logos', 'option' ) )
						{
							the_row();
							$image = get_sub_field( 'image' );
							?>
							<a href="<?php echo get_sub_field( 'url' ); ?>" target="_blank">
								<img class="object-fit object-center w-10 h-10 lg-w-12 lg-h-12" src="<?php echo esc_url( $image[ 'url' ] ); ?>" width="<?php echo esc_attr( $image[ 'width' ] ); ?>" height="<?php echo esc_attr( $image[ 'height' ] ); ?>" alt="<?php echo esc_attr( $image[ 'alt' ] ); ?>">
							</a>
							<?php
						}
						?>
					</div>
					<?php
				}
				?>
			</div>
		</div>
	</div>
</div>
