$(document).ready(function () {
    //autosize
    $('#email_to, #email_cc, #email_bcc').attr('rows', '5');
    //ckeditor
    CKEDITOR.replace('body_email');
    $('.select_add_address').select2({
        width: '70px',
        minimumResultsForSearch: Infinity
    });

    //dataTable
    $('#dataTableEmail').dataTable({
        "bSort": false
    });
    $('#dataTable').dataTable({
        "bSort": false
    });

    //select2
    $('#user_role_type_select').select2({
        width: '100%',
        minimumResultsForSearch: Infinity
    });

    //Nut thêm
    $('.btn_add_address').on('click', function () {
        var content = $(this).closest('.x_content');
        var mail = [];
        content.find('input[data-check="table_records"]').each(function () {
            if ($(this).is(':checked')) {
                mail.push($(this).closest('tr').find('td:nth-child(3)').text());
            }
        });
        if (mail.length > 0) {
            mail = mail.join(", ");
            var emailTO = $('#email_to');
            if (emailTO.val() == '') {
                emailTO.val(mail);
            } else {
                emailTO.val(emailTO.val() + ', ' + mail);
            }
            emailTO.focus();
            content.find('.flat').each(function () {
                if ($(this).is(':checked')) $(this).parent().find('.iCheck-helper').click();
            });
            alertify.success('<b>' + CI_language.add_success + '</b>');
        } else {
            alertify.error('<b>' + CI_language.not_yet_choose_email + '</b>');
        }
    });
    $('form[name="editview"]').on('submit', function () {
        new Spinner().show(CI_language.please_wait);
    });
});