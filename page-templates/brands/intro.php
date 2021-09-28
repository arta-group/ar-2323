<?php
$term_id = isset( $args[ 'term_id' ] ) ? $args[ 'term_id' ] : 0;

$term = get_term( $term_id );
?>
<section class="container mx-auto pt-3/3 flex flex-col lg-flex-row items-start px-2 md-px-3 lg-px-0">
	<?php
	$thumbnail_id = get_term_meta( $term_id, 'thumbnail_id', true );
	$logo         = wp_get_attachment_url( $thumbnail_id );
	if ( $logo )
	{
		?>
		<div class="w-full w-296 flex items-center justify-center flex-shrink-0 ml-3/6 border border-border rounded-xs h-26">
			<img class="object-contain object-center" src="<?php echo esc_url( $logo ); ?>"/>
		</div>
		<?php
	}
	?>
	<div class="flex-1 mt-3 lg-mt-0">
        <div class="border-b border-border flex items-center">
            <h1 class="lg-text-2/4 text-2 inline-block text-center md-text-right leading-4/4 pb-1/4 title text-gray-main font-bold">
                <?php echo $term->name; ?>
            </h1>
        </div>

		<?php

		if ( $term->description )
		{
			?>
			<div class="mt-2/8 relative">
				<div class="intro-content  max-h-18 transition-all duration-200 ease-linear overflow-hidden pb-2">
					<?php echo wpautop( $term->description ); ?>
				</div>
				<div class="bg-intro-overlay w-full absolute z-5 bottom-0 left-0 h-9 w-full"></div>
				<button type="button" id="show-rest" class="absolute bottom-0 z-10 left-half transform -translate-x-1/2 translate-y-1/2 pt-0/3 pb-0/5 px-1 bg-gray-100 text-gray-dark text-base leading-2/2 rounded-xs flex items-center">
					نمایش بیشتر
					<span class="icon-angle-down text-xs transform scale-75 mr-0/5 leading-0/7 h-1 flex items-center"></span>
				</button>
			</div>
			<?php
		}
		?>
	</div>
</section>