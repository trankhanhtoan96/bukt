<?php
$dataThead = array(
    0 => array(
        'label' => lang('name'),
        'width' => '50'
    ),
    1 => array(
        'label' => lang('date_modifiled'),
        'width' => '30'
    ),
    2 => array(
        'label' => lang('user_modifiled'),
        'width' => '10'
    )
);
$dataTbody = array();
$dataIds = array();
foreach ($data as $key => $item) {
    $dataTbody[] = array(
        $item['name'],
        $item['date_modifiled'],
        $item['user_modifiled']['first_name'] . ' ' . $item['user_modifiled']['last_name']
    );
    $dataIds[] = $item['id'];
}
include 'admin/views/core/list_subpanel.php';