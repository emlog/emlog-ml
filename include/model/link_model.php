<?php
/**
 * links model
 * @package EMLOG
 * @link https://emlog.io
 */

class Link_Model {

    private $db;

    function __construct() {
        $this->db = Database::getInstance();
    }

    function getLinks() {
        $res = $this->db->query("SELECT * FROM " . DB_PREFIX . "link ORDER BY taxis ASC");
        $links = [];
        while ($row = $this->db->fetch_array($res)) {
            $row['sitename'] = htmlspecialchars($row['sitename']);
            $row['description'] = htmlClean($row['description'], false);
            $row['siteurl'] = $row['siteurl'];
            $links[] = $row;
        }
        return $links;
    }

    function updateLink($linkData, $linkId) {
        $Item = [];
        foreach ($linkData as $key => $data) {
            $Item[] = "$key='$data'";
        }
        $upStr = implode(',', $Item);
/*vot*/        $this->db->query("UPDATE " . DB_PREFIX . "link SET $upStr WHERE id=$linkId");
    }

    function addLink($name, $url, $des) {
/*vot*/        $sql = "INSERT INTO " . DB_PREFIX . "link (sitename,siteurl,description) VALUES('$name','$url','$des')";
        $this->db->query($sql);
    }

    function deleteLink($linkId) {
/*vot*/        $this->db->query("DELETE FROM " . DB_PREFIX . "link WHERE id=$linkId");
    }

}
