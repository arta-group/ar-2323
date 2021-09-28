<?php
$term_id = isset( $args[ 'term_id' ] ) ? $args[ 'term_id' ] : 0;
$term    = get_term( $term_id );
if ( have_rows( 'brand-top-banners', $term ) )
{
	?>
	<section class="pt-6/4 container mx-auto px-2 md-px-3 lg-px-0">
		<div class="grid grid-cols-1 lg-grid-cols-2 gap-2 lg-gap-3/2 overflow-hidden">
			<?php
			while ( have_rows( 'brand-top-banners', $term ) )
			{
				the_row();
				$image = get_sub_field( 'image', $term );
				if ( $image )
				{
					?>
					<a href="<?php echo esc_url( get_sub_field( 'url', $term ) ); ?>" class="rounded-xs overflow-hidden">
						<img class="object-fit object-center w-full h-full" src="<?php echo esc_url( $image[ 'url' ] ); ?>" alt="<?php echo esc_attr( $image[ 'alt' ] ); ?>"/>
					</a>
					<?php
				}
			}
			?>
		</div>
	</section>
	<?php
}