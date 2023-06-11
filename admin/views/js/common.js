function getChecked(node) {
    let re = false;
    $('input.' + node).each(function (i) {
        if (this.checked) {
            re = true;
        }
    });
    return re;
}

function timestamp() {
    return new Date().getTime();
}

function em_confirm(id, property, token) {
    let url, msg;
/*vot*/    let text = lang('delete_not_recover')
    switch (property) {
        case 'article':
            url = 'article.php?action=del&gid=' + id;
            msg = lang('article_del_sure');
            break;
        case 'draft':
            url = 'article.php?action=del&draft=1&gid=' + id;
            msg = lang('draft_del_sure');
            break;
        case 'tw':
            url = 'twitter.php?action=del&id=' + id;
            msg = lang('twitter_del_sure');
            break;
        case 'comment':
            url = 'comment.php?action=del&id=' + id;
            msg = lang('comment_del_sure');
            break;
        case 'commentbyip':
            url = 'comment.php?action=delbyip&ip=' + id;
            msg = lang('comment_ip_del_sure');
            break;
        case 'link':
            url = 'link.php?action=dellink&linkid=' + id;
            msg = lang('link_del_sure');
            break;
        case 'navi':
            url = 'navbar.php?action=del&id=' + id;
            msg = lang('navi_del_sure');
            break;
        case 'media':
            url = 'media.php?action=delete&aid=' + id;
            msg = lang('attach_del_sure');
            break;
        case 'avatar':
            url = 'blogger.php?action=delicon';
            msg = lang('avatar_del_sure');
            break;
        case 'sort':
            url = 'sort.php?action=del&sid=' + id;
            msg = lang('category_del_sure');
            break;
        case 'del_user':
            url = 'user.php?action=del&uid=' + id;
            msg = lang('user_del_sure');
            break;
        case 'forbid_user':
            url = 'user.php?action=forbid&uid=' + id;
            msg = lang('user_disable_sure');
            text = '';
            break;
        case 'tpl':
            url = 'template.php?action=del&tpl=' + id;
            msg = lang('template_del_sure');
            break;
        case 'reset_widget':
            url = 'widgets.php?action=reset';
            msg = lang('plugin_reset_sure');
            text = '';
            break;
        case 'plu':
            url = 'plugin.php?action=del&plugin=' + id;
            msg = lang('plugin_del_sure');
            break;
        case 'media_sort':
            url = 'media.php?action=del_media_sort&id=' + id;
            msg = lang('media_category_del_sure');
/*vot*/     text = lang('category_not_deleted');
            break;
    }
    swal({
/*vot*/        title: msg, text: text, icon: "warning", buttons: [lang('cancel'), lang('ok')], dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            window.location = url + '&token=' + token;
        }
    });
}

function focusEle(id) {
    try {
        document.getElementById(id).focus();
    } catch (e) {
    }
}

function hideActived() {
    $(".alert-success").slideUp(300);
    $(".alert-danger").slideUp(300);
}

// Click action of [More Options]
let icon_mod = "down";

function displayToggle(id) {
    $("#" + id).toggle();
    if (icon_mod === "down") {
        icon_mod = "right";
        $(".icofont-simple-down").attr("class", "icofont-simple-right")
    } else {
        icon_mod = "down";
        $(".icofont-simple-right").attr("class", "icofont-simple-down")
    }

    Cookies.set('em_' + id, icon_mod, {expires: 365})
}

function doToggle(id) {
    $("#" + id).toggle();
}

function insertTag(tag, boxId) {
    var targetinput = $("#" + boxId).val();
    if (targetinput == '') {
        targetinput += tag;
    } else {
        var n = ',' + tag;
        targetinput += n;
    }
    $("#" + boxId).val(targetinput);
    if (boxId == "tag") $("#tag_label").hide();
}

function isalias(a) {
    var reg1 = /^[\u4e00-\u9fa5\w-]*$/;
    var reg2 = /^[\d]+$/;
    var reg3 = /^post(-\d+)?$/;
    if (!reg1.test(a)) {
        return 1;
    } else if (reg2.test(a)) {
        return 2;
    } else if (reg3.test(a)) {
        return 3;
    } else if (a == 't' || a == 'm' || a == 'admin') {
        return 4;
    } else {
        return 0;
    }
}

