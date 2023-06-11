<?php if (!defined('EMLOG_ROOT')) {
    exit('error!');
} ?>
<?php if (isset($_GET['active_del'])): ?>
    <div class="alert alert-success"><?= lang('tag_delete_ok') ?></div><?php endif ?>
<?php if (isset($_GET['active_edit'])): ?>
    <div class="alert alert-success"><?= lang('tag_modify_ok') ?></div><?php endif ?>
<?php if (isset($_GET['error_a'])): ?>
    <div class="alert alert-danger"><?= lang('tag_select') ?></div><?php endif ?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= lang('tag_management') ?></h1>
</div>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row justify-content-between">
            <div class="form-inline">
                <h6 class="m-2 font-weight-bold"><?= lang('tags_total') ?> (<?= $tags_count ?>)</h6>
            </div>
            <form action="tag.php" method="get">
                <div class="form-inline search-inputs-nowrap">
                    <input type="text" name="keyword" value="<?= $keyword ?>" class="form-control m-1 small" placeholder="<?= lang('tag_search') ?>">
                    <div class="input-group-append">
                        <button class="btn btn-sm btn-success" type="submit">
                            <i class="icofont-search-2"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <form action="tag.php?action=operate_tag" method="post" name="form_tag" id="form_tag">
        <div class="card-body">
            <div>
                <?php if ($tags): ?>
                    <?php foreach ($tags

                                   as $key => $v):
                        $count = count(explode(',', $v['gid']));
                        $count_style = $count > 0 ? 'text-muted' : 'text-danger';
                        ?>
                        <div class="badge badge-light m-3 p-2">
                            <h5><a href="#" data-toggle="modal" data-target="#editModal" data-tid="<?= $v['tid'] ?>"
                                   data-tagname="<?= $v['tagname'] ?>"><?= $v['tagname'] ?></a></h5>
                            <small class="<?= $count_style ?>">(<?= lang('articles') ?>: <?= $count ?>)</small>
                            <input type="checkbox" name="tids[]" value="<?= $v['tid'] ?>" class="tids align-top"/>
                        </div>
                    <?php endforeach ?>
                <?php else: ?>
                    <p class="m-3"><?= lang('tags_no_info') ?></p>
                <?php endif ?>
            </div>
        </div>
        <div class="form-row align-items-center mx-4">
            <input name="token" id="token" value="<?= LoginAuth::genToken() ?>" type="hidden"/>
            <input name="operate" id="operate" value="" type="hidden"/>
            <div class="col-auto my-1">
                <div class="custom-control custom-checkbox mr-sm-2">
                    <input type="checkbox" class="custom-control-input" id="checkAllCard">
                    <label class="custom-control-label" for="checkAllCard"><?= lang('select_all') ?></label>
                </div>
            </div>
            <div class="col-auto my-1 form-inline">
                <a href="javascript:tagact('del');" class="btn btn-sm btn-danger"><?= lang('delete') ?></a>
            </div>
        </div>
        <div class="page"><?= $pageurl ?></div>
    </form>
</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= lang('tag_edit') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="tag.php?action=update_tag">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="tagname" name="tagname" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" value="" id="tid" name="tid"/>
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal"><?= lang('cancel') ?></button>
                    <button type="submit" class="btn btn-sm btn-success"><?= lang('save') ?></button>
                    <a class="btn btn-sm btn-outline-danger" href="javascript:deltags();"><?= lang('delete') ?></a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(function () {
        $("#menu_category_content").addClass('active');
        $("#menu_content").addClass('show');
        $("#menu_tag").addClass('active');
        setTimeout(hideActived, 3600);

        $('#editModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var tagname = button.data('tagname')
            var tid = button.data('tid')
            var modal = $(this)
            modal.find('.modal-body input').val(tagname)
            modal.find('.modal-footer input').val(tid)
        })
    });

    function tagact(act) {
        if (getChecked('tids') === false) {
            swal("", lang('tag_select_del'), "info");
            return;
        }

        if (act == 'del') {
            swal({
                title: lang('tag_delete_sure'),
                text: lang('delete_not_recover'),
                icon: 'warning',
                buttons: [lang('cancel'), lang('ok')],
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $("#operate").val(act);
                    $("#form_tag").submit();
                }
            });
            return;
        }
        $("#operate").val(act);
        $("#form_media").submit();
    }

    function deltags() {
        var tid = $('#tid').val()
        swal({
            /*vot*/     title: lang('tag_delete_sure'),
            /*vot*/     text: lang('delete_not_recover'),
            icon: 'warning',
            /*vot*/     buttons: [lang('cancel'), lang('ok')],
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                window.open("./tag.php?action=del_tag&token=<?= LoginAuth::genToken() ?>&tid=" + tid, "_self");
            }
        });
    }
</script>
