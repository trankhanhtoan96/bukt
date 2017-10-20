<?php if (checkRole('', true)): ?>
    <a href="<?= site_url($this->router->class . '/edit') ?>" class="btn btn-success"><?= lang('create') ?></a>
    <a href="<?= site_url($this->router->class . '/edit/' . $data_id) ?>"
       class="btn btn-primary"><?= lang('edit') ?></a>
    <a href="<?= site_url($this->router->class . '/delete/' . $data_id) ?>"
       onclick="return confirm(CI_language.confirm_delete)" class="btn btn-default"><?= lang('delete') ?></a>
    <a href="<?= site_url($this->router->class . '/index') ?>" class="btn btn-default"><?= lang('list') ?></a>
<?php endif; ?>