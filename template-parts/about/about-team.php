<?php
if ( have_rows( 'team-profile' ) )
{
	?>
	<section class="pt-5 pb-10 container mx-auto px-3 lg-px-0">
		<div class="border-b border-border flex items-center justify-between">
			<?php
			section_title_b( "تیم آرتا الکتریک" );
			$team_description = get_field( 'team-description' );
			if ( $team_description )
			{
				?>
				<p class="custom-hidden-m md-block text-gray-500 text-lg leading-11"><?php echo $team_description; ?></p>
				<?php
			}
			?>
		</div>
		<div class="grid grid-cols-1 md-grid-cols-2 lg-grid-cols-4 gap-3/4 pt-5">
			<?php
			while ( have_rows( 'team-profile' ) )
			{
				the_row();
				$image = get_sub_field( 'image' );
				?>
				<div class="rounded-xs bg-gray-200 h-30 img-frame rounded-xs">
					<?php
					if ( $image )
					{
						?>
						<img src="<?php echo esc_url( $image[ 'url' ] ); ?>" class="rounded-xs grayscale w-full h-full object-center object-cover" alt="<?php echo esc_attr( $image[ 'alt' ] ); ?>">
						<?php
					}
					?>
					<div class="absolute bottom-0 left-0 w-full pb-1/6 pl-1/5 pr-1/7 z-20">
						<div class="bg-white-8 w-full rounded-xs pt-1/3 pb-1/5 px-1">
							<h3 class="text-lg font-bold text-center mb-0/8 text-gray-dark"><?php echo get_sub_field( 'fullname' ); ?></h3>
							<p class="text-base text-center text-gray-main"><?php echo get_sub_field( 'position-title' ); ?></p>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
	</section>
	<?php
}
