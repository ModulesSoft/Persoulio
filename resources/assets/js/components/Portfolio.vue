<template>
    <div style="height: 100vh; width: 100%;position: absolute;left:0;" dir="ltr">
        <div class="header">
            <div class="grad1">
                <div>پرسولیو</div>
            </div>
        </div>
        <div style="display: flex; flex-direction: row; height: 90%">
            <div class="pert">
        <div class="left">
            <div class="left_1">
                <div v-if="user && appointments" class="left_1_left">
                    <div>قرار ملاقات بعدی</div>
                    <div>{{appointments.dates}}</div>
                    <!--<div> اطلاعات بیشتر</div>-->
                </div>
                <div v-if="user && appointments" class="left_1_right">
                    <img src="../../assets/ut_logo.png"/>
                    <div>
                        <div>مربی</div>
                        <div style="color:white; ">آقای پیری</div>
                    </div>
                </div>
                <div v-else>
                    <div style="background-color: black;color: white">
                        شما هنوز مربی ندارید، درخواست برای مربی
                    </div>
                </div>
            </div>
            <div class="left_2">
                <div class="left_2_1">
                    <img src="../../assets/port-zarebin.png" class="left_2_1_bg"/>
                    <!-- <div style="position: absolute; background-image: url(./assets/Path_107.png); bottom: 20px; left:10px; height: 50px; width: 50px"></div> -->
                    <div style="position: relative; z-index: -1;height: 10%; padding: 2%">
                        <p class="right_text"> آزمون ها </p>
                    </div>
                    <div style="height: 90%">
                        <div style="
                  width: 85%;
                  margin-left: auto;
                  margin-right: auto;
                  display: flex;
                  flex-direction: row;
                  height: 20%;
                  align-items: flex-start;
                  align-content: flex-start;
                  justify-content: space-around;
                  margin-top: -4%;

                  ">
                            <div class="tip" v-for="doneQuize in doneQuizes">
                                <div class="tipimg_container"
                                     @click="showQuizResult(doneQuize.id); quizResultName = doneQuize.name">
                                    <img src="../../assets/2-layers32.png"/>
                                    <div> {{doneQuize.name}}</div>
                                </div>
                            </div>
                        </div>
                        <!-- todo -->
                        <div class="transparency" style="margin-top: -4%;" v-if="quizResultName">
                            <div class="menu" style="direction: rtl">
                                نتیجه {{quizResultName}}
                            </div>
                            <div class="desc_1">
                                {{quizResultDetails}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div></div>
        <div class="right">
            <div class="right_1">
                <div v-for="quizName in quizNames" style="height: 100%; width: 100%">
                    <!--<div v-for="doneQuiz in doneQuizes">-->
                        <div v-for="doneQuiz in doneQuizes" v-if="doneQuiz.id != quizName.id" class="percent_info">
                            <div>
                                <div>{{quizName.name}}</div>
                                <div>0٪</div>
                            </div>
                        </div>
                    <!--</div>-->
                </div>
                <!--<div v-for="quizName in quizNames">-->
                    <!--<div v-for="doneQuiz in doneQuizes">-->
                        <!--<div v-if="doneQuiz.id == quizName.id" class="percent_info2">-->
                            <!--<div>-->
                                <!--<div>{{quizName.name}}</div>-->
                                <!--<div>100٪</div>-->
                            <!--</div>-->
                        <!--</div>-->
                    <!--</div>-->
                <!--</div>-->
                <div class="line_between">
                </div>
                <div v-if="user" class="img_container">
                    <img :src="user.photo" class="img_fill_div"/>
                    <div>{{user.uses.firstName}} {{user.uses.lastName}}</div>
                </div>
            </div>
            <div class="right_2">
                <!-- <div style="background: #2a891a" class="img_fill_div"></div> -->
                <!-- <img src="../../assets/linechart.png" class="img_fill_div"/> -->
                <div class="menu1">
                    <div class="menu_2">
                        <div class="" style="color: white;display: table-cell;
                background: linear-gradient(to top,#cd9cf8 , #d28bf2);">
                            <a class="a_ok_color" href="#">
                                مهارت ها
                            </a>
                        </div>
                        <div class="" stylye="display: table-cell;">
                            <a class="a_ok_color" href="#">
                                مدارک
                            </a>
                        </div>
                        <div class="" style="display: table-cell;">
                            <a class="a_ok_color" href="#">
                                تجربیات
                            </a>
                        </div>
                        <div class="" style="display: table-cell;">
                            <a class="a_ok_color" href="#">
                                دستاوردها
                            </a>
                        </div>
                    </div>
                    <div class="menu_3">
                        <div class="" style="display: table-cell;">
                            <a class="a_ok_color" href="#">
                                تحلیلی
                            </a>
                        </div>
                        <div class="" stylye="display: table-cell;">
                            <a class="a_ok_color" href="#">
                                کار و پروژه
                            </a>
                        </div>
                        <div class="" style="display: table-cell;">
                            <a class="a_ok_color" href="#">
                                کلاس ها
                            </a>
                        </div>
                        <div class="" style="color: white;display: table-cell;
                background: #a253e9;">
                            <a class="a_ok_color" href="#">
                                سمینار و کارگاه ها
                            </a>
                        </div>
                    </div>
                    <div class="tozihat_panel" id="div1">
                        <a v-for="article in doneTunnels"  class="a_ok_color" href="#">
                            <div class="card">
                                <div class="card card-9-3">
                                    <div class="card-body card-swap">
                                        <div class="card-left">
                                            <img v-if="article.image.pic" v-bind:src="article.image.pic" class="img-responsive">
                                        </div>
                                        <div class="card-right">
                                            <h2 style="text-align: right">{{article.name}}</h2>
                                            <p style="text-align: right;">
                                                {{article.description}}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <!--<p>تاریخ ۹۸/۵/۸</p>-->
                                        <p>نام استاد{{article.launcher}}</p>
                                        <div style="font-size: 1.4rem;">
                                            <i class="fas fa-star fa-xs" style="color: gold;"></i>
                                            <i class="fas fa-star fa-xs" style="color: gold;"></i>
                                            <i class="fas fa-star fa-xs" style="color: gold;"></i>
                                            <i class="fas fa-star fa-xs" style=""></i>
                                            <i class="fas fa-star fa-xs" style=""></i>
                                            <i class="fas fa-star fa-xs" style=""></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Portfolio",
        data() {
            return {
                quizNames: null,
                user: null,
                doneQuizes: null,
                quizResultName: "",
                quizResultDetails: "",
                appointments: null,
                doneTunnels: null,
            }
        },
        mounted() {
            this.fetchData();
        },
        methods: {
            fetchData() {
                var form = new FormData();
                // form.append('id', id);
                axios.post('/getQuizesName', form).then(response => {
                        this.quizNames = response.data;
                        // console.log(this.event.image);
                    }
                );
                var form = new FormData();
                // form.append('id', id);
                axios.post('/getPersonalData', form).then(response => {
                        this.user = response.data;
                        this.getAdvisorData(response.data.uses.id);
                        // console.log(this.event.image);
                    }
                );
                var form = new FormData();
                // form.append('id', id);
                axios.post('/doneQuizes', form).then(response => {
                        this.doneQuizes = response.data;
                        // console.log(response.data);
                    }
                );
                var form = new FormData();
                // form.append('id', id);
                axios.post('/myDates', form).then(response => {
                        // this.user = response.data;
                        // console.log(response.data);
                        this.appointments = response.data
                    }
                );
                var form = new FormData();
                // form.append('id', id);
                axios.post('/getMyDoneTunnels', form).then(response => {
                        this.doneTunnels = response.data;
                    }
                );
            },
            getAdvisorData(id) {
                var form = new FormData();
                form.append('studentId', id);
                axios.post('/getPatientDates', form).then(response => {
                        this.appointments = response.data;
                        // console.log(response.data);
                    }
                );
            },
            showQuizResult(id) {
                var form = new FormData();
                // form.append('id', id);
                axios.post('/sendQuizResult', form).then(response => {
                        this.quizResultDetails = response.data;
                        // console.log(response.data);
                    }
                );
            }
        }
    }
</script>

<style scoped>
    @font-face {
        font-family: "yekan";
        src: url('../../fonts/b-yekan.ttf') format('truetype');
    }

    @font-face {
        font-family: "ghasem";
        src: url('../../fonts/AGhasem.ttf') format('truetype');
    }

    /*@font-face {*/
    /*font-family: "sina";*/
    /*src: url('fonts/sina.ttf') format('truetype');*/
    /*}*/

    .grad1{
        font-family: "ghasem";
        height: 100%;
        /* background: rgb(76, 0, 255); For browsers that do not support gradients */
        /* background: linear-gradient(to right,#b247a5,
        rgb(248, 92, 118),rgb(248, 92, 118),
        rgb(248, 92, 118), rgb(236, 214, 14)); Standard syntax (must be last) */
        width: 100%;
        color: white;
        font-size:40px;
        font-weight: 500;
        /* line-height: 90px ; */
        /* text-align: center; */
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
    }
    .grad1 > div{
        width: max-content;
        background: linear-gradient(to right,#b247a5,
        rgb(248, 92, 118),rgb(248, 92, 118),
        rgb(248, 92, 118), rgb(236, 214, 14));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .header {
        height: 10vh;
        line-height: 10vh;
        top: 0;
        width: 100%;
        border-bottom: 1px solid rgb(209, 194, 194);
    }


    .pert {
        /*position: absolute;*/
        left: 0;
        direction: ltr;
        font-family: "yekan";
        width: 100%;
        height: 90%;
        background: linear-gradient(to top, white, rgb(224, 224, 224));
        background: rgb(255, 255, 255);
        /* background: red; */
        display: grid;
        grid-template-columns: 50% 1% 49%;
        padding: 1% 1%;
    }

    .pert > div {
        width: 100%;
        height: 100%;;
    }

    .right {
        /* background: cyan; */
    }

    .right_1 {
        border-radius: 15px;
        overflow: hidden;
        /* background: rgb(223, 81, 223); */
        width: 100%;
        height: 30%;
        display: flex;
        flex-direction: row;
        justify-content: space-around;
        align-items: center;
        background-image: url(../../assets/background.png);

        /* background: linear-gradient(to right bottom,
        rgba(152, 95, 0, 0.99) 15%,
        #640935,#640935,
        #560043,#560043,
        rgba(58, 0, 34, 1)
    ); */
    }

    .percent_info > div {
        width: 70%;
        height: 70%;
        margin-left: 15%;
        margin-top: 15%;
        border-radius: 50%;
        background: #bb5d7f;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding-top: 10%;
        color: white;
    }

    .percent_info {
        max-height: 90%;
        max-width: 30%;
        height: 8em;
        width: 8em;
        border-radius: 50%;
        background: #c98faf;
        background-image: linear-gradient(149deg, transparent 50%, #f5e8e2 50%), linear-gradient(90deg, #f5e8e2 50%, transparent 50%);
        z-index: 1;
    }

    .percent_info2 {
        max-height: 90%;
        max-width: 30%;
        height: 8em;
        width: 8em;
        border-radius: 50%;
        background: #c98faf;
        background-image: linear-gradient(149deg, transparent 100%, #f5e8e2 50%), linear-gradient(90deg, #f5e8e2 50%, transparent 50%);
        z-index: 1;
    }

    .percent_info > div > :nth-child(1) {
        font-size: 25px;
        font-weight: 400;
    }

    .line_between {
        width: 2px;
        background: white;
        height: 80%;
    }

    .img_container {
        max-height: 90%;
        max-width: 30%;
        height: 8em;
        width: 8em;
        border-radius: 50%;
        background: blue;
        position: relative;
    }

    .img_container > img {
        border-radius: 50%;
    }

    .img_fill_div {
        height: 100%;
        width: 100%;
    }

    .mag_image {
        z-index: 1;
        position: absolute;
        bottom: 15px;
        left: 15px;
        width: 50%;
    }

    .img_container > div {
        position: absolute;
        width: 150%;
        left: -20%;
        text-align: center;
        top: 100%;
        color: white;
        font-size: 15px;
    }

    .right_2 {
        width: 100%;
        height: calc(70% - 10px);
        margin-top: 10px;
        border-radius: 15px;
        overflow: hidden;
        background: red;
    }

    .menu1 {
        /* padding: 20px;    */
        width: 100%;
        height: 100%;
        background: red;
        background: linear-gradient(to right, #e2aeff, #e796ff);
        /* margin-top: 10px; */
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
        overflow: hidden;
        min-height: 50vh;
        text-align: center;
        display: flex;
        flex-direction: column;
        font-size: 20px;
        /* //to delete later */
    }

    .menu_2 {
        display: table;
        /* align-content: space-between; */
        /* border-top-left-radius: 15px;
        border-top-right-radius: 15px; */
        align-items: center;
        table-layout: fixed;
        width: 100%;
        height: 8vh;
        line-height: 8vh;
        color: #b76ccc;
        /* margin-top: 10px; */
    }

    .menu_3 {
        display: table;
        /* align-content: space-between; */
        background: linear-gradient(to top, #c596f1, #cd92f9);
        /* background: red; */
        align-items: center;
        table-layout: fixed;
        width: 100%;
        height: 8vh;
        line-height: 8vh;
        color: #b260d7;
        /* margin-top: 10px; */
    }

    .tozihat_panel {
        min-height: 34vh;
        max-height: 45vh;
        overflow-y: scroll;
        /* scroll-behavior: smooth; */
        background: red;
        background: linear-gradient(to top, #b787f7, #9e50eb);
        /* background: #9e50eb; */
        /* background: #b787f7; */
        /* position: absolute; */
        display: flex;
        flex-direction: column;
    }

    .a_ok_color {
        color: inherit;
        /* display: block;

        text-decoration: none; */

    }

    .left {
        height: 100%;
        width: 100%;
        /* background: cyan; */
    }

    .left_1 {
        width: 100%;
        height: 21%;
        border-radius: 15px;
        overflow: hidden;
        padding: 10px;
        background-image: linear-gradient(112deg, #1a122b 0%, #3d3251 100%);
        display: grid;
        grid-template-columns: 60% 40%;
    }

    .left_1_left {
        width: 100%;
        height: 100%;
        /* background: cyan; */
        border-right: 1px solid white;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        color: gray;
        font-size: 19px;
        font-weight: 400;
        padding-right: 10%;
        padding-left: 10%;
    }

    .left_1_left > :nth-child(1) {
        text-align: right;
    }

    .left_1_left > :nth-child(2) {
        color: white;
        font-size: 38px;
        font-weight: 500;
        text-align: center;
    }

    .left_1_left > :nth-child(3) {
        cursor: pointer;
    }

    .left_1_right {
        width: 100%;
        height: 100%;
        /* background: cyan; */
        display: flex;
        flex-direction: row;
        align-items: center;
        color: gray;
        font-size: 28px;
        font-weight: 400;
        padding: 5%;
        max-height: 100%;
    }

    .left_1_right > img {
        border-radius: 50%;
        cursor: pointer;
        height: 100%;
        width: auto;
    }

    .left_1_right > div {
        height: 100%;
        width: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-around;
        align-items: flex-end;
    }

    .left_2 {
        width: 100%;
        height: calc(79% - 10px);
        margin-top: 10px;
        /* background: rgb(60, 0, 128); */
        display: grid;
        /* grid-template-columns: 59% 2% 39%; */
        grid-template-columns: 100%;
    }

    .left_2_1 {
        position: relative;
        background: gray;
        background: #707070;
        height: 100%;
        width: 100%;
        /* background: cyan; */
        border-radius: 15px;
        overflow: hidden;
        color: white;
    }

    .left_2_1_bg {
        position: absolute;
        width: 38%;
        height: auto;
        top: 40%;
        left: 6%;
        z-index: 0;
    }

    .tip {
        cursor: pointer;
        height: 12vh;
        width: 12vh;
        border-radius: 50%;
        color: white;
        text-align: center;
        display: flex;
        justify-content: center;
        align-items: center;
        align-content: center;
        padding: 0;
        font-size: 20px;
        /* background-image: url(./assets/2-layers32.png) !important;
        background-size: cover;
        background-repeat:   no-repeat;
        background-position: center center;   */
    }

    .tipimg_container {
        position: relative;
        height: 100%;
        /* background: #b247a5 !important; */
        width: 100%;
    }

    .tipimg_container > img {
        height: 100%;
        width: auto;
    }

    .tipimg_container > :nth-child(2) {
        position: absolute;
        top: 0px;
        left: 0px;
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .right_text {
        text-align: right;
    }

    .left_text {
        text-align: left;
    }

    .center_text {
        text-align: center;
    }

    .transparency {
        /* -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";       IE 8 */
        /* filter: alpha(opacity=50);  IE 5-7 */
        /* -moz-opacity: 0.5;          Netscape */
        /* -khtml-opacity: 0.5;        Safari 1.x */
        /* opacity: 0.5;           */
        /* background: #ebc08c; */
        height: calc(85% + 30px);
        margin-top: -10%;
        /* margin-right: -10px; */
        /* margin-left: -5px; */
        overflow: hidden;
        /* color: #43045c; */
        padding-top: 10%;
    }

    .menu {
        /* direction: rtl; */
        position: relative;
        cursor: pointer;
        width: 100%;
        height: 10%;
        border-bottom: 1px solid black;
        display: flex;
        align-items: center;
        justify-content: flex-end;
        padding-right: 5%;
        /* background: cyan; */
    }

    .transparency > :nth-last-child(1) {
        border: 0px;
    }

    .transparency > :nth-child(1) {
        /* border: 0px; */
    }

    .desc {
        width: 100%;
        height: 40%;
        background: rgb(187, 187, 187);
        color: white;
        z-index: 2 !important;
        position: relative;
    }

    .desc_1 {
        width: 100%;
        height: 30%;
        display: flex;
        display: grid;
        grid-template-columns: 50% 50%;
        background: rgb(173, 173, 173);
    }

    .desc_active {
        background: rgb(187, 187, 187);
    }

    .desc_1 > div {
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
    }

    .desc_2 {
        width: 100%;
        height: 70%;
        display: grid;
        grid-template-columns: 50% 50%;

    }

    .desc_2 > div {
        font-size: 30px;
        font-weight: 400;
        height: 100%;
        width: 100%;
        cursor: pointer;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .left_2_2 {
        height: 100%;
        width: 100%;
        /* background: cyan; */
    }

    .left_2_2_1 {
        width: 100%;
        height: 25%;
        /* background: red; */
        background-image: linear-gradient(45deg, #ff6666 0%, #ffae12 100%);
        padding: 2% 4%;
        border-radius: 15px;
        display: flex;
        flex-direction: row;
        color: white;
    }

    .left_2_2_1 > :nth-child(1) {
        height: 100%;
        width: 70%;
        font-family: "sina";
        font-size: 80px;
        /* font-size: 20px; */
        /* background: orangered; */
        display: flex;
        justify-content: center;
        align-items: center;
        /* align-content: flex-end; */
        /* background: #ff6666; */
    }

    .left_2_2_1 > :nth-child(2) {
        height: 100%;
        width: 30%;
        /* background: yellow; */
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .left_2_2_2 {
        width: 100%;
        height: calc(30% - 10px);
        margin-top: 10px;
        /* background: orange; */
        display: grid;
        grid-template-columns: 49% 2% 49%;
    }

    .left_2_2_2_item {
        position: relative;
        padding-top: 20px;
        overflow: hidden;
        height: 100%;
        width: 100%;
        border-radius: 15px;
        background: cyan;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center center;
        background: linear-gradient(235deg, #ffae12 0%, #ff6666 100%);
        display: flex;
        justify-content: center;
        align-content: center;
        align-items: center;
        cursor: pointer;
    }

    .left_2_2_2_item > div {
        position: absolute;
        right: 10px;
        top: 10px;
        color: white;
        font-size: 16px;
        font-weight: 300;
    }

    .left_2_2_2_item_large_img {
        position: absolute;
        height: 100%;
        width: auto;
        opacity: 0.2;
    }

    .left_2_2_3 {
        width: 100%;
        height: calc(45% - 10px);
        margin-top: 10px;
        /* background: orange; */
        display: grid;
        grid-template-columns: 38% 1% 30% 1% 30%;
    }

    .left_2_2_3_item {
        position: relative;
        height: 100%;
        width: 100%;
        border-radius: 15px;
        background-image: linear-gradient(46deg, #ff6666 0%, #ffae12 100%);
        display: flex;
        flex-direction: column;
        color: white;
        justify-content: center;
        align-items: center;
        overflow: hidden;
    }

    .left_2_2_3_item > :nth-child(1) {
        font-size: 55px;
        font-weight: 400;
        /* padding: 0px; */
    }

    .left_2_2_3_item > :nth-child(2) {
        font-size: 25px;
        font-weight: 300;
        margin-top: -20px;
    }

    .left_2_2_3_item_med > :nth-child(1) {
        font-size: 50px;
        font-weight: 400;
        /* padding: 0px; */
    }

    .left_2_2_3_item_med > :nth-child(2) {
        font-size: 23px;
        font-weight: 300;
        margin-top: -20px;
    }

    .left_2_2_3_item_small > :nth-child(1) {
        font-size: 45px;
        font-weight: 400;
        /* padding: 0px; */
    }

    .left_2_2_3_item_small > :nth-child(2) {
        font-size: 21px;
        font-weight: 300;
        margin-top: -20px;
    }

    .left_2_2_3_item_large_img {
        position: absolute;
        width: 96%;
        left: 2%;
        height: auto;
        bottom: 0px;
        opacity: 0.7;
    }
</style>