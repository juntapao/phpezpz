<?php
require_once '../includes/config.php';
require_once '../classes/ezpz/HTML.php';
require_once '../classes/ezpz/EZPZ.php';
require_once '../classes/ezpz/Excel.php';
require_once '../classes/App.php';
require_once '../includes/app.php';
require_once '../vendors/tcpdf/tcpdf.php';
require_once '../vendors/autoload.php';
set_time_limit(0);
$_SESSION[APP.'_current_url'] = 'http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
if(!(isset($_SESSION[APP.'_token']) && $_SESSION[APP.'_token'] != '')) $_SESSION[APP.'_token'] = bin2hex(random_bytes(32));
echo '<!doctype html><html><head>';
echo HTML::meta(['charset' => 'utf-8']);
switch(DES) {
    case 'Materialize':
        echo HTML::meta(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1']);
        break;
    case 'Bootstrap':
        echo HTML::meta(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
        break;
}
echo HTML::title(NAM);
// PATH CORRECTION
$_SESSION[APP.'_root_url'] = substr($_SESSION[APP.'_current_url'], 0, strpos($_SESSION[APP.'_current_url'], 'login'));
$url_explode = explode('/', $_SERVER['REQUEST_URI']);
$url_explode_count = count($url_explode);
if($url_explode_count > 4) {
    echo '<base href="../" />';
    $_SESSION[APP.'_login_path'] = $_SESSION[APP.'_root_url'].'../../login/';
} else $_SESSION[APP.'_login_path'] = $_SESSION[APP.'_root_url'].'../login/';
// 
$includes = array_merge(array(
    'jquery-3.3.1.min.js'
   ,(DES == 'Materialize' ? 'materialize-1.0.0.min.js' : '')
   ,(DES == 'Bootstrap' ? 'bootstrap-4.1.3.min.js' : '')
   ,'jquery.dataTables.min.js'
   ,'dataTables.bootstrap4.min.js'
   ,'numeral-2.0.6.min.js'
   ,'dropzone-5.2.0.min.js'
   ,'fontawesome-free/js/all.min.js'
   ,(DES == 'Materialize' ? 'materialize-1.0.0.min.css' : '')
   ,(DES == 'Bootstrap' ? 'bootstrap-4.1.3.min.css' : '')
   ,(DES == 'Materialize' ? 'dataTables.material.min.css' : '')
   ,(DES == 'Bootstrap' ? 'dataTables.bootstrap4.min.css' : '')
   ,'fontawesome-free/css/all.min.css'
   ,'dropzone-5.2.0.min.css'
), VND);
foreach($includes as $v) {
    $a = explode('.', $v);
    $x = $a[count($a) - 1];
    switch($x) {
        case 'js':
            echo HTML::script(['src' => '../vendors/'.$v]).HTML::endScript();
            break;
        case 'css':
            echo HTML::link(['rel' => 'stylesheet', 'type' => 'text/css', 'href' => '../vendors/'.$v]);
            break;
    }
}
// CURRENT PAGE CSS INCLUDER
$_SESSION[APP.'_page_name'] = $url_explode[$url_explode_count - 2];
$ezpz_page_css = '../includes/'.$_SESSION[APP.'_page_name'].'.css';
if(file_exists($ezpz_page_css)) echo HTML::link(['rel' => 'stylesheet', 'type' => 'text/css', 'href' => $ezpz_page_css]);
// CHECKER
if($_SESSION[APP.'_current_page'] == 'login') $_SESSION[APP.'_user_id'] = null;
else {
    if(!in_array($_SESSION[APP.'_current_page'], GST)) {
        if(!(isset($_SESSION[APP.'_user_id']) && $_SESSION[APP.'_user_id'] != '')) { // LOGIN VALIDATION
            $_SESSION[APP.'_failure_message'] = 'Invalid Login.  You have been logged out automatically.';
            header('Location: '.$_SESSION[APP.'_login_path']);
        }
    }
//    if(!in_array($_SERVER['REQUEST_URI'], json_decode('['.$_SESSION[APP.'_menu_names'].']'))) { // ACCESSS VALIDATION
//        $_SESSION[APP.'_failure_message'] = 'Invalid Access.  You have been logged out automatically.';
//        header('Location: ../login/');
//    }
}
ob_start();
$sheet = new PhpOffice\PhpSpreadsheet\Spreadsheet();
?>