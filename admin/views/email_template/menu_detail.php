<?php if (checkRole($this->router->class . '_edit')): ?>
    <a href="<?= site_url($this->router->class . '/edit') ?>" class="btn btn-success"><?= lang('create') ?></a>
    <a href="<?= site_url($this->router->class . '/edit/' . $data_id) ?>"
       class="btn btn-primary"><?= lang('edit') ?></a>
<?php endif; ?>
<?php if (checkRole($this->router->class . '_delete')): ?>
    <a href="<?= site_url($this->router->class . '/delete/' . $data_id) ?>"
       onclick="return confirm(CI_language.confirm_delete)" class="btn btn-default"><?= lang('delete') ?></a>
<?php endif; ?>

<?php if (checkRole($this->router->class . '_view')): ?>
    <a href="<?= site_url($this->router->class . '/index') ?>" class="btn btn-default"><?= lang('list') ?></a>
<?php endif; ?>

<?php if (checkRole('email_send_mail')): ?>
    <a href="<?= site_url('email/send_mail/' . $data_id) ?>" class="btn btn-info"><?= lang('send_mail') ?></a>
<?php endif; ?>