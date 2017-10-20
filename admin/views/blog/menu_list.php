<?php if (checkRole($this->router->class . '_edit')): ?>
    <a href="<?= site_url($this->router->class . '/edit') ?>" class="btn btn-success"><?= lang('create') ?></a>
<?php endif; ?>
<?php if (checkRole($this->router->class . '_delete')): ?>
    <button type="submit" class="btn btn-default"
            onclick="return confirm(CI_language.confirm_delete)"><?= lang('delete') ?></button>

<?php endif; ?>