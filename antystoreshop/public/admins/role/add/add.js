
$(function () {
    $('.checkbox_wrapper').on('click', function () {
        $(this).parents('.card1').find('.checkbox_sub_permission').prop('checked', $(this).prop('checked'));
    });
})
