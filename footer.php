<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package FOUR SIDES
 */
?>


<footer id="colophon" class="site-footer bg-gray-50">
	<div class="container mx-auto px-2 md-px-3 lg-px-0 overflow-hidden">
		<?php
		get_template_part( 'template-parts/footer/top-section' );
		get_template_part( 'template-parts/footer/mid-section' );
		get_template_part( 'template-parts/footer/bottom-section' );
		?>
	</div>
</footer><!-- #colophon -->
</div><!-- #page -->
<script type="text/javascript">window.$crisp=[];window.CRISP_WEBSITE_ID="bf4e8bff-f78a-4931-934e-daa0d50e2890";(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();</script>
<?php wp_footer(); ?>

<script>
	!function (t, e, n) {
		t.yektanetAnalyticsObject = n, t[n] = t[n] || function () {
			t[n].q.push(arguments)
		}, t[n].q = t[n].q || [];
		var a = new Date, r = a.getFullYear().toString() + "0" + a.getMonth() + "0" + a.getDate() + "0" + a.getHours(),
			c = e.getElementsByTagName("script")[0], s = e.createElement("script");
		s.id = "ua-script-jEFqNFtI"; s.dataset.analyticsobject = n; s.async = 1; s.type = "text/javascript";
		//s.src = "https://cdn.yektanet.com/rg_woebegone/scripts_v3/jEFqNFtI/rg.complete.js?v=" + r, c.parentNode.insertBefore(s, c)
		s.src = "https://cdn.yektanet.com/rg_woebegone/scripts_v3/jEFqNFtI/rg.complete.js", c.parentNode.insertBefore(s, c)
	}(window, document, "yektanet");
</script>

<link rel="manifest" href="/manifest.json">

</body>
</html>