<?php
require_once 'includes/config.php';
$_SESSION[APP.'_token'] = null;
header('Location: '.HOM.'/');
?>