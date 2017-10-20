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
                    'value' => !empty($data['name']) ? $data['name'] : '',
                    'name' => 'name'
                ),
                1 => array(
                    'label' => lang('email_address'),
                    'type' => 'email',
                    'value' => !empty($data['email_address']) ? $data['email_address'] : '',
                    'name' => 'email_address',
                    'required' => true
                )
            )
        )
    )
);
include 'admin/views/core/edit.php';
include 'admin/views/footer.php';