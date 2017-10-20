<?php
include 'admin/views/header.php';
$dataTemplates = array(
    0 => array(
        'panel_name' => lang('general_information'),
        'data_panel' => array(
            0 => array(
                0 => array(
                    'label' => lang('user_sent'),
                    'value' => !empty($data['user_created']) ? "<a href='" . site_url('user/detail/' . $data['user_created']['id']) . "'>" . $data['user_created']['first_name'] . ' ' . $data['user_created']['last_name'] . "</a>" : ''
                ),
                1 => array(
                    'label' => lang('date_sent'),
                    'value' => !empty($data['date_entered']) ? $data['date_entered'] : ''
                )
            ),
            1 => array(
                0 => array(
                    'label' => lang('subject'),
                    'value' => !empty($data['name']) ? $data['name'] : ''
                )
            ),
            2 => array(
                0 => array(
                    'label' => lang('body_email')
                )
            ),
            3 => array(
                0 => array(
                    'value' => !empty($data['content']) ? $data['content'] : ''
                )
            )
        )
    )
);
include 'admin/views/core/detail.php';
include 'admin/views/footer.php';