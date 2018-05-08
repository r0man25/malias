/**
 * Created by us10140 on 08.05.2018.
 */

$(document).ready(function () {

    $(document).on("change", "#productform-maincategory", function () {
        var params = {
            'mainCategoryId': $(this).val()
        };

        $.post('/product/manage/get-subcategory', params, function (data) {

            if (data.success) {
                $("#productform-category_id option").remove();
                $("#productform-category_id").append($('<option value=""></option>'));
                for (key in data.subcategories) {
                    $("#productform-category_id").append($('' +
                        '<option value="'+key+'">' +
                        data.subcategories[key] +
                        '</option>'
                    ));
                }
            }

            return false;
        });
    });


    $(document).on("change", "#productform-category_id", function () {
        var params = {
            'subCategoryId': $(this).val()
        };

        $.post('/product/manage/get-subcategory', params, function (data) {

            if (data.success) {
                $("#attrsSection").remove();
                $("#productform-attrs").append( $('<fieldset id="attrsSection" class="fieldset">' +
                    '<legend class="fieldset-legend">Chose product attributes</legend>' +
                    '</fieldset>'));

                for (key in data.categoryAttrs) {
                    $("#attrsSection").append($('' +
                        '<label>' +
                        '<input type="checkbox" name="ProductForm[attrs][]" value="' + key + '">' + '&nbsp;' + data.categoryAttrs[key] + '&nbsp;' +
                        '</label>'
                    ));
                }


            }

            return false;
        });
    });



});