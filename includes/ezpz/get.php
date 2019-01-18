<?php
error_reporting(E_ERROR | E_PARSE);
include_once '../config.php';
include_once '../../classes/ezpz/Common.php';
include_once '../../classes/App.php';
if(hash_equals($_SESSION[APP.'_token'], $_POST['_t'])) {
    $res = App::get($_POST);
    echo preg_replace_callback('/\\\\u([0-9a-fA-F]{4})/', function($match) {
        return mb_convert_encoding(pack('H*', $match[1]), 'UTF-8', 'UCS-2BE');
    }, $res);
} else echo 'Invalid Token';
?>