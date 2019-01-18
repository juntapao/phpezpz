<?php
require_once('../includes/ezpz/initial.php');
$cashiers = App::fetchCashiers();
EZPZ::mainContainer(['class' => 'container-large container-main']);
//     echo '    <div class="nav-wrapper">
//     <a href="#" class="brand-logo">Logo</a>
//     <ul id="nav-mobile" class="right hide-on-med-and-down">
//       <li><a href="sass.html">Sass</a></li>
//       <li><a href="badges.html">Components</a></li>
//       <li><a href="collapsible.html">JavaScript</a></li>
//     </ul>
//   </div>
// </nav>';
    // EZPZ::row([]);
    //     EZPZ::col(['small' => '12', 'class' => 'center-align']);
            // EZPZ::div(['class' => 'card blue-grey darken-1']);
            //     EZPZ::div(['class' => 'car-content white-text container']);
            //          EZPZ::p('asdfdsa', []);
            //     EZPZ::endDiv();
            // EZPZ::endDiv();
    //     EZPZ::endCol();
    // EZPZ::endRow();
    EZPZ::loginForm([]);
        EZPZ::row([]);
            EZPZ::col(['id' => 'cashierPanel', 'small' => '8']);
                EZPZ::div(['class' => 'container center-align']);
                    EZPZ::h5('Select Cashier', []);
                    EZPZ::row([]);
                        foreach($cashiers as $cashier) {
                            EZPZ::col(['small' => '3', 'class' => 'btn-common']);
                                App::cashierList($cashier['id'], $cashier['full_name']);
                            EZPZ::endCol();
                        }
                    EZPZ::endRow();
                EZPZ::endDiv();
            EZPZ::endCol();
            EZPZ::col(['small' => '4']);
                EZPZ::div(['id' => 'keypad', 'class' => 'container center-align']);
                    EZPZ::h5('Enter passcode for', []);
                    EZPZ::span('-', ['id' => 'cashier_name', 'class' => 'readable']);
                    EZPZ::input(['id' => 'pin', 'name' => 'pin', 'type' => 'password', 'readonly' => '', 'maxlength' => '10', 'class' => 'readable center-align']);
                    App::keypad();
                    EZPZ::loginForm([]);
                        EZPZ::hidden('id', 'id', '');
                        EZPZ::button(EZPZ::icon('lock', '').' Login', ['purpose' => 'success', 'id' => 'login', 'type' => 'submit', 'class' => 'btn-common waves-effect waves-light btn-large']);
                    EZPZ::endForm();
                EZPZ::endDiv();
            EZPZ::endCol();
        EZPZ::endRow();
    EZPZ::endForm();
EZPZ::endContainer();
?>
<script>
$(document).ready(function() {
    $('#ezpz_loading').hide();
    $('#keypad').hide();
    $('.container-large').css({ 'height': '95vh' });
    $('#cashierPanel').kinetic();
    resizePanel();
    $('.btn-keypad').click(function() {
        var i = $(this).attr('id');
        var p = $('#pin').val();
        if(i) {
            var n = i.split('_')[1];
            if(!isNaN(n)) $('#pin').val(p + n);
            else {
                if(n == 'b') {
                    var l = p.length - 1;
                    p = p.substr(0, l);
                    $('#pin').val(p);
                } else $('#pin').val('');
            }
        }
    });
});
$(window).on('resize', function() { resizePanel(); });
$('.cashierName').click(function(e) {
    var i = $(this).attr('id').split('_')[1];
    var n = $(this).html();
    if(i == $('#id').val()) {
        $(this).removeClass('green').addClass('blue darken-4');
        $('#keypad').hide('drop', {}, 'fast', function() {});
        $('#id').val('');
        $('#cashier_name').html('-');
        $('#pin').val('');
    } else {
        $('.cashierName').removeClass('blue green').addClass('blue darken-4');
        $(this).removeClass('blue darken-4').addClass('green');
        $('#keypad').show('drop', {}, 'fast', function() {});
        $('#id').val(i);
        $('#cashier_name').html(n);
    }
    e.stopPropagation();
});
function resizePanel() {
    $('#cashierPanel').css({
        height: $('.container-main').height() - 50 + 'px'
    });
}
</script>
<?php EZPZ::final(); ?>