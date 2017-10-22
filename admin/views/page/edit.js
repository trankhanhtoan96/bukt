$(document).ready(function(){
    CKEDITOR.replace('content');
    autosize($('#excerpt'));
    autosize($('#seo_description'));
});

//upload image
$('#btn_choose_image').on('click', function () {
    CKFinder.popup({
        resourceType : 'Images',
        language:CI_language.language,
        selectActionFunction: function (fileUrl, data, allFiles) {
            var ext = getExt(fileUrl);
            if (ext == 'jpg' || ext == 'png') {
                $('#img_image').attr('src', fileUrl);
                $('input[name="image"]').val(fileUrl);
            } else {
                alert(CI_language.choose_image_please);
            }
        }
    });
});
$('#btn_delete_image').on('click', function () {
    $('#img_image').removeAttr('src');
    $('input[name="image"]').val('');
});