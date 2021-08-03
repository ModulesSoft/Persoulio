<template>
    <div style="height: 100vh; width: 100%;position: absolute;left:0;" dir="ltr">
        <div class="header">
            <div class="grad1">
                <div>پرسولیو</div>
            </div>
        </div>

        <div v-if="event" style="display: flex; flex-direction: row; height: 90%; width: 100%;">
            <div class="left">
                <div class="left_1">
                    <div class="left_1_left">
                        <div class="buy_box">
                            <div v-if="event" class="gheymat">
                                {{event.price}} تومان
                            </div>
                            <div class="buy_container">
                                <!--<div>افزودن به سبد خرید +</div>-->
                                <!--<i class="fa fa-star"></i>-->
                                <div style="font-size: 25px;">خرید</div>

                            </div>
                        </div>
                    </div>
                    <div class="left_1_right">
                        <div class="ted_titles">
                            <div> {{event.price}} </div>
                            <div>{{event.place}}</div>
                            <div>
                                <div class="ted_circ"></div>
                                <div class="ted_circ"></div>
                                <div class="ted_circ"></div>
                            </div>
                        </div>
                        <img v-if="event.image[0]" v-bind:src="event.image[0].pic" class="ted"/>
                    </div>
                </div>
                <div class="left_23" id="div1" v-if="event.image">
                    <div v-for="image in event.image" >
                        <img v-bind:src="image.pic" class="img-responsive img_fill_div"/>
                    </div>
                </div>
                <div class="left_3">
                    <div @click="tab = 3" v-if="tab == 3" class="active">نظرات</div>
                    <div @click="tab = 3" v-else>نظرات</div>
                    <div @click="tab = 2" v-if="tab == 2" class="active">اطلاعات</div>
                    <div @click="tab = 2" v-else>اطلاعات</div>
                    <div @click="tab = 1" v-if="tab == 1" class="active">توضیحات</div>
                    <div @click="tab = 1" v-else>توضیحات</div>
                </div>

                <router-link style="color: unset;" to="/dashboard">
                    <div class="goback">
                    بازگشت
                </div>
                </router-link>

                <comments  v-if="tab == 3" :id="id"></comments>
                <information  v-if="tab == 2" :id="id"></information>
                <description  v-if="tab == 1" :id="id"></description>
        </div>

    <div class="right">
        <user-summary></user-summary>
    </div>
        </div>
    </div>
</template>

<script>
    import Vue from 'vue'
    Vue.component('user-summary', require('./UserSummary.vue'));
    Vue.component('comments', require('./article/Comments.vue'));
    Vue.component('description', require('./article/Description.vue'));
    Vue.component('information', require('./article/Information.vue'));
    export default {
        name: "Article"
        ,
        data(){
            return{
                id : null,
                tab : 1,
                event: null
            }
        }
        ,mounted(){
            this.id = this.$route.params.id;
            // console.log("umad " + this.id)
            this.fetchData(this.id);
        },
        methods: {
            fetchData(id) {
                var form = new FormData();
                form.append('id', id);
                axios.post('/getEventsById', form).then(response => {
                        this.event = response.data;
                        // console.log(this.event.image);
                    }
                );
            }
        }
    }
</script>

