<?php
include 'admin/views/header.php';
$dataThead = array(
    0 => array(
        'label' => lang('name'),
        'width' => '20'
    ),
    1 => array(
        'label' => lang('date_entered'),
        'width' => '10'
    ),
    2 => array(
        'label' => lang('date_modifiled'),
        'width' => '10'
    ),
    3 => array(
        'label' => lang('user_created'),
        'width' => '10'
    ),
    4 => array(
        'label' => lang('user_modifiled'),
        'width' => '10'
    )
);
$dataTbody = array();
$dataIds = array();
foreach ($data as $item) {
    $dataTbody[] = array(
        $item['name'],
        $item['date_entered'],
        $item['date_modifiled'],
        $item['user_created']['first_name'] . ' ' . $item['user_created']['last_name'],
        $item['user_modifiled']['first_name'] . ' ' . $item['user_modifiled']['last_name']
    );
    $dataIds[] = $item['id'];
}
include 'admin/views/core/list.php';
include 'admin/views/footer.php';