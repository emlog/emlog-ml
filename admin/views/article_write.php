<?php if (!defined('EMLOG_ROOT')) {
    exit('error!');
}
?>
<div id="msg" class="fixed-top alert" style="display: none"></div>
<h1 class="h3 mb-4 text-gray-800"><?= $containertitle ?> <span id="save_info"></span></h1>
<form action="article_save.php?action=add" method="post" enctype="multipart/form-data" id="addlog" name="addlog">
    <div class="row">
        <div class="col-xl-12">
            <div id="post" class="form-group">
                <div>
                    <input type="text" name="title" id="title" value="<?= $title ?>" class="form-control" placeholder="<?= lang('post_title') ?>" autofocus required/>
                </div>
                <div id="post_bar" class="small my-3">
                    <a href="#mediaModal" data-toggle="modal" data-target="#mediaModal"><i class="icofont-plus"></i><?= lang('upload_insert') ?></a>
                    <?php doAction('adm_writelog_head') ?>
                </div>
                <div id="logcontent"><textarea><?= $content ?></textarea></div>
            </div>
            <div class="form-group">
                <label><?= lang('post_description') ?>:</label>
                <div id="logexcerpt"><textarea><?= $excerpt ?></textarea></div>
            </div>
            <div class="show_advset" id="displayToggle" onclick="displayToggle('advset');"><?=lang('more_options')?><i class="icofont-simple-right"></i></div>
            <div id="advset" class="shadow-sm p-3 mb-2 bg-white rounded">
                <div class="form-group">
                <label><?= lang('article_cover') ?>:</label>
                <input name="cover" id="cover" class="form-control" placeholder="<?= lang('cover_placeholder') ?>" value="<?= $cover ?>"/>
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <label for="upload_img">
                                <img src="<?= $cover ?: './views/images/cover.svg' ?>" width="200" id="cover_image" class="rounded" alt="<?= lang('cover_image') ?>"/>
                                <input type="file" name="upload_img" class="image" id="upload_img" style="display:none"/>
                                <button type="button" id="cover_rm" class="btn-sm btn btn-link" <?php if (!$cover): ?>style="display:none"<?php endif ?>>x</button>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label><?= lang('category') ?>:</label>
                    <select name="sort" id="sort" class="form-control">
                        <option value="-1"><?= lang('category_select') ?></option>
                        <?php
                        foreach ($sorts as $key => $value):
                            if ($value['pid'] != 0) {
                                continue;
                            }
                            $flg = $value['sid'] == $sortid ? 'selected' : '';
                            ?>
                            <option value="<?= $value['sid'] ?>" <?= $flg ?>><?= $value['sortname'] ?></option>
                            <?php
                            $children = $value['children'];
                            foreach ($children as $key):
                                $value = $sorts[$key];
                                $flg = $value['sid'] == $sortid ? 'selected' : '';
                                ?>
                                <option value="<?= $value['sid'] ?>" <?= $flg ?>>&nbsp; &nbsp; &nbsp; <?= $value['sortname'] ?></option>
                            <?php
                            endforeach;
                        endforeach;
                        ?>
                    </select>
                </div>
                <div class="form-group">
<!--vot-->          <label><?= lang('tags') ?>: <small class="text-muted"><?= lang('tags_tips') ?></small></label>
                    <input name="tag" id="tag" class="form-control" value="<?= $tagStr ?>"/>
                    <?php if ($tags): ?>
                        <span class="small"><a href="javascript:doToggle('tags', 1);"><?= lang('recently_used') ?></a></span>
                        <div id="tags" style="display: none">
                            <?php
                            foreach ($tags as $val) {
                                echo " <a class=\"badge badge-primary\" href=\"javascript: insertTag('{$val['tagname']}','tag');\">{$val['tagname']}</a> ";
                            }
                            ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label><?= lang('publish_time') ?>: <small class="text-muted"><?= lang('publish_time_tips') ?></small></label>
                    <input type="text" maxlength="200" name="postdate" id="postdate" value="<?= $postDate ?>" class="form-control"/>
                </div>
                <div class="form-group">
                    <label><?= lang('link_alias') ?></label>
                    <input name="alias" id="alias" class="form-control" value="<?= $alias ?>"/>
                </div>
                <div class="form-group">
