var reminderTime = 0;
var username;
var password;
var firstName;
var lastName;

function checkEducationalCode() {
    if($("#educationalCode").val() == "" || $("#entryYear").val() == "none" || $("#field").val() == "none") {
        $("#errPass").empty().append(
            '<p class="alert alert-danger fade in" style="margin-bottom: 0px;">' + '<a href="#" class="close" data-dismiss="alert">&times;</a>'
            +           'لطفا تمامی موارد لازم را پر نمایید'
            +           '</p>'
        );
        return;
    }

    $.ajax({
        type: 'post',
        url: checkEducationalCodeDir,
        data: {
            'entryYear': $("#entryYear").val(),
            'educationalCode': $("#educationalCode").val()
        },
        success: function (response) {
            if(response == "ok") {
                educationalCode = $("#educationalCode").val();
                $("#header").text('اطلاعات کاربری');
                $("#pass1").addClass('hidden');
                $("#pass2").removeClass('hidden');

                $("#errPass").empty();
            }
            else if(response == "nok2")
                $("#errPass").empty().append(

                    '<p class="alert alert-danger fade in" style="margin-bottom: 0px;">' + '<a href="#" class="close" data-dismiss="alert">&times;</a>'
                    +'شماره ی دانشجویی وارد شده در سامانه موجود است'
                    +           '</p>'
                );
            else
                $("#errPass").empty().append(
                    '<p class="alert alert-danger fade in" style="margin-bottom: 0px;">' + '<a href="#" class="close" data-dismiss="alert">&times;</a>'+
                    'شماره ی دانشجویی وارد شده نامعتبر است'
                    +           '</p>'
                );
        }
    });
}

function checkUserName() {

    if($("#username").val() == "" || $("#password").val() == "" || $("#passwordRepeat").val() == "") {
        $("#errPass").empty().append(
            '<p class="alert alert-danger fade in" style="margin-bottom: 0px;">' + '<a href="#" class="close" data-dismiss="alert">&times;</a>'
            +      'لطفا تمامی موارد لازم را پر نمایید'
            +           '</p>'
        );
        return;
    }

    if($("#password").val() != $("#passwordRepeat").val()) {
        $("#errPass").empty().append(
            '<p class="alert alert-danger fade in" style="margin-bottom: 0px;">' + '<a href="#" class="close" data-dismiss="alert">&times;</a>'
            +     'رمزعبور وارد شده با تکرار آن یکسان نیست'
            +           '</p>'
        );
        return;
    }

    pas = $("#password").val();

    if(pas.length < 4) {
        $("#errPass").empty().append(
            '<p class="alert alert-danger fade in" style="margin-bottom: 0px;">' + '<a href="#" class="close" data-dismiss="alert">&times;</a>'
            +     'طول رمزعبور مورد نظر باید بیش از 4 کاراکتر باشد'
            +           '</p>'
        );
        return;
    }

    for(i = 0; i < pas.length; i++) {
        if((pas[i] >= 'a' && pas[i] <= 'z') || (pas[i] >= 'A' && pas[i] <= 'Z') || (pas[i] >= '0' && pas[i] <= '9')
            || (pas[i] == '!' || pas[i] == '_' || pas[i] == '@' || pas[i] == '-' || pas[i] == '.' || pas[i] == '&' || pas[i] == '?' || pas[i] == '[' || pas[i]== ']' || pas[i]== ',' || pas[i]== '#' || pas[i]== '%' || pas[i]=='(' || pas[i]==')' || pas[i]==';' || pas[i]=='*' || pas[i]=='+'))
            continue;
        $("#errPass").empty().append(
            '<p class="alert alert-danger fade in" style="margin-bottom: 0px;">' + '<a href="#" class="close" data-dismiss="alert">&times;</a>'
            +                 'رمزعبور نباید فارسی باشد'
            +           '</p>'
        );
        return;
    }

    pas = $("#username").val();

    for(i = 0; i < pas.length; i++) {
        if((pas[i] >= 'a' && pas[i] <= 'z') || (pas[i] >= 'A' && pas[i] <= 'Z') || (pas[i] >= '0' && pas[i] <= '9')
            || (pas[i] == '!' || pas[i] == '_' || pas[i] == '@' || pas[i] == '-' || pas[i] == '.' || pas[i] == '&' || pas[i] == '?' || pas[i] == '[' || pas[i]== ']' || pas[i]== ',' || pas[i]== '#' || pas[i]== '%' || pas[i]=='(' || pas[i]==')' || pas[i]==';' || pas[i]=='*' || pas[i]=='+'))
            continue;
        $("#errPass").empty().append('<p class="alert alert-danger fade in" style="margin-bottom: 0px;">' + '<a href="#" class="close" data-dismiss="alert">&times;</a>'
            +                 'نام کاربری نباید فارسی باشد'
            +           '</p>');
        return;
    }

    $.ajax({
        type: 'post',
        url: checkUserNameDir,
        data: {
            'username': $("#username").val()
        },
        success: function (response) {
            if(response == "ok") {

                username = $("#username").val();
                password = $("#password").val();
                $("#errPass").empty();
                $("#header").text('اطلاعات شخصی');

                $("#pass4").addClass('toggled');
            }
            else
                $("#errPass").empty().append(
                    '<p class="alert alert-danger fade in" style="margin-bottom: 0px;">' + '<a href="#" class="close" data-dismiss="alert">&times;</a>'
                    +               'نام کاربری وارد شده در سامانه موجود است'
                    +           '</p>'
                );
        }
    });
}