<style scoped>

    @media screen and (max-width: 600px) {
        .right {
            font-family: "yekan";
            height: 100%;
            width: 70% !important;
            left: 30% !important;
            position: absolute;
            /*z-index: 5 !important;*/
            /*background: rgb(243, 243, 243);*/
            /*overflow-y: scroll;*/
            /*overflow-y: hidden;*/
            /*padding-top: 12px;*/
            /*padding-left: 15px;*/
            /*padding-right: 12px;*/
            padding: 0px !important;
            border: 0px !important;
            background: unset !important;
        }

        .left_1 {
            height: 30%;
            width: 100%;
            display: flex;
            flex-direction: row;
            background: unset;
            border-radius: 0px;
            font-size: 14px;
            /*background: red !important;*/
        }

        .left_1_left{
            /*height: 100%;*/
            width: 30% !important;
            /* background: cyan; */
            /*display: flex;*/
            /*padding-top: 5%;*/
            /*flex-direction: column;*/
            /*justify-content: center;*/
            /*align-items: center;*/
        }
        .buy_box{
            width: 90% !important;
            /*height: 70%;*/
            margin-top: -30% !important;
            /* background: red; */
            /*border-radius: 30px;*/
            /*overflow: hidden;*/
            /* box-shadow: 0px 0px 1px; */
        }
        .buy_box > div{
            /*height: 50%;*/
            /*width: 100%;*/
        }

        .buy_container{
            /*background-image: linear-gradient(112deg, #7bdc67 0%, #63cdc6 100%);*/
            /*display: flex;*/
            /*justify-content: center ;*/
            /*padding-right: 3%;*/
            /*align-items: center;*/
            /*flex-direction: row;*/
            /*cursor: pointer;*/
            /*color: white;*/
            font-size: 20px !important;
            /*font-size: 100%;*/
            /*max-font-size: 10vh;*/
            /*font-weight: 500;*/
        }
        .gheymat{
            /*background: white;*/
            /*display: flex;*/
            /*align-items: center;*/
            /*justify-content: center;*/
            font-size: 20px !important;
            /*max-font-size: 1vh;*/
            /*font-weight: 700;*/
            /*color: rgb(30, 73, 2);*/
        }

        .left_1_right{
            /*height: 100%;*/
            width: 70% !important;
            /* background: red; */
            /*display: flex;*/
            /*padding-right: 10%;*/
            /*padding-left: 10%;*/
            padding-left: 1% !important;
            padding-right: 1% !important;
            /*padding-top: 3%;*/
            /*display: flex;*/
            /*flex-direction: row;*/
            /*justify-content: flex-end;*/
        }

        .ted{
            /* background: cyan; */
            width: 100px !important;
            height: 100px !important;
            /*max-height: max-content;*/
            /*max-width: max-content;*/
            /*border-radius: 20px;*/
        }

        .ted_titles{
            /*display: flex;*/
            /*flex-direction: column;*/
            /* background: cyan; */
            /*height: 100px;*/
            /*margin-right: 5%;*/
            /* padding: 10px 0px; */
            /*align-items: flex-end;*/
            /*justify-content: space-between;*/
        }
        .ted_titles > :nth-child(1){
            /*color: rgb(65, 65, 65);*/
            font-size: 20px !important;
            /*font-weight: 600;*/
            /*margin-top: 10px;*/
        }
        .ted_titles > :nth-child(2){
            /*color: rgb(107, 107, 107);*/
            font-size: 12px !important;
            /*font-weight: 500;*/
        }
        .ted_titles > :nth-child(3){
            /*display: flex;*/
            /*flex-direction: row;*/
            /*justify-content: flex-end;*/
        }

        .ted_circ{
            /*background: rgb(255, 255, 255);*/
            height: 8px !important;
            width: 8px !important;
            /*border-radius: 50%;*/
            /*margin-left: 6px;*/
        }

        .left_23{
            /*width: 100%;*/
            /*height: 55%;*/
            /* background: blue; */
            /*padding-left: 7%;*/
            padding-right: 3% !important;
            /*overflow-x: scroll;*/
            /*white-space: nowrap;*/
            /*overflow-y: hidden;*/
            /*font-size: 0px;*/
        }
        .left_23 > div{
            /*display: inline-block;*/
            width: 50% !important;
            /*height: 100%;*/
            /*background: red;*/
            /*margin-right: 2%;*/
        }

    }
    @media screen and (min-width: 601px) {
        .left{
            width: 80% !important;
        }
    }

    .goback{
        position: absolute;
        left: 2%;
        top: 13vh;
        background: darkgray;
        border-radius: 3px;
        padding: 4px;
        font-size: 18px;
        cursor: pointer;
    }
    .goback:hover{
        background: gray;
    }

    @font-face {
        font-family: "yekan";
        src: url('../../fonts/b-yekan.ttf') format('truetype');
    }

    @font-face {
        font-family: "ghasem";
        src: url('../../fonts/AGhasem.ttf') format('truetype');
    }
    .img_fill_div{
        width: 100% !important;
        height: 100% !important;
    }
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

    .left {
        background: silver;
        height: 100%;
        width: 100%;
        padding-top: 40px;
        background: linear-gradient(180deg, #ebebeb 0%, #ffffff 100%);
        overflow-y: scroll;
        z-index: 4;
        /*grid-template-rows: 30% 55% 15%;*/
    }
    .left_1 {
        height: 30%;
        width: 100%;
        display: flex;
        flex-direction: row;
        background: unset;
        border-radius: 0px;
        font-size: 14px;
    }

    .left_1_left{
        height: 100%;
        width: 40%;
        /* background: cyan; */
        display: flex;
        padding-top: 5%;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    .buy_box{
        width: 60%;
        height: 70%;
        margin-top: -10%;
        /* background: red; */
        border-radius: 30px;
        overflow: hidden;
        /* box-shadow: 0px 0px 1px; */
    }
    .buy_box > div{
        height: 50%;
        width: 100%;
    }

    .buy_container{
        background-image: linear-gradient(112deg, #7bdc67 0%, #63cdc6 100%);
        display: flex;
        justify-content: center ;
        padding-right: 3%;
        align-items: center;
        flex-direction: row;
        cursor: pointer;
        color: white;
        /*font-size: 30px;*/
        font-size: 100%;
        max-font-size: 10vh;
        font-weight: 500;
    }
    .gheymat{
        background: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 30px;
        /*max-font-size: 1vh;*/
        font-weight: 700;
        color: rgb(30, 73, 2);
    }

    .left_1_right{
        height: 100%;
        width: 60%;
        /* background: red; */
        display: flex;
        padding-right: 10%;
        padding-left: 10%;
        padding-top: 3%;
        display: flex;
        flex-direction: row;
        justify-content: flex-end;
    }
    .ted{
        /* background: cyan; */
        width: 150px;
        height: 150px;
        max-height: max-content;
        max-width: max-content;
        border-radius: 20px;
    }

    .ted_titles{
        display: flex;
        flex-direction: column;
        /* background: cyan; */
        height: 100px;
        margin-right: 5%;
        /* padding: 10px 0px; */
        align-items: flex-end;
        justify-content: space-between;
    }
    .ted_titles > :nth-child(1){
        color: rgb(65, 65, 65);
        font-size: 33px;
        font-weight: 600;
        margin-top: 10px;
    }
    .ted_titles > :nth-child(2){
        color: rgb(107, 107, 107);
        font-size: 26px;
        font-weight: 500;
    }
    .ted_titles > :nth-child(3){
        display: flex;
        flex-direction: row;
        justify-content: flex-end;
    }

    .ted_circ{
        background: rgb(255, 255, 255);
        height: 10px;
        width: 10px;
        border-radius: 50%;
        margin-left: 6px;
    }

    .left_23{
        width: 100%;
        height: 55%;
        /* background: blue; */
        padding-left: 7%;
        overflow-x: scroll;
        white-space: nowrap;
        overflow-y: hidden;
        font-size: 0px;
    }
    .left_23 > div{
        display: inline-block;
        width: 25%;
        height: 100%;
        /*background: red;*/
        margin-right: 2%;
    }

    .left_3 {
        padding-bottom: 2%;
        height: 15%;
        width: 80%;
        margin-left: auto;
        margin-right: auto;
        /*display: grid;*/
        /*grid-template-columns: 33% 34% 33%;*/
        display: flex;
        flex-direction: row;
    }
    .left_3 > :nth-child(1){
        width: 33% !important;
    }
    .left_3 > :nth-child(2){
        width: 34% !important;
    }
    .left_3 > :nth-child(3){
        width: 33% !important;
    }

    .left_3 > div {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        border-bottom: 2px solid #989898;
        cursor: pointer;
        font-size: 25px;
        font-weight: 400;
        color: #575757;
    }

    .left_3 > div.active {
        color: #5cebe6;
        border-bottom: 4px solid #5cebe6;
        margin-top: 1px;
    }
    .right {
        font-family: "yekan";
        /*height: 100%;*/
        /*width: 20%;*/
        /*background: rgb(243, 243, 243);*/
        /*overflow-y: scroll;*/
        /*border-left: 2px solid rgb(180, 180, 180);*/
        /*padding-top: 12px;*/
        /*padding-left: 15px;*/
        /*padding-right: 12px;*/
        height: 90%;
        width: 20%;
        left: 80%;
        position: absolute;
        background: rgb(243, 243, 243);
        /*background: red;*/
        /*overflow-y: scroll;*/
        /*overflow-y: hidden;*/
        border-left: 2px solid rgb(180, 180, 180);
        overflow: visible !important;
    }
    .img-responsive{
        width: 220px;
        height: 250px;
        padding: 20px;
    }
</style>