<?php if (!defined('EMLOG_ROOT')) {
    exit('error!');
} ?>
<?php if (isset($_GET['activated'])): ?>
    <div class="alert alert-success"><?= lang('settings_saved_ok') ?></div><?php endif ?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= lang('settings') ?></h1>
</div>
<div class="panel-heading">
    <ul class="nav nav-pills">
        <li class="nav-item"><a class="nav-link active" href="./setting.php"><?= lang('basic_settings') ?></a></li>
        <li class="nav-item"><a class="nav-link" href="./setting.php?action=user"><?= lang('user_settings') ?></a></li>
        <li class="nav-item"><a class="nav-link" href="./setting.php?action=mail"><?= lang('email_notify') ?></a></li>
        <li class="nav-item"><a class="nav-link" href="./setting.php?action=seo"><?= lang('seo_settings') ?></a></li>
        <li class="nav-item"><a class="nav-link" href="./setting.php?action=api"><?= lang('api_interface') ?></a></li>
        <li class="nav-item"><a class="nav-link" href="./blogger.php"><?= lang('personal_settings') ?></a></li>
    </ul>
</div>
<div class="card shadow mb-4 mt-2">
    <div class="card-body">
        <form action="setting.php?action=save" method="post" name="input" id="input">
            <h4><?= lang('site_info') ?></h4>
            <div class="form-group">
                <label><?= lang('site_title') ?>:</label>
                <input class="form-control" value="<?= $blogname ?>" name="blogname">
            </div>
            <div class="form-group">
                <label><?= lang('site_subtitle') ?>:</label>
                <textarea name="bloginfo" cols="" rows="3" class="form-control"><?= $bloginfo ?></textarea>
            </div>
            <div class="form-group">
                <label><?= lang('site_address') ?>:</label>
                <input class="form-control" value="<?= $blogurl ?>" name="blogurl" type="url">
            </div>
            <div class="form-group form-check">
                <input class="form-check-input" type="checkbox" value="y" name="detect_url" id="detect_url" <?= $conf_detect_url ?> />
                <label class="form-check-label" for="exampleCheck1"><?= lang('detect_url') ?></label>
            </div>

            <div class="form-group">
                <label><?= lang('your_timezone') ?></label>
                <select name="timezone" style="width:320px;" class="form-control">
                    <?php foreach ($tzlist as $key => $value):
                        $ex = $key == $timezone ? "selected=\"selected\"" : '' ?>
                        <option value="<?= $key ?>" <?= $ex ?>><?= $value ?></option>
                    <?php endforeach ?>
                </select>
            </div>

            <div class="form-group">
                <label><?= lang('icp_reg_no') ?></label>
                <input class="form-control" value="<?= $icp ?>" name="icp"/>
            </div>
            <div class="form-group">
                <label><?= lang('home_footer_info') ?> <?= lang('home_footer_info_html') ?></label>
                <textarea name="footer_info" rows="6" class="form-control"><?= $footer_info ?></textarea>
            </div>

            <hr>

            <h4><?= lang('comment_settings') ?></h4>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="y" name="iscomment" id="iscomment" <?= $conf_iscomment ?> />
                <label><?= lang('enable_comments') ?></label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="y" name="ischkcomment" id="ischkcomment" <?= $conf_ischkcomment ?> />
                <label><?= lang('comment_moderation') ?></label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="y" name="comment_code" id="comment_code" <?= $conf_comment_code ?> />
                <label><?= lang('comment_verification_code') ?></label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="y" name="isgravatar" id="isgravatar" <?= $conf_isgravatar ?> />
                <label><?= lang('comment_avatar') ?></label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="y" name="comment_needchinese" id="comment_needchinese" <?= $conf_comment_needchinese ?> />
                <label><?= lang('comment_must_contain_chinese') ?></label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="y" name="comment_paging" id="comment_paging" <?= $conf_comment_paging ?> />
                <label><?= lang('comment_per_page') ?></label>
            </div>
            <div class="form-group form-inline">
                <?= lang('comments_per_page') ?>: <input maxlength="5" style="width:80px;" class="form-control" value="<?= $comment_pnum ?>" name="comment_pnum" type="number" min="0"/>
            </div>
            <div class="form-group form-inline">
        <?= lang('comment_sort') ?>: <select name="comment_order" class="form-control mx-sm-3" style="width: 120px;">
                    <option value="newer" <?= $ex3 ?>><?= lang('new_first') ?></option>
                    <option value="older" <?= $ex4 ?>><?= lang('old_first') ?></option>
                </select>
            </div>
            <div class="form-group form-inline">
                <?= lang('comment_interval') ?> (<?= lang('seconds') ?>): <input class="form-control mx-sm-3" value="<?= $comment_interval ?>" name="comment_interval" style="width:80px;" type="number" min="0"/>
            </div>

            <hr>

            <h4><?= lang('article_settigs') ?></h4>
            <div class="form-group form-inline">
                <label><?= lang('posts_per_page') ?></label>
                <input class="form-control mx-sm-3" style="width:80px;" value="<?= $index_lognum ?>" name="index_lognum" type="number" min="0"/>
            </div>

            <div class="form-group form-inline">
                RSS <?= lang('export') ?> <input maxlength="5" style="width:80px;" value="<?= $rss_output_num ?>" type="number" min="0" class="form-control" name="rss_output_num"/> <?= lang('rss_output_num') ?>
                <select name="rss_output_fulltext" class="form-control">
                    <option value="y" <?= $ex1 ?>><?= lang('full_text') ?></option>
                    <option value="n" <?= $ex2 ?>><?= lang('summary') ?></option>
                </select>
            </div>
            <div class="alert alert-primary">
