<?php
$categories = get_categories( [
	'taxonomy'   => 'category',
	'hide_empty' => 1
] );
if ( $categories )
{
	?>
	<div>
		<div class="border-b-2 border-border flex items-center">
			<h2 class="text-1/8 text-2 inline-block text-center md-text-right leading-2/8 pb-1/2 title b2 text-gray-main font-bold">دسته بندی مطالب</h2>
		</div>
		<ul class="flex flex-col mt-1 has-disc sidebar">
			<?php
			foreach ( $categories as $category )
			{
				?>
				<li class="pr-2 text-base leading-2/2 text-gray-main border-b border-border">
					<a href="<?php echo esc_url( get_category_link( $category->cat_ID ) ); ?>" class="block py-1/4"><?php echo $category->cat_name ?></a>
				</li>
				<?php
			}
			?>
		</ul>
	</div>
	<?php
}
