<?php
/*
Plugin Name: Template options plugin
*/
!defined('EMLOG_ROOT') && exit('access deined!');

//Plugin settings page
function plugin_setting_view() {
    TplOptions::getInstance()->setting();
}

//Plugin settings empty function
function plugin_setting() {
}
