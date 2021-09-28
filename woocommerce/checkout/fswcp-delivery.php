<div class="mb-5 delivery-date-field" id="delivery_date_field">
	<div class="flex flex-row items-center mb-3">
		<img class="object-fit object-center flex-shrink-0" src="<?php echo get_stylesheet_directory_uri() . "/assets/img/svg/Calendar.svg"; ?>" alt=""/>
		<div class="flex flex-shrink-0 items-center mx-1 text-lg font-bold"> زمان تحویل</div>
		<div class="flex-1 border-b border-border"></div>
	</div>
	<div class="grid grid-cols-1 gap-1/8 ">
		<?php
		if ( $delivery_start_from === 'yes' )
		{
			?>
			<div class="text-1/3">قبل از ارسال با شما تماس گرفته می شود.</div>
			<?php
		}
		?>
		<div class="grid grid-cols-1 gap-1/5 shop_table_responsive delivery_dates">
			<input type="hidden" name="active_delivery" value="<?php echo esc_attr( $active_delivery ); ?>">
			<?php
			for ( $i = 0 + $dayStartFrom; $i <= $daysToShowNumber + $dayStartFrom - 1; $i ++ )
			{
				$dayDate_i18n = wcp_convert_numbers( wcp_time_date_i18n( 'Y/m/d', $i . ' day' ) );

				foreach ( $offDates as $offDate )
				{
					if ( $dayDate_i18n == $offDate )
					{
						$i ++;
						$daysToShowNumber ++;
						$dayDate_i18n = wcp_convert_numbers( wcp_time_date_i18n( 'Y/m/d', $i . ' day' ) );
					}
				}

				$dayName      = strtolower( wcp_time_date( 'l', $i . ' day' ) );
				$dayDate      = wcp_convert_numbers( wcp_time_date( 'Y/m/d', $i . ' day' ) );
				$dayTimestamp = strtotime( $dayDate );
				?>
				<div class="flex items-center justify-between bg-white px-1/5 py-1 border border-border rounded-xs">
					<div class="flex items-center font-bold">
						<?php
						if ( $i == 0 && $delivery_start_from === 'yes' && $delivery_end_hour > 0 && $current_hour > $delivery_end_hour )
						{
							?>
							<div class="w-full text-sm md-text-base ">

								<?php
								echo wcp_time_date_i18n( 'l', $i . ' day' ) . ' ' . wcp_time_date_i18n( 'j F', $i . ' day' ) . ' <span>(تکمیل ظرفیت)</span>';
								?>
							</div>
							<?php
						}
						else
						{
							?>
							<input type="radio" name="delivery_date" id="delivery_date_<?php echo $dayTimestamp; ?>_<?php echo $i; ?>" value="<?php echo $dayTimestamp; ?>">
							<label for="delivery_date_<?php echo $dayTimestamp; ?>_<?php echo $i; ?>" class="block mr-1/2 md-mr-2 text-sm md-text-base">
								<?php echo wcp_time_date_i18n( 'l', $i . ' day' ) . ' ' . wcp_time_date_i18n( 'j F', $i . ' day' ); ?>
							</label>
							<?php
						}
						?>
					</div>
				</div>
				<?php
			}
			?>
		</div>
	</div>
</div>