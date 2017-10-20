<?php
include 'admin/views/header.php';
$dataTemplates = array(
    0 => array(
        'panel_name' => lang('general_information'),
        'data_panel' => array(
            0 => array(
                0 => array(
                    'label' => lang('name'),
                    'type' => 'text',
                    'required' => true,
                    'value' => !empty($data['name']) ? $data['name'] : '',
                    'name' => 'name'
                ),
                1 => array(
                    'label' => lang('parent_category'),
                    'code' => getHtmlSelection($data['parent_category'], !empty($data['parent_id']) ? $data['parent_id'] : '0', array('name' => 'parent_id', 'id' => 'parent_id', 'style' => 'width:100%'))
                )
            ),
            1 => array(
                0 => array(
                    'label' => lang('description'),
                    'type' => 'textarea',
                    'value' => !empty($data['description']) ? $data['description'] : '',
                    'name' => 'description'
                )
            )
        )
    ),
    1 => array(
        'panel_name' => lang('meta_header'),
        'data_panel' => array(
            0 => array(
                0 => array(
                    'label' => lang('meta_title'),
                    'type' => 'text',
                    'value' => !empty($data['seo_title']) ? $data['seo_title'] : '',
                    'name' => 'seo_title'
                ),
                1 => array(
                    'label' => lang('meta_description'),
                    'type' => 'textarea',
                    'value' => !empty($data['seo_description']) ? $data['seo_description'] : '',
                    'name' => 'seo_description'
                )
            )
        )
    ),
    2 => array(
        'panel_name' => lang('rewrite_url'),
        'data_panel' => array(
            0 => array(
                0 => array(
                    'type' => 'text',
                    'value' => !empty($data['rewrite_url']) ? $data['rewrite_url'] : '',
                    'name' => 'rewrite_url'
                )
            )
        )
    )
);
include 'admin/views/core/edit.php';
include 'admin/views/footer.php';