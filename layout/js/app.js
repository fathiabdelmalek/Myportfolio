$(function () {
    'use strict';

    $('[placeholder]').focus(function () {
        $(this).attr('data-text', $(this).attr('placeholder'));
        $(this).attr('placeholder', '');
    }).blur(function () {
        $(this).attr('placeholder', 'data-text');
    });

    $('.confirm').click(function () {
        return confirm("Are you sure you want to delete this user?");
    });
});
