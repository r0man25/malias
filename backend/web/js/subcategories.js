/**
 * Created by us10140 on 24.04.2018.
 */

$(document).ready(function () {
    // $('#attrform-maincategory label input').click(function () {
    $(document).on("click", "#attrform-maincategory label input", function () {
        if ($(this).is(':checked')) {
            var params = {
                'isChecked' : true,
                'id': $(this).val()
            };
        } else {
            var params = {
                'isChecked' : false,
                'id': $(this).val()
            };
        }
        $.post('/attr/manage/get-subcategory', params, function (data) {

            if (data.success && data.isChecked) {
                for (key in data.subcategories){
                    $("#attrform-category_id").append( $('' +
                        '<label>' +
                            '<input type="checkbox" name="AttrForm[category_id][]" value="'+key+'">'+'&nbsp;'+data.subcategories[key]+'&nbsp;' +
                        '</label>'
                    ));
                }
            }

            if (data.success && !data.isChecked) {
                $('#attrform-category_id label input').each(function () {
                    for (key in data.subcategories){
                        if ($(this).val() == key) {
                            $(this).parent().remove();
                        }
                    }
                })
                $('#attrform-parent_id label input').each(function () {
                    for (keyy in data.parentAttrs) {
                        if ($(this).val() == keyy) {
                            $(this).parent().remove();
                        }
                    }
                })
            }

            if ($('#attrform-category_id label input').length > 0 && !$('*').is('#SubcategoryLabel')) {
                $('#attrform-category_id').parent().prepend( $('<label id="SubcategoryLabel">Subcategory</label>'));
            }
            if ($('#attrform-category_id label input').length == 0 ) {
                $('#SubcategoryLabel').remove();
            }
            if ($('#attrform-parent_id label input').length == 0 ) {
                $('#MainAttrLabel').remove();
            }
            return false;
        });
    });


    $(document).on("click", "#attrform-category_id label input", function () {
        if ($(this).is(':checked')) {
            var params = {
                'isChecked': true,
                'id': $(this).val()
            };
        } else {
            var params = {
                'isChecked': false,
                'id': $(this).val()
            };
        }


        $.post('/attr/manage/get-main-attr', params, function (data) {
            if (data.success && data.isChecked) {
                for (key in data.parentAttrs) {
                    $("#attrform-parent_id").append($('' +
                        '<label>' +
                        '<input type="checkbox" name="AttrForm[parent_id][]" value="'+key+'">' + '&nbsp;' + data.parentAttrs[key] + '&nbsp;' +
                        '</label>'
                    ));
                }
            }

            if (data.success && !data.isChecked) {
                $('#attrform-parent_id label input').each(function () {
                    for (key in data.parentAttrs) {
                        if ($(this).val() == key) {
                            $(this).parent().remove();
                        }
                    }
                })
            }

            if ($('#attrform-parent_id label input').length > 0 && !$('*').is('#MainAttrLabel')) {
                $('#attrform-parent_id').parent().prepend( $('<label id="MainAttrLabel">Main attribute</label>'));
            }
            if ($('#attrform-parent_id label input').length == 0 ) {
                $('#MainAttrLabel').remove();
            }

            return false;
        });
    });

});