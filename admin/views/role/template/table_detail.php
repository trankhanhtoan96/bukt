<table class='table table-bordered table-striped'>
    <thead>
    <tr>
        <th style="text-align: left;width:200px;vertical-align: middle"><?= lang('name') ?></th>
        <th style="text-align: center;width:70px;vertical-align: middle"><?= lang('edit') ?></th>
        <th style="text-align: center;width:70px;vertical-align: middle"><?= lang('view') ?></th>
        <th style="text-align: center;width:70px;vertical-align: middle"><?= lang('delete') ?></th>
        <th style="text-align: left;vertical-align: middle"><?= lang('orther') ?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($dataTbody as $key => $item): ?>
        <tr>
            <td style="text-align: left;width:200px;vertical-align: middle"><?= $item[0] ?></td>
            <td style="text-align: center;width:70px;vertical-align: middle"><?= $item[1] ?></td>
            <td style="text-align: center;width:70px;vertical-align: middle"><?= $item[2] ?></td>
            <td style="text-align: center;width:70px;vertical-align: middle"><?= $item[3] ?></td>
            <td style="text-align: left;vertical-align: middle"><?= $item[4] ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>