<?php if (checkRole($this->router->class . '_delete')): ?>
    <a href="<?= site_url($this->router->class . '/delete/' . $data_id) ?>"
       onclick="return confirm(CI_language.confirm_delete)" class="btn btn-default"><?= lang('delete') ?></a>
<?php endif; ?>

<?php if (checkRole($this->router->class . '_view')): ?>
    <a href="<?= site_url($this->router->class . '/index') ?>" class="btn btn-default"><?= lang('list') ?></a>
<?php endif; ?>