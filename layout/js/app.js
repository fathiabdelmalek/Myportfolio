$(function () {
    'use strict';

    $("select").selectBoxIt({
        autoWidth: false,
        showFirstOption: false,
        showEffect: "fadeIn",
        showEffectSpeed: 400,
        hideEffect: "fadeOut",
        hideEffectSpeed: 400
    });

    $('.toggle-info').click(function() {
        $(this).toggleClass('hid-info').parent().next('.card-body').fadeToggle(100);
        if($(this).hasClass('hid-info'))
            $(this).html('<i class="fa fa-arrow-down"></i>');
        else
            $(this).html('<i class="fa fa-arrow-up"></i>');
    });

    $('[placeholder]').focus(function () {
        $(this).attr('hint', $(this).attr('placeholder'));
        $(this).attr('placeholder', '');
    }).blur(function () {
        $(this).attr('placeholder', $(this).attr('hint'));
    });

    $('.confirm-delete').click(function () {
        return confirm("Are you sure you want to delete this user?");
    });

    $('.cat h3').click(function() {
        $(this).next('.view').fadeToggle(200);
    });

    $('.options span').click(function() {
        $(this).addClass('active').siblings('span').removeClass('active');
        if($(this).data('view') === 'full')
            $('.cat .view').fadeIn(200);
        else
            $('.cat .view').fadeOut(200);
    });
});