function checkform() {
    var a = $.trim($("#alias").val());
    var t = $.trim($("#title").val());

/*vot*/ if (typeof articleTextRecord !== "undefined") {  // When submitting, reset the original text record value to prevent the leaving prompt from appearing
        articleTextRecord = $("textarea[name=logcontent]").text();
    } else {
        pageText = $("textarea").text();
    }
    if (0 == isalias(a)) {
        return true;
    } else {
        alert(lang('alias_link_error'));
        $("#alias").focus();
        return false;
    }
}

function checkalias() {
    var a = $.trim($("#alias").val());
    if (1 == isalias(a)) {
        $("#alias_msg_hook").html('<span id="input_error">' + lang('alias_invalid_chars') + '</span>');
    } else if (2 == isalias(a)) {
        $("#alias_msg_hook").html('<span id="input_error">' + lang('alias_digital') + '</span>');
    } else if (3 == isalias(a)) {
        $("#alias_msg_hook").html('<span id="input_error">' + lang('alias_format_must_be') + '</span>');
    } else if (4 == isalias(a)) {
        $("#alias_msg_hook").html('<span id="input_error">' + lang('alias_system_conflict') + '</span>');
    } else {
        $("#alias_msg_hook").html('');
        $("#msg").html('');
    }
}

function insert_media_img(fileurl, imgsrc) {
    Editor.insertValue('[![](' + imgsrc + ')](' + fileurl + ')\n\n');
}

function insert_media_video(fileurl) {
    Editor.insertValue('<video class=\"video-js\" controls preload=\"auto\" width=\"100%\" data-setup=\'{"aspectRatio":"16:9"}\'> <source src="' + fileurl + '" type=\'video/mp4\' > </video>');
}

function insert_media_audio(fileurl) {
    Editor.insertValue('<audio src="' + fileurl + '" preload="none" controls loop></audio>');
}

function insert_media(fileurl, filename) {
    Editor.insertValue('[' + filename + '](' + fileurl + ')\n\n');
}

function insert_cover(imgsrc) {
    $('#cover_image').attr('src', imgsrc);
    $('#cover').val(imgsrc);
    $('#cover_rm').show();
}

// act 1:auto save 2:save
function autosave(act) {
    const nodeid = "as_logid";
    const timeout = 60000;
    const url = "article_save.php?action=autosave";
    const alias = $.trim($("#alias").val());
    const content = Editor.getMarkdown();
    let ishide = $.trim($("#ishide").val());
    if (ishide === "") {
        $("#ishide").val("y")
    }

    if (alias != '' && 0 != isalias(alias)) {
        $("#msg").show().html(lang('alias_link_error_not_saved'));
        if (act == 0) {
            setTimeout("autosave(1)", timeout);
        }
        return;
    }
    // Do not automatically save when editing published article
    if (act == 1 && ishide == 'n') {
        return;
    }
    // Do not save automatically when the content is empty
    if (act == 1 && content == "") {
        setTimeout("autosave(1)", timeout);
        return;
    }
    // Manual saving is not allowed when the last successful save time is less than one second
    if ((new Date().getTime() - Cookies.get('em_saveLastTime')) < 1000 && act != 1) {
        alert(lang('too_quick'));
        return;
    }
    const btname = $("#savedf").val();
    $("#savedf").val(lang('saving'));
    $('title').text(lang('saving_in') + titleText);
    $("#savedf").attr("disabled", "disabled");
    $.post(url, $("#addlog").serialize(), function (data) {
        data = $.trim(data);
        var isresponse = /.*autosave\_gid\:\d+\_.*/;
        if (isresponse.test(data)) {
            const getvar = data.match(/_gid:([\d]+)_/);
            const logid = getvar[1];
            const d = new Date();
            const h = d.getHours();
            const m = d.getMinutes();
            const s = d.getSeconds();
            const tm = (h < 10 ? "0" + h : h) + ":" + (m < 10 ? "0" + m : m) + ":" + (s < 10 ? "0" + s : s);
            $("#save_info").html(lang('saved_ok_time') + tm);
            $('title').text(lang('saved_ok') + titleText);
            articleTextRecord = $("#addlog textarea[name=logcontent]").val(); // After the save is successful, replace the original text record value with the current text
            Cookies.set('em_saveLastTime', new Date().getTime()); // Put (or update) the save success timestamp into a cookie
            $("#" + nodeid).val(logid);
            $("#savedf").attr("disabled", false).val(btname);
        } else {
            $("#savedf").attr("disabled", false).val(btname);
/*vot*/     $("#save_info").html(lang('save_system_error')).addClass("alert-danger");
            $('title').text(lang('save_failed') + titleText);
        }
    });
    if (act == 1) {
        setTimeout("autosave(1)", timeout);
    }
}

