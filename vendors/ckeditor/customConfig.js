CKEDITOR.editorConfig = function (config) {
    config.toolbarGroups = [
        {name: 'basicstyles', groups: ['basicstyles', 'cleanup']},
        {name: 'paragraph', groups: ['list', 'align']}
    ];
    config.format_tags = 'p;h1;h2;h3;h4;pre';
    config.extraPlugins = 'justify';
};
