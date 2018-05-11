/**
 * Created by us10140 on 24.04.2018.
 */

$(document).ready(function () {

    $('#attrform-maincategory label input').each(function () {
        if ($(this).is(':checked')) {

            var params = {
                'isChecked' : true,
                'id': $(this).val(),
                'attrId' : $('#attrform-maincategory').attr('data-id')
            };

            $.post('/attr/manage/get-subcategory', params, function (data) {

                if (data.success && data.isChecked) {
                    $("#attrform-category_id").append( $('<fieldset id="categoriesSection'+data.mainCategory['id']+'" class="fieldset">' +
                        '<legend class="fieldset-legend">'+data.mainCategory['title']+'</legend>' +
                        '</fieldset>'));
                    for (key in data.subcategories){
                        var elem = "#categoriesSection"+data.mainCategory['id'];
                        var input = $(elem).append( $('' +
                            '<label>' +
                            '<input type="checkbox" name="AttrForm[category_id][]" value="'+key+'">'+'&nbsp;'+data.subcategories[key]+'&nbsp;' +
                            '</label>'
                        ));

                        if (data.attrSubCategories.hasOwnProperty(key)) {
                            var selector = 'input[value='+key+']';
                            input.find(selector).prop('checked', true);
                        }
                    }
                }

                if (data.success && !data.isChecked) {
                    var categoryElem = "#categoriesSection"+data.mainCategory['id'];
                    $(categoryElem).remove();

                    for (key in data.parentAttrs) {
                        var attrElem = "#parentsSection" + data.parentAttrs[key]['category_id'];
                        $(attrElem).remove();
                    }
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
        }
    });



    setTimeout(function(){

        $('#attrform-category_id fieldset label input:checked').each(function () {
            // console.log($(this));

            var params = {
                'isChecked': true,
                'id': $(this).val(),
                'attrId' : $('#attrform-maincategory').attr('data-id')
            };

            $.post('/attr/manage/get-main-attr', params, function (data) {
                if (data.success && data.isChecked) {
                    $("#attrform-parent_id").append($('<fieldset id="parentsSection' + data.parentAttrs[0]['category_id'] + '" class="fieldset">' +
                        '<legend class="fieldset-legend">' + data.parentAttrs[0]['category_title'] + '</legend>' +
                        '</fieldset>'));
                    for (key in data.parentAttrs) {
                        var elem = "#parentsSection" + data.parentAttrs[0]['category_id'];
                        var input = $(elem).append($('' +
                            '<label>' +
                            '<input type="checkbox" name="AttrForm[parent_id][]" value="' + data.parentAttrs[key]['attr_id'] + '">' + '&nbsp;' + data.parentAttrs[key]['attr_title'] + '&nbsp;' +
                            '</label>'
                        ));

                        var attrId = data.parentAttrs[key]['attr_id'];
                        attrId = attrId.substring(attrId.indexOf('/')+1, attrId.length);

                        if ($.inArray(attrId,data.mainAttrs) >= 0) {
                            var selector = 'input[value="'+data.parentAttrs[key]['attr_id']+'"]';
                            input.find(selector).prop('checked', true);
                        }
                    }
                }

                if (data.success && !data.isChecked) {
                    var elem = "#parentsSection" + data.parentAttrs[0]['category_id'];
                    $(elem).remove();
                }

                if ($('#attrform-parent_id label input').length > 0 && !$('*').is('#MainAttrLabel')) {
                    $('#attrform-parent_id').parent().prepend($('<label id="MainAttrLabel">Main attribute</label>'));
                }
                if ($('#attrform-parent_id label input').length == 0) {
                    $('#MainAttrLabel').remove();
                }

                return false;

            });
        });

    }, 1000);



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
                $("#attrform-category_id").append( $('<fieldset id="categoriesSection'+data.mainCategory['id']+'" class="fieldset">' +
                        '<legend class="fieldset-legend">'+data.mainCategory['title']+'</legend>' +
                    '</fieldset>'));
                for (key in data.subcategories){
                    var elem = "#categoriesSection"+data.mainCategory['id'];
                    $(elem).append( $('' +
                        '<label>' +
                            '<input type="checkbox" name="AttrForm[category_id][]" value="'+key+'">'+'&nbsp;'+data.subcategories[key]+'&nbsp;' +
                        '</label>'
                    ));
                }
            }

            if (data.success && !data.isChecked) {
                var categoryElem = "#categoriesSection"+data.mainCategory['id'];
                $(categoryElem).remove();
                // $('#attrform-category_id label input').each(function () {
                //     for (key in data.subcategories){
                //         if ($(this).val() == key) {
                //             $(this).parent().remove();
                //         }
                //     }
                // })
                for (key in data.parentAttrs) {
                    var attrElem = "#parentsSection" + data.parentAttrs[key]['category_id'];
                    $(attrElem).remove();
                }
                // $('#attrform-parent_id label input').each(function () {
                //     for (keyy in data.parentAttrs) {
                //         if ($(this).val() == keyy) {
                //             $(this).parent().remove();
                //         }
                //     }
                // })
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
                $("#attrform-parent_id").append( $('<fieldset id="parentsSection'+data.parentAttrs[0]['category_id']+'" class="fieldset">' +
                    '<legend class="fieldset-legend">'+data.parentAttrs[0]['category_title']+'</legend>' +
                    '</fieldset>'));
                for (key in data.parentAttrs) {
                    var elem = "#parentsSection"+data.parentAttrs[0]['category_id'];
                    $(elem).append($('' +
                        '<label>' +
                        '<input type="checkbox" name="AttrForm[parent_id][]" value="'+data.parentAttrs[key]['attr_id']+'">' + '&nbsp;' + data.parentAttrs[key]['attr_title'] + '&nbsp;' +
                        '</label>'
                    ));
                }
            }

            if (data.success && !data.isChecked) {
                var elem = "#parentsSection"+data.parentAttrs[0]['category_id'];
                $(elem).remove();
                // $('#attrform-parent_id label input').each(function () {
                //     for (key in data.parentAttrs) {
                //         if ($(this).val() == key) {
                //             $(this).parent().remove();
                //         }
                //     }
                // })
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

    $(document).on("click", "#attrform-parent_id fieldset label input", function () {
        var fieldset = $(this).parent().parent();
        var that = $(this);
        if (that.is(':checked')) {
            fieldset.find('input').each(function () {
                if (!$(this).is(that)) {
                    $(this).attr('disabled', 'disabled');
                }
            });
        } else {
            fieldset.find('input').each(function () {
                $(this).attr('disabled', false);
            });
        }
    });


    setTimeout(function() {
        $('#attrform-parent_id fieldset label input').each(function () {
            if ($(this).is(':checked')) {
                var fieldset = $(this).parent().parent();
                var that = $(this);
                fieldset.find('input').each(function () {
                    if (!$(this).is(that)) {
                        $(this).attr('disabled', 'disabled');
                    }
                });
            }
        });
    }, 1500);

});