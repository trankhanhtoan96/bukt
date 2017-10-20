<?php
include 'admin/views/header.php';
$dataThead = array(
    0 => array(
        'label' => lang('name'),
        'width' => '30'
    ),
    1=>array(
        'label'=>lang('blog_category'),
        'width'=>'30'
    ),
    2 => array(
        'label' => lang('date_modifiled'),
        'width' => '20'
    ),
    3 => array(
        'label' => lang('user_modifiled'),
        'width' => '10'
    )
);
$dataTbody = array();
$dataIds = array();
foreach ($data as $item) {
    $dataTbody[] = array(
        $item['name'],
        $item['blog_category'],
        $item['date_modifiled'],
        $item['user_modifiled']['first_name'] . ' ' . $item['user_modifiled']['last_name']
    );
    $dataIds[] = $item['id'];
}
include 'admin/views/core/list.php';
include 'admin/views/footer.php';