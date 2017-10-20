<?php
include 'admin/views/header.php';
$dataThead = array(
    0 => array(
        'label' => lang('name'),
        'width' => '40'
    ),
    1 => array(
        'label' => lang('date_modifiled'),
        'width' => '30'
    ),
    2 => array(
        'label' => lang('user_modifiled'),
        'width' => '20'
    )
);
$dataTbody = array();
$dataIds = array();
foreach ($data as $item) {
    $dataTbody[] = array(
        $item['name'],
        $item['date_modifiled'],
        $item['user_modifiled']['first_name'] . ' ' . $item['user_modifiled']['last_name']
    );
    $dataIds[] = $item['id'];
}
include 'admin/views/core/list.php';
include 'admin/views/footer.php';