// editor.md: Page AutoSave shortcut: Ctrl + S
const pagetitle = $('title').text();

function pagesave() {
/*vot*/ document.addEventListener('keydown', function (e) {  // Prevents the browser default action from autosave
        if (e.keyCode == 83 && (navigator.platform.match("Mac") ? e.metaKey : e.ctrlKey)) {
            e.preventDefault();
        }
    });
    let url = "page.php?action=save";
    if ($("[name='pageid']").attr("value") < 0) return alert(lang('save_first'));
/*vot*/ if (!$("[name='pagecontent']").html()) return alert(lang('content_empty'));
/*vot*/ $('title').text(lang('saving_in') + ' ' + pagetitle);
    $.post(url, $("#addlog").serialize(), function (data) {
/*vot*/ $('title').text(lang('saved_ok') + pagetitle);
        setTimeout(function () {
            $('title').text(pagetitle);
        }, 2000);
        pageText = $("textarea").text();
    }).fail(function () {
/*vot*/ $('title').text(lang('save_failed') + pagetitle);
/*vot*/ alert(lang('save_failed!'))
    });
}

// toggle plugin
$.fn.toggleClick = function () {
    var functions = arguments;
    return this.click(function () {
        var iteration = $(this).data('iteration') || 0;
        functions[iteration].apply(this, arguments);
        iteration = (iteration + 1) % functions.length;
        $(this).data('iteration', iteration);
    });
};

function removeHTMLTag(str) {
    str = str.replace(/<\/?[^>]*>/g, ''); //Remove HTML tags
    str = str.replace(/[ | ]*\n/g, '\n'); //Remove trailing whitespace
    str = str.replace(/ /ig, '');
    return str;
}

// Select all forms
$(function () {
    $('#checkAll').click(function (event) {
        let tr_checkbox = $('table tbody tr').find('input[type=checkbox]');
        tr_checkbox.prop('checked', $(this).prop('checked'));
        event.stopPropagation();
    });
    // Click on the checkbox in each row of the table, and when the number of checkboxes selected in the table = the number of table rows, set the "checkAll" radio box in the header of the table to be selected, otherwise it is unselected
    $('table tbody tr').find('input[type=checkbox]').click(function (event) {
        let tbr = $('table tbody tr');
        $('#checkAll').prop('checked', tbr.find('input[type=checkbox]:checked').length == tbr.length ? true : false);
        event.stopPropagation();
    });
});

// Select all cards
$(function () {
    $('#checkAllCard').click(function (event) {
        let card_checkbox = $('.card-body').find('input[type=checkbox]');
        card_checkbox.prop('checked', $(this).prop('checked'));
        event.stopPropagation();
    });
    $('.card-body').find('input[type=checkbox]').click(function (event) {
        let cards = $('.card-body');
        $('#checkAllCard').prop('checked', cards.find('input[type=checkbox]:checked').length == cards.length ? true : false);
        event.stopPropagation();
    });
});

// editor.md js hook
var queue = new Array();
var hooks = {
    addAction: function (hook, func) {
        if (typeof (queue[hook]) == "undefined" || queue[hook] == null) {
            queue[hook] = new Array();
        }
        if (typeof func == 'function') {
            queue[hook].push(func);
        }
    }, doAction: function (hook, obj) {
        try {
            for (var i = 0; i < queue[hook].length; i++) {
                queue[hook][i](obj);
            }
        } catch (e) {
        }
    }
}