<!--vot-->          <label><?=lang('jump_link')?>: <small class="text-muted"><?=lang('jump_link_info')?></small></label>
                    <input name="link" id="link" type="url" class="form-control" value="<?= $link ?>" placeholder="https://"/>
                </div>
                <div class="form-group">
                    <label><?= lang('access_password') ?>:</label>
                    <input type="text" name="password" id="password" class="form-control" value="<?= $password ?>"/>
                </div>
                <div class="form-group">
                    <input type="checkbox" value="y" name="allow_remark" id="allow_remark" <?= $is_allow_remark ?> />
                    <label for="allow_remark"><?= lang('allow_comments') ?></label>
                </div>
            </div>
            <div id="post_button">
                <input type="hidden" name="ishide" id="ishide" value="<?= $hide ?>"/>
                <input type="hidden" name="as_logid" id="as_logid" value="<?= $logid ?>"/>
                <input type="hidden" name="gid" id="gid" value="<?= $logid ?>"/>
                <input type="hidden" name="author" id="author" value="<?= $author ?>"/>
                <?php if ($logid < 0): ?>
                    <input type="submit" name="pubPost" id="pubPost" value="<?= lang('post_publish') ?>" onclick="return checkform();" class="btn btn-sm btn-success"/>
                    <input type="button" name="savedf" id="savedf" value="<?= lang('save_draft') ?>" onclick="autosave(2);" class="btn btn-sm btn-primary"/>
                <?php else: ?>
                    <input type="submit" value="<?= lang('save_and_return') ?>" onclick="return checkform();" class="btn btn-sm btn-success"/>
                    <input type="button" name="savedf" id="savedf" value="<?= lang('save') ?>" onclick="autosave(2);" class="btn btn-sm btn-primary"/>
                    <?php if ($isdraft) : ?>
                        <input type="submit" name="pubPost" id="pubPost" value="<?= lang('publish') ?>" onclick="return checkform();" class="btn btn-sm btn-success"/>
                    <?php endif ?>
                <?php endif ?>
            </div>
        </div>
    </div>
</form>

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
                    <div><a href="#" id="mediaAdd" class="btn btn-sm btn-success shadow-sm mb-3"><?=lang('upload_files')?></a></div>
                    <div>
                        <?php if (User::haveEditPermission() && $mediaSorts): ?>
                            <select class="form-control" id="media-sort-select">
                                <option value=""><?=lang('select_file_category')?></option>
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
<!-- Cover image cropping -->
<div class="modal fade" id="modal" tabindex="-2" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?= lang('crop_upload') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="img-container">
                    <div class="row">
                        <div class="col-md-11">
                            <img src="" id="sample_image"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal"><?= lang('cancel') ?></button>
                <button type="button" id="crop" class="btn btn-sm btn-success"><?= lang('save') ?></button>
            </div>
        </div>
    </div>
