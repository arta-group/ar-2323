<div class="px-2 md-px-3 lg-px-0 w-625">
	<?php section_title( " ارسال پیام به آرتا الکتریک" ); ?>
    <p class="mt-3/3 mb-4 text-base md-text-medium leading-3/2 text-gray-main">برای ارسال مستقیم پیام، پیگیری سفارش و
        درخواست پشتیبانی، فرم زیر را پر کنید.</p>
    <form class="mdr_form grid grid-cols-1 gap-1/5">
        <div class="flex flex-col md-flex-row items-center space-y-1/5 md-space-y-0 md-space-x-reverse md-space-x-3">
            <div class="w-full md-flex-1">
                <label class="text-base block leading-2/2 text-gray-main mb-0/7" for="l-num"> نام و نام
                    خانوادگی </label>
                <input type="text" name="full_name"
                       class="border border-border w-full rounded-xs text-base leading-4/5 px-2">
            </div>
            <div class="w-full md-flex-1">
                <label class="text-base block leading-2/2 text-gray-main mb-0/7" for="l-num"> شماره موبایل </label>
                <input type="text" name="phone"
                       class="h-4/5 border border-border w-full rounded-xs text-base leading-4/5 px-2">
            </div>
        </div>
        <div class="">
            <label class="text-base block leading-2/2 text-gray-main mb-0/7" for="l-num"> آدرس ایمیل </label>
            <input type="email" name="email"
                   class="h-4/5 border border-border w-full rounded-xs text-base leading-4/5 px-2">
        </div>
        <div class="">
            <label class="text-base block leading-2/2 text-gray-main mb-0/7" for="l-num"> پیام شما </label>
            <textarea name="message" class="w-full h-14 text-base border-border border rounded-xs p-1"></textarea>
        </div>
        <input type="hidden" name="form_type" value="contact_us">
        <input type="hidden" name="_wpnonce" value="<?php echo wp_create_nonce( 'wp_rest' ) ?>">
        <input type="hidden" name="noteClass" value="mdr-note-contact-us">
        <div class="flex items-center" style="justify-self: left;">
            <div class="loader loader-contact-us"></div>
            <button type="submit"
                    class="bg-secondary-main text-gray-dark text-1/7 cursor-pointer rounded-xs leading-2/7 h-4/7
                     py-1 w-14 mt-1/5 mr-auto">ارسال پیام
            </button>
        </div>
        <div class="mdr-note-contact-us" style="display: none">
    </form>
</div>