// Paste upload image
function imgPasteExpand(thisEditor) {
/*vot*/    var listenObj = document.querySelector("textarea").parentNode  // Object to listen for
/*vot*/    var postUrl = './media.php?action=upload';  // emlog image upload address
/*vot*/    var emMediaPhpUrl = "./media.php?action=lib";  // The resource library address of emlog, which is used to asynchronously obtain the uploaded image data

    // By dynamically configuring the read-only mode, the original paste action of the editor is prevented and the cursor position is restored
    function preventEditorPaste() {
        let l = thisEditor.getCursor().line;
        let c = thisEditor.getCursor().ch - 3;

        thisEditor.config({readOnly: true,});
        thisEditor.config({readOnly: false,});
        thisEditor.setCursor({line: l, ch: c});
    }

    // The editor replaces the text by the first few digits of the cursor position
    function replaceByNum(text, num) {
        let l = thisEditor.getCursor().line;
        let c = thisEditor.getCursor().ch;

        thisEditor.setSelection({line: l, ch: (c - num)}, {line: l, ch: c});
        thisEditor.replaceSelection(text);
    }

    // Paste event fires
    listenObj.addEventListener("paste", function (e) {
/*vot*/        if ($('.editormd-dialog').css('display') == 'block') return;  // Exit if editor has dialog
        if (!(e.clipboardData && e.clipboardData.items)) return;

/*vot*/        var pasteData = e.clipboardData || window.clipboardData; // Get the entire contents of the clipboard
/*vot*/        pasteAnalyseResult = new Array;  // Used to store the results of traversal analysis

/*vot*/        for (var i = 0; i < pasteData.items.length; i++) {  // Traverse the data in the analysis clipboard
            var item = pasteData.items[i];

            if ((item.kind == "file") && (item.type.match('^image/'))) {
                var imgData = item.getAsFile();
                if (imgData.size === 0) return;
                pasteAnalyseResult['type'] = 'img';
                pasteAnalyseResult['data'] = imgData;
/*vot*/                break;  // When there is a picture in the pasteboard, jump out of the loop
            }
            ;
        }

/*vot*/        if (pasteAnalyseResult['type'] == 'img') {  // If there is a picture in the clipboard, upload the picture
            preventEditorPaste();
            uploadImg(pasteAnalyseResult['data']);
            return;
        }
    }, false);

    // Upload image
    function uploadImg(img) {
        var formData = new FormData();
        var imgName = lang('paste_upload') + new Date().getTime() + "." + img.name.split(".").pop();

        formData.append('file', img, imgName);
        thisEditor.insertValue(lang('uploading'));
        $.ajax({
            url: postUrl, type: 'post', data: formData, processData: false, contentType: false, xhr: function () {
                var xhr = $.ajaxSettings.xhr();
                if (xhr.upload) {
                    thisEditor.insertValue("....");
                    xhr.upload.addEventListener('progress', function (e) {  // Show upload progress
                        console.log(lang('progress') + e.loaded + ' / ' + e.total);
                        let percent = Math.floor(e.loaded / e.total * 100);
                        if (percent < 10) {
                            replaceByNum('..' + percent + '%', 4);
                        } else if (percent < 100) {
                            replaceByNum('.' + percent + '%', 4);
                        } else {
                            replaceByNum(percent + '%', 4);
                        }
                    }, false);
                }
                return xhr;
            }, success: function (result) {
                console.log(lang('upload_ok_get_result'));
                $.get(emMediaPhpUrl, function (resp) {
                    var image = resp.data.images[0];
                    if (image) {
/*vot*/                 console.log(lang('result_ok'))
/*vot*/                 replaceByNum(`[![](${image.media_icon})](${image.media_url})`, 10);  // The number 10 here corresponds to 'Uploading...100%' which is 10 characters
                    } else {
/*vot*/                 console.log(lang('get_result_fail'))
/*vot*/                 alert(lang('get_result_fail'));
                    }
                })
            }, error: function (result) {
                alert(lang('upload_failed_error'));
                replaceByNum(lang('upload_failed_error'), 6);
            }
        })
    }
}

// Attach the paste upload image function to the js hook located in the article editor and page editor
hooks.addAction("loaded", imgPasteExpand);
hooks.addAction("page_loaded", imgPasteExpand);

