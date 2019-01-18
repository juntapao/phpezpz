<?php
require_once('../includes/ezpz/initial.php');
EZPZ::top(HTML::i('', ['class' => 'maa-logo', 'style' => 'font-size: 3.5em; padding: 0.08em 0em 0em 0.08em;']).' '.NAM);
EZPZ::mainContainer([]);
EZPZ::endMainContainer();
?>
<script>
$(document).ready(function() {
    $('#ezpz_loading').hide();
});
</script>
<?php EZPZ::final(); ?>