<?php
include 'admin/views/header.php';
$dataTemplates = array(
    0 => array(
        'panel_name' => lang('general_information'),
        'data_panel' => array(
            0 => array(
                0 => array(
                    'label' => lang('page_title'),
                    'type' => 'text',
                    'value' => !empty($data['page_title']) ? $data['page_title'] : '',
                    'name' => 'page_title'
                ),
                1 => array(
                    'code'=>'<input type="hidden" name="input_setting" value="1" />'
                )
            ),
            1 => array(
                0 => array(
                    'label' => lang('page_description'),
                    'type' => 'textarea',
                    'value' => !empty($data['page_description']) ? $data['page_description'] : '',
                    'name' => 'page_description'
                )
            ),
            2 => array(
                0 => array(
                    'label' => lang('logo'),
                    'code'=>"<input type='hidden' name='logo' value='".(!empty($data['logo']) ? $data['logo'] : '')."' />
                             <button type='button' class='btn btn-info' id='btn_choose_logo'>".lang('choose')."</button>
                             <button type='button' class='btn btn-danger' id='btn_delete_logo'>".lang('delete')."</button>"
                ),
                1 => array(
                    'code' => "<img id='img_logo' src='" . (!empty($data['logo']) ? $data['logo'] : '') . "' style='width:150px' />"
                )
            ),
            3 => array(
                0 => array(
                    'label' => lang('icon'),
                    'code'=>"<input type='hidden' name='icon' value='".(!empty($data['icon']) ? $data['icon'] : '')."' />
                             <button type='button' class='btn btn-info' id='btn_choose_icon'>".lang('choose')."</button>
                             <button type='button' class='btn btn-danger' id='btn_delete_icon'>".lang('delete')."</button>"
                ),
                1 => array(
                    'code' => "<img id='img_icon' src='" . (!empty($data['icon']) ? $data['icon'] : '') . "' style='width:150px' />"
                )
            )
        )
    ),
    1 => array(
        'panel_name' => lang('setting_email'),
        'data_panel' => array(
            0 => array(
                0 => array(
                    'label' => lang('mail_host'),
                    'type' => 'text',
                    'value' => !empty($data['mail_host']) ? $data['mail_host'] : '',
                    'name' => 'mail_host'
                ),
                1 => ''
            ),
            1 => array(
                0 => array(
                    'label' => lang('mail_secure'),
                    'type' => 'text',
                    'value' => !empty($data['mail_secure']) ? $data['mail_secure'] : '',
                    'name' => 'mail_secure'
                ),
                1 => array(
                    'label' => lang('mail_port'),
                    'type' => 'text',
                    'value' => !empty($data['mail_port']) ? $data['mail_port'] : '',
                    'name' => 'mail_port'
                )
            ),
            2 => array(
                0 => array(
                    'label' => lang('mail_username'),
                    'type' => 'text',
                    'value' => !empty($data['mail_username']) ? $data['mail_username'] : '',
                    'name' => 'mail_username'
                ),
                1 => array(
                    'label' => lang('mail_password'),
                    'type' => 'text',
                    'value' => !empty($data['mail_password']) ? $data['mail_password'] : '',
                    'name' => 'mail_password'
                )
            ),
            3 => array(
                0 => array(
                    'label' => lang('mail_from'),
                    'type' => 'text',
                    'value' => !empty($data['mail_from']) ? $data['mail_from'] : '',
                    'name' => 'mail_from'
                ),
                1 => array(
                    'label' => lang('mail_from_name'),
                    'type' => 'text',
                    'value' => !empty($data['mail_from_name']) ? $data['mail_from_name'] : '',
                    'name' => 'mail_from_name'
                )
            ),
            4=>array(
                0=>array(
                    'label'=>lang('mail_signature'),
                    'type'=>'textarea',
                    'value' => !empty($data['mail_signature']) ? $data['mail_signature'] : '',
                    'name' => 'mail_signature'
                )
            )
        )
    ),
    2 => array(
        'panel_name' => lang('post'),
        'data_panel' => array(
            0 => array(
                0 => array(
                    'label' => lang('num_posts_per_page'),
                    'type' => 'number',
                    'value' => !empty($data['num_posts_per_page']) ? $data['num_posts_per_page'] : '',
                    'name' => 'num_posts_per_page'
                ),
                1 => ''
            )
        )
    )
);
include 'admin/views/core/edit.php';
include 'admin/views/footer.php';