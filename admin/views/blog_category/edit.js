$(document).ready(function(){
    CKEDITOR.replace('description',{
        customConfig:CI_language.base_url+"vendors/ckeditor/customConfig.js"
    });
    autosize($('#seo_description'));
    $('#parent_id').select2();
});