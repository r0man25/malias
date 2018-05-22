/**
 * Created by us10140 on 08.05.2018.
 */

$(document).ready(function () {

    $(document).on("change", ".main-category", function () {
        var params = {
            'mainCategoryId': $(this).val()
        };

        var fieldWrap = $(this).parent().parent();

        $.post('/income/manage/get-subcategory', params, function (data) {

            if (data.success) {
                fieldWrap.find(".sub-category option").remove();
                fieldWrap.find(".product option").remove();
                fieldWrap.find(".sub-category").append($('<option value=""></option>'));
                for (key in data.subcategories) {
                    fieldWrap.find(".sub-category").append($('' +
                        '<option value="'+key+'">' +
                        data.subcategories[key] +
                        '</option>'
                    ));
                }
            }

            return false;
        });
    });


    $(document).on("change", ".sub-category", function () {
        var products = $(".product");
        var productsArr = [];

        products.each(function () {
            productsArr.push($(this).val());
        });

        var params = {
            'subCategoryId': $(this).val(),
            'productsArr': productsArr,
        }



        var fieldWrap = $(this).parent().parent();

        $.post('/income/manage/get-subcategory', params, function (data) {

            if (data.success) {
                fieldWrap.find(".product option").remove();
                fieldWrap.find(".product").append($('<option value=""></option>'));
                for (key in data.products) {
                    fieldWrap.find(".product").append($('' +
                        '<option value="'+key+'">' +
                        data.products[key] +
                        '</option>'
                    ));
                }
            }

            return false;
        });
    });

    var i = 1;

    $(document).on("click", ".btn-add", function () {
        var parentCategories;
        $.post('/income/manage/get-maincategory', [], function (data) {
            if (data.success) {
                parentCategories = data.parentCategories;
                var opt = '';
                for (key in parentCategories) {
                    opt = opt + '<option value="'+key+'">' + parentCategories[key] + '</option>';
                }

                $('#income-product-wrap').append($('<div class="income-product-field">' +
                    '<div class="form-group field-setproductform-income-'+i+'-maincategory">' +
                    // '<label class="control-label" for="setproductform-income-'+i+'-maincategory">Main category</label>' +
                    '<select id="setproductform-income-'+i+'-maincategory" class="form-control main-category" name="SetProductForm[income]['+i+'][mainCategory]">' +
                    '<option value=""></option>' +
                      opt +
                    '</select>' +

                    '<div class="help-block"></div>' +
                    '</div>' +
                    '<div class="form-group field-setproductform-income-'+i+'-category_id">' +
                    // '<label class="control-label" for="setproductform-income-'+i+'-category_id">Subcategory</label>' +
                    '<select id="setproductform-income-'+i+'-category_id" class="form-control sub-category" name="SetProductForm[income]['+i+'][category_id]">' +
                    '<option value=""></option>' +
                    '</select>' +

                    '<div class="help-block"></div>' +
                    '</div>' +
                    '<div class="form-group field-setproductform-income-'+i+'-product_id">' +
                    // '<label class="control-label" for="setproductform-income-'+i+'-product_id">Product</label>' +
                    '<select id="setproductform-income-'+i+'-product_id" class="form-control product" name="SetProductForm[income]['+i+'][product_id]">' +
                    '<option value=""></option>' +
                    '</select>' +

                    '<div class="help-block"></div>' +
                    '</div>' +
                    '<div class="form-group field-setproductform-income-'+i+'-quantitu">' +
                    // '<label class="control-label" for="setproductform-income-'+i+'-quantitu">Quantity</label>' +
                    '<input type="text" id="setproductform-income-'+i+'-quantitu" class="form-control quantitu" name="SetProductForm[income]['+i+'][quantitu]">' +

                    '<div class="help-block"></div>' +
                    '</div>' +
                    '<div class="form-group field-setproductform-income-'+i+'-price">' +
                    // '<label class="control-label" for="setproductform-income-'+i+'-price">Price</label>' +
                    '<input type="text" id="setproductform-income-'+i+'-price" class="form-control price" name="SetProductForm[income]['+i+'][price]">' +

                    '<div class="help-block"></div>' +
                    '</div>' +
                    '<div class="btn-rem-wrap">' +
                    '<div class="btn-rem btn btn-danger glyphicon glyphicon-minus"></div>' +
                    '</div>' +
                    '</div>'
                ));
                i++;
            }
        });


    });

    $(document).on("click", ".btn-rem", function () {
        var row = $(this).closest(".income-product-field");
        row.remove();
    });

    $(document).on("submit", "#w0", function (event) {
        if ( validateForm() ) { // если есть ошибки возвращает true
            event.preventDefault();
        }
    });

    function validateForm() {
        $(".text-error").remove();
        $(".error").toggleClass('error', false );


        //validate quantitu
        var el_q = $(".quantitu");
        var regV_q = /^[0-9]+$/;

        var v_quantitu = false;
        var v_q_err = false;

        el_q.each(function () {
            if ($(this).val()) {
                v_q_err = false;
            } else {
                v_q_err = true;
                v_quantitu = true;
            }

            if ( v_q_err ) {
                $(this).after('<span class="text-error">Must be required</span>');
                $(this).toggleClass('error', v_q_err );
            } else if ( !regV_q.test( $(this).val() ) ) {
                v_q_err = true;
                v_quantitu = true;
                $(this).after('<span class="text-error">Quantitu should be a integer</span>');
                $(this).toggleClass('error', v_q_err );
            }
        });
        //validate quantitu

        //validate price
        var el_p = $(".price");
        var regV_p = /^[-]?(([1-9][0-9]*)|(0))([.][0-9]+)?$/;

        var v_price = false;
        var v_p_err = false;

        el_p.each(function () {
            if ($(this).val()) {
                v_p_err = false;
            } else {
                v_p_err = true;
                v_price = true;
            }

            if ( v_p_err ) {
                $(this).after('<span class="text-error">Must be required</span>');
                $(this).toggleClass('error', v_p_err );
            } else if ( !regV_p.test( $(this).val() ) ) {
                v_p_err = true;
                v_price = true;
                $(this).after('<span class="text-error">Price should be a double</span>');
                $(this).toggleClass('error', v_p_err );
            }
        });
        //validate price

        //validate category and product
        var el_int = $(".main-category, .sub-category, .product");
        var regV_int = /^[0-9]+$/;

        var v_int = false;
        var v_int_err = false;

        el_int.each(function () {
            if ($(this).val()) {
                v_int_err = false;
            } else {
                v_int_err = true;
                v_int = true;
            }

            if ( v_int_err ) {
                $(this).after('<span class="text-error">Must be required</span>');
                $(this).toggleClass('error', v_int_err );
            } else if ( !regV_p.test( $(this).val() ) ) {
                v_int_err = true;
                v_int = true;
                $(this).after('<span class="text-error">Bad values</span>');
                $(this).toggleClass('error', v_int_err );
            }
        });
        //validate category and product

        return (v_quantitu || v_price || v_int);
    }



});