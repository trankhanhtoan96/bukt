<?php
include 'admin/views/header.php';
$dataTemplates = array(
    0 => array(
        'panel_name' => lang('general_information'),
        'data_panel' => array(
            0 => array(
                0 => array(
                    'label' => lang('old_password'),
                    'type' => 'password',
                    'required' => true,
                    'name' => 'old_password'
                ),
                1 => array(
                    'label' => lang('new_password'),
                    'type' => 'password',
                    'required' => true,
                    'name' => 'new_password'
                )
            )
        )
    )
);
include 'admin/views/core/edit.php';
include 'admin/views/footer.php';
/**
 * nếu có label sẽ hiển thị label, còn không có thì hiển thị field lên phần của label
 * nếu có code sẽ ưu tiên hiển thị code
 * sau đó sẽ hiển thị field theo type nếu không có code
 * nếu không có type sẽ không hiển thị field lên
 * nếu dòng đó chỉ có 1 field sẽ hiển field tràn qua field còn lại,
 * nếu dòng đó chỉ có 2 field, thì sẽ hiển thị đúng form dành cho 2 field
 */