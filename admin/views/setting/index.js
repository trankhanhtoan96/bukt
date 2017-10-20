$(document).ready(function () {
    autosize($('#script_header'));
    autosize($('#script_footer'));
    CKEDITOR.replace('mail_signature');
});

//upload logo
$('#btn_choose_logo').on('click', function () {
    CKFinder.popup({
        resourceType: 'Images',
        language: CI_language.language,
        selectActionFunction: function (fileUrl, data, allFiles) {
            var ext = getExt(fileUrl);
            if (ext == 'jpg' || ext == 'png') {
                $('#img_logo').attr('src', fileUrl);
                $('input[name="logo"]').val(fileUrl);
            } else {
                alert(CI_language.choose_image_please);
            }
        }
    });
});
$('#btn_delete_logo').on('click', function () {
    $('#img_logo').removeAttr('src');
    $('input[name="logo"]').val('');
});

//upload icon
$('#btn_choose_icon').on('click', function () {
    CKFinder.popup({
        resourceType: 'Images',
        language: CI_language.language,
        selectActionFunction: function (fileUrl, data, allFiles) {
            var ext = getExt(fileUrl);
            if (ext == 'jpg' || ext == 'png') {
                $('#img_icon').attr('src', fileUrl);
                $('input[name="icon"]').val(fileUrl);
            } else {
                alert(CI_language.choose_image_please);
            }
        }
    });
});
$('#btn_delete_icon').on('click', function () {
    $('#img_icon').removeAttr('src');
    $('input[name="icon"]').val('');
});