</div>
<script src="./editor.md/editormd.js?t=<?= Option::EMLOG_VERSION_TIMESTAMP ?>"></script>
<!--vot--><?php if (strtolower(LANG) !== 'zh-cn') { ?>
<!--vot--><script src="./editor.md/languages/<?=strtolower(LANG)?>.js"></script>
<!--vot--><?php } ?>
<script>
    $("#alias").keyup(function () {
        checkalias();
    });
    setTimeout("autosave(1)", 60000);
    $("#menu_category_content").addClass('active');
    $("#menu_content").addClass('show');
    $("#menu_write").addClass('active');

    // Editor
    var Editor, Editor_summary;
    $(function () {
        Editor = editormd("logcontent", {
            width: "100%",
            height: 640,
            toolbarIcons: function () {
                return ["undo", "redo", "|", "bold", "del", "italic", "quote", "|", "h1", "h2", "h3", "|", "list-ul", "list-ol", "hr", "|",
                    "link", "image", "video", "preformatted-text", "code-block", "table", "|", "search", "watch", "help", "fullscreen"]
            },
            path: "editor.md/lib/",
            tex: false,
            watch: false,
            htmlDecode: true,
            flowChart: false,
            autoFocus: false,
            sequenceDiagram: false,
            imageUpload: true,
            imageFormats: ["jpg", "jpeg", "gif", "png"],
            imageUploadURL: "media.php?action=upload&editor=1",
            videoUpload: false, //Enable video upload
            syncScrolling: "single",
            onload: function () {
                hooks.doAction("loaded", this);
                //In the large screen mode, the editor displays the preview by default
                if ($(window).width() > 767) {
                    this.watch();
                }
            }
        });
        Editor_summary = editormd("logexcerpt", {
            width: "100%",
            height: 300,
            toolbarIcons: function () {
                return ["undo", "redo", "|", "bold", "del", "italic", "quote", "|", "h1", "h2", "h3", "|", "list-ul", "list-ol", "hr", "|", "link", "image", "|", "watch"]
            },
            path: "editor.md/lib/",
            tex: false,
            watch: false,
            htmlDecode: true,
            flowChart: false,
            autoFocus: false,
            sequenceDiagram: false,
            placeholder: "<?=lang('enter_summary')?>",
            onload: function () {
                hooks.doAction("sum_loaded", this);
            }
        });
        Editor.setToolbarAutoFixed(false);
        Editor_summary.setToolbarAutoFixed(false);
    });

    // Cover image
    $(function () {
        var $modal = $('#modal');
        var image = document.getElementById('sample_image');
        var cropper;
        $('#upload_img').change(function (event) {
            var files = event.target.files;
            var done = function (url) {
                image.src = url;
                $modal.modal('show');
            };
            if (files && files.length > 0) {
                reader = new FileReader();
                reader.onload = function (event) {
                    done(reader.result);
                };
                reader.readAsDataURL(files[0]);
            }
        });
        $modal.on('shown.bs.modal', function () {
            cropper = new Cropper(image, {
                aspectRatio: NaN,
                viewMode: 1
            });
        }).on('hidden.bs.modal', function () {
            cropper.destroy();
            cropper = null;
        });
        $('#crop').click(function () {
            canvas = cropper.getCroppedCanvas({
                width: 650,
                height: 366
            });
            canvas.toBlob(function (blob) {
                var formData = new FormData();
                formData.append('image', blob, 'cover.jpg');
                $.ajax('./article.php?action=upload_cover', {
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        $modal.modal('hide');
                        if (data != "error") {
                            $('#cover_image').attr('src', data);
                            $('#cover').val(data);
                            $('#cover_rm').show();
                        }
                    }
                });
            });
        });

        $('#cover_rm').click(function () {
            $('#cover_image').attr('src', "./views/images/cover.svg");
            $('#cover').val("");
            $('#cover_rm').hide();
        });
    });

    $('#cover').blur(function () {
            c = $('#cover').val();
            if (!c) {
                $('#cover_image').attr('src', "./views/images/cover.svg");
                $('#cover_rm').hide();
                return
            }
            $('#cover_image').attr('src', c);
            $('#cover_rm').show();
        }
    );

    // When leaving the page, if the content of the article has been modified, ask the user whether to leave
    var articleTextRecord;
    hooks.addAction("loaded", function () {
        articleTextRecord = $("textarea[name=logcontent]").text();
    });
    window.onbeforeunload = function (e) {
        if ($("textarea[name=logcontent]").text() == articleTextRecord) return
        e = e || window.event;
        if (e) e.returnValue = lang('leave_prompt');
        return lang('leave_prompt');
    }

    // If the content of the article has been modified, make the page title modified to 'modified'
    var titleText = $('title').text()
    hooks.addAction("loaded", function (obj) {
        obj.config({
            onchange: function () {
                if ($("textarea[name=logcontent]").text() == articleTextRecord) return
                $('title').text(lang('already_edited') + titleText);
            }
        });
    });

    // The global shortcut key of the article editing interface Ctrl (Cmd) + S to save the content
    document.addEventListener('keydown', function (e) {
        if (e.keyCode == 83 && (navigator.platform.match("Mac") ? e.metaKey : e.ctrlKey)) {
            e.preventDefault();
            autosave(2);
        }
    });

    // Use cookie to decide whether to collapse [More Options]
    if (Cookies.get('em_advset') === "right") {
        $("#advset").toggle();
        icon_mod = "right";
        $(".icofont-simple-down").attr("class", "icofont-simple-right")
    } else {
        $(".icofont-simple-right").attr("class", "icofont-simple-down")
    }
</script>
