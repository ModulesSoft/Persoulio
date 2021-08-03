
function deleteContent(id) {
    
    $.ajax({
        type: 'post',
        url: deleteUrl,
        data: {
            'id': id
        },
        success: function (response) {
            if(response == "ok")
                document.location.href = selfUrl;
        }
    });
}

function filter() {

    $(".tipCheckBox").removeClass('hidden');

    $.each($(".tipCheckBox"), function () {

        var checkBox = $(this);

        $.each($("input:checkbox[name='factorId']:checked"), function(){
            if(checkBox.attr('floor_' + $(this).val()) > $("#input_ceil_" + $(this).val()).val() ||
                checkBox.attr('ceil_' + $(this).val()) < $("#input_floor_" + $(this).val()).val())
                checkBox.addClass('hidden');
        });
    });

}


function filterE() {

    $(".tipCheckBoxE").removeClass('hidden');

    $.each($(".tipCheckBoxE"), function () {

        var checkBox = $(this);

        $.each($("input:checkbox[name='factorIdE']:checked"), function(){
            if(checkBox.attr('floor_' + $(this).val()) > $("#input_ceilE_" + $(this).val()).val() ||
                checkBox.attr('ceil_' + $(this).val()) < $("#input_floorE_" + $(this).val()).val())
                checkBox.addClass('hidden');
        });
    });

}