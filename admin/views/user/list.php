<?php
include 'admin/views/header.php';
$dataThead = array(
    0=>array(
        'label'=>lang('avatar'),
        'width'=>'10'
    ),
    1=>array(
        'label'=>lang('username'),
        'width'=>'10'
    ),
    2=>array(
        'label'=>lang('full_name'),
        'width'=>'20'
    ),
    3=>array(
        'label'=>lang('email'),
        'width'=>'20'
    ),
    4=>array(
        'label'=>lang('phone'),
        'width'=>'10'
    ),
    5=>array(
        'label'=>lang('date_entered'),
        'width'=>'10'
    ),
    6=>array(
        'label'=>lang('role'),
        'width'=>'10'
    )
);
$dataTbody = array();
$dataIds = array();
foreach ($data as $item) {
    $dataTbody[] = array(
        "<img src='{$item['avatar']}' style='width:70px' />",
        $item['username'],
        $item['first_name'].' '.$item['last_name'],
        $item['email'],
        $item['phone'],
        $item['date_entered'],
        $item['role']
    );
    $dataIds[] = $item['id'];
}
include 'admin/views/core/list.php';
include 'admin/views/footer.php';