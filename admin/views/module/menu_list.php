<?php if (checkRole('', true)): ?>
    <a href="<?= site_url($this->router->class . '/edit') ?>" class="btn btn-success"><?= lang('create') ?></a>
    <button type="submit" class="btn btn-default"
            onclick="return confirm(CI_language.confirm_delete)"><?= lang('delete') ?></button>

<?php endif; ?>