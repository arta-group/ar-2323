<div class="px-2 md-px-3 lg-px-0">
	<?php section_title( "شبکه های اجتماعی" ); ?>
	<p class="mt-3/3 mb-4 text-base md-text-medium leading-3/2 text-gray-main">برای دریافت اخبار جدید و ارتباطی پایدار، در شبکه های اجتماعی زیر ما را دنبال کنید.</p>
	<div class="grid grid-cols-2 gap-x-1/5 md-gap-x-3/2 gap-y-1/5 md-gap-y-2/6">
		<?php
		$socials = [
			array(
				"title" => "اینستاگرام",
				"icon"  => "icon-instagram",
				"color" => "text-primary-main",
				'url'   => get_field( 'instagram', 'option' )
			),
			array(
				"title" => " تلگرام پشتیبانی ",
				"icon"  => "icon-telegram",
				"color" => "text-telegram",
				'url'   => get_field( 'support-telegram', 'option' )
			),
			array(
				"title" => " لینکداین شرکت",
				"icon"  => " icon-linkedin ",
				"color" => "text-linkedin",
				'url'   => get_field( 'linkedin', 'option' )
			),
			array(
				"title" => " تلگرام همکاران ",
				"icon"  => "icon-telegram",
				"color" => "text-telegram",
				'url'   => get_field( 'teammate-telegram', 'option' )
			),
			array(
				"title" => " حساب توئیتر ",
				"icon"  => "icon-twitter h-3/6 w-3/6 rounded-full text-twitter h-1/5 leading-1/5 bg-telegram",
				"color" => "text-white",
				'url'   => get_field( 'twitter', 'option' )
			),
			array(
				"title" => " پشتیبانی واتساپ ",
				"icon"  => " icon-whatsapp",
				"color" => "text-whatsapp",
				'url'   => get_field( 'support-whatsapp', 'option' )
			),
		];

		foreach ( $socials as $item )
		{
			if ( ! empty( $item[ 'url' ] ) )
			{
				?>
				<a href="<?php echo esc_url( $item[ 'url' ] ); ?>" rel="nofollow" class="flex items-center bg-gray-50 py-1/5 pr-2 pl-1 rounded-xs">
					<div class="w-3/6 h-3/6 rounded-full flex items-center justify-center bg-white">
						<div class="flex items-center justify-center text-3/6 leading-3/6 <?php echo $item[ 'icon' ] . ' ' . $item[ 'color' ] ?>"></div>
					</div>
					<div class="text-sm md-text-medium leading-2/5 font-bold mr-2 text-gray-600"> <?php echo $item[ 'title' ]; ?></div>
				</a>
				<?php
			}
		}
		?>
	</div>
</div>
