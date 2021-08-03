
function changeFriendAvailibility() {

    status = 0;
    if($("#friendAvailibility").is(':checked'))
        status = 1;

    $.ajax({
        type: 'post',
        url: friendAvailibilityDir,
        data: {
            'status': status
        }
    });
    
}

function changeQuizStatus() {

    status = 0;
    if($("#quizStatus").is(':checked'))
        status = 1;

    $.ajax({
        type: 'post',
        url: quizStatusDir,
        data: {
            'status': status
        }
    });
}

function changeExchangeRate(val) {

    $.ajax({
        type: 'post',
        url: changeExchangeRateDir,
        data: {
            'val': val
        },
        success: function (response) {
            document.location.href = homeDir;
        }
    });
}