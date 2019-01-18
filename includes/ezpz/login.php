<?php
include_once '../config.php';
include_once '../../classes/Login.php';
$data = Login::validate($_POST['username'], $_POST['password']);
if($data) header('Location: ../../'.HOM.'/');
else {
	$_SESSION[APP.'_failure_message'] = 'Invalid Login Credentials.';
	header('Location: ../../login/');
}
?>