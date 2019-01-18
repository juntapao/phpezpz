<?php
if(isset($_SESSION[APP.'_success_message']) && $_SESSION[APP.'_success_message']) {
    EZPZ::row([]);
        EZPZ::col(['small' => '12', 'class' => 'green white-text', 'style' => 'border-radius: 5px;']);
            EZPZ::p($_SESSION[APP.'_success_message'], []);
        EZPZ::endCol();
    EZPZ::endRow();
}
if(isset($_SESSION[APP.'_failure_message']) && $_SESSION[APP.'_failure_message']) {
    EZPZ::row([]);
        EZPZ::col(['small' => '12', 'class' => 'red white-text', 'style' => 'border-radius: 5px;']);
            EZPZ::p($_SESSION[APP.'_failure_message'], []);
        EZPZ::endCol();
    EZPZ::endRow();
}
?>