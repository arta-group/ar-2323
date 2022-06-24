$(function () {

    $('body').on('change', '#privacyPolicyChecked', function () {
        if (!$("#privacyPolicyChecked").is(':checked')) {
            $("#place_order").css('background-color', '#c1c1c1').attr('disabled', 'disabled');
        } else {
            $("#place_order").css('background-color', '').attr('disabled', false);

        }
    })
});

function CopyToClipboard() {
    var copyText = document.getElementById("PostCode");

    copyText.select();
    copyText.setSelectionRange(0, 99999);

    navigator.clipboard.writeText(copyText.value);

    alert("کپی شد");
}

function myFunction() {
    /* Get the text field */
    var copyText = document.getElementById("myInput");

    /* Select the text field */
    copyText.select();
    copyText.setSelectionRange(0, 99999); /* For mobile devices */

    /* Copy the text inside the text field */
    navigator.clipboard.writeText(copyText.value);

    /* Alert the copied text */
    alert("Copied the text: " + copyText.value);
}
