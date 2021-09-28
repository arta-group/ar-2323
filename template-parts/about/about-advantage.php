<?php
if ( have_rows( 'advantages' ) )
{
	?>
	<section class="flex flex-col lg-flex-row  pb-5 md-py-5 container mx-auto px-2 md-px-3 lg-px-0">
		<div class="flex-1 flex-col">
			<?php
			section_title_b( " مزیت‌های فروشگاه آرتا الکتریک" );
			?>
			<ul class="flex flex-col pr-4 pt-2/8 text-base md-text-base leading-2/5 md-leading-3 list-tick">
				<?php
				while ( have_rows( 'advantages' ) )
				{
					the_row();
					?>
					<li class="ss02"><?php echo get_sub_field( 'title' ); ?></li>
					<?php
				}
				?>
			</ul>
			<?php
			$description = get_field( 'advantage-description' );
			if ( $description )
			{
				?>
				<p class="text-base leading-2/2 md-text-base text-gray-main mt-1/9 md-leading-2/8 text-justify ss02">
					<?php echo nl2br( $description ); ?>
				</p>
				<?php
			}
			?>
		</div>
		<?php
		$cover_image = get_field( 'advantage-cover' );
		if ( $cover_image )
		{
			?>
			<div class="w-full h-30 lg-w-75 md-h-55 rounded-xs flex-shrink-0 lg-mr-3 bg-gray-200 img-frame mt-3 lg-mt-0">
				<img src="<?php echo esc_url( $cover_image[ 'url' ] ) ?>" class="rounded-xs grayscale w-full h-full object-center object-cover" alt="<?php echo esc_attr( $cover_image[ 'alt' ] ) ?>">
			</div>
			<?php
		}
		?>
	</section>
	<?php
}
