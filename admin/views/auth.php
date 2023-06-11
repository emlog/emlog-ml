<?php if (!defined('EMLOG_ROOT')) {
    exit('error!');
} ?>
<?php if (isset($_GET['active_reg'])): ?>
    <div class="alert alert-success"><?= lang('em_reg_ok') ?></div><?php endif ?>
<?php if (isset($_GET['error_b'])): ?>
    <div class="alert alert-danger"><?= lang('reg_failed') ?></div><?php endif ?>
<?php if (!Register::isRegLocal()) : ?>
    <div class="container-fluid">
        <div>
            <?php if (isset($_GET['error_store'])): ?>
                <p class="lead text-danger mb-4"><?= lang('ext_store_info') ?></p>
            <?php endif ?>
            <p class="lead text-danger mb-4"><?=lang('emlog_reg_advantages')?></p>
            <ul>
                <li><?=lang('advantage1')?></li>
                <li><?=lang('advantage2')?></li>
                <li><?=lang('advantage3')?></li>
                <li><?=lang('advantage4')?></li>
                <li><?=lang('advantage5')?></li>
                <li><?=lang('advantage6')?></li>
            </ul>
            <hr>
            <a href="#" class="btn btn-sm btn-primary shadow-lg" data-toggle="modal" data-target="#exampleModal"><?= lang('ok_register_now') ?></a>
            <a href="https://emlog.net/register" target="_blank" class="btn btn-sm btn-success shadow-lg"><?=lang('get_emkey')?></a>
        </div>
    </div>
<?php else: ?>
    <div class="container-fluid">
        <div class="text-center">
            <p class="lead text-success mb-4"><?= lang('emlog_reg_ok') ?></p>
        </div>
    </div>
<?php endif ?>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= lang('register_emlog') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="auth.php?action=auth" method="post">
                <div class="modal-body">
                    <div class="form-group">
<!--vot-->              <input class="form-control" id="emkey" name="emkey" placeholder="<?= lang('enter_reg_code') ?>" minlength="32" maxlength="32" required>
                    </div>
                    <div class="form-group">
                        <a href="https://www.emlog.net/register" target="_blank"><?= lang('get_emkey') ?>&rarr; </a>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-success"><?= lang('register') ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(function () {
        $("#menu_store").addClass('active');
        setTimeout(hideActived, 3600);
    });
</script>
