<?php
//reveice data of which module name
$dataThead = array(
    0 => array(
        'label' => lang('subject'),
        'width' => '30'
    ),
    1 => array(
        'label' => lang('date_sent'),
        'width' => '20'
    ),
    2 => array(
        'label' => lang('user_sent'),
        'width' => '20'
    )
);

//custom in each module
if ($this->router->class == 'user') {
    $dataThead[3] = array(
        'label' => lang('status'),
        'width' => '20'
    );
}
if ($this->router->class == 'email') {
    $dataThead[3] = array(
        'label' => lang('status'),
        'width' => '20'
    );
}

$dataTbody = array();
$dataIds = array();
foreach ($data as $key => $item) {
    $dataTbody[] = array(
        $item['name'],
        $item['date_entered'],
        $item['user_created']['first_name'] . ' ' . $item['user_created']['last_name']
    );
    $dataIds[] = $item['id'];

    //custom in each module
    if ($this->router->class == 'user') {
        $dataTbody[count($dataTbody)-1][3] = lang('status_email')[$dataRelationship[$key]['status']].' '.$dataRelationship[$key]['date_modifiled'];
    }
    if ($this->router->class == 'email') {
        $dataTbody[count($dataTbody)-1][3] = lang('status_email')[$dataRelationship[$key]['status']].' '.$dataRelationship[$key]['date_modifiled'];
    }
}
include 'admin/views/core/list_subpanel.php';