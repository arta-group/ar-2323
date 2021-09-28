<div>

	<div class="fixed top-0 left-0 h-screen w-screen z-45 transform scale-0 opacity-0 ease-linear bg-gray-50 opacity-50 duration-100" style="transition: opacity 100ms;" id="cart_overlay"></div>

	<div class="fixed cart top-0 left-0 h-screen overflow-y-auto w-40 bg-white z-50 pl-3 pr-3/5 py-3 transform -translate-x-44 transition-transform ease-linear duration-150" id="cart-container">

		<div class="w-full flex flex-col">

			<div class="flex flex-row items-center justify-between w-full border-b border-border pb-1/6">
				<div class="text-lg leading-2/8 text-gray-dark">سبد خرید</div>
				<div class="flex w-3 h-3 icon-trash bg-primary-main text-white rounded-xs text-sm flex-col items-center justify-center cursor-pointer"></div>
			</div>


			<ul class="flex flex-col divide-y divide-border">

				<?php

				$arr = [
					(object) array(
						"title" => "چراغ LED هود مدل گرد آلتون رای ",
						"img"   => "sample-1",
						"count" => "3"
					),
					(object) array(
						"title" => "پروژکتور SMD اس ام دی 70 وات آلتون رای مدل آیدیس",
						"img"   => "sample-2",
						"count" => "4"
					),
					(object) array(
						"title" => " بخاری برقی آراسته 5 میله فن دار مدل 2200 ",
						"img"   => "sample-3",
						"count" => "1"
					),
				];

				foreach ( $arr as $item )
				{

					?>
					<li class="py-3 flex flex-row justify-between">
						<div class="w-10 h-10 rounded-xs border border-border">
							<img class="object-fit object-center w-full h-full rounded-xs" src="<?php echo get_stylesheet_directory_uri() . "/assets/img/png/type-2-carousel/" . $item->img . ".png"; ?>" alt=""/>
						</div>
						<div class=" flex flex-col justify-between h-10 w-17 pr-1 minicart-info">
							<div class="text-base leading-2 text-gray-main"><?php echo $item->title ?></div>
							<div class="flex items-center">
								<div class="text-lg leading-2 text-gray-500 ml-1">X
									<span><?php echo $item->count ?></span></div>
								<div class="text-lg leading-2 text-gray-main font-bold"> ۳۶.۶۰۰.۰۰۰
									<span class="font-normal text-base"> تومان</span></div>
							</div>
						</div>
						<div class="flex flex-col items-center justify-start cursor-pointer icon-close-alt text-medium text-primary-main"></div>
					</li>

				<?php } ?>

			</ul>
		</div>

		<div class="flex flex-col">

			<div class="w-full rounded-xs mb-2 bg-gray-50 flex items-center px-2 justify-between text-gray-main pt-0/7 pb-0/9">
				<div class="leading-2/2 text-base">مجموع سبد خرید:</div>
				<div class="leading-2/8 text-lg font-bold">8.600.000
					<span class="mr-0/5 font-normal text-base">تومان</span>
				</div>
			</div>
			<a href="<?php echo esc_url( site_url( 'cart' ) ); ?>" class="w-full rounded-xs mb-1/7 leading-2/2 py-1/1 bg-gray-300 text-base text-center text-gray-main cursor-pointer">مشاهده سبد خرید </a>
			<a href="<?php echo esc_url( site_url( 'checkout' ) ); ?>" class="w-full rounded-xs leading-282 py-1/1 bg-secondary-main text-center text-lg text-gray-main cursor-pointer">تسویه حساب </a>
		</div>

	</div>
</div>
