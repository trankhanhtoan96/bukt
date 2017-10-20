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
            1 => array(
                0 => array(
                    'label' => lang('content'),
                    'type' => 'textarea',
                    'value' => !empty($data['content']) ? $data['content'] : '',
                    'name' => 'content'
                )
            ),
            3 => array(
                0 => array(
                    'label' => lang('excerpt'),
                    'type' => 'textarea',
                    'value' => !empty($data['excerpt']) ? $data['excerpt'] : '',
                    'name' => 'excerpt'
                )
            ),
            4 => array(
                0 => array(
                    'label' => lang('avatar'),
                    'code'=>"<input type='hidden' name='image' value='".(!empty($data['image']) ? $data['image'] : '')."' />
                             <button type='button' class='btn btn-info' id='btn_choose_image'>".lang('choose')."</button>
                             <button type='button' class='btn btn-danger' id='btn_delete_image'>".lang('delete')."</button>"
                ),
                1 => array(
                    'code' => "<img id='img_image' src='" . (!empty($data['image']) ? $data['image'] : '') . "' style='width:150px' />"
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