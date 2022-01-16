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
        get_template_part('template-parts/footer/top-section');
        get_template_part('template-parts/footer/mid-section');
        get_template_part('template-parts/footer/bottom-section');
        ?>
    </div>
</footer><!-- #colophon -->
</div><!-- #page -->

<a href="https://profile.iwmf.ir/organizations/artaelectric.ir?utm_source=artaelectric.ir&amp;utm_medium=iwmf&amp;utm_campaign=iwmf-people-votes&amp;utm_content=b-bottom-right"
   target="_blank" class="jashnvare"
   style="position: fixed; bottom: 0px; right: 0px; z-index: 9999; overflow: hidden; border-radius: 95% 0px 0px; width: 180px; height: 180px; border: none;">
    <img src="/wp-content/uploads/2022/01/4-1.png" style="vertical-align: bottom;">
</a>
<div class="chat_whatsapp">
    <a href="https://api.whatsapp.com/send?phone=+989199320601" rel="nofollow"
       class="inline-block icon-whatsapp text-whatsapp"></a>
</div>
<?php wp_footer(); ?>

<script>
    !function (t, e, n) {
        t.yektanetAnalyticsObject = n, t[n] = t[n] || function () {
            t[n].q.push(arguments)
        }, t[n].q = t[n].q || [];
        var a = new Date, r = a.getFullYear().toString() + "0" + a.getMonth() + "0" + a.getDate() + "0" + a.getHours(),
            c = e.getElementsByTagName("script")[0], s = e.createElement("script");
        s.id = "ua-script-jEFqNFtI";
        s.dataset.analyticsobject = n;
        s.async = 1;
        s.type = "text/javascript";
        //s.src = "https://cdn.yektanet.com/rg_woebegone/scripts_v3/jEFqNFtI/rg.complete.js?v=" + r, c.parentNode.insertBefore(s, c)
        s.src = "https://cdn.yektanet.com/rg_woebegone/scripts_v3/jEFqNFtI/rg.complete.js", c.parentNode.insertBefore(s, c)
    }(window, document, "yektanet");
</script>

<link rel="manifest" href="/manifest.json">

</body>
</html>