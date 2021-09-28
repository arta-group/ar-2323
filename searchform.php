<form action="<?php echo esc_url( home_url( '/shop/' ) ) ?>" method="get" class="border-2 border-border w-23 lg-w-50 rounded-xs flex flex-row">
	<input type="hidden" name="type" value="product"/>
	<input class="pt-0/5 pb-0/7 lg-pt-1/1 lg-pb-1/2 flex-1 text-sm lg-text-base leading-2/2 text-gray-600 pr-1/3 lg-pr-2/1 rounded-xs" type="search" name="s" placeholder="جستجو در محصولات ..."/>
	<button type="submit" class="px-1 lg-px-1/5 h-full text-xl pt-0/5 pb-0/7 lg-pt-1/1 lg-pb-1/2 leading-2 lg-leading-2/2 icon-search text-gray-500 flex items-center justify-center"></button>
</form>