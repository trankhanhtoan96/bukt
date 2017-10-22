$(document).ready(function() {
    autosize($('#description'));
    $('#role_id').select2();
});

//upload avatar
$('#btn_choose_avatar').on('click', function () {
    CKFinder.popup({
        resourceType : 'Images',
        language:CI_language.language,
        selectActionFunction: function (fileUrl, data, allFiles) {
            var ext = getExt(fileUrl);
            if (ext == 'jpg' || ext == 'png') {
                $('#img_avatar').attr('src', fileUrl);
                $('input[name="avatar"]').val(fileUrl);
            } else {
                alert(CI_language.choose_image_please);
            }
        }
    });
});
$('#btn_delete_avatar').on('click', function () {
    $('#img_avatar').removeAttr('src');
    $('input[name="avatar"]').val('');
});