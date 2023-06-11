<?php
/**
 * comment controller
 *
 * @package EMLOG
 * @link https://www.emlog.net
 */

class Comment_Controller {
    function addComment($params) {
        $name = Input::postStrVar('comname');
        $content = Input::postStrVar('comment');
        $mail = Input::postStrVar('commail');
        $url = Input::postStrVar('comurl');
        $imgcode = strtoupper(Input::postStrVar('imgcode'));
        $blogId = Input::postIntVar('gid', -1);
        $pid = Input::postIntVar('pid');
        $resp = Input::postStrVar('resp'); // eg: json (only support json now)
        $uid = 0;

        if (ISLOGIN === true) {
            $User_Model = new User_Model();
            $user_info = $User_Model->getOneUser(UID);
            $name = addslashes($user_info['name_orig']);
            $mail = addslashes($user_info['email']);
            $url = addslashes(BLOG_URL);
            $uid = UID;
        }

        if ($url && strncasecmp($url, 'http', 4)) {
            $url = 'https://' . $url;
        }

        doAction('comment_post');

        $Comment_Model = new Comment_Model();
        $Comment_Model->setCommentCookie($name, $mail, $url);
        $err = '';
        if ($Comment_Model->isLogCanComment($blogId) === false) {
            $err = lang('comment_error_comment_disabled');
        } elseif (User::isVistor() && $Comment_Model->isCommentTooFast() === true) {
            $err = lang('comment_error_flood_control');
        } elseif (empty($name)) {
            $err = lang('comment_error_name_enter');
        } elseif (strlen($name) > 20) {
            $err = lang('comment_error_name_invalid');
        } elseif ($mail !== '' && !checkMail($mail)) {
            $err = lang('comment_error_email_invalid');
        } elseif (empty($content)) {
            $err = lang('comment_error_empty');
        } elseif (strlen($content) > 60000) {
            $err = lang('comment_error_content_invalid');
        } elseif (User::isVistor() && Option::get('comment_needchinese') == 'y' && !preg_match('/[\x{4e00}-\x{9fa5}]/iu', $content)) {
            $err = lang('comment_error_national_chars');
        } elseif (ISLOGIN === false && Option::get('comment_code') == 'y' && session_start() && (empty($imgcode) || $imgcode !== $_SESSION['code'])) {
            $err = lang('comment_error_captcha_invalid');
        }

        if ($err) {
            $resp === 'json' ? Output::error($err) : emMsg($err);
        }
        $r = $Comment_Model->addComment($uid, $name, $content, $mail, $url, $blogId, $pid);
        $cid = isset($r['cid']) ? $r['cid'] : 0;
        $hide = isset($r['hide']) ? $r['hide'] : '';

        $_SESSION['code'] = null;
        notice::sendNewCommentMail($content, $blogId, $pid);

        if ($hide === 'y') {
/*vot*/            $msg = lang('comment_wait_approve');
            $resp === 'json' ? Output::ok($msg) : emMsg($msg);
        }
        if ($resp === 'json') {
            Output::ok(['cid' => $cid]);
        } else {
            emDirect(Url::log($blogId) . '#' . $cid);
        }
    }
}
