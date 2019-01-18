<?php
switch(DES) {
    case 'Materialize': ?>
        <script>
        $(document).ready(function() {
            $('select').formSelect();
            $('.datepicker').datepicker({
                selectMonths: true,
                selectYears: 10,
                today: 'Today',
                clear: '',
                close: '',
                closeOnSelect: true,
                format: 'mm/dd/yyyy'
            });
            $('.dropdown-trigger').dropdown();
            $('.modal').modal();
            $('#ezpz_sign_out').click(function() {
                $('#ezpz_confirmation h5.modal-title').html('Confirmation');
                $('#ezpz_confirmation p.modal-body').html('Are you sure you want to logout?');
                $('#ezpz_modal_yes_confirmation').click(function() {
                    window.location = '<?php echo $_SESSION[APP.'_login_path']; ?>';
                });
            });
            $('.ezpz_delete').click(function() {
                $('#ezpz_id').val($(this).children('input').val());
                $('#ezpz_confirmation h5.modal-title').html('Confirmation');
                $('#ezpz_confirmation p.modal-body').html('Are you sure you want delete record?');
                $('#ezpz_modal_yes_confirmation').click(function() {
                    $('form').submit();
                });
            });
            $('#ezpz_refresh').click(function() {
                location.reload();
            });
            $('form').on('submit', function() {
                $('#ezpz_loading').show();
            });
            $('.ezpz_multiselect').change(function() {
                var i = $(this).attr('id');
                i = i.substr(0, i.length - 5);
                $('#' + i).val($(this).val());
            });
            if($('nav div').hasClass('black-text')) {
                $('nav a').addClass('black-text');
                $('footer div').addClass('black-text');
            }
            $('input:checkbox').click(function() {
                var d = $(this).attr('id');
                i = d.substr(0, d.length - 6);
                if($(this).is(':checked')) $('#' + i).val('1');
                else $('#' + i).val('0');
            });
        });
        </script> <?php
        break;
    case 'Bootstrap': ?>
        <script>
        $(document).ready(function() {
            $('#ezpz_sign_out').click(function() {
                $('#ezpz_confirmation h5.modal-title').html('Confirmation');
                $('#ezpz_confirmation div.modal-body').html('Are you sure you want to logout?');
                $('#ezpz_modal_yes_confirmation').click(function() {
                    window.location = '<?php echo $_SESSION[APP.'_login_path']; ?>';
                });
                $('#ezpz_confirmation').modal('show');
            });
            $('.ezpz_delete').click(function() {
                $('#ezpz_id').val($(this).children('input').val());
                $('#ezpz_confirmation h5.modal-title').html('Confirmation');
                $('#ezpz_confirmation div.modal-body').html('Are you sure you want delete record?');
                $('#ezpz_modal_yes_confirmation').click(function() {
                    $('form').submit();
                });
            });
            $('#ezpz_refresh').click(function() {
                location.reload();
            });
            $('form').on('submit', function() {
                $('#ezpz_loading').show();
            });
        });
        </script> <?php
        break;
}
if(substr($_SERVER['REQUEST_URI'], -7) != '/login/') {
    switch(DES) {
        case 'Materialize': ?>
            <footer class="page-footer<?php echo Common::getClassColor(); ?>">
                <div class="footer-copyright"> <?php
                    include_once '../includes/footer.php' ?>
                </div>
            </footer>
        <?php break;
        case 'Bootstrap':?>
            <footer class="footer<?php echo Common::getClassColor(); ?>"> 
                <div class="container"> <?php
                    include_once '../includes/footer.php' ?>
                </div>
            </footer>
        <?php break;
    }
}
echo '</body></html>';
?>