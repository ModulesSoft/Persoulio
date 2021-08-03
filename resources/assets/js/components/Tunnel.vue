<template>
    <div class="left_22" id="div3">
        <!--<div v-for="event in events">-->
            <div v-for="event in events" class="left_2_item">
                <div class="left_2_item_left">
                    <div class="left_2_item_left_frame">
                        <div class="left_2_item_left_frame_1" v-html="event.description.replace(/<[^>]*>/g, '').substring(0,30)">
                        </div>
                        <div class="left_2_item_left_frame_2">
                            <p>استاد: {{event.launcher}}</p>
                            <p v-if="event.days[0]">{{event.days[0].date}} :زمان</p>
                        </div>
                        <div class="left_2_item_left_frame_3">
                            <div class="rate_box">۴.۲</div>
                            <div style="font-size: 1.4rem;">
                                <i class="fas fa-star fa-xs" style="color: #9d9d9d;"></i>
                                <i class="fas fa-star fa-xs" style="color: #9d9d9d;"></i>
                                <i class="fas fa-star fa-xs" style="color: #9d9d9d"></i>
                                <i class="fas fa-star fa-xs" style="color: rgb(200, 200, 200)"></i>
                                <i class="fas fa-star fa-xs" style="color: rgb(200, 200, 200)"></i>
                                <i class="fas fa-star fa-xs" style="color: rgb(200, 200, 200)"></i>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="left_2_item_right">
                <router-link :to="'tunnel/article'+event.id" style="text-decoration: none; color: inherit;">
                <div class="left_2_item_right_frame">
                    <img v-if="event.image" class="img_fill_div img-responsive"  :src="event.image">
                    <img v-else class="img_fill_div img-responsive"  src="../../assets/noimage.png">
                    <div class="kargah_title">
                        <p>{{event.name}}</p>
                        <img src="../../assets/2-layers32.png"/>
                    </div>
                </div>
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Tunnel",
        props: {
            subMode: '',//8 hamayesh o kargah ,9 kelas ,10 proje o kar
            page: 1,
        },
        data() {
            return {
                events: null
            }
        },
        mounted() {
            this.fetchData();
            console.log(this.subMode);
        },
        methods: {
            fetchData() {
                var form = new FormData();
                form.append('page', 1);
                form.append('subMode', this.subMode);
                axios.post('/getEvents', form).then(response => {
                        this.events = response.data;
                        console.log(this.events);
                    }
                );
            }
        }
    }
</script>

<style scoped>
    .img_fill_div{
        width: 100%;
        height: 100%;
    }
    @media screen and (max-width: 600px) {
        .left_2_item{
            /*height: 90%;*/
            /*width: 70%;*/
            display: flex !important;
            flex-direction: column-reverse !important;
        }
        .left_2_item_right{
            display: flex !important;
            height: 60% !important;
            width: 100% !important;
            font-size: 20px;
            /*background: cyan !important;*/
        }
        .left_2_item_right_frame{
            /*width: 100%;*/
            /*height: calc(100% + 40px);*/
            height: 100% !important;
            height: 100% !important;
            width: calc(100% + 40px) !important;
            margin-top: 0px !important;
            margin-left: -20px;
            /*background: #ea7b86;*/
            /*overflow: hidden;*/
            /*border-radius: 15px;*/
        }
        .kargah_title{
            /*font-size: 32px;*/
            /*font-weight: 900;*/
            /*color: white;*/
            margin-top: -15% !important;
            /*text-align: right;*/
            /*display: flex;*/
            /*justify-content: flex-end;*/
            /*align-content: center;*/
            /*align-items: center;*/
            /*padding-right: 30%;*/
            /*background: rgba(0,0,0,0.2);*/
            /*width: 100%;*/
            height: calc(15% + 20px) !important;
            /*z-index: 10;*/
            /*position: relative;*/
        }
        .kargah_title > img{
            position: absolute;
            right: 5%;
            height: 80%;
            top: 10%;
            width: auto;
            /*border-radius: 50%;*/
        }
        .left_2_item_left{
            /*font-size: 20px;*/
            display: block !important;
            /*vertical-align: top;*/
            height: 40% !important;
            width: 100% !important;
        }
    }

    .left_22 {
        height: calc(87% - 30px);
        padding-top: 30px;
        padding-bottom: 30px;
        margin-top: 30px;
         /*background: cyan;*/
        /*display: flex;*/
        flex-direction: column;
        overflow-y: scroll;
        /* todo */
    }


    .left_2_item{
        height: 90%;
        width: 70%;
        margin-left: auto;
        margin-right: auto;
        background: #e5e5e5;
        background: white;
        border-radius: 15px;
        margin-top: 10px;
        margin-bottom: 60px;
        font-size: 0;
        cursor: pointer;

    }
    .left_2_item_right{
        display: inline-block;
        height: 100%;
        font-size: 20px;
        width: 55%;
        background: #eec558;
    }
    .left_2_item_right_frame{
        width: 100%;
        height: calc(100% + 40px);
        margin-top: -20px;
        background: #ea7b86;
        overflow: hidden;
        border-radius: 15px;
    }
    .kargah_title{
        font-size: 32px;
        font-weight: 900;
        color: white;
        margin-top: -20%;
        /*text-align: right;*/
        display: flex;
        justify-content: flex-end;
        align-content: center;
        align-items: center;
        padding-right: 30%;
        background: rgba(0,0,0,0.4);
        background: linear-gradient(to bottom, rgba(0,0,0,0.1),  rgba(0,0,0,0.6));
        /*width: 100%;*/
        height: 22%;
        z-index: 10;
        position: relative;
    }
    .kargah_title > img{
        position: absolute;
        right: 5%;
        height: 80%;
        top: 10%;
        width: auto;
        /*border-radius: 50%;*/
    }
    .left_2_item_left{
        font-size: 20px;
        display: inline-block;
        vertical-align: top;
        height: 100%;
        width: 45%;
    }
    .left_2_item_left_frame{
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        padding-left: 40px;
        padding-right: 40px;
        text-align: right;
    }
    .left_2_item_left_frame_1{
        /* background: #ea7b86; */
        width: 100%;
        height: 55%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        font-size: 35;
        font-weight: 600;
        color: rgb(119, 119, 119);
        /*overflow-y: scroll;*/
        padding-top: 7%;
        margin-top: 15%;
        z-index: 4;
    }
    .left_2_item_left_frame_2{
        width: 100%;
        height: 25%;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        font-size: 18px;
        font-weight: 300;
        color: rgb(151, 151, 151);
    }
    .left_2_item_left_frame_3{
        width: 100%;
        height: 20%;
        display: flex;
        flex-direction: row;
        justify-content: flex-start;
        align-items: center;
        font-size: 35;
        font-weight: 600;
        color: rgb(151, 151, 151);
    }
    .rate_box{
        margin-right: 10px;
        height: 35px;
        width: 35px;
        background: rgb(206, 25, 25);
        color: white;
        border-radius: 50%;
        font-size: 18px;
        font-weight: 800;
        display: flex;
        justify-content: center;
        align-items: center;
    }


</style>