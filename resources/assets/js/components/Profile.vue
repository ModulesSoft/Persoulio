<template>
    <div style="height: 100vh; width: 100%;position: absolute;left:0;" dir="ltr">
        <div class="header">
            <div class="grad1">
                <div>پرسولیو</div>
            </div>
        </div>
        <div style="display: flex; flex-direction: row; height: 90%">
            <div class="left">

                <div class="left_1"  style="font-family: 'yekan'; margin-top: 1%">
                    <div v-if="funTab" class="div_yek_sevvom left_1_font yellow_background">
                        <div class="centered_text_div"
                             @click="magTab = false;tunnelTab1=false;tunnelTab2=false;tunnelTab3=false;funTab=true;tunnelTab=false">
                            پرسولیو فان
                        </div>
                    </div>
                    <div v-else class="div_yek_sevvom left_1_font">
                        <div class="centered_text_div"
                             @click="magTab = false;tunnelTab1=false;tunnelTab2=false;tunnelTab3=false;funTab=true;tunnelTab=false">
                            پرسولیو فان
                        </div>
                    </div>
                    <div v-if="tunnelTab1 || tunnelTab2 || tunnelTab3 || tunnelTab"
                         class="div_yek_sevvom left_1_font yellow_background">
                        <!--@click="magTab = false;tunnelTab1=true;tunnelTab2=false;tunnelTab3=false;funTab=false;"-->

                        <div class="centered_text_div">
                            تونل
                        </div>
                        <div v-if="tunnelTab1 || tunnelTab2 || tunnelTab3" class="tunel_options">

                            <div v-if="tunnelTab3" class="tunel_selected"
                                 @click="magTab = false;tunnelTab1=false;tunnelTab2=false;tunnelTab3=true;funTab=false;">
                                پروژه /کار
                            </div>
                            <div v-else
                                 @click="magTab = false;tunnelTab1=false;tunnelTab2=false;tunnelTab3=true;funTab=false;">
                                پروژه /کار
                            </div>
                            <div v-if="tunnelTab2" class="tunel_selected"
                                 @click="magTab = false;tunnelTab1=false;tunnelTab2=true;tunnelTab3=false;funTab=false;">
                                کلاس
                            </div>
                            <div v-else
                                 @click="magTab = false;tunnelTab1=false;tunnelTab2=true;tunnelTab3=false;funTab=false;">
                                کلاس
                            </div>
                            <div v-if="tunnelTab1" class="tunel_selected"
                                 @click="magTab = false;tunnelTab1=true;tunnelTab2=false;tunnelTab3=false;funTab=false;"
                            > همایش/ کارگاه
                            </div>
                            <div v-else
                                 @click="magTab = false;tunnelTab1=true;tunnelTab2=false;tunnelTab3=false;funTab=false;"
                            > همایش/ کارگاه
                            </div>
                        </div>
                    </div>
                    <div v-else class="div_yek_sevvom left_1_font"
                         @click="magTab = false;tunnelTab1=false;tunnelTab2=false;tunnelTab3=false;funTab=false;tunnelTab=true">
                        <div class="centered_text_div">
                            تونل
                        </div>
                    </div>
                    <div v-if="magTab" class="div_yek_sevvom left_1_font yellow_background"
                         @click="magTab = true;tunnelTab1=false;tunnelTab2=false;tunnelTab3=false;funTab=false;tunnelTab=false">
                        <div class="centered_text_div">
                            پرسولیو مگ
                        </div>
                    </div>
                    <div v-else class="div_yek_sevvom left_1_font"
                         @click="magTab = true;tunnelTab1=false;tunnelTab2=false;tunnelTab3=false;funTab=false;tunnelTab=false">
                        <div class="centered_text_div">
                            پرسولیو مگ
                        </div>
                    </div>
                </div>
                <fun v-if="funTab"></fun>
                <mag v-if="magTab"></mag>
                <transition name="slide-fade bounce">
                    <!--<div v-if="tunnelTab && !tunnelTab1 && !tunnelTab2 && !tunnelTab3">-->
                        <div v-if="tunnelTab && !tunnelTab1 && !tunnelTab2 && !tunnelTab3" class="left_2" id="div1">
                            <div class="left_2_item" @click="tunnelTab3=true"><img src="../../assets/project.png"
                                                               class="img-responsive"/></div>
                            <div class="left_2_item" @click="tunnelTab2=true"><img src="../../assets/class.png"
                                                               class="img-responsive"/></div>
                            <div class="left_2_item" @click="tunnelTab1=true"><img src="../../assets/workshop.png"
                                                               class="img-responsive"/></div>
                        </div>
                    <!--</div>-->
                </transition>
                <tunnel v-show="tunnelTab1" :subMode="8"></tunnel>
                <tunnel v-show="tunnelTab2" :subMode="9"></tunnel>
                <tunnel v-show="tunnelTab3" :subMode="10"></tunnel>
            </div>

            <div class="right">
                <user-summary></user-summary>
            </div>
        </div>

        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
              integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU"
              crossorigin="anonymous">
        <!--<link rel="stylesheet" href="../../assets/animate.css">-->
    </div>
