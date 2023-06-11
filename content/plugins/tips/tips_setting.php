<?php
if (!defined('EMLOG_ROOT')) {
    die('err');
}
function plugin_setting_view() {
    ?>
    <?php if (isset($_GET['succ'])): ?>
        <div class="alert alert-success"><?= lang('got_it') ?></div>
    <?php endif; ?>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= lang('tips_plugin') ?></h1>
    </div>
    <div class="card shadow mb-4 mt-2">
        <div class="card-body">
            <form method="post">
                <div class="form-group">
                    <p><?= lang('tips_plugin_info') ?></p>
                    <?php tips(); ?>
                    <hr/>
                    <p><?= lang('tips_plugin_info2') ?></p>
                </div>
                <input name="test" type="hidden" class="form-control" value="hello">
                <input type="submit" class="btn btn-success btn-sm" value="<?= lang('ok_i_know') ?>"/>
            </form>
        </div>
    </div>
    <script>
        setTimeout(hideActived, 3600);
        $("#menu_category_ext").addClass('active');
        $("#menu_ext").addClass('show');
        $("#menu_plug").addClass('active');
    </script>
<?php }

if (!empty($_POST)) {
    $ak = isset($_POST['ak']) ? addslashes(trim($_POST['ak'])) : '';

    header('Location:./plugin.php?plugin=tips&succ=1');
}
