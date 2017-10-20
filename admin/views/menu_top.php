<?php $userLogined = $this->session->userdata('userLogined'); ?>
<li>
    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        <img src="<?= $userLogined['avatar'] ?>"><?= $userLogined['first_name'].' '.$userLogined['last_name'] ?>
        <span class=" fa fa-angle-down"></span>
    </a>
    <ul class="dropdown-menu dropdown-usermenu pull-right">
        <li><a href="<?= site_url('user/detail/'.$this->session->userdata('userLogined')['id']) ?>"><i class="fa fa-user pull-right"></i> <?= lang('profile') ?></a></li>
        <li><a href="<?= site_url('user/change_password') ?>"><i class="fa fa-key pull-right"></i> <?= lang('change_password') ?></a></li>
        <li><a href="<?= site_url('login/logout') ?>"><i class="fa fa-sign-out pull-right"></i> <?= lang('logout') ?></a></li>
    </ul>
</li>