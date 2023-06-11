<?php
/**
 * Database operation routing
 *
 * @package EMLOG
 * @link https://emlog.io
 */

class Database {

    public static function getInstance() {
        if (class_exists('mysqli', FALSE)) {
            return MySqlii::getInstance();
        }

        if (class_exists('pdo', false)) {
            return Mysqlpdo::getInstance();
        }

        emMsg(lang('mysql_not_supported'));
    }

}
