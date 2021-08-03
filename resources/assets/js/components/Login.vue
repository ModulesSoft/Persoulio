<template>
    <div class="container-fluid mainRow">
        <div class="top_part">
            <div class="top_part_2">
                <h2>پرسولیو</h2>
            </div>
        </div>
        <div class="user">
            <input v-model="username" class="user_1" name="username"
                   placeholder="شماره دانشجویی و یا نام کاربری"></input>
            <i class="material-icons user_logo"
               style="margin-top: 2px;margin-right: 3px;font-size: 6vh;color: #ada6b8;">account_circle</i>
        </div>
        <div class="user">
            <input v-model="password" class="user_1 user_2" name="password" type="password"
                   style="direction: rtl;font-size: 15px;"
                   placeholder="رمز عبور"></input>
            <i class="material-icons user_logo_2" style="font-size: 3.5vh;color: #847594;">lock_open</i>
        </div>
        <div class="but">
            <p v-if="error" style="color: white" id="err">{{error}}</p>
            <!--<button class="but_1" onclick="document.location.href = '{{route('signUp')}}'" type="button">ثبت‌نام-->
            <!--</button>-->
            <button class="but_2 " @click="login" value="ورود">ورود</button>
            <a href="/resetPas" >
                <button class="forget" type="button">فراموشی
                    رمز عبور
                </button>
            </a>
        </div>
        <div class="down">
            <router-link to="/">
                <button type="button">آنچه درباره پرسولیو باید بدانید
                </button>
            </router-link>
            <p style="color: #e0a53f"><a href="http://www.instagram.com/persoulio/" class="fa fa-instagram"/>
                <a href="http://www.instagram.com/persoulio/" style="
                        text-decoration: none;color: #e0a53f;">ورود به اینستاگرام</a></p>
            <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
                  rel="stylesheet">
            <link rel="stylesheet"
                  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        </div>
    </div>
</template>

<script>
    export default {
        name: "Login",
        data() {
            return {
                username: '',
                password: '',
                error: ''
            }
        },
        methods: {
            login() {
                var form = new FormData();
                form.append('username', this.username);
                form.append('password', this.password);
                axios.post('/checkAuth', form).then(response => {
                        if (response.data == "nok") {
                            this.error = "نام کاربری یا رمز اشتباه است"
                        }
                        if (response.data == "profile") {
                            this.$router.push('profile')
                        }
                        if (response.data == "likesList") {
                            this.$router.push('dashboard')
                        }
                        if (response.data == "events") {
                            this.$router.push('dashboard')
                        }
                        console.log(response.data);
                    }
                );
            }
        }
    }
</script>