</template>

<script>
    import Vue from 'vue'
    import Tunnel from "./Tunnel";

    Vue.component('user-summary', require('./UserSummary.vue'));
    Vue.component('fun', require('./Fun.vue'));
    Vue.component('mag', require('./Mag.vue'));
    export default {
        name: "Porfile",
        components: {Tunnel},
        data() {
            return {
                magTab: false,
                tunnelTab: true,
                tunnelTab1: false,
                tunnelTab2: false,
                tunnelTab3: false,
                funTab: false,
            }
        },
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

        .left_1_font {
            font-size: 16px !important;
            /*font-weight: 800;*/
            /*color: #8d8d8d;*/
        }

        .div_yek_sevvom {
            /*overflow: hidden;*/
            /*position: relative;*/
            /* display: inline-block; */
            border-radius: 10px !important;
            /*height: 100%;*/
            /*width: 100%;*/
            /*cursor: pointer;*/
            /* background: white; */
        }
        .yellow_background {
            border-radius: 5px !important;
        }

        .tunel_options > div {
            font-size: 7px !important;
            /*font-weight: 200;*/
        }

        .left_2_item{
            height: 50% !important;
            /*width: 29%;*/
        }
    }
    @media screen and (min-width: 601px) {
        .left{
            width: 80% !important;
        }
        .right{
            border: 0px !important;
        }
    }

    @media screen and (min-width: 601px) {
        .left{
            width: 80% !important;
        }
        .right{
            border: 0px !important;
        }
    }


    .right {
        font-family: "yekan";
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
        /*padding-top: 12px;*/
        /*padding-left: 15px;*/
        /*padding-right: 12px;*/
    }

    .left {
        /*background: #dddddd;*/
        height: 100%;
        width: 80%;
        width: 100%;
        padding-top: 40px;
        z-index: 4;
        /*background: linear-gradient(180deg, #ebebeb 0%, #ffffff 100%)*/
        background: #ebebeb ;
    }

    @font-face {
        font-family: "yekan";
        src: url('../../fonts/b-yekan.ttf') format('truetype');
    }

    @font-face {
        font-family: "ghasem";
        src: url('../../fonts/AGhasem.ttf') format('truetype');
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

    .left_1{
        background: #e8e8e8;
        background: white;
        height: 13%;
        width: 85%;
        margin-left: auto;
        margin-right: auto;
        /* border-bottom: 15px solid white; */
        border-radius: 15px;
        font-size: 0;
        display: flex !important;
        flex-direction: row !important;
        z-index: 2;
    }

    .left_1 > :nth-child(1){
        width: 33% !important;
    }
    .left_1 > :nth-child(2){
        width: 34% !important;
    }
    .left_1 > :nth-child(3){
        width: 33% !important;
    }
    .left_1_font{
        font-size: 27px;
        font-weight: 800;
        color: #8d8d8d;
    }
    .div_yek_sevvom{
        overflow: hidden;
        position: relative;
        /* display: inline-block; */
        border-radius: 15px;
        height: 100%;
        width: 100%;
        cursor: pointer;
         /*background: red;*/
    }
    /* .div_yek_sevvom:hover{
        background: #c9c8b5;
    } */
    .yellow_background{
        background: #eec558;
        background-image: linear-gradient(180deg, #f3c850 0%, #f6d272 100%);
        box-shadow: 0px 0px 10px;
        height: calc(100% + 40px);
        border-radius: 30px !important;
        margin-top: -20px;
        color: white;
        padding-bottom: 1%;
    }
    .yellow_background:hover{
        background: #f4d459;

    }

    .left_3 {
        /* background: violet; */
        padding-bottom: 2%;
        height: 100%;
        width: 80%;
        margin-left: auto;
        margin-right: auto;
        display: grid;
        grid-template-columns: 33% 34% 33%;
    }

    .left_3 > div {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        border-bottom: 3px solid #989898;
        cursor: pointer;
        font-size: 25px;
        font-weight: 400;
        color: #575757;
    }

    .left_3 > div.active {
        color: #5cebe6;
        border-bottom: 3px solid #5cebe6;
    }

    .div_yek_sevvom {
        overflow: hidden;
        position: relative;
        /* display: inline-block; */
        border-radius: 15px;
        height: 140%;
        width: 100%;
        /* background: white; */
    }

    .centered_text_div {
        width: 100%;
        height: 100%;
        margin-top: -10px;
        display: flex;
        justify-content: center;
        align-items: center;
        align-content: center;
    }

    .tunel_options{
        position: absolute;
        height: 30%;
        bottom: 0px;
        width: 100%;
        background: rgb(180, 190, 30);
        background: #eec558;
        /*display: grid;*/
        /*grid-template-columns: 33% 34% 33%;*/
        display: flex;
        flex-direction: row;
    }
    .tunel_options > :nth-child(1){
        width: 33% !important;
    }
    .tunel_options > :nth-child(2){
        width: 34% !important;
    }.tunel_options > :nth-child(3){
         width: 33% !important;
     }
    .tunel_options > div{
        height: 100%;
        /*width: 100%;*/
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 13px;
        font-weight: 200;
    }
    .tunel_options :nth-child(2)
    {
        border-left: 1px solid  #ffefc1;
        border-right: 1px solid #ffefc1;
    }
    .tunel_selected{
        background: rgb(185, 72, 72);
    }

    .left_2{
        font-family: "yekan";
        height: calc(87% - 30px);
        padding-top: 30px;
        padding-bottom: 30px;
        margin-top: 30px;
        /* background: cyan; */
        padding-left: 7%;
        padding-right: 7%;
        display: flex;
        align-items: center;
        justify-content: space-around;
        /* todo */
    }
    .left_2_item{
        position: relative;
        height: 87%;
        width: 29%;
        /*background: #f1f1f1;*/
        border-radius: 20px;
        overflow: hidden;
        cursor: pointer;
    }
    .left_2_item > img{
        height: 100%;
        width: 100%;
        /*margin-left: 45px;*/
        border: 2px solid #fff;
        /*-moz-box-shadow: 10px 10px 5px #ccc;*/
        /*-webkit-box-shadow: 10px 10px 5px #ccc;*/
        /*box-shadow: 10px 10px 5px #ccc;*/
        -moz-border-radius: 25px;
        -webkit-border-radius: 25px;
        border-radius: 50px;
        cursor: pointer;
    }
    .left_2_item_text{
        position: absolute;
        bottom: 9%;
        right: 12%;
        color: white;
        font-size: 35px;
        font-weight: 400;
        z-index: 2;
    }


    .bounce-enter-active {
        animation: bounce-in .5s;
    }

    .bounce-leave-active {
        animation: bounce-in .5s reverse;
    }

    @keyframes bounce-in {
        0% {
            transform: scale(0);
            margin-top: -200px;
        }
        50% {
            transform: scale(1.2);
            opacity: 50%;
        }
        100% {
            transform: scale(1);
        }
    }
</style>