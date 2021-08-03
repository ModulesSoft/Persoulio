function checkAuth() {
    $.ajax({
        type: 'post',
        url: checkAuthDir,
        data: {
            'username': $("#username").val(),
            'password': $("#password").val()
        },
        success: function (response) {
            
            if(response == "okAndRedirectToPreQuiz")
                document.location.href = preQuizDir;
            else if(response == "okAndRedirectToProfile"){
                document.location.href = profileDir;
            }
            else {
                $("#err").empty();
                $("#err").append('نام کاربری و یا رمز عبور ناصحیح است');
            }
        }
    });
}