<ul class="flex flex-col mt-1">
	<?php
	$posts = get_posts( [
		'post_type'      => 'post',
		'post_status'    => 'publish',
		'posts_per_page' => 5,
		'meta_key'       => 'post_views_count',
		'orderby'        => 'meta_value_num'
	] );
	foreach ( $posts as $post )
	{
		setup_postdata( $post );
		?>
		<li class="text-base leading-2/2 text-gray-main border-b border-border">
			<a href="<?php echo esc_url( get_the_permalink() ); ?>" class="flex items-center py-1/6">
				<?php
				the_post_thumbnail( 'fs-blog-card', array( 'class' => 'h-4/1 w-6/4 rounded-xs  object-center object-fill' ) );
				?>
				<div class="mr-1/5 flex-1"><?php echo get_the_title(); ?></div>
			</a>
		</li>
		<?php
	}
	wp_reset_postdata();
	?>
</ul>