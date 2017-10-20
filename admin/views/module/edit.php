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
                    'label'=>lang('other_role'),
                    'type'=>'textarea',
                    'value'=>!empty($data['other_role']) ? $data['other_role'] : '',
                    'name'=>'other_role'
                )
            )
        )
    )
);
include 'admin/views/core/edit.php';
include 'admin/views/footer.php';