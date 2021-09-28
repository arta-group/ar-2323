<?php
$section = isset( $args[ 'section' ] ) ? $args[ 'section' ] : 1;

$small_banners       = get_field( 'sidebar-small-banners', 'option' );
$small_banners_count = count( $small_banners );
$mid                 = ceil( $small_banners_count / 2 );

if ( $small_banners && $section == 1 )
{
	$iteration = 1;
	while ( have_rows( 'sidebar-small-banners', 'option' ) )
	{
		the_row();
		if ( $iteration <= $mid )
		{
			$image = get_sub_field( 'image' );
			?>
			<div class="lg-h-18 w-full mt-7/2">
				<a href="<?php echo get_sub_field( 'url' ); ?>" class="lg-h-18 w-full rounded-xs">
					<img src="<?php echo esc_url( $image[ 'url' ] ); ?>" class="h-full w-full rounded-xs object-center object-fill" alt="<?php echo esc_attr( $image[ 'alt' ] ); ?>">
				</a>
			</div>
			<?php
		}
		$iteration ++;
	}
}

if ( $small_banners && $section == 2 )
{
	$iteration = 1;

	while ( have_rows( 'sidebar-small-banners', 'option' ) )
	{
		the_row();
		if ( $iteration > $mid )
		{
			$image = get_sub_field( 'image' );
			?>
			<div class="h-18 w-full mt-6/7">
				<a href="<?php echo get_sub_field( 'url' ); ?>" class="h-18 w-full rounded-xs">
					<img src="<?php echo esc_url( $image[ 'url' ] ); ?>" class="h-full w-full rounded-xs object-center object-fill" alt="<?php echo esc_attr( $image[ 'alt' ] ); ?>">
				</a>
			</div>
			<?php
		}
		$iteration ++;
	}
}
