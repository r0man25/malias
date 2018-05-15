/**
 * Created by us10140 on 08.05.2018.
 */

$(document).ready(function () {
    $('.check-image').each(function () {
        if ($(this).is(':checked')) {
            var that = $(this);
            that.parent().parent().parent().parent().addClass('check-div');
            $('.product-image-wrap').each(function () {
                var checkBox = $(this).find('.check-image');
                if (!checkBox.is(that)) {
                    checkBox.attr('disabled', 'disabled');
                }
            });
        }
    });

    $(document).on("change", ".check-image", function () {
        if ($(this).is(':checked')) {
            var that = $(this);
            that.parent().parent().parent().parent().addClass('check-div');
            $('.product-image-wrap').each(function () {
                var checkBox = $(this).find('.check-image');
                if (!checkBox.is(that)) {
                    checkBox.attr('disabled', 'disabled');
                }
            });
        } else {
            var that = $(this);
            that.parent().parent().parent().parent().removeClass('check-div');
            $('.product-image-wrap').each(function () {
                var checkBox = $(this).find('.check-image');
                if (!checkBox.is(that)) {
                    checkBox.attr('disabled', false);
                }
            });
        }
    });


});





