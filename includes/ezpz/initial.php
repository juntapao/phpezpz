<?php
require_once 'includes.php';
echo HTML::script(['src' => '../includes/app.js']).HTML::endScript();
echo HTML::script(['src' => '../includes/ezpz/ezpz.js']).HTML::endScript();
echo HTML::link(['rel' => 'stylesheet', 'type' => 'text/css', 'href' => '../includes/ezpz/ezpz.css']);
echo HTML::link(['rel' => 'stylesheet', 'type' => 'text/css', 'href' => '../includes/app.css']);
if(BCK) { ?><style>body { background: url("../images/<?php echo BCK; ?>"); }</style> <?php }
echo '</head><body>';
EZPZ::loading();
EZPZ::confirmation();
EZPZ::information();
require_once '../includes/message.php';
$_SESSION[APP.'_success_message'] = null;
$_SESSION[APP.'_failure_message'] = null;
?>