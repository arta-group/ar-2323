<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FOUR SIDES
 *
 * Template Name: Menu
 */

get_header();

while ( have_posts() ) {
	the_post();
	?>
    <main id="primary" class="site-main">
		<?php
		get_template_part( "template-parts/breadcrumb" );
		?>
        <style>


            .mdr-scroll {
                overflow-y: hidden;
                overflow-x: auto;
            }

            /* width */
            .mdr-scroll::-webkit-scrollbar {
                height: 8px;
                background: #d0d0d0;
            }

            /* Handle */
            .mdr-scroll::-webkit-scrollbar-thumb {
                background: #888;
            }

            /* Handle on hover */
            .mdr-scroll::-webkit-scrollbar-thumb:hover {
                background: #555;
            }

            .menu-page-or {
                display: none;
            }

            #menu-page {
                display: flex;
                flex-direction: row;
                padding-bottom: 10px;
                margin-bottom: 10px;
            }

            #menu-page > li {
                display: flex;
                flex-direction: column;
                justify-content: center;
                width: 100px;
                height: 130px;
                background-color: #dddddd;
                margin: 10px;
                padding: 10px;
                border-radius: 10px;
                text-align: center;
                font-size: 15px;
                box-shadow: rgb(0 0 0 / 15%) 0px 5px 6px 0px;
                border: #ffffff solid 2px;
            }

            #menu-page > li > ul {
                display: none;
            }

            #menu-page > li > a {
                width: 75px;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
            }

            #menu-page > li > a > img {
                padding-bottom: 5px;
            }

            #menu-page > li > ul > li > ul {
                display: none;
            }

            #sub-menu-page {
                display: flex;
                flex-direction: row;
                padding-bottom: 10px;
                margin-bottom: 10px;
            }

            #sub-menu-page > li {
                display: flex;
                flex-direction: column;
                justify-content: center;
                width: 100px;
                height: 130px;
                background-color: #ebebeb;
                margin: 5px;
                padding: 7px;
                border-radius: 10px;
                text-align: center;
                font-size: 14px;
                box-shadow: rgb(0 0 0 / 15%) 0px 5px 6px 0px;
                border: #ffffff solid 2px;
            }

            #sub-menu-page > li > a {
                width: 75px;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
            }

            #sub_menu-page > li > a > img {
                padding-bottom: 5px;
            }

            #sub-menu-page > li > ul {
                display: none;
            }

            #sub-menu-page > li > ul > li > ul {
                display: none;
            }

            #sub2-menu-page {
                display: flex;
                flex-direction: row;
                padding-bottom: 10px;
                margin-bottom: 10px;
            }

            #sub2-menu-page > li {
                display: flex;
                flex-direction: column;
                justify-content: center;
                width: 100px;
                height: 130px;
                background-color: #f3f3f3;
                margin: 4px;
                padding: 5px;
                border-radius: 10px;
                text-align: center;
                font-size: 12px;
                box-shadow: rgb(0 0 0 / 15%) 0px 5px 6px 0px;
                border: #ffffff solid 2px;
                align-items: center;
            }

            #sub2-menu-page > li > a {
                width: 75px;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
            }

            #menu-page > li > a > img {
                padding-bottom: 5px;
            }

            @media (max-width: 768px) {
                /* width */
                .mdr-scroll::-webkit-scrollbar {
                    height: 3px;
                    background: #d0d0d0;
                }

                /* Handle */
                .mdr-scroll::-webkit-scrollbar-thumb {
                    background: #888;
                }

                /* Handle on hover */
                .mdr-scroll::-webkit-scrollbar-thumb:hover {
                    background: #555;
                }
            }

        </style>

        <section class="grid grid-cols-1 gap-11 container mx-auto pt-1 md-pt-3/3 pb-3 md-pb-10">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'header-category-menu',
				'menu_class'     => 'menu-page-or',
				'container'      => '',
				'fallback_cb'    => 'false',
				'depth'          => 3,
			) );
			?>
            <div>
                <div id="menu-page" class="mdr-scroll">

                </div>
                <div id="sub-menu-page" class="mdr-scroll">

                </div>
                <div id="sub2-menu-page" class="mdr-scroll">

                </div>
            </div>
            <script>
                jQuery(function () {
                    jQuery("#menu-page").append($(".menu-page-or").children().clone());

                    $("body").on("click", "#menu-page > li", function (e) {

                        if ($(this).find("> ul").children().length > 0) {
                            e.preventDefault();
                        }

                        $("#sub-menu-page").slideUp("fast");
                        $("#sub-menu-page").children().remove()
                        $("#sub2-menu-page").slideUp("fast");
                        $("#sub2-menu-page").children().remove()
                        $("#sub-menu-page").append($(this).find("> ul").children().clone());
                        $("#sub-menu-page").slideDown("slow");
                    });

                    $("body").on("click", "#sub-menu-page > li", function (e) {

                        if ($(this).find("> ul").children().length > 0) {
                            e.preventDefault();
                        }

                        $("#sub2-menu-page").slideUp("fast");
                        $("#sub2-menu-page").children().remove()
                        $("#sub2-menu-page").append($(this).find("> ul").children().clone().slideDown("slow"));
                        $("#sub2-menu-page").slideDown("slow");
                    });

                });
            </script>
        </section>
    </main><!-- #main -->
	<?php
}

get_footer();