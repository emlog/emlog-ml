<?php
/**
 * notes
 * @package EMLOG
 * @link https://emlog.in
 */

/**
 * @var string $action
 * @var object $CACHE
 */

const TW_PAGE_COUNT = 20; // Number of notes displayed per page

require_once 'globals.php';

$Twitter_Model = new Twitter_Model();

if (empty($action)) {
    $page = Input::getIntVar('page', 1);
    $all = Input::getStrVar('all');

    $uid = $all === 'y' && user::isAdmin() ? '' : UID;
    $tws = $Twitter_Model->getTwitters($uid, $page, TW_PAGE_COUNT);
    $twnum = $Twitter_Model->getCount($uid);

    $parsedown = new Parsedown();
    $parsedown->setBreaksEnabled(true); //automatic line wrapping

    $subPage = '';
    foreach ($_GET as $key => $val) {
        $subPage .= $key != 'page' ? "&$key=$val" : '';
    }
    $pageurl = pagination($twnum, TW_PAGE_COUNT, $page, "twitter.php?{$subPage}&page=");

    include View::getAdmView('header');
    require_once View::getAdmView('twitter');
    include View::getAdmView('footer');
    View::output();
}

if ($action == 'post') {
    $t = Input::postStrVar('t');

    if (!$t) {
        emDirect("twitter.php?error_a=1");
    }

    // Registered users are limited in the number of posts (including drafts) within 24 hours, when it is 0, it is forbidden to post notes and upload graphic resources
    if (!User::haveEditPermission() && Option::get('posts_per_day') <= 0) {
        emDirect("twitter.php?error_forbid=1");
    }

    $data = [
        'content' => $t,
        'author'  => UID,
        'date'    => time(),
    ];

    $Twitter_Model->addTwitter($data);
    $CACHE->updateCache('sta');
    emDirect("twitter.php?active_t=1");
}

if ($action == 'update') {
    $t = Input::postStrVar('t');
    $id = Input::postIntVar('id');

    if (!$t) {
        emDirect("twitter.php?error_a=1");
    }

    $data = [
        'content' => $t,
    ];

    $Twitter_Model->update($data, $id);
    $CACHE->updateCache('sta');
    emDirect("twitter.php?active_set=1");
}

if ($action == 'del') {
    LoginAuth::checkToken();
    $id = Input::getIntVar('id');
    $Twitter_Model->delTwitter($id);
    $CACHE->updateCache('sta');
    emDirect("twitter.php?active_del=1");
}
