,<?php
include 'admin/views/header.php';
$dataTemplates = array(
    0 => array(
        'panel_name' => lang('general_information'),
        'data_panel' => array(
            0 => array(
                0 => array(
                    'label' => lang('avatar'),
                    'value' => "<img style='width: 150px' " . (!empty($data['image']) ? 'src="' . $data['image'] . '"' : '') . " />"
                )
            ),
            1 => array(
                0 => array(
                    'label' => lang('name'),
                    'value' => !empty($data['name']) ? $data['name'] : ''
                )
            ),
            2 => array(
                0 => array(
                    'label' => lang('user_created'),
                    'value' => !empty($data['user_created']) ? "<a href='" . site_url('user/detail/' . $data['user_created']['id']) . "'>" . $data['user_created']['first_name'] . ' ' . $data['user_created']['last_name'] . "</a>" : ''
                ),
                1 => array(
                    'label' => lang('user_modifiled'),
                    'value' => !empty($data['user_modifiled']) ? "<a href='" . site_url('user/detail/' . $data['user_modifiled']['id']) . "'>" . $data['user_modifiled']['first_name'] . ' ' . $data['user_modifiled']['last_name'] . "</a>" : ''
                )
            ),
            3 => array(
                0 => array(
                    'label' => lang('date_entered'),
                    'value' => !empty($data['date_entered']) ? $data['date_entered'] : ''
                ),
                1 => array(
                    'label' => lang('date_modifiled'),
                    'value' => !empty($data['date_modifiled']) ? $data['date_modifiled'] : ''
                )
            ),
            4 => array(
                0 => array(
                    'label' => lang('excerpt'),
                    'value' => !empty($data['excerpt']) ? $data['excerpt'] : ''
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
                    'value' => !empty($data['seo_title']) ? $data['seo_title'] : ''
                ),
                1 => array(
                    'label' => lang('meta_description'),
                    'value' => !empty($data['seo_description']) ? $data['seo_description'] : ''
                )
            )
        )
    ),
    2 => array(
        'panel_name' => lang('rewrite_url'),
        'data_panel' => array(
            0 => array(
                0 => array(
                    'value' => !empty($data['rewrite_url']) ? $data['rewrite_url'] : ''
                )
            )
        )
    )
);
include 'admin/views/core/detail.php';
include 'admin/views/footer.php';