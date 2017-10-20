<?php if (checkRole($this->router->class . '_delete')): ?>
    <button type="submit" class="btn btn-default"
            onclick="return confirm(CI_language.confirm_delete)"><?= lang('delete') ?></button>

<?php endif; ?>