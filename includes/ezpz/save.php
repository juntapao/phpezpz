<?php
chdir('../');
include_once 'config.php';
include_once '../classes/'.$_POST['class'].'.php';
class_alias($_POST['class'], 'C');
if(hash_equals($_SESSION[APP.'_token'], $_POST['_token'])) C::save($_POST);
else $_SESSION[APP.'_failure_message'] = 'Invalid Token.';
header('Location: '.$_SESSION[APP."_current_url"]);
?>