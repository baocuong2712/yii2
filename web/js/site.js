$(function() {
    "use strict";
    $(document).on('click', '.lang', function() {
        var lang = $(this).attr('id');
        $.post(baseUrl + 'site/language', {'lang': lang}, function () {
            location.reload();

            /*$.ajax({
                type: "POST",
                url: baseUrl + "site/language",
                data: { lang: lang },
                success: function(res) {
                    location.reload();
                },
                error: function(error) {}
            });*/
        });
    });
});