<!--vot-->            <?=lang('rss_url')?>: <?= $blogurl . 'rss.php' ?>
            </div>

            <hr>

            <h4><?= lang('upload_settings') ?></h4>
            <div class="form-group form-inline">
                <?= lang('php_upload_max_size') ?> <input maxlength="20" style="width:120px;" class="form-control" value="<?= $att_maxsize ?>" name="att_maxsize"/> KB (1M=1024KB)
            </div>
            <div class="form-group form-inline">
                <?= lang('allow_attach_type') ?> <input maxlength="200" style="width:500px;" class="form-control" value="<?= $att_type ?>" name="att_type"/> <?= lang('separate_by_comma') ?>
            </div>
            <div class="form-group form-inline">
                <input type="checkbox" value="y" name="isthumbnail" id="isthumbnail" <?= $conf_isthumbnail ?> /> <?= lang('thumbnail_max_size') ?>
                <input maxlength="5" style="width:80px;" class="form-control" value="<?= $att_imgmaxw ?>" name="att_imgmaxw"/> x
                <input maxlength="5" style="width:80px;" class="form-control" value="<?= $att_imgmaxh ?>" name="att_imgmaxh"/> <?= lang('unit_pixels') ?>
            </div>
            <hr>

<!--vot-->        <h4><?=lang('other_settings')?></h4>
            <div class="form-group form-inline">
<!--vot-->                <label><?=lang('admin_per_page')?></label>
<!--vot-->                <input class="form-control mx-sm-3" style="width:80px;" value="<?= $admin_perpage_num ?>" name="admin_perpage_num" type="number" min="0"/> <?=lang('admin_per_page_tips')?>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="y" name="accept_app_recs" id="accept_app_recs" <?= $conf_accept_app_recs ?> />
                <label><?= lang('today_app_news') ?></label>
            </div>
            <hr>

            <input name="token" id="token" value="<?= LoginAuth::genToken() ?>" type="hidden"/>
            <input type="submit" value="<?= lang('save_settings') ?>" class="btn btn-sm btn-success"/>
        </form>
    </div>
</div>
<script>
    $(function () {
        $("#menu_category_sys").addClass('active');
        $("#menu_sys").addClass('show');
        $("#menu_setting").addClass('active');
        setTimeout(hideActived, 3600);
    });
</script>
