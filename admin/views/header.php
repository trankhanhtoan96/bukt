<!DOCTYPE html>
<html lang="<?= $this->config->item('language') ?>">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?= $this->setting_model->get('icon') ?>"/>
    <title><?= !empty($meta_title) ? $meta_title : lang('admin_page') ?></title>

    <!--define language-->
    <script>
        var CI_language = <?= json_encode($this->lang->language) ?>;
        CI_language.language = '<?= $this->config->item('language') ?>';
        CI_language.base_url = '<?= base_url() ?>';
        CI_language.site_url = '<?= site_url() ?>';
    </script>

    <!--jquery-->
    <script src="<?= base_url('vendors/jquery.min.js') ?>"></script>

    <!--script-->
    <script src="<?= base_url('admin/views/script.js') ?>"></script>

    <!--bootstrap-->
    <link rel="stylesheet" href="<?= base_url('vendors/bootstrap/css/bootstrap.min.css') ?>"/>
    <script src="<?= base_url('vendors/bootstrap/js/bootstrap.min.js') ?>"></script>

    <!--font awesome-->
    <link href="<?= base_url('vendors/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet">

    <!--nprogress-->
    <link href="<?= base_url('vendors/nprogress/nprogress.css') ?>" rel="stylesheet">

    <!--icheck-->
    <link href="<?= base_url('vendors/iCheck/skins/flat/green.css') ?>" rel="stylesheet">

    <!--select 2-->
    <link href="<?= base_url('vendors/select2/css/select2.min.css') ?>" rel="stylesheet">

    <!--multiple select-->
    <link href="<?= base_url('vendors/multiple-select/multiple-select.css') ?>" rel="stylesheet">

    <!--datatables-->
    <link href="<?= base_url('vendors/datatables/css/dataTables.bootstrap.css') ?>" rel="stylesheet">

    <!--alertify-->
    <link href="<?= base_url('vendors/AlertifyJS/alertify.min.css') ?>" rel="stylesheet">

    <!--spinner loading-->
    <link href="<?= base_url('vendors/Spinner/Spinner.css') ?>" rel="stylesheet">

    <!--ckeditor-->
    <script src="<?= base_url('vendors/ckeditor/ckeditor.js') ?>"></script>

    <!--ckfinder-->
    <script src="<?= base_url('vendors/ckfinder/ckfinder.js') ?>"></script>

    <!--admin-->
    <link rel="stylesheet" href="<?= base_url('vendors/admin/custom.min.css') ?>"/>
    <link rel="stylesheet" href="<?= base_url('admin/views/style.css') ?>"/>

</head>
<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;background-color: #FFF">
                    <a href="<?= site_url() ?>" class="site_title">
                        <img class="img-responsive" src="<?= $this->setting_model->get('logo') ?>"/>
                        <!--<img style="width:50px" src="<?= $this->setting_model->get('logo') ?>"/>-->
                        <!--<span>Company Name</span>-->
                    </a>
                </div>
                <div class="clearfix"></div>
                <!-- menu profile quick info -->
                <?php //$userLogined = $this->session->userdata('userLogined'); ?>
                <!--                <div class="profile">
                <!--                    <div class="profile_pic">
                <!--                        <img src="-->
                <? //= $userLogined['avatar'] ?><!--" class="img-circle profile_img">
                <!--                    </div>
                <!--                    <div class="profile_info">
                <span><? //= $userLogined['username'] ?></span>
                <!--                        <h2>-->
                <? //= $userLogined['first_name'] . ' ' . $userLogined['last_name'] ?><!--</h2>-->
                <!--                    </div>-->
                <!--                </div>-->
                <!-- /menu profile quick info -->
                <!--                <br/>-->
                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <!--                        <h3>--><? //= lang('title_menu') ?><!--</h3>-->
                        <ul class="nav side-menu">
                            <?php $this->load->view('menu'); ?>
                        </ul>
                    </div>
                </div>
                <!-- /sidebar menu -->
            </div>
        </div>
        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>
                    <ul class="nav navbar-nav navbar-right">
                        <?php $this->load->view('menu_top'); ?>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- /top navigation -->
        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">
                <div class="clearfix"></div>
<?= !empty($alert) ? '<br/>' . $alert : '' ?>