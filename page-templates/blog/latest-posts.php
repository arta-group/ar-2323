<div>
	<div class="border-b-2 border-border flex items-center">
		<h2 class="text-1/8 text-2 inline-block text-center md-text-right leading-2/8 pb-1/2 title b2 text-gray-main font-bold">آخرین مطالب</h2>
	</div>
	<ul class="flex flex-col mt-1">
		<?php
		$posts = get_posts( [
			'post_type'      => 'post',
			'post_status'    => 'publish',
			'posts_per_page' => 5,
			'post__not_in'   => array( get_the_ID() )
		] );

		foreach ( $posts as $post )
		{
			setup_postdata( $post );
			?>
			<li class="py-1/6 text-base leading-2/2 text-gray-main border-b border-border">
				<a href="<?php echo get_permalink(); ?>" class="flex items-center">
					<?php
					the_post_thumbnail( 'fs-blog-card', array( 'class' => 'h-4/1 w-6/4 rounded-xs object-center object-fill' ) );
					?>
					<div class="mr-1/5 flex-1"><?php the_title(); ?></div>
				</a>
			</li>
			<?php
		}
		wp_reset_postdata();
		?>
	</ul>
</div>
