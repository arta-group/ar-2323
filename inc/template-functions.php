<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package FOUR SIDES
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 *
 * @return array
 */

function fs_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}

add_filter( 'body_class', 'fs_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function fs_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}

add_action( 'wp_head', 'fs_pingback_header' );

function section_title( $title ) {
	echo '
	<div class="border-b border-border flex items-center">
        <h2 class="lg-text-2/4 text-2 inline-block text-center md-text-right leading-3/8 pb-1 title text-gray-main font-bold">
           ' . $title . '
        </h2>
    </div>
	';
}

function section_title_b( $title ) {
	echo '
	<div class="border-b border-border flex items-center">
        <h2 class="lg-text-2/4 text-2 inline-block text-center md-text-right leading-4/4 pb-1/4 title text-gray-main font-bold">
           ' . $title . '
        </h2>
    </div>
	';
}

function fs_remove_image_sizes() {
	// Remove default WP image sizes
	remove_image_size( '1536x1536' );
	remove_image_size( '2048x2048' );
	remove_image_size( 'medium_large' );
	remove_image_size( 'shop_thumbnail' );
	remove_image_size( 'shop_catalog' );
	remove_image_size( 'shop_single' );
	remove_image_size( 'woocommerce_single' );
	remove_image_size( 'woocommerce_thumbnail' );
	remove_image_size( 'woocommerce_gallery_thumbnail' );
}

add_action( 'init', 'fs_remove_image_sizes' );

function fs_disable_medium_large_images( $sizes ) {
	unset( $sizes['medium_large'] );

	return $sizes;
}

add_filter( 'intermediate_image_sizes_advanced', 'fs_disable_medium_large_images' );

// Primary category not a native wordpress feature, it's a feature of Yoast SEO plugin.
if ( ! function_exists( 'fs_get_the_primary_category' ) ) {
	function fs_get_the_primary_category( $taxonomy = 'product_cat', $post_id = 0 ) {
		$post_id = $post_id > 0 ? $post_id : get_the_ID();

		if ( $taxonomy == 'product_cat' ) {
			$category = get_the_terms( $post_id, $taxonomy );
		} else {
			$category = get_the_category();
		}

		if ( $category ) {
			if ( class_exists( 'WPSEO_Primary_Term' ) ) {
				$wpseo_primary_term = new WPSEO_Primary_Term( $taxonomy, $post_id );
				$wpseo_primary_term = $wpseo_primary_term->get_primary_term();
				$term               = get_term( $wpseo_primary_term );

				if ( is_wp_error( $term ) ) {
					// Default to first category (not Yoast) if an error is returned
					$category_name = $category[0]->name;
					$category_id   = $category[0]->term_id;
					$category_link = get_category_link( $category[0]->term_id );
				} else {
					// Yoast Primary category
					$category_name = $term->name;
					$category_id   = $term->term_id;
					$category_link = get_category_link( $term->term_id );
				}
			} else {
				$category_id   = $category[0]->term_id;
				$category_name = $category[0]->name;
				$category_link = get_category_link( $category[0]->term_id );
			}

			return array(
				'id'   => $category_id,
				'name' => $category_name,
				'url'  => esc_url( $category_link )
			);
		}
	}
}

if ( ! function_exists( 'fs_save_post_views_count' ) ) {
	function fs_save_post_views_count() {
		if ( is_preview() ) {
			return;
		}

		if ( is_singular( 'post' ) ) {
			global $post;

			if ( is_int( $post ) ) {
				$post = get_post( $post );
			}

			if ( wp_is_post_revision( $post ) ) {
				return;
			}

			if ( ! $post instanceof WP_Post ) {
				return;
			}

			$views_count = get_post_meta( $post->ID, 'post_views_count', true );

			if ( empty( $views_count ) ) {
				$views_count = 1;
			} else {
				$views_count += 1;
			}

			update_post_meta( $post->ID, 'post_views_count', $views_count );
		}
	}

	add_action( 'wp_head', 'fs_save_post_views_count' );
}

if ( ! function_exists( 'fs_estimated_reading_time' ) ) {
	function fs_estimated_reading_time() {
		$content = strip_tags( strip_shortcodes( get_the_content() ) );

		// Unicode (UTF8) string word count
		$real_words = array_map( 'trim', explode( ' ', $content ) );

		return floor( count( $real_words ) / 300 ) . ' دقیقه';
	}
}

add_filter( 'wpcf7_autop_or_not', '__return_false' );

function fs_yoast_seo_admin_user_remove_social( $contactmethods ) {
	return [];
}

add_filter( 'user_contactmethods', 'fs_yoast_seo_admin_user_remove_social' );

function fs_remove_image_zoom_support() {
	remove_theme_support( 'wc-product-gallery-zoom' );
}

//add_action( 'wp', 'fs_remove_image_zoom_support', 100 );

add_filter( 'woocommerce_gallery_image_size', function ( $size ) {
	return 'fs-product-main';
} );

add_filter( 'wpseo_json_ld_output', '__return_false' );

/**
 * @throws Exception
 */
function sa_add_schema() {
	if ( is_home() ) {
		?>
        <script type="application/ld+json">
			{
				"@context": "https://schema.org",
				"@type": "Organization",
				"Name": "آرتا الکتریک",
				"URL": "<?php echo home_url(); ?>",
				"logo": "https://artaelectric.ir/wp-content/themes/arta/assets/img/svg/arta-logo.svg",
				"sameAs": [
					"https://api.whatsapp.com/send?phone=+989199320601",
					"http://www.instagram.com/arta_electric",
					"https://www.linkedin.com/company/arta-electric",
					"http://t.me/arta_electric1"
				]
			}







        </script>
		<?php
	}
	?>
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebSite",
            "url": "https://artaelectric.ir/",
            "potentialAction": {
                "@type": "SearchAction",
                "target": "https://artaelectric.ir/shop/?type=product&s={search_term_string}",
                "query-input": "required name=search_term_string"
            }
        }
    </script>
	<?php

	if ( is_product_category() || is_product_taxonomy() ) {
		$category   = get_queried_object();
		$categories = [];

		woocommerce_product_loop_start();

		if ( wc_get_loop_prop( 'total' ) ) {
			while ( have_posts() ) {
				the_post();
				$categories[] = get_the_permalink();
			}
		}

		woocommerce_product_loop_end();

		?>
        <script type="application/ld+json">
			{
				"@context": "https://schema.org",
				"@type": "ItemList",
				"url": "<?php echo get_category_link( $category->term_id ); ?>",
				"itemListElement": [
					<?php
			$i = 1;
			foreach ( $categories as $c ) { ?>
					{
						"@type": "ListItem",
						"position": <?php echo $i; ?>,
						"url": "<?php echo $c; ?>"
					}<?php if ( $i < count( $categories ) ) {
				echo ',';
			} ?><?php $i ++;
			} ?>
				]
			}







        </script>

		<?php
		$queried_object = get_queried_object();
		$taxonomy       = $queried_object->taxonomy;
		$term_id        = $queried_object->term_id;
		$contentUrl     = get_term_meta( $term_id, 'contentUrl', true );
		if ( $contentUrl ) {
			$meta        = get_option( 'wpseo_taxonomy_meta' );
			$title       = $meta[ $taxonomy ][ $term_id ]['wpseo_title'];
			$description = $meta[ $taxonomy ][ $term_id ]['wpseo_desc'];

			$product_update = get_lastpostmodified();
			$duration       = get_term_meta( $term_id, 'duration', true );
			$thumbnailUrl   = get_term_meta( $term_id, 'thumbnailUrl', true );
			?>
            <script type="application/ld+json">
            {
                "@context": "https://schema.org",
                    "@type": "VideoObject",
                    "name": "<?php echo $title; ?>",
                    "description": "<?php echo $description; ?>",
                    "thumbnailUrl": "<?php echo $thumbnailUrl; ?>",
                    "uploadDate": "<?php echo $product_update ?>",
                    "duration": "<?php echo $duration; ?>",
                    "contentUrl": "<?php echo $contentUrl; ?>",
                    "embedUrl": "",
                    "interactionStatistic": {
                        "@type": "InteractionCounter",
                        "interactionType": { "@type": "WatchAction" },
                        "userInteractionCount": <?php echo rand( 1000, 6000 ); ?>
                        },
                    "regionsAllowed": ""
            }







            </script>
			<?php
		}
		$faqextra = get_term_meta( $term_id, 'faqextra_0_question', true );

		if ( $faqextra ) {
			?>
            <script type="application/ld+json">
			{
				"@context": "https://schema.org",
				"@type": "FAQPage",
				"mainEntity": [
					<?php
				for ( $n = 0; $n <= 4; $n ++ ) {
					$faq_question_key = 'faqextra_' . $n . '_question';
					$faq_answer_key   = 'faqextra_' . $n . '_answer';

					$question = get_term_meta( $term_id, $faq_question_key, true );
					$answer   = get_term_meta( $term_id, $faq_answer_key, true );

					if ( $question ) {
						if ( $n != 0 ) {
							echo ',';
						}
						?>
                        {
                            "@type": "Question",
                            "name": "<?php echo $question; ?>",
                            "acceptedAnswer": {
                            "@type": "Answer",
                                "text": "<?php echo $answer; ?>"
                            }
                        }
                        <?php
					}
				}
				?>
				]
			}







            </script>
			<?php
		}
	}

	if ( is_product() ) {
		global $product;

		if ( is_product() && ! is_a( $product, 'WC_Product' ) ) {
			$product = wc_get_product( get_the_id() );
		}

		$product_name  = get_post_meta( get_the_ID(), '_yoast_wpseo_title', true ) ?: $product->get_name();
		$yoast         = get_option( 'wpseo_titles' );
		$metadesc      = $yoast['metadesc-product'];
		$product_desc  = get_post_meta( get_the_ID(), '_yoast_wpseo_metadesc', true ) ?: str_replace( '%%title%%', $product_name, $metadesc );
		$product_price = ( $product->get_price() ?: 0 ) * 10;
		$product_sku   = $product->get_sku() ?: 0;

//		$rate_value = get_post_meta( get_the_ID(), 'product-rate-value', true );
//		$rate_count = get_post_meta( get_the_ID(), 'product-rate-count', true );

//		if ( empty( $rate_value ) ) {
//			$rate_value = rand( 40, 50 ) / 10;
//			$rate_count = rand( 50, 300 );
//			update_post_meta( get_the_ID(), 'product-rate-value', $rate_value );
//			update_post_meta( get_the_ID(), 'product-rate-count', $rate_count );
//		}
		?>
        <script type="application/ld+json">
			{
				"@context": "https://www.schema.org",
				"@type": "Product",
				"name": "<?php echo $product_name; ?>",
				"image": "<?php echo get_the_post_thumbnail_url( $product->get_id(), 'full' ); ?>",
				"description": "<?php echo $product_desc; ?>",
				"sku": "<?php echo $product_sku; ?>",
				"mpn": "<?php echo $product_sku; ?>",
				"brand": {
					"@type": "Brand",
					"name": "<?php $brand = wp_get_post_terms( $product->get_id(), 'product_brand' );
			$brand                        = reset( $brand );
			echo $brand->name; ?>"
				},
				"offers": {
					"@type": "AggregateOffer",
					"priceCurrency": "IRR",
					"lowPrice": <?php echo $product_price; ?>,
					"highPrice": <?php echo $product_price; ?>,
					"offerCount": 100,
					"offers": {
						"@type": "Offer",
						"priceCurrency": "IRR",
						"price": <?php echo $product_price; ?>,
						"itemCondition": "https://schema.org/NewCondition",
						"availability": "https://schema.org/<?php echo $product->is_in_stock() ? 'InStock' : 'OutOfStock'; ?>",
						"seller": {
							"@type": "Organization",
							"name": "آرتا الکتریک"
						}
					}
				},
				"review": {
					"@type": "Review",
					"author": {
					    "@type": "Person",
					    "name": "کاربر آرتا الکتریک"
					}
				}
	    	}






        </script>
		<?php
		$contentUrl = get_post_meta( get_the_ID(), 'contentUrl', true );
		if ( $contentUrl ) {
			$product_update = get_lastpostmodified();
			$duration       = get_post_meta( get_the_ID(), 'duration', true );
			$thumbnailUrl   = get_post_meta( get_the_ID(), 'thumbnailUrl', true );
			?>
            <script type="application/ld+json">
                {
                "@context": "https://www.schema.org",
                "@type": "VideoObject",
                "name": "<?php echo $product_name; ?>",
                "description": "<?php echo $product_desc; ?>",
                "thumbnailUrl": "<?php echo $thumbnailUrl; ?>",
                "uploadDate": "<?php echo $product_update ?>",
                "duration": "<?php echo $duration; ?>",
                "contentUrl": "<?php echo $contentUrl; ?>",
                "embedUrl": "",
                "interactionStatistic": {
                    "@type": "InteractionCounter",
                    "interactionType": { "@type": "WatchAction" },
                    "userInteractionCount": <?php echo rand( 1000, 6000 ); ?>
                    },
                "regionsAllowed": ""
               	}




            </script>
			<?php
		}

		if ( have_rows( 'faqextra', get_the_ID() ) ) {
			$count11 = count( get_field( 'faqextra', get_the_ID() ) );
			$i       = 1;
			?>
            <script type="application/ld+json">
			{
				"@context": "https://schema.org",
				"@type": "FAQPage",
				"mainEntity": [
					<?php
				while ( have_rows( 'faqextra', get_the_ID() ) ) {
					the_row();
					?>
                        {
                            "@type": "Question",
                            "name": "<?php echo get_sub_field( 'question' ); ?>",
                            "acceptedAnswer": {
                                "@type": "Answer",
                                "text": "<?php echo str_replace( '"', "'", get_sub_field( 'answer' ) ); ?>"
                            }
                        }
                        <?php
					$i ++;
					if ( $i <= $count11 ) {
						echo ',';
					}
				}
				?>
				]
			}






            </script>
			<?php
		}
	}

	//article post page
	if ( is_single() && ! is_product() ) {
		global $post, $authordata;

		$author_data = $authordata->data;
		$author_name = $author_data->display_name;
		$author_url  = get_site_url() . '/user-profile/?id=' . $author_data->ID;

		$post_title = ( get_post_meta( $post->ID, '_yoast_wpseo_title', true ) == '' ) ? $post->post_title : get_post_meta( $post->ID, '_yoast_wpseo_title', true );
		$post_desc  = get_post_meta( $post->ID, '_yoast_wpseo_metadesc', true ) ?? $post->post_title;

		$post_date     = new DateTime( $post->post_date );
		$post_modified = new DateTime( $post->post_modified );

		$post_image = get_the_post_thumbnail_url( $post );
		?>

        <script type="application/ld+json">
            {
                "@context": "https://schema.org",
                "@type": "Article",
                "headline": "<?php echo $post_title; ?>",
                "description": "<?php echo $post_desc; ?>",
                "image": [
                    "<?php echo $post_image; ?>"
                ],
                "datePublished": "<?php echo $post_date->format( DateTimeInterface::ATOM ); ?>",
                "dateModified": "<?php echo $post_modified->format( DateTimeInterface::ATOM ); ?>",
                "author": [
                    {
                        "@type": "Person",
                        "name": "<?php echo $author_name; ?>",
                        "url": "<?php echo $author_url; ?>"
                    }
                ],
                "publisher": {
                        "@type": "Organization",
                        "name": "آرتا الکتریک",
                        "url": "https://artaelectric.ir"
                    }
            }





        </script>
		<?php
	}

	//blog page
	if ( is_page( 'blog' ) ) {
		global $post;
	}
}

