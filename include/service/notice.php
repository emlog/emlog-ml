<?php
/**
 * Service: Notice
 *
 * @package EMLOG
 * @link https://www.emlog.net
 */

class Notice {

    // Send user registration verification code email
    public static function sendRegMailCode($mail) {
        if (!self::smtpServerReady()) {
            return false;
        }
        if (!isset($_SESSION)) {
            session_start();
        }
        $randCode = getRandStr(8, false);
        $_SESSION['mail_code'] = $randCode;
        $_SESSION['mail'] = $mail;

/*vot*/        $title = lang('email_verif_code_title');
/*vot*/        $content = lang('email_verif_code') . $randCode;
        $sendmail = new SendMail();
        $ret = $sendmail->send($mail, $title, $content);
        if ($ret) {
            return true;
        }
        return false;
    }

    public static function sendResetMailCode($mail) {
        if (!self::smtpServerReady()) {
            return false;
        }
        if (!isset($_SESSION)) {
            session_start();
        }
        $randCode = getRandStr(8, false);
        $_SESSION['mail_code'] = $randCode;
        $_SESSION['mail'] = $mail;

        $title = lang('reset_password_code');
        $content = lang('email_verify_code') . $randCode;
        $sendmail = new SendMail();
        $ret = $sendmail->send($mail, $title, $content);
        if ($ret) {
            return true;
        }
        return false;
    }

    public static function sendNewPostMail($post_title) {
        if (!self::smtpServerReady()) {
            return false;
        }
        if (Option::get('mail_notice_post') === 'n') {
            return false;
        }
        $email = self::getFounderEmail();
        if (!$email) {
            return false;
        }
        $title = lang('new_article_review');
        $content = lang('new_article_title') . $post_title;
        $sendmail = new SendMail();
        $ret = $sendmail->send($email, $title, $content);
        if ($ret) {
            return true;
        }
        return false;
    }

    public static function sendNewCommentMail($comment, $gid, $pid) {
        if (!self::smtpServerReady()) {
            return false;
        }
        if (Option::get('mail_notice_comment') === 'n') {
            return false;
        }

        $sendmail = new SendMail();
/*vot*/        $content = lang('new_comment_is') . $comment;
        $article = self::getArticleInfo($gid);

        if (empty($article)) {
            return false;
        }

        if ($pid) {
            $title = lang('new_comment_reply_review');
            $content .= '<br><br>' . lang('from_article') . $article['log_title'];
            $email = self::getCommentAuthorEmail($pid);
        } else {
            $title = lang('new_comment_review');
            $content .= '<br><br>' . lang('from_article') . $article['log_title'];
            $email = self::getArticleAuthorEmail($article['author']);
        }
        if (!$email) {
            return false;
        }
        $sendmail->send($email, $title, $content);
        return true;
    }

    private static function smtpServerReady() {
        if (empty(Option::get('smtp_pw')) || empty(Option::get('smtp_mail'))) {
            return false;
        }
        return true;
    }

    private static function getFounderEmail() {
        $User_Model = new User_Model();
        $user_info = $User_Model->getOneUser(1);
        if (empty($user_info['email'])) {
            return false;
        }
        return $user_info['email'];
    }

    private static function getArticleInfo($gid) {
        $Log_Model = new Log_Model();
        $r = $Log_Model->getOneLogForHome($gid);
        if (isset($r['author'])) {
            return $r;
        }
        return false;
    }

    private static function getArticleAuthorEmail($uid) {
        $User_Model = new User_Model();
        $r = $User_Model->getOneUser($uid);
        if (isset($r['email'])) {
            return $r['email'];
        }
        return false;
    }

    private static function getCommentAuthorEmail($cid) {
        $Comment_Model = new Comment_Model();
        $r = $Comment_Model->getOneComment($cid);
        if (isset($r['mail'])) {
            return $r['mail'];
        }
        return false;
    }

}
