<!DOCTYPE html>
<html lang="vi">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <!--jquery-->
    <script src="<?= base_url('vendors/jquery.min.js') ?>"></script>

    <!--script-->
    <script src="<?= base_url('admin/views/script.js') ?>"></script>

    <!--bootstrap-->
    <link rel="stylesheet" href="<?= base_url('vendors/bootstrap/css/bootstrap.min.css') ?>"/>
    <script src="<?= base_url('vendors/bootstrap/js/bootstrap.min.js') ?>"></script>

    <!--admin-->
    <link rel="stylesheet" href="<?= base_url('vendors/admin/custom.min.css') ?>"/>
    <link rel="stylesheet" href="<?= base_url('admin/views/style.css') ?>"/>

    <!--login css-->
    <link rel="stylesheet" href="<?= base_url('admin/views/login/index.css') ?>"/>

</head>
<body class="login">
<?= isset($alert) ? $alert : ''; ?>
<div class="login_wrapper">
    <div class="animate form login_form">
        <section class="login_content">
            <form action="" method="post">
                <img style="width: 250px" src="<?= $this->setting_model->get('logo') ?>"/><br/><br/>
                <div>
                    <input type="text" class="form-control" placeholder="Username" required="" name="username"/>
                </div>
                <div>
                    <input type="password" class="form-control" placeholder="Password" required="" name="password"/>
                </div>
                <div class="form-inline">
                    <button class="btn btn-default submit" type="submit">Log in</button>
                </div>
                <div class="clearfix"></div>
            </form>
        </section>
    </div>
</div>
<!--admin-->
<script src="<?= base_url('vendors/admin/custom.min.js') ?>"></script>
</body>
</html>