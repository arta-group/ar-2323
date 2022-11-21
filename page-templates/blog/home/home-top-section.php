<?php
$args = array(
	'post_type'      => 'post',
	'post_status'    => 'publish',
	'posts_per_page' => 5
);

$hotlinks_number = get_option( 'options_blog-hotlink' );

$posts = get_posts( $args );
if ( $posts ) {
	?>

    <style>
        .hotlink-box {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: flex-start;
        }

        .hotlink-box > div:nth-child(1) {
            font-size: 18px;
            font-weight: bold;
            color: #f6412d;
            white-space: nowrap;
            height: 40px;
        }

        /*.hotlink-box > div:nth-child(2) {*/
        /*    width: 55px;*/
        /*    display: flex;*/
        /*    flex-direction: row;*/
        /*    align-items: center;*/
        /*    justify-content: center;*/
        /*}*/

        .hotlink-box > div:nth-child(2) {
            height: 60px;
            margin-right: 20px;
            overflow-y: hidden;
            overflow-x: auto;
            white-space: nowrap;
        }

        /* width */
        .hotlink-box > div:nth-child(2)::-webkit-scrollbar {
            height: 3px;
        }

        /* Handle */
        .hotlink-box > div:nth-child(2)::-webkit-scrollbar-thumb {
            background: #888;
        }

        /* Handle on hover */
        .hotlink-box > div:nth-child(2)::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        /*.hotlink-box > div:nth-child(4) {*/
        /*    width: 55px;*/
        /*    display: flex;*/
        /*    flex-direction: row;*/
        /*    align-items: center;*/
        /*    justify-content: center;*/
        /*}*/

        .hotlink-box > div > svg {
            width: 35px;
            border-radius: 50px;
            padding: 5px;
            box-shadow: rgba(14, 30, 37, 0.12) 0 2px 4px 0, rgba(14, 30, 37, 0.32) 0 2px 16px 0;
        }

        .hotlink-box > div:nth-child(2) > a {
            display: inline-block;
            color: #ffffff;
            text-align: center;
            padding: 14px;
            text-decoration: none;
            background-color: #919191;
            margin-left: 10px;
            border-radius: 15px;
            font-weight: bold;
            font-size: 14px;
        }
    </style>

    <section class="px-0 container mx-auto overflow-hidden" dir="rtl">
        <div class="hotlink-box">
            <div><h3>داغ ترین ها :</h3></div>
            <!--            <div>-->
            <!--                <svg viewBox="15 0 100 100">-->
            <!--                    <path d="M 10,50 L 35,80 L 45,75 L 25,50  L 45,25 L 35,20 Z"-->
            <!--                          transform="translate(100, 100) rotate(180) "></path>-->
            <!--                </svg>-->
            <!--            </div>-->
            <div>
				<?php if ( $hotlinks_number ) {
					for ( $i = 0; $i < $hotlinks_number; $i ++ ) {
						$hotlink_name = get_option( 'options_blog-hotlink_' . $i . '_hotlink-name' );
						$hotlink      = get_option( 'options_blog-hotlink_' . $i . '_hotlink' );
						?>
                        <a href="<?php echo $hotlink  ?>" target="_blank"><?php echo $hotlink_name  ?></a>
					<?php }
				} ?>
            </div>
            <!--            <div style="width: 100px">-->
            <!--                <svg viewBox="-15 0 100 100">-->
            <!--                    <path d="M 10,50 L 35,80 L 45,75 L 25,50  L 45,25 L 35,20 Z"></path>-->
            <!--                </svg>-->
            <!--            </div>-->
        </div>

        <div class="grid grid-cols-1 lg-grid-cols-4 lg-grid-rows-2 gap-x-3 gap-y-2 mobile-carousel"
             data-slick='{"slidesToShow":1, "slidesToScroll": 1 ,"dots": true,"infinite": true,"speed": 900 , "rtl" : true}'>
			<?php
			$iteration = 1;

			foreach ( $posts as $post ) {
				setup_postdata( $post );

				$category = fs_get_the_primary_category( 'category' );

				if ( $iteration == 1 ) {
					?>
                    <div class="h-30 lg-h-full mx-1 lg-mx-0 lg-col-span-2 row-span-2 bg-gray-300 rounded-xs relative overflow-hidden">
                        <a href="<?php echo esc_url( get_permalink() ); ?>" class="block w-full h-full">
							<?php the_post_thumbnail( 'fs-blog-main', array( 'class' => 'object-fit object-center w-full h-full' ) ); ?>
                        </a>
                        <div class="absolute left-0 bottom-0 w-full bg-mag-card px-1/6 lg-px-3/6 pb-1/3 lg-pb-3/3 ">
							<?php
							if ( $category ) {
								?>
                                <a href="<?php echo esc_url( $category['url'] ); ?>"
                                   class="bg-primary-main inline-block text-sm leading-1/9 text-white px-1 mb-1/2 pt-0/2 pb-0/4 rounded-xs"><?php echo $category['name']; ?></a>
								<?php
							}
							?>
                            <a href="<?php echo esc_url( get_permalink() ); ?>"
                               class="flex items-center justify-between">
                                <p class="text-white text-base lg-text-lg leading-2/2 lg-text-2/4 font-bold lg-leading-3/8"><?php echo get_the_title(); ?></p>
                                <div class="icon-right-arrow-alt text-primary-main text-2 lg-text-2/5 leading-2 lg-leading-2/5 flex-shrink-0 mr-2 flex items-end"></div>
                            </a>
                        </div>
                    </div>
					<?php
				} else {
					?>
                    <div class="h-19 mx-1 lg-mx-0 bg-gray-300 lg-h-full rounded-xs relative overflow-hidden">
                        <a href="<?php echo esc_url( get_permalink() ); ?>" class="block w-full h-full">
							<?php the_post_thumbnail( 'fs-blog-card', array( 'class' => 'object-fit object-center w-full h-full' ) ); ?>
                            <div class="absolute left-0 bottom-0 w-full bg-mag-card flex flex-row items-end py-1/5 px-2 justify-between">
                                <p class="text-white text-base lg-text-lg font-bold leading-13"><?php echo get_the_title(); ?></p>
                            </div>
                        </a>
						<?php
						if ( $category ) {
							?>
                            <a href="<?php echo esc_url( $category['url'] ); ?>"
                               class="absolute top-1 left-1 bg-primary-main text-sm text-white px-1 mb-1/2 pt-0/2 pb-0/4 rounded-xs"><?php echo $category['name']; ?></a>
							<?php
						}
						?>
                    </div>
					<?php
				}
				$iteration ++;
			}
			?>
        </div>
    </section>
	<?php
}
wp_reset_postdata();
