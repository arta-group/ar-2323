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

<div class="w-full lg-w-auto lg-flex-1">

	<?php
	$hotlinks_number = get_option( 'options_blog-hotlink' );
	if ( $hotlinks_number ) { ?>
        <div class="hotlink-box">
            <div><h3>داغ ترین ها :</h3></div>
            <!--            <div>-->
            <!--                <svg viewBox="15 0 100 100">-->
            <!--                    <path d="M 10,50 L 35,80 L 45,75 L 25,50  L 45,25 L 35,20 Z"-->
            <!--                          transform="translate(100, 100) rotate(180) "></path>-->
            <!--                </svg>-->
            <!--            </div>-->
            <div>
				<?php
				for ( $i = 0; $i < $hotlinks_number; $i ++ ) {
					$hotlink_name = get_option( 'options_blog-hotlink_' . $i . '_hotlink-name' );
					$hotlink      = get_option( 'options_blog-hotlink_' . $i . '_hotlink' );
					?>
                    <a href="<?php echo $hotlink ?>" target="_blank"><?php echo $hotlink_name ?></a>
				<?php } ?>
            </div>
            <!--            <div style="width: 100px">-->
            <!--                <svg viewBox="-15 0 100 100">-->
            <!--                    <path d="M 10,50 L 35,80 L 45,75 L 25,50  L 45,25 L 35,20 Z"></path>-->
            <!--                </svg>-->
            <!--            </div>-->
        </div>
	<?php } ?>

    <div class="px-2 md-px-3 lg-px-0 mb-1">
        <h1 class="text-xl md-text-2/4 leading-3/8 font-bold text-gray-main"><?php the_title(); ?></h1>
        <div class="flex flex-col md-flex-row items-center justify-between mt-2">
            <div class="flex flex-wrap items-center justify-between lg-space-x-reverse lg-space-x-2">
                <div class="flex items-center mb-1/5 lg-mb-0">
                    <div class="icon-calendar ml-1 mb-0/3 text-1/9 leading-1/9 flex items-center  text-gray-500"></div>
                    <div class="text-sm md-text-sbase leading-2 text-gray-400 flex-shrink-0">تاریخ انتشار:</div>
                    <div class="text-sm md-text-sbase leading-2 text-gray-400 flex-shrink-0 ss02"><?php echo get_the_date( 'Y/m/d' ); ?></div>
                </div>
                <div class="flex items-center mb-1/5 lg-mb-0">
                    <div class="icon-square-user ml-0/7 text-2/4 leading-2/4 h-2/4 text-gray-500"></div>
                    <div class="text-sm md-text-sbase leading-2 text-gray-400 flex-shrink-0">نویسنده:</div>
                    <div class="text-sm md-text-sbase leading-2 text-gray-400 flex-shrink-0 ss02"><?php echo get_the_author(); ?></div>
                </div>
                <div class="flex items-center mb-1/5 lg-mb-0">
                    <div class="icon-timer ml-0/7 text-2/4 leading-2/4 h-2/4 text-gray-500"></div>
                    <div class="text-sm md-text-sbase leading-2 text-gray-400 flex-shrink-0">مدت مطالعه:&nbsp</div>
                    <div class="text-sm md-text-sbase leading-2 text-gray-400 flex-shrink-0 ss02"><?php echo fs_estimated_reading_time(); ?></div>
                </div>
				<?php
				$category = fs_get_the_primary_category( 'category' );
				if ( $category ) {
					?>
                    <a href="<?php echo esc_url( $category['url'] ); ?>"
                       class="pb-0/4 pt-0/2 px-1 bg-primary-main text-white text-sm leading-1/8 rounded-xs mb-1/5 lg-mb-0 flex items-center">
						<?php echo $category['name']; ?>
                    </a>
					<?php
				}
				?>
            </div>
            <a href="#" id="share-btn" class="flex flex-row items-center ml-0 mr-auto">
                <div class="icon-network-share ml-0/7 text-2/4 leading-2/4 h-2/4"></div>
                <div class="text-sm md-text-base text-gray-main">اشتراک گذاری</div>
            </a>
			<?php get_template_part( "page-templates/blog/share-modal" ); ?>
        </div>
    </div>
    <div class="post-thumbnail pt-1 lg-pt-3/5 px-2 md-px-3 lg-px-0 w-full">
		<?php
		the_post_thumbnail( 'fs-blog-main', array( 'class' => 'w-full h-full' ) );
		?>
    </div>
    <div class="c-blog-content px-2 md-px-3 lg-px-0">
		<?php the_content(); ?>
    </div>
	<?php
	$tags = get_the_tags();
	if ( $tags ) {
		?>
        <div class="lg-flex flex-col lg-flex-row  mb-4 lg-mb-8 mt-3 lg-mt-5 px-2 md-px-3 lg-px-0 custom-hidden-m">
            <div class="text-lg leading-13 mb-2 lg-mb-0 lg-ml-2 flex-shrink-0"> هشتگ‌ها :</div>
            <div class="flex items-center flex-wrap justify-between lg-justify-start">
				<?php
				foreach ( $tags as $tag ) {
					?>
                    <div class="pt-0/2 pb-0/4 px-1 ml-1 mb-1 lg-mb-0 text-sm leading-1/9 text-gray-main border flex-shrink-0 border-border rounded-xs">
                        <a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>" rel="tag" class="block">
							<?php echo $tag->name; ?>
                        </a>
                    </div>
					<?php
				}
				?>
            </div>
        </div>
		<?php
	}

	if ( comments_open() || get_comments_number() ) {
		comments_template();
	}

	get_template_part( "page-templates/blog/similar-posts" );
	?>
</div>
