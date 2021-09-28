<div class="fs-footer-top grid grid-cols-2 md-grid-cols-3 lg-grid-cols-6 border-b-2 border-border pt-5/1 lg-pt-6/6 pb-5/4 lg-pb-5/6 gap-4">

	<?php
	while ( have_rows( 'features-icons', 'option' ) )
	{
		the_row();
		$icon = get_sub_field( 'icon' );
		?>
		<div class="flex flex-col h-9 items-center justify-between">
			<div class="mb-1/6 <?php echo 'icon-footer-' . $icon .''; ?> h-4/8 text-4/8 leading-4/8 text-primary-main"></div>
			<div class="text-base leading-2/7 text-gray-600 font-bold text-center"><?php echo get_sub_field( 'title' ); ?></div>
		</div>
		<?php
	}
	?>

</div>