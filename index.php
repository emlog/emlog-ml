<?php
/**
 * @package EMLOG
 * @link https://emlog.io
 */

require_once 'init.php';

define('TEMPLATE_PATH', TPLS_PATH . Option::get('nonce_templet') . '/');

$emDispatcher = Dispatcher::getInstance();
$emDispatcher->dispatch();
View::output();
