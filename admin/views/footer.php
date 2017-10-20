<div class="clearfix"></div>
</div>
</div>
<!-- /page content -->
<!-- footer content -->
<footer>
    <div class="pull-left">
        &copy; <?= date('Y') ?> - Trần Khánh Toàn
    </div>
    <div class="pull-right">
        <form method="get" name="form_change_ci_language" id="form_change_ci_language">
            <select class="form-control" name="ci_change_language_to" id="ci_change_language_to">
                <option value="vi" <?= $this->config->item('language') == 'vi' ? 'selected' : '' ?>>Tiếng việt</option>
                <option value="en" <?= $this->config->item('language') == 'en' ? 'selected' : '' ?>>English</option>
            </select>
        </form>
        <script type="text/javascript">
            $('#ci_change_language_to').on('change', function () {
                $('#form_change_ci_language').submit();
            });
        </script>
    </div>
    <div class="clearfix"></div>
</footer>
<!-- /footer content -->
</div>
</div>

<!--nprogress-->
<script src="<?= base_url('vendors/nprogress/nprogress.js') ?>"></script>

<!--datatables-->
<script src="<?= base_url('vendors/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?= base_url('vendors/datatables/dataTables.bootstrap.js') ?>"></script>

<!--alertify-->
<script src="<?= base_url('vendors/AlertifyJS/alertify.min.js') ?>"></script>

<!--fastclick-->
<script src="<?= base_url('vendors/fastclick/lib/fastclick.js') ?>"></script>

<!--icheck-->
<script src="<?= base_url('vendors/iCheck/icheck.min.js') ?>"></script>

<!--select2-->
<script src="<?= base_url('vendors/select2/js/select2.full.min.js') ?>"></script>

<!--multiple select-->
<script src="<?= base_url('vendors/multiple-select/multiple-select.js') ?>"></script>

<!--autosize-->
<script src="<?= base_url('vendors/autosize/autosize.min.js') ?>"></script>

<!--spinner loading-->
<script src="<?= base_url('vendors/Spinner/Spinner.js') ?>"></script>

<!--admin-->
<script src="<?= base_url('vendors/admin/custom.min.js') ?>"></script>
</body>
</html>