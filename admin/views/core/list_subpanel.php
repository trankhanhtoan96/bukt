<link rel="stylesheet" type="text/css" href="<?= base_url('admin/views/' . $module . '/list_subpanel.css') ?>"/>
<table id="dataTable_subpanel_<?= $module . $count ?>" class="table table-striped table-bordered">
    <thead>
    <th style="width:10%;text-align: center"></th>
    <?php
    foreach ($dataThead as $item) {
        echo "<th style='width: {$item['width']}%;text-align: center'>{$item['label']}</th>";
    }
    ?>
    </thead>
    <tbody>
    <?php
    foreach ($dataTbody as $key => $item) {
        echo "<tr><td style='text-align: center'><a data-toggle='tooltip' style='font-size:16px' title='" . lang('view') . "' href='" . site_url($module . '/detail/' . $dataIds[$key]) . "'><i class='fa fa-search'></i></a> <b style='font-size:16px'>";
        if (checkRole($module . '_edit')) {
            echo " | </b><a data-toggle='tooltip' style='font-size:16px' title='" . lang('edit') . "' href='" . site_url($module . '/edit/' . $dataIds[$key]) . "'><i class='fa fa-edit'></i></a></td>";
        }
        foreach ($item as $key2 => $item2) {
            if(!empty($dataThead[$key2]['style'])) {
                echo "<td style='{$dataThead[$key2]['style']}' >{$item2}</td>";
            }else{
                echo "<td>{$item2}</td>";
            }
        }
        echo '</tr>';
    }
    ?>
    </tbody>
</table>
<script type="text/javascript">
    $(document).ready(function () {
        $('#dataTable_subpanel_<?= $module . $count ?>').dataTable({
            "bSort": false
        });
    });
</script>
<script src="<?= base_url('admin/views/' . $module . '/list_subpanel.js') ?>"></script>