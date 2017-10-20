<table id="dataTableEmail" class="table table-striped table-bordered bulk_action">
    <thead>
    <tr>
        <th style="width:3%;text-align: center">
            <input type="checkbox" class="flat" id="check-all"/>
        </th>
        <th><?= lang('name') ?></th>
        <th><?= lang('email') ?></th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($dataTbody as $key => $item) {
        echo "<tr><td style='text-align: center'><input type='checkbox' data-check='table_records' class='flat' value='{$dataIds[$key]}'/></td>";
        foreach ($item as $item2) {
            echo "<td>{$item2}</td>";
        }
        echo '</tr>';
    }
    ?>
    </tbody>
</table>