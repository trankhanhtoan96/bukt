<link rel="stylesheet" type="text/css" href="<?= base_url('admin/views/' . $this->router->class . '/list.css') ?>"/>
<form action="<?= site_url($this->router->class . '/deleteList') ?>" name="ListView" method="post">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <h1 class="text-center"><?= $data_header ?></h1>
            <?php $this->load->view($this->router->class . '/menu_list'); ?>
            <div class="x_panel">
                <div class="x_content">
                    <table id="dataTable" class="table table-striped table-bordered bulk_action">
                        <thead>
                        <tr>
                            <?php if (checkRole($this->router->class . '_delete')): ?>
                                <th style="width:3%;text-align: center"><input type="checkbox" class="flat"
                                                                               id="check-all"/>
                                </th>
                            <?php endif; ?>
                            <th style="width:7%;text-align: center"></th>
                            <?php
                            foreach ($dataThead as $item) {
                                echo "<th style='width: {$item['width']}%;text-align: center'>{$item['label']}</th>";
                            }
                            ?>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($dataTbody as $key => $item) {
                            echo "<tr>";
                            if (checkRole($this->router->class . '_delete')) {
                                echo "<td style='text-align: center'><input type='checkbox' data-check='table_records' class='flat' name='record_selected[]' value='{$dataIds[$key]}'/></td>";
                            }
                            echo "<td style='text-align: center'><a data-toggle='tooltip' style='font-size:16px' title='" . lang('view') . "' href='" . site_url($this->router->class . '/detail/' . $dataIds[$key]) . "'><i class='fa fa-search'></i></a> <b style='font-size:16px'>";
                            if (checkRole($this->router->class . '_edit')) {
                                echo " | </b><a data-toggle='tooltip' style='font-size:16px' title='" . lang('edit') . "' href='" . site_url($this->router->class . '/edit/' . $dataIds[$key]) . "'><i class='fa fa-edit'></i></a></td>";
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
                </div>
            </div>
            <?php $this->load->view($this->router->class . '/menu_list'); ?>
        </div>
    </div>
</form>
<script type="text/javascript">
    $(document).ready(function () {
        $('#dataTable').dataTable({
            "bSort": false
        });
    });
</script>
<script src="<?= base_url('admin/views/' . $this->router->class . '/list.js') ?>"></script>