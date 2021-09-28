<?php
$intro = get_field( 'about-intro' );
if ( $intro )
{
	?>
	<section class="flex flex-col lg-flex-row container mx-auto pt-1 lg-pt-3/3 pb-1 md-pb-5 px-2 md-px-3 lg-px-0">
		<?php
		$cover_image = get_field( 'about-cover' );
		if ( $cover_image )
		{
			?>
			<div class="w-full h-30 md-h-auto lg-w-50 lg-h-35 rounded-xs bg-gray-200 flex-shrink-0 lg-ml-3/2 img-frame">
				<img src="<?php echo esc_url( $cover_image[ 'url' ] ); ?>" class="rounded-xs grayscale w-full h-full object-center object-cover" alt="<?php echo esc_url( $cover_image[ 'alt' ] ); ?>">
			</div>
			<?php
		}
		?>
		<div class="flex-1">
			<div class="mt-3 lg--mt-1">
				<?php section_title_b( "معرفی و تاریخچه مجموعه آرتا الکتریک" ); ?>
			</div>
			<p class="text-gray-main text-base leading-2/2 mt-1/4 md-leading-3/2 text-justify ss02">
				<?php
				echo nl2br( $intro );
				?>
			</p>
		</div>
	</section>
	<?php
}
