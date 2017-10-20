<?php if (checkRole($this->router->class . '_edit')): ?>
    <a href="<?= site_url($this->router->class . '/edit') ?>" class="btn btn-success"><?= lang('create') ?></a>
<?php endif; ?>

<?php if (checkRole($this->router->class . '_delete')): ?>
    <button type="submit" class="btn btn-default"
            onclick="return confirm(CI_language.confirm_delete)"><?= lang('delete') ?></button>
<?php endif; ?>

<?php if (checkRole('email_filter_duplicate')): ?>
    <button type="button" class="btn btn-warning btn_filter_duplicate"><i
            class="fa fa-filter"></i> <?= lang('filter_duplicate') ?></button>
<?php endif; ?>

<?php if (checkRole('email_filter_valid_email')): ?>
    <button type="button" class="btn btn-warning btn_filter_valid_email"><i
            class="fa fa-filter"></i> <?= lang('filter_valid_email') ?></button>
<?php endif; ?>
