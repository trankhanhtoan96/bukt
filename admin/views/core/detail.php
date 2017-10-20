<link rel="stylesheet" type="text/css"
      href="<?= base_url('admin/views/' . $this->router->class . '/' . $this->router->method . '.css') ?>"/>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <h1 class="text-center"><?= $data_header ?></h1>
        <?php $this->load->view($this->router->class . '/menu_' . $this->router->method); ?>
        <?php
        foreach ($dataTemplates as $dataPanel) {
            echo "<div class='x_panel'>
                        <div class='x_title'>
                            <a class='collapse-link'>
                                <i class='fa fa-chevron-up'></i>
                                <label style='cursor: pointer'>{$dataPanel['panel_name']}</label>
                            </a>
                        </div>
                        <div class='x_content'>";
            foreach ($dataPanel['data_panel'] as $dataItem) {
                echo "<div class='row'>";
                foreach ($dataItem as $item) {
                    if (isset($dataItem[1])) {
                        echo "<div class='col-sm-6'>";
                    } else {
                        echo "<div class='col-sm-12'>";
                    }
                    if (!empty($item['label'])) {
                        if (isset($dataItem[1])) {
                            echo "<div style='background-color: #f5f5f5;' class='col-xs-4 text-right'><label>{$item['label']}:</label></div><div class='col-xs-8 text-left'>";
                        } else {
                            echo "<div style='background-color: #f5f5f5;' class='col-xs-2 text-right'><label>{$item['label']}:</label></div><div class='col-xs-10 text-left'>";
                        }
                    } else {
                        echo "<div class='col-xs-12 text-left'>";
                    }
                    if (!empty($item['value'])) {
                        echo $item['value'];
                    }
                    echo "</div></div>";
                }
                echo "</div><br/>";
            }
            echo "</div></div>";
        }
        ?>
    </div>
</div>
<script src="<?= base_url('admin/views/' . $this->router->class . '/' . $this->router->method . '.js') ?>"></script>

<?php
$moduleRelationship = $this->relationship_model->get_list('*', array('module_1' => $this->router->class), '', '');
$relationshipPanelCount = 0;
$relationshipPanelName = '';
$relationshipPanelHtml = '';
foreach ($moduleRelationship as $item) {
    if ($this->session->userdata('userLogined')['admin'] == 1 || checkRole($item['module_2'] . '_view')) {
        $relationshipPanelCount++;
        if ($item['order_table'] == '12') {
            $tableRelationship = $item['module_1'] . '_' . $item['module_2'];
        } else {
            $tableRelationship = $item['module_2'] . '_' . $item['module_1'];
        }
        $dataRelationship = $this->{$tableRelationship . '_model'}->get_list('*', array($item['module_1'] . '_id' => $this->uri->segments[3]), 'date_entered', 'DESC', 0, 0);
        $module2 = array();
        foreach ($dataRelationship as $item2) {
            $module2[] = $this->{$item['module_2'] . '_model'}->get($item2[$item['module_2'] . '_id']);
            if ($module2[count($module2) - 1]) {
                $module2[count($module2) - 1]['user_created'] = $this->user_model->get($module2[count($module2) - 1]['user_created']);
                $module2[count($module2) - 1]['user_modifiled'] = $this->user_model->get($module2[count($module2) - 1]['user_modifiled']);
            } else {
                unset($module2[count($module2) - 1]);
            }
        }
        $relationshipPanelName .= "<li role='presentation'><a href='#tab_content{$relationshipPanelCount}' role='tab' data-toggle='tab'>" . lang($item['module_2']) . "</a></li>";

        $relationshipPanelHtml .= "<div role='tabpanel' class='tab-pane' id='tab_content{$relationshipPanelCount}'>";
        $relationshipPanelHtml .= $this->load->view($item['module_2'] . '/list_subpanel', array('dataRelationship' => $dataRelationship, 'data' => $module2, 'module' => $item['module_2'], 'count' => $relationshipPanelCount), true);
        $relationshipPanelHtml .= "</div>";
    }
}
if ($relationshipPanelName != ''): ?>
    <div class="row subpanel_row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <?= $relationshipPanelName ?>
                    </ul>
                    <div id="myTabContent" class="tab-content">
                        <?= $relationshipPanelHtml ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>