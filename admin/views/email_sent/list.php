<?php
include 'admin/views/header.php';
$dataThead = array(
    0 => array(
        'label' => lang('subject'),
        'width' => '40'
    ),
    1 => array(
        'label' => lang('date_sent'),
        'width' => '30'
    ),
    2 => array(
        'label' => lang('user_sent'),
        'width' => '30'
    )
);
$dataTbody = array();
$dataIds = array();
foreach ($data as $item) {
    $dataTbody[] = array(
        $item['name'],
        $item['date_entered'],
        $item['user_created']['first_name'] . ' ' . $item['user_created']['last_name']
    );
    $dataIds[] = $item['id'];
}
include 'admin/views/core/list.php';
include 'admin/views/footer.php';