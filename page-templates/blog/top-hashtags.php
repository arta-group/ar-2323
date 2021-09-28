<?php
$tags = get_terms( array(
	'taxonomy' => 'post_tag',
	'orderby'  => 'count',
	'order'    => 'DESC',
	'number'   => 10
) );

if ( $tags )
{
	?>
	<div class="mt-7">
		<div class="border-b-2 border-border flex items-center">
			<h2 class="lg-text-1/8 text-2 inline-block text-center md-text-right leading-2/8 pb-1/2 title b2 text-gray-main font-bold">
				هشتگ‌های پربازدید </h2>
		</div>
		<ul class="mt-3 flex items-center flex-wrap justify-between">
			<?php
			foreach ( $tags as $tag )
			{
				?>
				<li class="pt-0/3 pb-0/5 px-1 text-base leading-2/2 text-gray-main border flex-shrink-0 mb-1/3 border-border rounded-xs">
					<a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>" class="block"><?php echo $tag->name; ?></a>
				</li>
				<?php
			}
			?>
		</ul>
	</div>
	<?php
}