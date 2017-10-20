<li><a href="<?= site_url('home') ?>"><i class="fa fa-dashboard"></i> <?= lang('home') ?></a></li>

<?php if (checkRole('blog_edit') || checkRole('blog_view')): ?>
    <li><a><i class='fa fa-newspaper-o'></i><?= lang('blog') ?><span class='fa fa-chevron-down'></span></a>
        <ul class='nav child_menu'>
            <?php if (checkRole('blog_edit')): ?>
                <li><a href='<?= base_url('admin.php/blog/edit') ?>'><?= lang('create') ?></a></li>
            <?php endif; ?>
            <?php if (checkRole('blog_view')): ?>
                <li><a href='<?= base_url('admin.php/blog/index') ?>'><?= lang('list') ?></a></li>
            <?php endif; ?>
        </ul>
    </li>
<?php endif; ?>

<?php if (checkRole('page_edit') || checkRole('page_view')): ?>
    <li><a><i class='fa fa-newspaper-o'></i><?= lang('page') ?><span class='fa fa-chevron-down'></span></a>
        <ul class='nav child_menu'>
            <?php if (checkRole('page_edit')): ?>
                <li><a href='<?= base_url('admin.php/page/edit') ?>'><?= lang('create') ?></a></li>
            <?php endif; ?>
            <?php if (checkRole('page_view')): ?>
                <li><a href='<?= base_url('admin.php/page/index') ?>'><?= lang('list') ?></a></li>
            <?php endif; ?>
        </ul>
    </li>
<?php endif; ?>

<?php if (checkRole('blog_category_edit') || checkRole('blog_category_view')): ?>
    <li><a><i class='fa fa-database'></i><?= lang('blog_category') ?><span class='fa fa-chevron-down'></span></a>
        <ul class='nav child_menu'>
            <?php if (checkRole('blog_category_edit')): ?>
                <li><a href='<?= base_url('admin.php/blog_category/edit') ?>'><?= lang('create') ?></a></li>
            <?php endif; ?>
            <?php if (checkRole('blog_category_view')): ?>
                <li><a href='<?= base_url('admin.php/blog_category/index') ?>'><?= lang('list') ?></a></li>
            <?php endif; ?>
        </ul>
    </li>
<?php endif; ?>

<?php if (checkRole('setting_edit') && checkRole('setting_view') && checkRole('setting_delete')): ?>

    <li><a target="_blank"
           href="<?= base_url('vendors/ckfinder/ckfinder.html?langCode=' . $this->config->item('language')) ?>"><i
                class="fa fa-image"></i> <?= lang('file_browser') ?></a></li>

    <li><a href="<?= site_url('setting/index') ?>"><i class="fa fa-cogs"></i> <?= lang('setting') ?></a></li>

<?php endif; ?>

<?php if (checkRole('email_edit') || checkRole('email_view') || checkRole('email_send_mail')): ?>
    <li><a><i class='fa fa-envelope'></i><?= lang('email') ?><span class='fa fa-chevron-down'></span></a>
        <ul class='nav child_menu'>
            <?php if (checkRole('email_edit')): ?>
                <li><a href='<?= base_url('admin.php/email/edit') ?>'><?= lang('create') ?></a></li>
            <?php endif; ?>
            <?php if (checkRole('email_view')): ?>
                <li><a href='<?= base_url('admin.php/email/index') ?>'><?= lang('list') ?></a></li>
            <?php endif; ?>
            <?php if (checkRole('email_send_mail')): ?>
                <li><a href='<?= base_url('admin.php/email/send_mail') ?>'><?= lang('send_mail') ?></a></li>
            <?php endif; ?>
            <?php if (checkRole('email_template_view')): ?>
                <li><a href='<?= base_url('admin.php/email_template/index') ?>'><?= lang('email_template') ?></a></li>
            <?php endif; ?>
            <?php if (checkRole('email_sent_view')): ?>
                <li><a href='<?= base_url('admin.php/email_sent/index') ?>'><?= lang('email_sent') ?></a></li>
            <?php endif; ?>
        </ul>
    </li>
<?php endif; ?>


<?php if (checkRole('user_edit') || checkRole('user_view') || checkRole('user_delete')): ?>
    <li><a><i class="fa fa-user"></i><?= lang('user') ?><span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
            <?php if (checkRole('user_edit')): ?>
                <li><a href="<?= site_url('user/edit') ?>"><?= lang('create') ?></a></li>
            <?php endif; ?>
            <?php if (checkRole('user_view')): ?>
                <li><a href="<?= site_url('user/index') ?>"><?= lang('list') ?></a></li>
            <?php endif; ?>
        </ul>
    </li>
<?php endif; ?>

<?php if (checkRole('', true)): ?>
    <li><a><i class='fa fa-key'></i><?= lang('role') ?><span class='fa fa-chevron-down'></span></a>
        <ul class='nav child_menu'>
            <li><a href='<?= site_url('role/edit') ?>'><?= lang('create') ?></a></li>
            <li><a href='<?= site_url('role/index') ?>'><?= lang('list') ?></a></li>
            <li><a href='<?= site_url('module/index') ?>'><?= lang('module') ?></a></li>
        </ul>
    </li>
<?php endif; ?>