<?php
/***************************************************************************************************
APPLICATION
 - APP = affix, NAM = name, BCK = background file located in images folder
 - DES = Materialize or Bootstrap only, remember to add/remove js and css from VENDOR INCLUDES
 - THM = blue, grey, green, red, yellow, cyan, light, dark, purple
 - ADS = active directory server, ADD = active directory domain
 - DAT = php date format
***************************************************************************************************/
define('APP', 'pos_client');
define('NAM', 'Tindahan');
define('BCK', 'store6.png');
define('DES', 'Materialize');
define('THM', '');
define('ADS', '');
define('ADD', '');
define('DAT', 'm/d/Y');
define('HOM', 'dashboard');
/***************************************************************************************************
MYSQL DATABASE
 - DOM = domain, USR = username, PAS = password, DBA = database, PRT = port
***************************************************************************************************/
define('DOM', 'localhost');
define('USR', 'root');
define('PAS', 'pass1234');
define('DBA', 'posezpz');
define('PRT', '3369');
/***************************************************************************************************
VENDOR INCLUDES
 - js and css only, located inside vendors directory
 - take note of the heirarchy
***************************************************************************************************/
define('VND', array(
     'jquery-ui.min.js'
    ,'jquery.kinetic.min.js'
));
/***************************************************************************************************
ALLOW GUESTS
 - include pages here that you allow guest users to access
***************************************************************************************************/
define('GST', array(
     ''
    ,''
));
/***************************************************************************************************
SYSTEM REQUIRED (DO NOT CHANGE)
***************************************************************************************************/
session_start();
$pdo = new PDO('mysql:dbname='.DBA.';host='.DOM.';port='.PRT, USR, PAS);
$pdo->exec('set names utf8');
//include_once $_SERVER['DOCUMENT_ROOT'].'/vendors/Envms/FluentPDO/src/Query.php';
//require '../vendors/fluentpdo-master/src/Query.php';
//require '../vendors/Envms/FluentPDO/src/Query.php';
//$fluent = new Query($pdo);
//$fluent = new $_SERVER['DOCUMENT_ROOT']Query($pdo);
include_once '../classes/ezpz/Common.php';
$ezpz_url_array = explode('/', $_SERVER['REQUEST_URI']);
$_SESSION[APP.'_current_page'] = $ezpz_url_array[count($ezpz_url_array) - 2];
?>