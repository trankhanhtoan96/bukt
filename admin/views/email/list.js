$(document).ready(function () {

    //button loc email trung
    $('.btn_filter_duplicate').on('click', function () {
        var loading = new Spinner();
        loading.show(CI_language.please_wait);
        $.ajax({
            url: CI_language.site_url+'/email/filter_duplicate',
            type: 'post',
            async: true,
            data: {},
            dataType: "json",
            success: function (data) {
                alertify.success(CI_language.filter_email_duplicate_success);
                loading.hide();
                location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
                alertify.error(CI_language.ajax_error);
                loading.hide();
            }
        });
    });

    //button loc email hop le
    $('.btn_filter_valid_email').on('click', function () {
        var loading = new Spinner();
        loading.show(CI_language.please_wait);
        $.ajax({
            url: CI_language.site_url+'/email/filter_valid_email',
            type: 'post',
            async: true,
            data: {},
            dataType: "json",
            success: function (data) {
                alertify.success(CI_language.filter_email_valid_success);
                loading.hide();
                location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
                alertify.error(CI_language.ajax_error);
                loading.hide();
            }
        });
    });
});