<?php
/**
 * Pagination - Show numbered pagination for catalog pages
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/pagination.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.3.1
 */

if ( ! defined( 'ABSPATH' ) )
	exit;

$total   = isset( $total ) ? $total : wc_get_loop_prop( 'total_pages' );
$current = isset( $current ) ? $current : wc_get_loop_prop( 'current_page' );
$base    = isset( $base ) ? $base : esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) );
$format  = isset( $format ) ? $format : '';

if ( $total <= 1 )
	return;
?>
<div class="mb-6 flex items-center justify-center woocommerce-pagination">
	<div class="flex items-center p-1 border border-border rounded-xs pagination-con">
		<?php
		$args = apply_filters( 'woocommerce_pagination_args', array(
			'base'      => $base,
			'format'    => $format,
			'add_args'  => false,
			'current'   => max( 1, $current ),
			'total'     => $total,
			'prev_next' => false,
			'type'      => 'array',
			'end_size'  => 1,
			'mid_size'  => 2
		) );

		$pages = paginate_links( $args );

		if ( is_array( $pages ) )
		{
			$prev_link    = $next_link = $first_link = $last_link = '';
			$prev_disable = $next_disable = $first_disable = $last_disable = 'disabled';

			if ( get_previous_posts_link() )
			{
				$prev_link    = "href='" . get_previous_posts_page_link() . "'";
				$prev_disable = '';
			}

			$pagination = '';

			// First page
			if ( $current > 1 )
			{
				$first_link    = "href='" . get_pagenum_link( 1 ) . "'";
				$first_disable = '';
			}

			$pagination = '<div class="flex items-center ml-2">';

			$pagination .= '<a ' . $first_link . ' ' . $first_disable . ' class="' . $first_disable . ' w-3 lg-w-4/4 h-2 lg-h-3 leading-2 arrows lg-leading-3 text-center text-gray-main text-base lg-text-lg flex items-center justify-center border-l border-border">
						<span class="icon-angle-down flex items-center justify-center transform -rotate-90 text-0/7 scale-60 lg-scale-75 w-0/5"></span>
						<span class="icon-angle-down flex items-center justify-center transform -rotate-90 text-0/7 scale-60 lg-scale-75 w-0/5"></span>
					</a>';

			// Previous page
			$pagination .= '<a ' . $prev_link . ' ' . $prev_disable . '  class="' . $prev_disable . ' w-3 lg-w-4/4 h-2 lg-h-3 leading-2 arrows lg-leading-3 text-center text-gray-main text-base lg-text-lg flex items-center justify-center border-l border-border">
						<span class="icon-angle-down flex items-center justify-center transform -rotate-90 text-0/7 scale-60 lg-scale-75"></span>
					</a>';

			$pagination .= '</div>';

			$pagination .= '<ul class="pagination flex items-center md-space-x-reverse md-space-x-1/5">';

			foreach ( $pages as $page )
			{
				$active_class = ( strpos( $page, 'current' ) !== false ? 'active ' : '' );

				$pagination .= '<li>
			 	' . str_replace( 'span', 'a', str_replace( 'page-numbers', $active_class . ' w-2 h-2 lg-w-3 lg-h-3 leading-2 lg-leading-3 text-center text-gray-main text-base lg-text-lg flex items-center justify-center rounded-xs', $page ) ) . '</li>';
			}

			$pagination .= '</ul>';

			if ( get_next_posts_link() )
			{
				$next_link    = "href='" . get_next_posts_page_link() . "'";
				$next_disable = '';
			}

			$pagination .= '<div class="flex items-center mr-2">';

			// Next page
			$pagination .= '<a ' . $next_link . $next_disable . ' class="' . $next_disable . ' w-3 lg-w-4/4 h-2 lg-h-3 leading-2 arrows lg-leading-3 text-center text-gray-main text-base lg-text-lg flex items-center justify-center border-border border-r">
						<span class="icon-angle-down flex items-center justify-center transform rotate-90 text-0/7 scale-60 lg-scale-75"></span>
					</a>';

			// Last page
			if ( $current < $total )
			{
				$last_link    = "href='" . get_pagenum_link( $total ) . "'";
				$last_disable = '';
			}

			$pagination .= '<a ' . $last_link . ' ' . $last_disable . ' class="' . $last_disable . ' w-3 lg-w-4/4 h-2 lg-h-3 leading-2 arrows lg-leading-3 text-center text-gray-main text-base lg-text-lg flex items-center justify-center border-border border-r">
						<span class="icon-angle-down flex items-center justify-center transform rotate-90 text-0/7 scale-60 lg-scale-75 w-0/5"></span>
						<span class="icon-angle-down flex items-center justify-center transform rotate-90 text-0/7 scale-60 lg-scale-75 w-0/5"></span>
					</a>';

			$pagination .= '</div>';

			echo $pagination;
		}
		?>
	</div>
</div>