add_action( 'wp_body_open', 'sa_add_schema' );

if ( ! function_exists( 'fs_validate_melli_code' ) ) {
	function fs_validate_melli_code( $code ) {
		$en_numbers = [
			"0",
			"1",
			"2",
			"3",
			"4",
			"5",
			"6",
			"7",
			"8",
			"9"
		];
		$fa_numbers = [
			"۰",
			"۱",
			"۲",
			"۳",
			"۴",
			"۵",
			"۶",
			"۷",
			"۸",
			"۹"
		];

		$code = str_replace( $fa_numbers, $en_numbers, $code );

		if ( ! preg_match( '/^[0-9]{10}$/', $code ) ) {
			return false;
		}

		for ( $i = 0; $i < 10; $i ++ ) {
			if ( preg_match( '/^' . $i . '{10}$/', $code ) ) {
				return false;
			}
		}

		for ( $i = 0, $sum = 0; $i < 9; $i ++ ) {
			$sum += ( ( 10 - $i ) * intval( substr( $code, $i, 1 ) ) );
		}

		$ret    = $sum % 11;
		$parity = intval( substr( $code, 9, 1 ) );

		return ( ( $ret < 2 && $ret == $parity ) || ( $ret >= 2 && $ret == 11 - $parity ) );
	}
}

function carousel_category_card( $category ) {
	echo '
	<div class="product-card more-slide product type-product status-publish first instock product_cat-cat-one has-post-thumbnail product-type-variable slick-slide lg-p-2" >
		<a href="' . home_url() . '/category/' . $category->slug . '" target="_blank" class="h-full bg-gray-100 rounded-xs p-4 lg-p-2 block">
		    <h3 class="text-lg text-center h-full flex flex-col items-center justify-center">مشاهده محصولات بیشتر <span class="text-primary-main ml-1"> ' . $category->name . ' </span> <span class="icon-right-arrow-alt text-primary-main text-lg mt-1 leading-2 inline-block"></span> </h3>
		</a>
	</div>';
}

function fs_dequeue_scripts() {
	// yith-woocommerce-wishlist-premium
	wp_dequeue_style( 'yith-wcwl-font-awesome' );
	wp_dequeue_style( 'yith-wcwl-main' );
}

add_action( 'wp_enqueue_scripts', 'fs_dequeue_scripts', 99 );