<?php
include 'admin/views/header.php';
$dataThead = array(
    0 => array(
        'label' => lang('name'),
        'width' => '25'
    ),
    1 => array(
        'label' => lang('description'),
        'width' => '65'
    )
);
$dataTbody = array();
$dataIds = array();
foreach ($data as $item) {
    $dataTbody[] = array(
        $item['name'],
        $item['description']
    );
    $dataIds[] = $item['id'];
}
include 'admin/views/core/list.php';
include 'admin/views/footer.php';