<table id="dataTable" class="table table-striped table-bordered bulk_action">
    <thead>
    <tr>
        <th style="width:3%;text-align: center">
            <input type="checkbox" class="flat" id="check-all"/>
        </th>
        <th style="width:40%;text-align: center"><?= lang('name') ?></th>
        <th style="width:40%;text-align: center"><?= lang('email') ?></th>
        <th style="width:17%;text-align: center"><?= lang('role') ?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($dataTbody as $key => $item): ?>
        <tr>
            <td style='text-align: center'>
                <input type='checkbox' data-check='table_records' class='flat' value='<?= $dataIds[$key] ?>'/>
            </td>
            <td><?= $item[0] ?></td>
            <td><?= $item[1] ?></td>
            <td><label
                    class="label <?= $item[2] == 1 ? 'label-danger' : 'label-primary' ?>"><?= $item[2] == 1 ? lang('admin') : $item[2] ?></label>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>