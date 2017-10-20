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
                    'label' => lang('description'),
                    'type' => 'textarea',
                    'value' => !empty($data['description']) ? $data['description'] : '',
                    'name' => 'description'
                )
            )
        )
    ),
    1 => array(
        'panel_name' => lang('role'),
        'data_panel' => array(
            0 => array(
                0 => array(
                    'code' => !empty($data['detail']) ? $data['detail'] : ''
                )
            )
        )
    )
);
include 'admin/views/core/edit.php';
include 'admin/views/footer.php';