<style scoped>
    @font-face {
        font-family: ghasem;
        src: url('../../fonts/AGhasem.ttf');
    }

    @font-face {
        font-family: IRANSans;
        src: url('../../fonts/IRANSansWeb.ttf');
    }

    @font-face {
        font-family: "B Yekan";
        src: url('../../fonts/b-yekan.ttf');
    }

    body {
        font-family: "B Yekan";
        /*overflow-y: hidden;*/
        overflow-x: hidden;
        overflow-y: scroll;
    }

    .on {
        display: none;
    }

    .container-fluid {
        font-family: "B Yekan";
        background-image: url("../../assets/desktop.jpg");
        background-size: cover;
        padding: 0;
        height: 100vh;
    }

    .top_part {
        margin-top: 5%;
        border-top: solid #f7f7f7 1px;
        border-bottom: solid #f7f7f7 1px;
        height: 10em;
        padding-top: 10px;
        padding-bottom: 10px;
        margin-bottom: 8%;
    }

    .top_part_2 h2 {
        margin: 0;
        color: #f7f7f7;
        font-size: 400%;
    }

    .top_part_2 {
        font-family: ghasem;
        background-color: #9687a3;
        height: 100%;
        text-align: center;
        padding-top: 2%;

    }

    .user {
        width: 70vw;
        margin: auto;
        position: relative;
        margin-bottom: 10px;
    }

    .user {
        width: 40vw;
        margin: auto;
        position: relative;
        margin-bottom: 10px;
    }

    .user_1 {
        width: 100%;
        height: 6.5vh;
        direction: ltr;
        color: #f7f7f7;
        /*padding-right: 12vw;*/
        background-color: rgba(50, 36, 95, 0.4);
        border: none;
        border: solid #f7f7f7 2px;
        text-align: center;
        border-radius: 50px;
    }

    .user_2 {
        padding-right: 0%;
    }

    .user_logo {
        position: absolute;
        font-size: 30px;
        top: 0%;
        right: 0%;
    }

    .user_logo_2 {
        background-color: #ada6b8;
        border-radius: 100%;
        position: absolute;
        font-size: 30px;
        top: 5px;
        right: 6px;
        height: 5vh;
        width: 5vh;
        text-align: center;
        padding-top: 1vh;
    }

    .forget {
        background-color: transparent;
        border: none;
        /*position: absolute;*/
        /*top: 25%;*/
        /*left: 2.5vh;*/
        margin-top: 20px;
        color: #dddddd;
        margin-left : 40%;
    }

    .but {
        width: 40vw;
        margin: auto;
    }

    .but_1 {
        background-color: #ada6b6;
        color: #ffffff;
        border: none;
        height: 6.5vh;
        width: 25%;
        font-size: 15px;
        border-radius: 50px;
        border: solid #f7f7f7 1px;
    }

    .but_2 {
        background-color: #e0a53f;
        color: #ffffff;
        border: none;
        height: 6.5vh;
        width: 100%;
        font-size: 20px;
        border-radius: 50px;
        margin-left: 0.5vw;
        border: solid #f7f7f7 1px;
        float: right;
    }

    .down {
        width: 100vw;
        /*margin: auto;*/
        text-align: center;
        /*bottom: 4vh;*/
        position: absolute;
        margin-top: 5vh;
    }

    .down button {
        background-color: transparent;
        color: #e0a53f;
        border: none;
        height: 6vh;
        width: 40vw;
        font-size: 13px;
        border-radius: 50px;
        border: solid #e0a53f 1px;
        font-family: "B Yekan";
    }

    input::-webkit-input-placeholder {
        color: white !important;
    }

    input:-moz-placeholder { /* Firefox 18- */
        color: white !important;
    }

    input::-moz-placeholder { /* Firefox 19+ */
        color: white !important;
    }

    input:-ms-input-placeholder {
        color: white !important;
    }

    @media screen and (max-width: 768px) {
        body {
            font-family: "B Yekan";

        }

        .on {
            display: block;
        }

        .container-fluid {
            font-family: "B Yekan";
            background-image: url("../../assets/phoneback.png");
            background-size: cover;
            padding: 0;
            height: 100vh;
        }

        .off {
            display: none;
        }

        .top_part {
            margin-top: 15%;
            border-top: solid #f7f7f7 1px;
            border-bottom: solid #f7f7f7 1px;
            height: 10em;
            padding-top: 10px;
            padding-bottom: 10px;
            margin-bottom: 15%;
        }

        .top_part_2 h2 {
            margin: 0;
            color: #f7f7f7;
            font-size: 400%;
        }

        .top_part_2 {
            font-family: ghasem;
            background-color: rgba(50, 36, 95, 0.4);
            height: 100%;
            text-align: center;
            padding-top: 5%;

        }

        .user {
            width: 70vw;
            margin: auto;
            position: relative;
            margin-bottom: 10px;
        }

        .user_1 {
            width: 100%;
            height: 6.5vh;
            direction: ltr;
            color: #f7f7f7;
            background-color: #706381;
            border: none;
            border: solid #f7f7f7 2px;
            text-align: center;
            border-radius: 50px;
        }

        .user_2 {
            padding-right: 0%;
        }

        .user_logo {
            position: absolute;
            font-size: 30px;
            top: 0%;
            right: 0%;
        }

        .user_logo_2 {
            background-color: #ada6b8;
            border-radius: 100%;
            position: absolute;
            font-size: 30px;
            top: 5px;
            right: 6px;
            height: 5vh;
            width: 5vh;
            text-align: center;
            padding-top: 1vh;
        }

        .forget {
            background-color: transparent;
            border: none;
            /*position: absolute;*/
            /*top: 25%;*/
            /*left: 2.5vh;*/
            color: #dddddd;
        }

        .but {
            width: 70vw;
            margin: auto;
        }

        .but_1 {
            background-color: #ada6b6;
            color: #ffffff;
            border: none;
            height: 6.5vh;
            width: 30%;
            font-size: 15px;
            border-radius: 50px;
            border: solid #f7f7f7 1px;
        }

        .but_2 {
            background-color: #e0a53f;
            color: #ffffff;
            border: none;
            height: 6.5vh;
            width: 100%;
            font-size: 20px;
            margin-left: 2vw;
            border-radius: 50px;
            border: solid #f7f7f7 1px;
            float: right;
        }

        .down {
            width: 100vw;
            /*margin: auto;*/
            text-align: center;
            /*bottom: 4vh;*/
            position: absolute;
            margin-top: 2vh;
        }

        .down button {
            background-color: transparent;
            color: #e0a53f;
            border: none;
            height: 6vh;
            width: 70vw;
            font-size: 13px;
            border-radius: 50px;
            border: solid #e0a53f 1px;
            font-family: "B Yekan";
        }

        input::-webkit-input-placeholder {
            color: white !important;
        }

        input:-moz-placeholder { /* Firefox 18- */
            color: white !important;
        }

        input::-moz-placeholder { /* Firefox 19+ */
            color: white !important;
        }

        input:-ms-input-placeholder {
            color: white !important;
        }

    }

    @media screen and (max-width: 768px) and (max-height: 420px) {
        .container-fluid {
            height: 150vh;
        }

        .top_part {
            margin-top: 5%;
            height: 5em;
            margin-bottom: 5%;
        }

        .top_part_2 h2 {
            margin: 0;
            color: #f7f7f7;
            font-size: 200%;
        }

        .top_part_2 {
            font-family: ghasem;
            background-color: rgba(50, 36, 95, 0.4);
            height: 100%;
            text-align: center;
            padding-top: 1%;

        }

        .user {
            width: 70vw;
            margin: auto;
            position: relative;
            margin-bottom: 10px;
        }

        .user_1 {
            width: 100%;
            height: 15vh;
            direction: ltr;
            color: #f7f7f7;
            background-color: #706381;
            border: none;
            border: solid #f7f7f7 2px;
            text-align: center;
            border-radius: 50px;
        }

        .user_2 {
            padding-right: 18%;
        }

        .user_logo {
            position: absolute;
            font-size: 30px;
            top: 0%;
            right: 0%;
            visibility: hidden;
        }

        .user_logo_2 {
            background-color: #ada6b8;
            border-radius: 100%;
            position: absolute;
            font-size: 30px;
            top: 5px;
            right: 6px;
            height: 5vh;
            width: 5vh;
            text-align: center;
            padding-top: 1vh;
            visibility: hidden;
        }

        .forget {
            background-color: transparent;
            border: none;
            /*position: absolute;*/
            /*top: 25%;*/
            /*left: 2.5vh;*/
            /*color: #dddddd;*/
            color: #d4d4d4;
        }

        .but {
            width: 70vw;
            margin: auto;
        }

        .but_1 {
            background-color: #ada6b6;
            color: #ffffff;
            border: none;
            height: 15vh;
            width: 30%;
            font-size: 15px;
            border-radius: 50px;
            border: solid #f7f7f7 1px;
        }

        .but_2 {
            background-color: #e0a53f;
            color: #ffffff;
            border: none;
            height: 15vh;
            width: 47vw;
            font-size: 20px;
            border-radius: 50px;
            margin-left: 2vw;
            border: solid #f7f7f7 1px;
            float: right;
        }

        .down {
            width: 100vw;
            /*margin: auto;*/
            text-align: center;
            /*bottom: 4vh;*/
            position: absolute;
            margin-top: 6vh;
        }

        .down button {
            background-color: transparent;
            color: #e0a53f;
            border: none;
            height: 15vh;
            width: 70vw;
            font-size: 13px;
            border-radius: 50px;
            border: solid #e0a53f 1px;
            font-family: "B Yekan";
        }

        input::-webkit-input-placeholder {
            color: white !important;
        }

        input:-moz-placeholder { /* Firefox 18- */
            color: white !important;
        }

        input::-moz-placeholder { /* Firefox 19+ */
            color: white !important;
        }

        input:-ms-input-placeholder {
            color: white !important;
        }

    }

    @media only screen and (max-width: 767px) {
        .btnWidthEntry {
            width: 55% !important;
            margin-right: 5%;
            float: right;
            min-width: 55%;
        }

        .btnWidthRegistry {
            width: 35% !important;
            float: right;
            ‍min-width: 35%;
        }
    }

    .fa {
        padding: 10px;
        font-size: 20px;
        /*width: 100%;*/
        /*height: 100%;*/
        text-align: center;
        text-decoration: none;
        border-radius: 50%;
    }

    .fa:hover {
        opacity: 0.7;
        background: white;
        text-decoration-line: none;
    }

    .fa-instagram {
        /*background: #e0a53f;*/
        color: #e0a53f;
    }

    fa-instagram:before {
        content: "\f16d"
    }

    .mainRow {
        position: absolute;
        /*overflow: auto;*/
        left: 0;
        /*direction: ltr;*/
        width: 100%;
        /*min-height: 100vh;*/
        /*max-height: 100vh;*/
        /*background-image: url('../images/smallBack.jpg');*/
        /*background-size: cover;*/
    }
</style>