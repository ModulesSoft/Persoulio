
function changeAns(qoqId, ans, idx) {

    $.ajax({
        type: 'post',
        url: changeAnsDir,
        data: {
            'qoqId': qoqId,
            'newAns': ans
        },
        success: function (response) {
            
            if(response == "nok")
                document.location.href = profileDir;
            else {
                $("#percent").empty().append(response + "%");

                if($("#q_" + idx).length == 0)
                    return;
                // $(".answer").removeClass("active");
                // $(".answer_"+ans).addClass("active");
                // $(".choice_" + idx).css('background-color', 'transparent');

                // switch (ans) {
                //     case 1:
                //     case 2:
                //     default:
                //         $("#choice_" + ans + "_" + qoqId).css('background-color', '#00461e');
                //         break;
                //     case 3:
                //         $("#choice_" + ans + "_" + qoqId).css('background-color', '#4d4d4e');
                //         break;
                //     case 4:
                //     case 5:
                //         $("#choice_" + ans + "_" + qoqId).css('background-color', '#660007');
                //         break;
                // }
                $("#q_"+ idx +" .answer").removeClass("active");
                $("#answer_"+ idx +"_"+ans).addClass("active");

                idx++;

                // $('html,body').animate({
                //         scrollTop: $( "#q_div_" + idx).offset().top - window.innerHeight * 0.3
                // }, 'fast');
            }
        }
    });

}