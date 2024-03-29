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

<!--<div class="chat_whatsapp w-6 rounded-full flex items-center justify-center bg-white hide-on-mobile" style="height: 6rem; padding-top: 15px;">-->
<!--    <a href="https://web.whatsapp.com/send?phone=+989199320601" rel="nofollow" target="_blank"-->
<!--       class="inline-block icon-whatsapp text-whatsapp"></a>-->
<!--</div>-->
<!--<div class="chat_whatsapp w-6 rounded-full flex items-center justify-center bg-white hide-on-desktop" style="height: 6rem; padding-top: 15px;">-->
<!--    <a href="https://api.whatsapp.com/send?phone=+989199320601" rel="nofollow" target="_blank"-->
<!--       class="inline-block icon-whatsapp text-whatsapp"></a>-->
<!--</div>-->
<?php wp_footer(); ?>

<link rel="manifest" href="/manifest.json">

</body>
</html>