<?php if (!defined('EMLOG_ROOT')) {
    exit('error!');
} ?>
<form action="page.php?action=save" method="post" enctype="multipart/form-data" id="addlog" name="addlog">
    <h1 class="h3 mb-4 text-gray-800"><?= $containertitle ?></h1>
    <div class="row">
        <div class="col-xl-12">
            <div id="post" class="form-group">
                <div>
                    <input type="text" name="title" id="title" value="<?= $title ?>" class="form-control" placeholder="<?= lang('page_title') ?>"/>
                </div>
                <div id="post_bar">
                </div>
                <div id="post_bar" class="small my-3">
                    <a href="#mediaModal" data-toggle="modal" data-target="#mediaModal"><i class="icofont-plus"></i><?= lang('upload_insert') ?></a>
                    <?php doAction('adm_writelog_head') ?>
                </div>
                <div id="pagecontent"><textarea><?= $content ?></textarea></div>
            </div>

            <div class="form-group">
                <label><?= lang('link_alias') ?></label>
                <input name="alias" id="alias" class="form-control" value="<?= $alias ?>"/>
            </div>
            <div class="form-group">
                <label><?= lang('page_template') ?>:</label>
                <?php if ($customTemplates):
                    $sortListHtml = '<option value=""><?= lang('default') ?></option>';
                    foreach ($customTemplates as $v) {
                        $select = $v['filename'] == $template ? 'selected="selected"' : '';
                        $sortListHtml .= '<option value="' . str_replace('.php', '', $v['filename']) . '" ' . $select . '>' . ($v['comment']) . '</option>';
                    }
                    ?>
                    <select id="template" name="template" class="form-control"><?= $sortListHtml; ?></select>
                    <small class="form-text text-muted"><?= lang('select_tmpl_option') ?></small>
                <?php else: ?>
                    <input class="form-control" id="template" name="template" value="<?= $template ?>">
                    <small class="form-text text-muted"><?= lang('custom_tmpl_info') ?></small>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <input type="checkbox" value="y" name="allow_remark" id="allow_remark" <?= $is_allow_remark ?> />
                <label for="allow_remark"><?= lang('allow_comments') ?></label>
            </div>

            <div id="post_button">
                <input type="hidden" name="ishide" id="ishide" value="<?= $hide ?>"/>
                <input type="hidden" name="pageid" value="<?= $pageId ?>"/>
                <?php if ($pageId < 0): ?>
                    <input type="submit" value="<?= lang('page_publish') ?>" onclick="return checkform();" class="btn btn-sm btn-success"/>
                <?php else: ?>
                    <input type="submit" value="<?= lang('save_and_return') ?>" onclick="return checkform();" class="btn btn-sm btn-success"/>
                <?php endif ?>
            </div>
        </div>
    </div>
</form>
<!--Resource Library-->
<div class="modal" id="mediaModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= lang('resource_library') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-between">
                    <div><a href="#" id="mediaAdd" class="btn btn-sm btn-success shadow-sm mb-3"><?= lang('upload_files') ?></a></div>
                    <div>
                        <?php if (User::haveEditPermission() && $mediaSorts): ?>
                            <select class="form-control" id="media-sort-select">
                                <option value=""><?= lang('select_file_category') ?></option>
                                <?php foreach ($mediaSorts as $v): ?>
                                    <option value="<?= $v['id'] ?>"><?= $v['sortname'] ?></option>
                                <?php endforeach ?>
                            </select>
                        <?php endif ?>
                    </div>
                </div>
                <form action="media.php?action=operate_media" method="post" name="form_media" id="form_media">
                    <div class="row" id="image-list"></div>
                    <div class="text-center">
                        <button type="button" class="btn btn-success btn-sm mt-2" id="load-more"><?=lang('load_more')?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="dropzone-previews" style="display: none;"></div>
<script src="./views/js/dropzone.min.js?t=<?= Option::EMLOG_VERSION_TIMESTAMP ?>"></script>
<script src="./views/js/media-lib.js?t=<?= Option::EMLOG_VERSION_TIMESTAMP ?>"></script>
<script src="./editor.md/editormd.js?t=<?= Option::EMLOG_VERSION_TIMESTAMP ?>"></script>
<? if (strtolower(LANG) !== 'zh-cn') { ?>
    <script src="./editor.md/languages/<?= strtolower(LANG) ?>.js"></script>
<? } ?>
<script>
    $("#menu_category_view").addClass('active');
    $("#menu_view").addClass('show');
    $("#menu_page").addClass('active');

    checkalias();
    $("#alias").keyup(function () {
        checkalias();
    });
    $("#title").focus(function () {
        $("#title_label").hide();
    });
    $("#title").blur(function () {
        if ($("#title").val() == '') {
            $("#title_label").show();
        }
    });
    if ($("#title").val() != '') $("#title_label").hide();

    var Editor;
    $(function () {
        Editor = editormd("pagecontent", {
            width: "100%",
            height: 640,
            toolbarIcons: function () {
                return ["undo", "redo", "|",
                    "bold", "del", "italic", "quote", "|",
                    "h1", "h2", "h3", "|",
                    "list-ul", "list-ol", "hr", "|",
                    "link", "image", "preformatted-text", "table", "|", "watch", "help"]
            },
            path: "editor.md/lib/",
            tex: false,
            flowChart: false,
            watch: false,
            htmlDecode: true,
            sequenceDiagram: false,
            syncScrolling: "single",
            onload: function () {
                hooks.doAction("page_loaded", this);
                //In the large screen mode, the editor displays the preview by default
                if ($(window).width() > 767) {
                    this.watch();
                }
            }
        });
        Editor.setToolbarAutoFixed(false);


    });
    // When leaving the page, if the page content has been modified, ask the user whether to leave
    var pageText;
    hooks.addAction("page_loaded", function () {
        pageText = $("textarea").text();
    });
    window.onbeforeunload = function (e) {
        if ($("textarea").text() == pageText) return
        e = e || window.event;
        if (e) e.returnValue = lang('leave_prompt');
        return lang('leave_prompt');
    }

    // Global shortcut keys on page editing interface Ctrl (Cmd) + S to save content
    document.addEventListener('keydown', function (e) {
        if (e.keyCode == 83 && (navigator.platform.match("Mac") ? e.metaKey : e.ctrlKey)) {
            e.preventDefault();
            pagesave();
        }
    });
</script>