function checkupdate() {
    $("#upmsg").html("").addClass("spinner-border text-primary");
    $.get("./upgrade.php?action=check_update", function (result) {
        if (result.code == 1001) {
/*vot*/            $("#upmsg").html(lang('emlog_not_registered') + ", <a href=\"auth.php\">" + lang('register') + "</a>").removeClass();
        } else if (result.code == 1002) {
/*vot*/            $("#upmsg").html(lang('is_latest_version')).removeClass();
        } else if (result.code == 200) {
/*vot*/            $("#upmsg").html(lang('new_ver_available') + result.data.version + ", <a href=\"https://emlog.io/docs/#/changelog\" target=\"_blank\">" + lang('check_for_new') + "</a>, <a id=\"doup\" href=\"javascript:doup('" + result.data.file + "', '" + result.data.sql + "');\">" + lang('update_now') + "</a>").removeClass();
        } else {
/*vot*/            $("#upmsg").html(lang('check_failed')).removeClass();
        }
    });
}

function doup(source, upsql) {
/*vot*/    $("#upmsg").html(lang('updating_now')).addClass("ajaxload");
    $.get('./upgrade.php?action=update&source=' + source + "&upsql=" + upsql, function (data) {
        $("#upmsg").removeClass();
        if (data.match("succ")) {
/*vot*/            $("#upmsg").html(lang('updated_ok'));
        } else if (data.match("error_down")) {
/*vot*/            $("#upmsg").html(lang('update_download_fail'));
        } else if (data.match("error_zip")) {
/*vot*/            $("#upmsg").html(lang('unzip_fail'));
        } else if (data.match("error_dir")) {
/*vot*/            $("#upmsg").html(lang('update_not_writable'));
        } else {
/*vot*/            $("#upmsg").html(lang('update_fail'));
        }
    });
}

function loadTopAddons() {
    $.ajax({
        type: 'GET', url: './store.php?action=top', success: function (resp) {
            $.each(resp.data, function (i, app) {
                let insertBtnHtml;
                let typeName = lang('template');
                let storeUlr = './store.php?';
                if (app.type === 'plu') {
                    typeName = lang('plugin');
                    storeUlr = './store.php?action=plu';
                }
                if (app.price > 0) {
/*vot*/                    insertBtnHtml = lang('price') + app.price + lang('price_unit') + ' <a href="' + app.buy_url + '" target="_blank">' + lang('buy') + '</a>';
                } else {
/*vot*/                    insertBtnHtml = lang('price') + lang('free') + ' <a href="' + storeUlr + '&keyword=' + app.name + '">' + lang('go_store_install') + '</a>';
                }
                const cardHtml = '<div class="col-md-4">' + '<div class="card">' + '<a href="' + app.buy_url + '" target="_blank"><img class="card-img-top" style="max-height: 90px;" src="' + app.icon + '" alt="icon"/></a>' + '<div class="card-body">' + '<div class="card-text text-muted small">' + typeName + app.name + '</div>' + '<p class="card-text d-flex justify-content-between small">' + insertBtnHtml + '</p>' + '</div></div></div>';
                $('#app-list').append(cardHtml);
            });
        },
    });
}

$(function () {
    // Check once the page is loaded
    // Setting interface, if "automatically detect address" is set, set input to read-only to indicate that the item is invalid
    if ($("#detect_url").prop("checked")) {
        $("[name=blogurl]").attr("readonly", "readonly")
    }

    $("#detect_url").click(function () {
        if ($(this).prop("checked")) {
            $("[name=blogurl]").attr("readonly", "readonly")
        } else {
            $("[name=blogurl]").removeAttr("readonly")
        }
    })

    // store app install
    $('.installBtn').click(function (e) {
        e.preventDefault();
        let link = $(this);
        let down_url = link.data('url');
        let type = link.data('type');
/*vot*/        link.text(lang('installing'));
        link.prev(".installMsg").html("").addClass("spinner-border text-primary");

        let url = './store.php?action=install&type=' + type + '&source=' + down_url;
        $.get(url, function (data) {
/*vot*/            link.text(lang('install_free'));
            link.prev(".installMsg").html('<span class="text-danger">' + data + '</span>').removeClass("spinner-border text-primary");
        });
    });
})