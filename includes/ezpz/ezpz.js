function getEZPZOnChangeValue(ff, p, f, t) {
    $('#' + ff).change(function() {
        var c = $(this).val();
        if(c) {
            $.post('../includes/ezpz/get.php', {
                p: p, c: c, _t: $('#ezpz_token').val()
            }, function(d) {
                if(d) f(d);
            }, t);
        }
    });
}