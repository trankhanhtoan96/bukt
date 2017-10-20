<?php
$dataThead = array(
    0 => array(
        'label' => lang('username'),
        'width' => '10'
    ),
    1 => array(
        'label' => lang('full_name'),
        'width' => '20'
    ),
    2 => array(
        'label' => lang('email'),
        'width' => '20'
    )
);

//custom in each module
if ($this->router->class == 'email_sent' && !empty($module)) {
    $dataThead[3] = array(
        'label' => lang('status'),
        'width' => '40',
        'style'=>'text-align: center'
    );
}

$dataTbody = array();
$dataIds = array();
foreach ($data as $key => $item) {
    $dataIds[] = $item['id'];
    $dataTbody[] = array(
        $item['username'],
        $item['first_name'] . ' ' . $item['last_name'],
        $item['email']
    );

    //custom in each module
    if ($this->router->class == 'email_sent' && !empty($module)) {
        $dataTbody[count($dataTbody)-1][3] = lang('status_email')[$dataRelationship[$key]['status']].' '.$dataRelationship[$key]['date_modifiled'];
    }
}

include 'admin/views/core/list_subpanel.php';