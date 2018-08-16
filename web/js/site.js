$(function() {
    'use strict';
    $(document).on('click', '.lang', function() {
       var lang = $(this).attr('id');
       $.post( 'index.php/site/language', {'lang': lang}, function () {
            location.reload();
        });
    });
});