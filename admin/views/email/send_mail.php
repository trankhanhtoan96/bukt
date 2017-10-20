<?php
include 'admin/views/header.php';
$dataTemplates = array(
    0 => array(
        'panel_name' => lang('body_email'),
        'data_panel' => array(
            0 => array(
                0 => array(
                    'label' => lang('subject'),
                    'type' => 'text',
                    'value' => !empty($data['subject']) ? $data['subject'] : '',
                    'name' => 'subject',
                    'required'=>true
                )
            ),
            1=>array(
                0=>array(
                    'label'=>lang('body_email'),
                    'type'=>'textarea',
                    'value' => !empty($data['body_email']) ? $data['body_email'] : '',
                    'name'=>'body_email',
                    'required'=>true
                )
            )
        )
    ),
    1 => array(
        'panel_name' => lang('receiver'),
        'data_panel' => array(
            0 => array(
                0 => array(
                    'type' => 'textarea',
                    'name' => 'email_to'
                )
            )
        )
    ),
    2 => array(
        'panel_name' => lang('user'),
        'data_panel' => array(
            0 => array(
                0 => array(
                    'code'=>$data['table_user_email']
                )
            ),
            1 => array(
                0=>array(
                    'code'=>"<button type='button' style='margin-top:5px' class='btn btn-primary btn_add_address'>".lang('add_to')."</button>"
                )
            )
        )
    ),
    3 => array(
        'panel_name' => lang('email'),
        'data_panel' => array(
            0 => array(
                0 => array(
                    'code'=>$data['table_email']
                )
            ),
            1 => array(
                0=>array(
                    'code'=>"<button type='button' style='margin-top:5px' class='btn btn-primary btn_add_address'>".lang('add_to')."</button>"
                )
            )
        )
    )
);
include 'admin/views/core/edit.php';
include 'admin/views/footer.php';