function changeActivationStatus() {

    if($("#phoneNum").val().length != 11) {
        $("#resendActivationCodeDiv").addClass('hidden');
    }
    else {
        $("#resendActivationCodeDiv").removeClass('hidden');
    }
}

function sendActivation() {

    if($("#activationCode").val() == "")
        return;

    $.ajax({
        type: 'post',
        url: sendActivationDir,
        data: {
            'phoneNum': $("#phoneNum").val(),
            'code': $("#activationCode").val(),
            'entryYear': $("#entryYear").val(),
            'field': $("#field").val(),
            'sex': $("#sex").val(),
            'firstName': firstName,
            'lastName': lastName,
            'educationalCode': educationalCode,
            'username': username,
            'password': password
        },
        success: function (response) {
            if(response == "ok") {
                // alert(response);
                // $(".dark").removeClass('hidden');
                $("#end_part").addClass('toggled');
            }
            else{
                // alert(response);
            }
        }
    });
}

function goToPreQuiz(){

    $("#usernameForm").val(username);
    $("#passwordForm").val(password);
    $("#myForm").submit();
}

function getActivation() {
    if($("#phoneNum").val() == "" || firstName == "" || lastName == "" || educationalCode == "" || $("#sex").val() == "none" ||
        $("#entryYear").val() == "none" || $("#field").val() == "none") {
        $("#errPass_1").empty();
        $("#errPass_1").append(
            '<p class="alert alert-danger fade in" style="margin-bottom: 0px;">' + '<a href="#" class="close" data-dismiss="alert">&times;</a>'
            +               'لطفا مجددا ثبت‌نام را از ابتدا انجام دهید.'
            +           '</p>'
        );
        return;
    }
    $.ajax({
        type: 'post',
        url: getActivationDir,
        data: {
            'phoneNum': $("#phoneNum").val()
        },
        success: function (response) {
            if(response.length == 0)
                return;
// alert(response);
            response = JSON.parse(response);
            // alert(response);
            reminderTime = response.reminderTime;

            $("#errPass_1").empty();

            if(response.status == "ok") {
                $("#errPass3").empty().append(
                    '<p class="alert alert-danger fade in" style="margin-bottom: 0px;">' + '<a href="#" class="close" data-dismiss="alert">&times;</a>'
                    +              'کد فعال سازی برای شما ارسال شده است'
                    +           '</p>'
                );
                $("#activationCodeDiv").removeClass('hidden');
            }
            else if(response.status == "nok1")
                $("#errPass_1").empty().append(
                    '<p class="alert alert-danger fade in" style="margin-bottom: 0px;">' + '<a href="#" class="close" data-dismiss="alert">&times;</a>'
                    +            'هنوز زمان لازم برای ارسال مجدد کد فعال سازی به اتمام نرسیده است'
                    +           '</p>'
                );
            else if(response.status == "nok2")
                $("#errPass_1").empty().append(
                    '<p class="alert alert-danger fade in" style="margin-bottom: 0px;">' + '<a href="#" class="close" data-dismiss="alert">&times;</a>'
                    + 'اشکالی در ارسال پیامک رخ داده است. لطفا بعدا اقدام فرمایید'
                    + '</p>'
                );
            else {
                $("#errPass_1").empty().append(
                    '<p class="alert alert-danger fade in" style="margin-bottom: 0px;">' + '<a href="#" class="close" data-dismiss="alert">&times;</a>'
                    +          'شماره وارد شده در سامانه موجود است'
                    +           '</p>'
                );
                return;
            }

            $("#reminderTimePane").removeClass('hidden');
            $("#resendActivationCode").attr('disabled', 'disabled');
            decreaseTime();
        }
    });

}

function decreaseTime() {

    $("#reminderTime").text((reminderTime % 60) + " : " + Math.floor(reminderTime / 60));

    if(reminderTime > 0) {
        reminderTime--;
        setTimeout("decreaseTime()", 1000);
    }
    else {
        $("#reminderTimePane").addClass('hidden');
        $("#resendActivationCode").removeAttr('disabled');
    }
}

function validate(evt) {
    var theEvent = evt || window.event;
    var key = theEvent.keyCode || theEvent.which;
    key = String.fromCharCode( key );
    var regex = /[0-9]|\./;
    if( !regex.test(key) ) {
        theEvent.returnValue = false;
        if(theEvent.preventDefault) theEvent.preventDefault();
    }
}

function goToPass4() {

    if($("#sex").val() == "none" || $("#firstName").val() == "" || $("#lastName").val() == "") {
        $("#errPass").empty().append(
            '<p class="alert alert-danger fade in" style="margin-bottom: 0px;">' + '<a href="#" class="close" data-dismiss="alert">&times;</a>'
            +          'لطفا تمامی موارد لازم را پر نمایید'
            +           '</p>'
        );
        return;
    }

    firstName = $("#firstName").val();
    lastName = $("#lastName").val();

    $("#errPass").empty();
    $("#pass2").addClass('hidden');
    $("#pass3").removeClass('hidden');

}
