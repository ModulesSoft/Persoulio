<template>

    <div style="width: 100%;height: 100%; overflow-x: visible !important;overflow-y: visible !important;" v-if="user">
        <nav role="navigation">
            <div id="menuToggle">
                <input type="checkbox"/>
                <span></span>
                <span></span>
                <span></span>
                <div id="menu" class="rightt">
                    <div class="right_1">
                        <div class="user_header">
                            <div style="display: flex; flex-direction: row; align-items: center">
                                <div style="margin-right: 5px;">{{user.uses.firstName+" "+user.uses.lastName}}</div>
                                <div class="prof_img_border"><a href="#"> <img v-bind:src="user.photo"
                                                                               class="user_pic"/>
                                </a></div>
                            </div>
                        </div>
                    </div>
                    <div class="right_2">
                        <div class="right_2_up"></div>
                        <div class="right_2_down">
                            <div class="moshaver_frame">
                                <div class="moshaver_img_frame">
                                    <img class="img-circle img_fill_div" src="../../assets/mojtaba.jpg"
                                         style="border-radius: 50%">
                                    <!--</div>-->
                                </div>
                            </div>
                            <div class="message_frame">
                                <p>سلام</p>
                                <div>{{user.messages}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="right_3" id="div1">
                        <div class="right_3_today">
                            <p style="font-size: 18px;font-weight: 800; text-align: right; color: white;">
                                برنامه بعدی امروز
                            </p>
                            <p style="font-size: 30px;font-weight: 800; text-align: center; color: #7b7a68;
                    margin-top: -.7em;">
                                ساعت ۱۵:۰۰
                            </p>
                            <p style="font-size: 20px;font-weight: 400; text-align: left; color: #7b7a68;
                    margin-top: -1em;">
                                <a href="#" class="a_ok_color"> کلاس طراحی </a>
                            </p>
                        </div>
                        <div class="right_3_week">
                            <div v-for="notif in user" class="right_3_week_day">
                                <div class="right_3_week_day_left">
                                    <div class="centered_text_div"><a href="#" class="a_ok_color"></a></div>
                                </div>
                                <div class="right_3_week_day_right">
                                    <div class="centered_text_div">{{notif.week}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="right_4">
                        <a href="/logout" class="a_ok_color">
                            <div class="my_button centered_text_div">
                                خروج
                            </div>
                        </a>
                        <a href="#" class="a_ok_color"><i class="fas fa-cog fa-2x"></i></a>
                    </div>
                </div>
            </div>
        </nav>
    </div>

</template>

<script>
    export default {
        name: "UserSummary",
        data() {
            return {user: null}
        },
        mounted() {
            // console.log("umad " + this.id)
            this.fetchData(this.user);
        },
        methods: {
            fetchData(id) {
                var form = new FormData();
                // form.append('eventId', id);
                axios.post('/getPersonalData', form).then(response => {
                        this.user = response.data;
                        // console.log(response.data);
                    }
                );
            }
        }
    }
</script>

<style scoped>


    @media screen and (max-width: 600px) {
        .my_button {
            border-radius: 15px !important;
            /*background: rgb(168, 168, 168);*/
            height: 5vh !important;
            width: 20vw !important;
            /*cursor: pointer;*/
        }
    }

    @media screen and (min-width: 601px) {
        #menuToggle input {
            visibility: hidden !important;
        }

        #menuToggle span {
            visibility: hidden !important;
        }

        #menuToggle menu {
            margin: 0px !important;
        }

        #menu {
            /*position: absolute;*/
            /*width: 100%;*/
            /* margin: -100px 0 0 -50px; */
            width: 20vw !important;
            /*margin-left: -80%;*/
            margin-left: 0px !important;
            /* margin-top: -10v; */
            top: -2vh;
            height: 90vh;
            padding: 50px;
            left: -80% !important;
            /* padding-left: 100px; */
            padding-top: 125px;
            /* margin-top: -10px; */
            background: #ededed;
            /*background: #0f74a8 !important;*/
            list-style-type: none;
            -webkit-font-smoothing: antialiased;
            /* to stop flickering of text in safari */

            transform-origin: 0% 0%;
            transform: translate(140%, 0);

            transition: transform 0.5s cubic-bezier(0.77, 0.2, 0.05, 1.0);
            transform: unset !important;
            transition: unset !important;
        }

    }

    .rightt {
        background: #f9f9f9 !important;
        font-family: "yekan";
        height: 100%;
        width: 100%;
        padding: 0px !important;
        /*background: rgb(243, 243, 243);*/
        /*overflow-y: scroll;*/
        overflow-y: hidden;
        border-left: 2px solid rgb(180, 180, 180);
        padding-top: 12px !important;
        padding-left: 15px !important;
        padding-right: 12px !important;
    }

    .rightt > div {
        /*background: #0f74a8;*/
        width: 100%;
    }

    #menuToggle {
        /* color: blue !important; */
        display: block;
        position: relative;
        /*background: red !important;*/
        top: -5vh;
        left: 80%;

        z-index: 10;

        -webkit-user-select: none;
        user-select: none;
    }

    #menuToggle input {
        display: block;
        width: 40px;
        height: 32px;
        position: absolute;
        top: -7px;
        left: -5px;
        background: black !important;
        cursor: pointer;

        opacity: 0;
        z-index: 2;

        -webkit-touch-callout: none;
    }

    #menuToggle span {
        display: block;
        width: 33px;
        height: 4px;
        margin-bottom: 5px;
        position: relative;

        background: #cdcdcd;
        /*background: white;*/
        border-radius: 3px;

        /*z-index: 10;*/

        transform-origin: 4px 0px;

        transition: transform 0.5s cubic-bezier(0.77, 0.2, 0.05, 1.0),
        background 0.5s cubic-bezier(0.77, 0.2, 0.05, 1.0),
        opacity 0.55s ease;
    }

    #menuToggle span:first-child {
        transform-origin: 0% 0%;
    }

    #menuToggle span:nth-last-child(2) {
        transform-origin: 0% 100%;
    }

    #menuToggle input:checked ~ span {
        opacity: 1;
        transform: rotate(45deg) translate(-2px, -1px);
        background: #232323;
    }

    #menuToggle input:checked ~ span:nth-last-child(3) {
        opacity: 0;
        transform: rotate(0deg) scale(0.2, 0.2);
    }

    #menuToggle input:checked ~ span:nth-last-child(2) {
        /* background: #232323; */
        transform: rotate(-45deg) translate(0, -1px);
    }

    #menuToggle input:checked ~ #menu {
        /*background: #232323 !important;*/
        z-index: 5;
    }

    #menu {
        position: absolute;
        width: 100%;
        /* margin: -100px 0 0 -50px; */
        margin-left: -80%;
        /* margin-top: -10v; */
        top: 5vh;
        height: 90vh;
        padding: 50px;
        /* padding-left: 100px; */
        padding-top: 125px;
        /* margin-top: -10px; */
        background: #ededed;
        list-style-type: none;
        -webkit-font-smoothing: antialiased;
        /* to stop flickering of text in safari */

        transform-origin: 0% 0%;
        transform: translate(140%, 0);
        z-index: -1px;

        transition: transform 0.5s cubic-bezier(0.77, 0.2, 0.05, 1.0);
    }

    /*#menu div*/
    /*{*/
    /*display: inline;*/
    /*padding: 10px 10px;*/
    /*margin: 20px;*/
    /*font-size: 22px;*/
    /*!* color: red; *!*/
    /*cursor: pointer;*/
    /*}*/

    #menuToggle input:checked ~ div {
        transform: none;
    }

    .user_header {
        background: #facb5f;
        background: white;
        height: 100%;
        color: rgb(53, 53, 53);
        border-radius: 15px;
        /* border: 1px solid black; */
        box-shadow: 0px 0px 8px #a4a4a4;
        font-size: 20px;
        font-weight: 300;
        padding-top: 10px;
        display: flex;
        flex-direction: row;
        justify-content: flex-end;
        align-items: center;
        cursor: pointer;
    }

    a:hover {
        text-decoration: none;
    }

    .user_pic {
        width: 50px;
        height: 50px;
        margin-left: 15px;
        border-radius: 50%;
    }

    .prof_img_border {
        margin-right: 10px;
        border-left: 1px solid rgb(209, 194, 194);
    }

    .a_ok_color {
        color: inherit;
    }

    .right_1 {
        height: 14%;
        padding-bottom: 10px;
    }

    .right_2 {
        height: 37%;
        /* background: #ea7b86; */
        background: blue;
        background: linear-gradient(to right bottom, rgb(242, 160, 43), rgb(175, 35, 219));
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
        overflow: hidden;
        border-bottom: 7px solid white;
        padding-bottom: 3px;
    }

    .right_2_up {
        /* background: linear-gradient(to top , #ea7b86 10%, #f3ada5 70%); */
        height: 40%;
    }

    .right_2_down {
        height: 60%;
        margin-right: 4px;
        margin-left: 2px;
        background: white;
        color: black;
        position: relative;
    }

    .moshaver_frame {
        /* background: linear-gradient(to top , #ea7b86 40%, #f59d9c 100%); */
        width: 100px;
        height: 100px;
        border-radius: 50%;
        margin-left: auto;
        margin-right: auto;
        position: absolute;
        left: calc(50% - 50px);
        top: -60px;
        padding: 10px;
        /*background: linear-gradient(to right bottom,rgb(242, 160, 43), rgb(175, 35, 219));*/
        /*box-shadow: 0px 0px 10px rgba(175, 35, 219,0.1);*/
    }

    .moshaver_img_frame {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background: blue;
    }

    .message_frame {
        /*background: #b247a5;*/
        position: absolute;
        top: 40px;
        height: calc(100% - 40px);
        width: 100%;
        padding-right: 15px;
        padding-left: 15px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: flex-end;
        font-size: 20px;
        font-weight: 600;
        color: #6e6e6e;
        overflow-y: scroll;
        padding-top: 4%;
    }

    .img_fill_div {
        width: 100%;
        height: 100%;
    }

    .right_3 {
        height: 40%;
        overflow-y: scroll;
    }

    .right_3_today {
        height: 15vh;
        /*background: #f4d459;*/
        background: rgb(187, 187, 187);
        background: #e3e3e3;
        width: 100%;
        /*border-bottom-left-radius: 15px;*/
        /*border-bottom-right-radius: 15px;*/
        padding-left: 20px;
        padding-right: 15px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .right_3_week {
        margin-left: 3px;
        margin-right: 3px;
        border: 1px solid #c9c8b5;
        border-top: 0;
        border-bottom-left-radius: 15px;
        border-bottom-right-radius: 15px;
        overflow: hidden;
        margin-top: -6px;
        padding-top: 6px;
    }

    .right_3_week_day {
        height: 10vh;
        margin-bottom: -1px;
        border-bottom: 1px solid #c9c8b5;
        font-size: 0;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .centered_text_div {
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        align-content: center;
    }

    .right_3_week_day_left {
        display: inline-block;
        width: 65%;
        height: 100%;
        font-size: 23px;
        font-weight: 500;
        color: rgb(141, 141, 141);
    }

    .right_3_week_day_right {
        display: inline-block;
        width: 35%;
        height: 100%;
        font-size: 20px;
        font-weight: 400;
        color: rgb(168, 168, 168);
        padding-right: 10px;
    }

    .right_4 {
        height: 9%;
        display: flex;
        flex-direction: row;
        justify-content: space-around;
        align-items: center;
    }

    .my_button {
        border-radius: 20px;
        background: rgb(168, 168, 168);
        height: 4vh;
        width: 7vw;
        cursor: pointer;
    }

    .my_button:hover {
        background: #8b8080;
    }

    .moshaver_pm {
        visibility: hidden;
        /* changes after click */
        width: 100%;
        background: cyan;
        /* height: 30px; */
        position: relative;
        top: 40%;
        padding: 10px;
    }

    .moshaver_pm_1 {
        width: 80%;
        padding: 5px;
        background: gray;
        margin-top: 10px;
        display: flex;
        justify-content: center;
    }

    .moshaver_pm_2 {
        width: 80%;
        padding: 5px;
        background: pink;
        margin-top: 10px;
        margin-left: auto;
        display: flex;
        justify-content: center;
    }

    .show_chat_icon {
        position: absolute;
        bottom: 10px;
        left: 10px;
        color: #6e6e6e;
        cursor: pointer;
    }

    .left {
        display: grid;
        width: 100%;
        height: 100%;
        padding: 0;
        margin: 0;
        grid-template-rows: 15% 85%;
        background: linear-gradient(to top, white, #ececec);
    }


</style>