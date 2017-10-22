<?php $this->load->view('header'); ?>
<?php
echo createId() . '<br/>';
print_r($GLOBALS['custom_config']);
?>
<?php $this->load->view('footer'); ?>