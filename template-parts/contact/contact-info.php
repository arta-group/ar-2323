<?php
$address    = get_field( 'central-office-address', 'option' );
$phone      = get_field( 'phone', 'option' );
$email      = get_field( 'email', 'option' );
$work_hours = get_field( 'work-hours', 'option' );
$work_days  = get_field( 'work-days', 'option' );
?>
<div class="col-span-1 lg-col-span-2 grid grid-cols-1 lg-grid-cols-2 gap-3 lg-gap-3 px-2 md-px-3 lg-px-0">
	<div>
		<p class="text-base md-text-lg text-gray-main leading-2/8">خوشحال می شویم</p>
		<p class="text-2 lg-text-2/4 text-gray-main font-bold leading-3/7">با شما دوستان بیشتر در ارتباط باشیم</p>
		<div class="grid column grid-cols-2 gap-y-2 md-gap-y-4 gap-x-6 md-gap-x-12 mt-3 lg-mt-5">
			<?php
			if ( $address )
			{
				?>
				<div class="flex flex-row md-items-center col-span-2">
					<div class="h-3/2 icon-address text-3/2 leading-3/2 text-gray-main flex items-center text-gray-600"></div>
					<div class="flex flex-col mr-2/5">
						<div class="text-base md-text-medium leading-3 font-bold text-gray-600">آدرس دفتر مرکزی</div>
						<a href="#" class="text-base md-text-medium leading-3 text-gray-600 ss02"><?php echo nl2br( $address ); ?></a>
					</div>
				</div>
				<?php
			}

			if ( $phone )
			{
				?>
				<div class="flex flex-row items-center">
					<div class="h-3/2 icon-phone text-3/2 leading-3/2 text-gray-main flex items-center text-gray-600"></div>
					<div class="flex flex-col mr-2/5">
						<div class="text-base md-text-medium leading-3 font-bold text-gray-600">تلفن تماس</div>
						<a href="tel:+98<?php echo $phone; ?>" class="text-base md-text-medium leading-3 text-gray-600 ss02"><?php echo $phone; ?></a>
					</div>
				</div>
				<?php
			}

			if ( $work_hours )
			{
				?>
				<div class="flex flex-row items-center">
					<div class="h-2/8 icon-clock text-2/8 leading-2/8 text-gray-main flex items-center text-gray-600"></div>
					<div class="flex flex-col mr-2/5">
						<div class="text-base md-text-medium leading-3 font-bold text-gray-600">ساعت کاری</div>
						<a href="#" class="text-base md-text-medium leading-3 text-gray-600 ss02"><?php echo $work_hours; ?></a>
					</div>
				</div>
				<?php
			}

			if ( $email )
			{
				?>
				<div class="flex flex-row items-center">
					<div class="h-2/5 icon-envelope text-2/5 leading-2/5 text-gray-main flex items-center text-gray-600"></div>
					<div class="flex flex-col mr-2/5">
						<div class="text-base md-text-medium leading-3 font-bold text-gray-600">ایمیل</div>
						<a href="mailto:<?php echo esc_attr( $email ); ?>" class="text-base md-text-medium leading-3 text-gray-600 ss02"><?php echo $email; ?></a>
					</div>
				</div>
				<?php
			}

			if ( $work_days )
			{
				?>
				<div class="flex flex-row items-center">
					<div class="h-3 text-3 leading-3 text-gray-main flex items-center text-gray-600">
						<img class="object-fit object-center" src="<?php echo get_stylesheet_directory_uri() . "/assets/img/svg/contact-calendar.svg"; ?>" alt=""/>
					</div>
					<div class="flex flex-col mr-2/5">
						<div class="text-base md-text-medium leading-3 font-bold text-gray-600">روزهای کاری</div>
						<a href="#" class="text-base md-text-medium leading-3 text-gray-600 ss02"><?php echo $work_days; ?></a>
					</div>
				</div>
				<?php
			}
			?>
		</div>
	</div>
	<div class="h-30 map-container bg-gray-300 w-full w-625 h-392 rounded-xs relative z-10">
		<?php
		$map_api_key  = get_field( 'map-api-key', 'option' );
		$map_lat_lang = str_replace( ' ', '', get_field( 'map-lat-lang', 'option' ) );
		if ( $map_api_key )
		{
			?>
			<link href="https://static.neshan.org/sdk/leaflet/1.4.0/leaflet.css" rel="stylesheet" type="text/css">
			<script src="https://static.neshan.org/sdk/leaflet/1.4.0/leaflet.js" type="text/javascript"></script>
			<div id="map" style="width: 625px; height: 392px; background: #eee;"></div>
			<script type="text/javascript">
				let greenIcon = L.icon( {
					iconUrl : '<?php echo get_template_directory_uri() . '/assets/img/png/marker.png'; ?>',
					iconSize : [ 75, 75 ], // size of the icon
					iconAnchor : [ 35, 65 ], // point of the icon which will correspond to marker's location
				} );

				let myMap = new L.Map( 'map', {
					key : '<?php echo $map_api_key; ?>',
					maptype : 'dreamy-gold',
					poi : true,
					traffic : false,
					center : [<?php echo $map_lat_lang; ?>],
					zoom : 15
				} );

				let marker = L.marker( [<?php echo $map_lat_lang; ?>], { icon : greenIcon } ).addTo( myMap );
			</script>
			<a href="https://www.google.com/maps/dir/?api=1&destination=<?php echo $map_lat_lang; ?>" class="text-white text-medium bg-primary-main hover:bg-primary-dark rounded-xs py-0/5 px-3 leading-2/2 transition-colors duration-200 ease-linear absolute left-half transform -translate-x-1/2 top-23 lg-left-25 z-1000" >مسیریابی</a>
			<?php
		}
		?>
	</div>
</div>
