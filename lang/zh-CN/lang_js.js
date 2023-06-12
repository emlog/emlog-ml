var LNG = {
//---------------------------
//admin/views/article_write.php
    'leave_prompt': '离开页面提示',//'Leave page prompt',
    'already_edited': '[已修改] ',//'[already edited] ',

// admin/views/article.php
    'select_article': '请选择文章',//'Please select an article',
    'sure_delete_articles': '确定要删除所选文章吗',//'Are you sure you want to delete the selected articles',

// admin/views/comment.php
    'comment_operation_select': '请选择评论',//'Please select a comment',
    'comment_selected_delete_sure': '确定要删除所选评论吗',//'Are you sure you want to delete the selected comment',

// admin/views/media.php
    'resource_select': '请选择资源文件',//'Please select a resource file',
    'resource_del_sure': '确定要删除所选资源文件吗',//'Are you sure you want to delete the selected resource file',

// admin/views/page.php
    'select_page_to_operate': '请选择页面',//'Please select a page',
    'sure_delete_selected_pages': '确定要删除所选页面吗',//'Are you sure you want to delete the selected page',

//---------------------------
//admin/views/plugin.php
    'update': '更新',//'Update',
    'plugin_update_check_fail': '插件更新检查无法正常进行,错误码:',//'Plug-in update check failed, error code: ',
    'plugin_update_check_exception': '插件更新检查异常： ',//'Plugin update check exception: ',

//---------------------------
//admin/views/signup.php
    'send_email_code': '发送邮件验证码',//'Send email verification code',
    'code_valid_for': '已发送,请查收邮件 ',//'Sent successfully, please check your email in ',
    '_seconds': '秒',//' seconds',
    'test_mail_failed': '发送失败',//'Failed to send',

//---------------------------
//admin/views/tag.php
    'tag_select_del': '请选择要删除的标签',//'Please select a tag to delete',
    'tag_delete_sure': '确定要删除所选标签吗',//'Are you sure you want to delete the selected tags',

//---------------------------
//admin/views/template.php
    'update_api_error': '更新接口返回错误',//'The update interface returned an error',
    'update_request_error': '请求更新接口失败',//'The request to update the interface failed',

//---------------------------
//admin/views/js/common.js
    'twitter_del_sure': '确定要删除该笔记吗？',//'Are you sure you want to delete this note?',
    'comment_del_sure': '确定要删除该评论吗？',//'Are you sure you want to delete this comment?',
    'comment_ip_del_sure': '确定要删除来自该IP的所有评论吗？',//'Are you sure you want to delete all comments from that IP?',
    'link_del_sure': '确定要删除该链接吗？',//'Are you sure you want to delete this link?',
    'navi_del_sure': '确定要删除该导航吗？',//'Are you sure you want to delete this navigation?',
    'attach_del_sure': '确定要删除该媒体文件吗？',//'Are you sure you want to delete this media file?',
    'avatar_del_sure': '确定要删除头像吗？',//'Are you sure you want to delete this avatar?',
    'category_del_sure': '确定要删除该分类吗？',//'Are you sure you want to delete this category?',
    'user_del_sure': '确定要删除该用户吗？',//'Are you sure you want to delete this user?',
    'template_del_sure': '确定要删除该模板吗？',//'Are you sure you want to delete default template?',
    'plugin_reset_sure': '确定要恢复组件设置到初始状态吗？这样会丢失你自定义的组件。',//'Are you sure you want to restore default plugin settings? This operation will lose your custom plugin configuration.',
    'plugin_del_sure': '确定要删除该插件吗？',//'Are you sure you want to delete this plugin?',
    'alias_link_error': '链接别名错误',//'Link Alias error',
    'alias_invalid_chars': '别名错误，应由字母、数字、下划线、短横线组成',//'Alias should contain only latin letters, numbers, underscores and dashes',
    'alias_digital': '别名错误，不能为纯数字',//'Alias cannot contain numbers only',
    'alias_format_must_be': '别名错误，不能为\'post\'或\'post-数字\'',//'Invalid alias. It can not contain \'post\' or \'post-digits\'',
    'alias_system_conflict': '别名错误，与系统链接冲突',//'Alias error (system conflict)',
    'alias_link_error_not_saved': '链接别名错误，自动保存失败',//'Invalid Link Alias. Can not be saved automatically.',
// 'saving'		: '正在保存',//'Saving',
    'saving': '正在保存中...',//'Saving...',
    'saved_ok_time': '保存于：',//'Saved at: ',
    'save_system_error': '保存失败，可能文章不可编辑或达到每日发文限额',//'Failed to save, maybe the article cannot be edited or the daily post limit has been reached',
    'too_quick': '请勿频繁操作！',//'Do not operate frequently!',
    'saving_in': '[保存中] ',//'[Saving] ',
    'saved_ok': '[保存成功] ',//'[Saved successfully]: ',
    'save_failed': '[保存失败] ',//'[Save failed]: ',
    'save_failed!': '保存失败！',//'Save failed!',
    'save_failed_prompt': '保存失败，请备份内容和刷新页面后重试！',//'Failed to save, please backup content, refresh the page and try again!',
    'paste_upload': '粘贴上传 ',//'Paste upload ',
    'uploading': '上传中...',//'Uploading...',
    'progress': '进度(bytes): ',//'Progress (bytes): ',
    'upload_ok_get_result': '上传成功！正在获取结果...',//'Upload successful! Getting results...',
    'result_ok': '获取结果成功！',//'Get the result successfully!',
    'unknown_error': '未知错误',//'Unknown error',
    'upload_failed_error': '上传失败,图片类型错误或网络错误',//'Upload failed, wrong image type or network error',
    'installing': '安装中…',//'Installing...',
    'install_free': '免费安装',//'Install for free',
    'get_result_fail': '获取结果失败！',//'Failed to get result!',

//----
    'backup_import_sure': '你确定要导入该备份文件吗？',//'Are you sure you want to import the backup files?',
    'page_del_sure': '你确定要删除该页面吗？',//'Are you sure you want to delete this page?',
    'title_empty': '标题不能为空',//'Title can not be empty',
    'wysiwyg_switch': '请先切换到所见所得模式',//'Please, switch to WYSIWYG mode',
    'click_view_fullsize': '点击查看原图',//'Click to view full size',
    'user_disable_sure': '确定要禁用该用户吗？',//'Are you sure you want to disable this user?',
    'article_del_sure': '确定要删除该篇文章吗？',//'Are you sure you want to delete this article?',
    'draft_del_sure': '确定要删除该篇草稿吗？',//'Are you sure you want to delete this draft? ',
    'media_category_del_sure': '确定要删除该资源分类吗（不会删除资源文件）？',//'Are you sure you want to delete this resource category (resource files will not be deleted)?',
    'media_select': '请选择要移动的资源',//'Please select a media file to move',
    'delete_not_recover': '删除后可能无法恢复',//'Deleted may not be recoverable',
    'ok': '确定',//'OK',
    'cancel': '取消',//'Cancel',
    'category_not_deleted': '不会删除分类下资源文件',//'The resource files under the category will not be deleted',
    'emlog_not_registered': '您的emlog pro尚未注册',//'Your emlog has not been registered',
    'register': '去注册',//'Register',
    'is_latest_version': '已经是最新版本',//'Already the latest version',
    'update_expired': '更新服务已到期',//'Update service has expired',
    'log_in_renew': '登录官网续期',//'Log in to the official website to renew',
    'new_ver_available': '有可用的新版本 ',//'There is a new version available ',
    'check_for_new': '查看更新内容',//'Check out what\'s new',
    'update_now': '现在更新',//'Update now',
    'check_failed': '检查失败，可能是网络问题',//'Check failed, may be a network problem',
    'updating_now': '正在更新中，请耐心等待',//'Updating, please wait patiently',
    'updated_ok': '恭喜您！更新成功了，请<a href="./">刷新页面</a>开始体验新版emlog',//'Congratulations! The update is successful, please <a href="./">refresh the page</a> to start experiencing the new emlog',
    'update_download_fail': '下载更新失败，可能是服务器网络问题',//'Failed to download the update, it may be a server network problem',
    'unzip_fail': '解压更新失败，可能是你的服务器空间不支持zip模块',//'Failed to decompress and update. your server does not support zip',
    'update_not_writable': '更新失败，目录不可写',//'Update failed, the directory is not writable',
    'update_fail': '更新失败',//'Update failed',
    'save_first': '请先保存页面！',//'Please save the page first!',
    'content_empty': '页面内容不能为空！',//'Page content cannot be empty!',
    'plugin': '插件：',//'Plugin: ',
    'template': '模板：',//'Template: ',
    'buy': '购买',//'Buy',
    'go_store_install': '去商店安装',//'Go to the store to install',
    'free': '免费',//'Free',
    'price': '应用售价',//'Price: ',

//---------------------------
//include/lib/js/common_tpl.js
    'loading': '加载中...',//'Loading...',
    'max_140_bytes': '(回复长度需在140个字内)',//'(Up to 140 characters)',
    'nickname_empty': '(昵称不能为空)',//'(Nickname cannot be empty)',
    'captcha_error': '(验证码错误)',//'(Verification code error)',
    'nickname_disabled': '(不允许使用该昵称)',//'(This nickname is not allowed)',
    'nickname_exists': '(已存在该回复)',//'(This nickname already exists)',
    'comments_disabled': '(禁止回复)',//'(Comments disabled)',
    'comment_ok_moderation': '(回复成功，等待管理员审核)',//'(Your comment saved successfully and is awaiting for moderation.)',
    'chinese_must_have': '评论内容需要包含中文！',//'The comment content must contain Chinese characters!',
    'email_invalid': '邮箱格式错误！',//'The email format is wrong!',
    'url_invalid': '网址格式错误！',//'URL format is wrong!',
    'toc': '目录',//'Table of contents',

//---------------------------
//admin/views/js/dropzone.min.js
    'drag_message': '拖动文件到这里，或者点击后选择上传',//'Drag the file here, or click to upload',

//---------------------------
//admin/views/js/media-lib.js
    'insert_to_article': '插入文章',//'Insert to the article',
    'set_cover': '设为封面',//'Set as cover',
    'file_size': '文件大小：',//'File size: ',

//----------------
// The LAST key. DO NOT EDIT!!!
    '@': '@'
};

//------------------------------
// Return the language var value
function lang(key) {
    if (LNG[key]) {
        val = LNG[key];
    } else {
        val = '{' + key + '}';
    }
    return val;
}
