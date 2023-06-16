<?php if (!defined('EMLOG_ROOT')) {
    exit('error!');
} ?>
<div class="d-sm-flex align-items-center justify-content-between mb-3">
    <div class="mb-0 text-gray-800">
        <span class="h3"><?= lang('welcome') ?>, <a class="small" href="./blogger.php"><?= $user_cache[UID]['name'] ?></a></span>
        <span class="badge badge-primary ml-2"><?= $role_name ?></span>
    </div>
    <a href="./article.php?action=write" class="btn btn-sm btn-success shadow-sm mt-4"><i class="icofont-pencil-alt-5"></i> <?= lang('article_add') ?></a>
</div>
<div class="row ml-1 mb-1"><?php doAction('adm_main_top') ?></div>
<div class="row">
    <div class="col-lg-6 mb-4">
        <div class="card shadow mb-4">
            <h6 class="card-header"><?= lang('site_info') ?></h6>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="row">
                        <div class="col-xl-4 col-md-6 mb-1">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?= lang('articles_pending') ?></div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><a href="./article.php?checked=n"><?= $sta_cache['checknum'] ?></a></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="icofont-pencil-alt-5 fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6 mb-1">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                <?= lang('pending_review') ?>
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><a href="./comment.php?hide=y"><?= $sta_cache['hidecomnum'] ?></a></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="icofont-comment fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 mb-1">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                <?= lang('user_num') ?>
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><a href="./user.php"><?= count($user_cache) ?></a></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="icofont-user fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <a href="./article.php"><?= lang('articles') ?></a>
                        <a href="./article.php"><span class="badge badge-primary badge-pill"><?= $sta_cache['lognum'] ?></span></a>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <a href="./twitter.php"><?= lang('twitters') ?></a>
                        <a href="./twitter.php?all=y"><span class="badge badge-primary badge-pill"><?= $sta_cache['note_num'] ?></span></a>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <a href="./comment.php"><?= lang('comments') ?></a>
                        <a href="./comment.php"><span class="badge badge-primary badge-pill"><?= $sta_cache['comnum_all'] ?></span></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <?php if (User::isAdmin()): ?>
    <div class="col-lg-6 mb-4">
        <div class="card shadow mb-4">
            <h6 class="card-header"><?= lang('software_info') ?></h6>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        PHP
                        <span class="small"><?= $php_ver ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <?= lang('database') ?>
                        <span class="small">MySQL <?= $mysql_ver ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <?= lang('web_server') ?>
                        <span class="small"><?= $server_app ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        EMLOG
                        <?php if (!Register::isRegLocal()) : ?>
                            <!--vot-->                  <a href="auth.php"><span class="badge badge-secondary"><?= Option::EMLOG_VERSION ?> <?= lang('unregistered') ?>, <?= lang('click_to_register') ?></span></a>
                        <?php elseif (Register::getRegType() == 2): ?>
                            <span class="badge badge-warning"><?= Option::EMLOG_VERSION ?> <?= lang('svip_hard') ?></span>
                        <?php elseif (Register::getRegType() == 1): ?>
                            <span class="badge badge-success"><?= Option::EMLOG_VERSION ?> <?= lang('vip_friend') ?></span>
                        <?php else: ?>
                            <span class="badge badge-success"><?= Option::EMLOG_VERSION ?> <?= lang('registered') ?></span>
                        <?php endif ?>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <a id="ckup" href="javascript:checkupdate();" class="btn btn-success btn-sm"><?= lang('update_check') ?></a>
                        <span id="upmsg"></span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
    <div class="row">
        <?php if (!Register::isRegLocal()) : ?>
            <div class="col-lg-6 mb-4">
                <div class="card shadow">
                    <div class="card-header bg-danger text-white">
                        <h6 class="my-0"><?= lang('emlog_reg_advantages') ?></h6>
                    </div>
                    <div class="card-body">
                        <div><?= lang('advantage1') ?></div>
                        <div><?= lang('advantage2') ?></div>
                        <div><?= lang('advantage3') ?></div>
                        <div><?= lang('advantage4') ?></div>
                        <div><?= lang('advantage5') ?></div>
                        <div><?= lang('advantage6') ?></div>
                    </div>
                    <div class="card-footer text-center">
                        <a href="auth.php" class="btn btn-sm btn-primary shadow-lg"><?= lang('register_now') ?></a>
                        <a href="https://emlog.io/register" target="_blank" class="btn btn-sm btn-success shadow-lg"><?= lang('get_emkey') ?></a>
                    </div>
                </div>
            </div>
        <?php endif ?>
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <h6 class="card-header"><?= lang('official_news') ?></h6>
                <div class="card-body" id="admindex_msg">
                    <ul class="list-group list-group-flush">
                        <li class="msg_type_0"><a href="https://emlog.io/docs/#/faq" target="_blank"><?= lang('help_faq') ?></a></li>
                        <li class="msg_type_0"><a href="https://emlog.io/docs/#/" target="_blank"><?= lang('app_development') ?></a></li>
                        <li class="msg_type_0"><a href="https://emlog.io/docs/#/contact" target="_blank"><?= lang('contacts') ?></a></li>
                        <li class="msg_type_0"><a href="https://github.com/emlog/emlog-ml/discussions" target="_blank"><?= lang('feedback') ?></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <?php if (Register::isRegLocal() && option::get('accept_app_recs') === 'y'): ?>
            <div class="col-lg-6 mb-4">
                <div class="card mb-4">
                    <h6 class="card-header"><?= lang('applied_today') ?> - <a href="./store.php"><?= lang('app_store') ?></a></h6>
                    <div class="card-body" id="admindex_msg">
                        <div class="row" id="app-list"></div>
                    </div>
                </div>
            </div>
            <script>loadTopAddons();</script>
        <?php endif; ?>
    </div>
    <script>
        setTimeout(hideActived, 3600);
        // upgrade
        $("#menu_panel").addClass('active');
        $.get("./upgrade.php?action=check_update", function (result) {
            if (result.code == 200) {
                /*vot*/
                $("#upmsg").html(lang('new_ver_available') + result.data.version + ", <a href=\"https://emlog.io/docs/#/changelog\" target=\"_blank\">" + lang('check_for_new') + "</a>, <a id=\"doup\" href=\"javascript:doup('" + result.data.file + "','" + result.data.sql + "');\">" + lang('update_now') + "</a>").removeClass();
            }
        });
    </script>
<?php endif ?>
<div class="row">
    <?php doAction('adm_main_content') ?>
</div>
