$(document).ready(function (e) {
    $('form').submit(function (e) {
        if ($('label.error').length === 0) {
            $('#loading-overlay').show();
        }
    });
});
