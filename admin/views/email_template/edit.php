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
                1 => ''
            ),
            1=>array(
                0=>array(
                    'label' => lang('content'),
                    'type' => 'textarea',
                    'required' => true,
                    'value' => !empty($data['content']) ? $data['content'] : '',
                    'name' => 'content'
                )
            )
        )
    )
);
include 'admin/views/core/edit.php';
include 'admin/views/footer.php';