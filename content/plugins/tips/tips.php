<?php
/*
Plugin Name: Tips
Version: 3.0
Plugin URL:
Description: Display a usage tip on the home page of the background, and it can also be used as a demo for plug-in development.
Author: emlog
Author URL: https://emlog.io
*/

!defined('EMLOG_ROOT') && exit('access deined!');

/*vot: Moved to /lang/XX/lang_plugin_tips.php
$array_tips = [
//...
];
vot*/

// Load Plugin Language from content/plugins/PLUGIN_NAME/lang/XX/lang.php
load_language('plugin/tips');


function tips() {
/*vot*/    $array_tips = lang('array_tips');
    $i = mt_rand(0, count($array_tips) - 1);
    $tip = $array_tips[$i];
    echo "<div id=\"tip\"> $tip</div>";
}

addAction('adm_main_top', 'tips');

function tips_css() {
    echo "<style>
    #tip{
        background:url(../content/plugins/tips/icon_tips.gif) no-repeat left 3px;
        padding:3px 18px;
        margin:5px 0px;
        font-size:12px;
        color:#999999;
    }
    </style>\n";
}

addAction('adm_head', 'tips_css');
