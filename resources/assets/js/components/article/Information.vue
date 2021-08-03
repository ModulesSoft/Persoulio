<template>
    <!--<div>-->
        <div class="left_5">
            <div>
            </div>
            <div v-if="event">
                <div style="direction: rtl">
                    <span>زمان :</span>
                    <span> {{event.days[0].date}}</span>
                </div>
                <div style="direction: rtl">
                    <span>مکان :</span>
                    <span> {{event.place}}</span>
                </div>
            </div>
        <!--<div class="left_3">-->
            <!--<div class="left_3_left">نمودار-->
            <!--</div>-->
            <!--<div></div>-->
            <!--<div class="left_3_right">نمودار</div>-->
        <!--</div>-->
        <!--<div class="left_4">-->
            <!--<div class="left_4_1">-->
                <!--<div class="img_box_container">-->
                    <!--<div class="img_box">-->
                        <!--<p>سلام</p>-->
                        <!--<img src="/resources/assets/assets/nemudar.jpg" class="img-responsive img_fill_div img-circle">-->
                    <!--</div>-->
                    <!--<div class="img_box">-->
                        <!--<p>2</p>-->
                        <!--<img src="/resources/assets/assets/mojtaba.jpg" class="img-responsive img_fill_div img-circle">-->
                    <!--</div>-->
                    <!--<div class="img_box">-->
                        <!--<p>alis</p>-->
                        <!--<img src="/resources/assets/assets/nemudar2.jpg" class="img-responsive img_fill_div img-circle">-->
                    <!--</div>-->
                    <!--<div class="img_box">-->
                        <!--<p>سلام</p>-->
                        <!--<img src="/resources/assets/assets/nemudar.jpg" class="img-responsive img_fill_div img-circle">-->
                    <!--</div>-->
                    <!--<div class="img_box">-->
                        <!--<p>2</p>-->
                        <!--<img src="/resources/assets/assets/mojtaba.jpg" class="img-responsive img_fill_div img-circle">-->
                    <!--</div>-->
                    <!--<div class="img_box">-->
                        <!--<p>alis</p>-->
                        <!--<img src="/resources/assets/assets/nemudar2.jpg" class="img-responsive img_fill_div img-circle">-->
                    <!--</div>-->
                    <!--<div class="img_box">-->
                        <!--<p>سلام</p>-->
                        <!--<img src="/resources/assets/assets/ted_info.jpg" class="img-responsive img_fill_div img-circle">-->
                    <!--</div>-->
                    <!--<div class="img_box">-->
                        <!--<p>2</p>-->
                        <!--<img src="/resources/assets/assets/mojtaba.jpg" class="img-responsive img_fill_div img-circle">-->
                    <!--</div>-->
                    <!--<div class="img_box">-->
                        <!--<p>alis</p>-->
                        <!--<img src="/resources/assets/assets/nemudar2.jpg" class="img-responsive img_fill_div img-circle">-->
                    <!--</div>-->
                    <!--<div class="img_box_title">-->
                        <!--دوست و رفیق-->
                    <!--</div>-->
                <!--</div>-->
            <!--</div>-->
            <!--<div class="left_4_2">-->
                <!--<div class="img_box_container_2">-->
                    <!--<div class="img_box_2">-->
                        <!--<img src="/resources/assets/assets/nemudar.jpg" class="img-responsive img_fill_div img-circle">-->
                    <!--</div>-->
                    <!--<div class="img_box_2">-->
                        <!--<img src="/resources/assets/assets/nemudar2.jpg" class="img-responsive img_fill_div img-circle">-->
                    <!--</div>-->
                    <!--<div class="img_box_2">-->
                        <!--<img src="/resources/assets/assets/mojtaba.jpg" class="img-responsive img_fill_div img-circle">-->
                    <!--</div>-->
                    <!--<div class="img_box_2">-->
                        <!--<img src="/resources/assets/assets/nemudar.jpg" class="img-responsive img_fill_div img-circle">-->
                    <!--</div>-->
                    <!--<div class="img_box_2">-->
                        <!--<img src="/resources/assets/assets/nemudar2.jpg" class="img-responsive img_fill_div img-circle">-->
                    <!--</div>-->
                    <!--<div class="img_box_2">-->
                        <!--<img src="/resources/assets/assets/mojtaba.jpg" class="img-responsive img_fill_div img-circle">-->
                    <!--</div>-->
                    <!--<div class="img_box_2_title">-->
                        <!--آشناها-->
                    <!--</div>-->
                <!--</div>-->
            <!--</div>-->


        <!--</div>-->
    </div>
</template>

<script>
    export default {
        name: "Information",
        props: {
            id: null
        },
        data() {
            return {event: null}
        },
        mounted() {
            // console.log("umad " + this.id)
            this.fetchData(this.id);
        },
        methods: {
            fetchData(id) {
                var form = new FormData();
                form.append('id', id);
                axios.post('/getEventsById', form).then(response => {
                        this.event = response.data;
                        console.log(this.event.days[0].date);
                    }
                );
            }
        }
    }
</script>

<style scoped>

    @media screen and (max-width: 600px) {
        .left_5{
            /*height: 100%;*/
            /*width: 100%;*/
            /* background: cyan; */
            /*position: relative;*/
        }
        .left_5 > :nth-child(1)
        {
            position: absolute;
            top: 10% !important;
            left: 20% !important;
            width: 60% !important;
            height: 30% !important;
            /* width: 100px; */
            /* height: 100px; */
            /*border: 1px solid black;*/
            /*background: red;*/
        }

        .left_5 > :nth-child(2)
        {
            /*position: absolute;*/
            top: 45% !important;
            right: 20% !important;
            width: 60% !important;
            height: 40% !important;
            /*display: flex;*/
            /*flex-direction: column;*/
            /*justify-content: space-around;*/
            /*align-items: flex-end;*/
            /* background: red; */
            /*padding: 0px 10%;*/
        }
        .left_5 > :nth-child(2) > div > :nth-child(1){
            color: black;
            font-size: 25px;
            font-weight: 500;
        }
        .left_5 > :nth-child(2) > div > :nth-child(2){
            color: gray;
            font-size: 22px;
            font-weight: 500;
        }
    }

    .left_5{
        height: 100%;
        width: 100%;
        /* background: cyan; */
        position: relative;
    }
    .left_5 > :nth-child(1)
    {
        position: absolute;
        top: 20%;
        left: 10%;
        width: 40%;
        height: 40%;
        /* width: 100px; */
        /* height: 100px; */
        border: 1px solid black;
        background: red;
    }

    .left_5 > :nth-child(2)
    {
        position: absolute;
        top: 20%;
        right: 10%;
        width: 40%;
        height: 40%;
        display: flex;
        flex-direction: column;
        justify-content: space-around;
        align-items: flex-end;
        /* background: red; */
        padding: 0px 10%;
    }
    .left_5 > :nth-child(2) > div > :nth-child(1){
        color: black;
        font-size: 25px;
        font-weight: 500;
    }
    .left_5 > :nth-child(2) > div > :nth-child(2){
        color: gray;
        font-size: 22px;
        font-weight: 500;
    }
    .img_fill_div{
        height: 100%;
        width: 100%;
    }
</style>