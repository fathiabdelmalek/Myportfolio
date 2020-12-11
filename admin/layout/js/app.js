$(function () {
    'use strict';

    $('[placeholder]').focus(function () {
        $(this).attr('hint', $(this).attr('placeholder'));
        $(this).attr('placeholder', '');
    }).blur(function () {
        $(this).attr('placeholder', $(this).attr('hint'));
    });

    $('.confirm-delete').click(function () {
        return confirm("Are you sure you want to delete this user?");
    });
});
