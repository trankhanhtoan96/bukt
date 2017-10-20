<?php
include 'admin/views/header.php';
$dataThead = array(
    0 => array(
        'label' => lang('name'),
        'width' => '40'
    ),
    1 => array(
        'label' => lang('parent_category'),
        'width' => '30'
    ),
    2 => array(
        'label' => lang('date_modifiled'),
        'width' => '20'
    )
);
$dataTbody = array();
$dataIds = array();
foreach ($data as $item) {
    $dataTbody[] = array(
        $item['name'],
        !empty($item['parent']['name']) ? $item['parent']['name'] : lang('[none]'),
        $item['date_modifiled']
    );
    $dataIds[] = $item['id'];
}
include 'admin/views/core/list.php';
include 'admin/views/footer.php';