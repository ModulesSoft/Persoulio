<template>
    <div class="left_11">
        <div class="left_222" id="div1" style="margin-top: -1px;">
            <!--<div v-for="event in events">-->

            <!--inja error mide-->
            <!--event.id error midad-->
            <router-link :to="'fun/article'+'123'">
                <div class="left_222_container" v-for="event in events" v-if="event.color == 'gold'">
                    <!--<div v-if="event.image[0]"> umad</div>-->
                    <img v-if="event.image" v-bind:src="event.image.pic" class="img_fill_div" style="max-height: 30vh;"/>
                    <img v-else class="img_fill_div"  src="../../assets/noimage.png">
                </div>
            </router-link>
            <!--</div>-->
        </div>
        <div class="left_3">
            حلقه ها
        </div>
        <div class="left_44" id="div2">
            <!--<div v-for="event in events">-->
                <div v-for="event in events" v-if="event.color == 'silver'" class="cart3">
                    <div class="cart_img_container">
                        <div>
                            <img v-bind:src="event.image.pic" class="img_fill_div">
                        </div>
                    </div>
                    <router-link style="text-decoration: none; color: inherit;" class="cart_text" :to="'/fun/article'+event.id">
                        <div>{{event.name}}</div>
                        <div>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <span> ۱۳۴۵</span>
                        </div>
                        <div>{{event.launcher}}</div>
                    <!--</router-link>-->
                    </router-link>
                </div>
            <!--</div>-->
        </div>
    </div>
</template>

<script>
    export default {
        name: "Tunnel",
        data() {
            return {
                mode: 3,
                page: 1,
                events: null
            }
        },
        mounted() {
            this.fetchData();
        },
        methods: {
            fetchData() {
                // console.log('fun:')
                // axios.post('/getEvents', {
                //     subMode: this.subMode,
                //     page: this.page,
                // }).then(response => {
                //     console.log(response.data)
                //     if(response.data == "nok2" || response.data == "nok"){
                //         console.log("error dare")
                //     }
                // }).catch(error => {
                //     console.log(error)
                //     this.errorColor = 'red'
                //     this.error = "شناسه یا رمز وارد شده اشتباه است"
                // });
                var form = new FormData();
                form.append('page', this.page);
                form.append('mode', this.mode);
                axios.post('getEventsByMode', form).then(response => {
                        this.events = response.data;
                    }
                );
            }
        }
    }
</script>

<style scoped>
    @media screen and (max-width: 600px) {
        .left_222{
            height: 40% !important;
            /*width: 100%;*/
            /*background: blue;*/
            /*margin-top: -3% !important;*/
            /*padding-left: 1%;*/
            /*padding-bottom: 10px !important;*/
            /*overflow-x: scroll;*/
            /*white-space: nowrap;*/
            /*overflow-y: hidden;*/
            /*font-size: 0px;*/
        }
        .left_222_container{
            /*display: inline-block;*/
            width: 40% !important;
            /*height: 100%;*/
            /*height: 90%;*/
            /*margin-top: 2%;*/
            /*margin-right: 2%;*/
            /*border-radius: 15px;*/
            /*overflow: hidden;*/
            /*margin-right: 1%;*/
            /*cursor: pointer;*/
            /*box-shadow: 0px 0px 2px;*/
        }
        .left_44 {
            /*width: 100%;*/
            height: 55% !important;
            margin-top: 5% !important;
            /*background: red;*/
            /*max-height: 35vh;*/
            /*background: blue;*/
            /*overflow-x: scroll;*/
            /*display: flex;*/
            /*flex-direction: column !important;*/
            /*flex-wrap: wrap !important;*/
            /*padding-left: 4%;*/
            /*padding-right: 4%;*/
            /*align-items: flex-start;*/
            /*justify-content: flex-start;*/
            /*background: red;*/
        }
        .cart3 {
            /*font-size: 30px;*/
            width: 37% !important;
            /*height: 44% !important;*/
            /*cursor: pointer;*/
            /*display: flex !important;*/
            /*flex-direction: row;*/
            /*justify-content: flex-start;*/
            /*align-items: center;*/
            /*margin-top: 1%;*/
        }

        .cart_img_container {
            width: 43% !important;
            /*height: 90%;*/
            /*background: #bebebe;*/
            /*background: linear-gradient(to top, #bebebe, white, #bebebe);*/
            /*padding: 10px;*/
            /*padding-top: 8px;*/
            /*border-radius: 10px;*/
            /*cursor: pointer;*/
        }

        .cart_img_container:hover {
            /*background: gray;*/
        }

        .cart_img_container > div {
            /*height: 100%;*/
            /*width: 100%;*/
            /*background: yellow;*/
            /*box-shadow: 0px 5px 5px rgb(112, 112, 112);*/
        }

        .cart_text {
            /* padding-top: 5%; */
            /*display: flex;*/
            /*flex-direction: column;*/
            height: 90px !important;
            /*height: %;*/
            /*margin-left: 5%;*/
            /*align-items: flex-start;*/
            /*justify-content: space-around;*/
            /*background: red;*/
        }

        .cart_text > :nth-child(1) {
            /*color: rgb(45, 45, 45);*/
            font-size: 20px !important;
            /*font-weight: 600;*/
        }

        .cart_text > :nth-child(2) {
            /*color: rgb(107, 107, 107);*/
            font-size: 12px !important;
            /* font-weight: 500; */
        }

        .cart_text > :nth-child(2) > span {
            /*color: #bebebe;*/
            font-size: 11px !important;
        }

        .cart_text > :nth-child(3) {
            /*color: rgb(87, 87, 87);*/
            font-size: 12px !important;
            /*font-weight: 300;*/
        }

    }
    .left_11 {
        height: calc(87% - 30px);
        padding-top: 30px;
        padding-bottom: 30px;
        margin-top: 30px;
        /*height: 80% !important;*/
        /*background: cyan;*/
    }
    .img_fill_div{
        width: 100%;
        height: 100%;
        max-height: 100%;
    }
    .left_222{
        height: 67%;
        width: 100%;
         /*background: blue;*/
        margin-top: -3% !important;
        padding-left: 1%;
        padding-bottom: 10px !important;
        overflow-x: scroll;
        white-space: nowrap;
        overflow-y: hidden;
        font-size: 0px;
    }

    .left_222_container{
        display: inline-block;
        width: 35%;
        height: 100%;
        height: 90%;
        margin-top: 2%;
        margin-right: 2%;
        border-radius: 15px;
        overflow: hidden;
        margin-right: 1%;
        cursor: pointer;
        box-shadow: 0px 0px 2px;
    }
    .left_3 {
        font-size: 26px;
        color: #353535;
        font-weight: 500;
        display: flex;
        padding-right: 4%;
        flex-direction: column;
        align-items: flex-end;
        justify-content: flex-start;
        height: 7%;
    }

    .left_44 {
        width: 100%;
        height: 40%;
        /*background: red;*/
        /*max-height: 35vh;*/
         /*background: blue;*/
        overflow-x: scroll;
        display: flex;
        flex-direction: column !important;
        flex-wrap: wrap !important;
        padding-left: 4%;
        padding-right: 4%;
         align-items: flex-start;
        justify-content: flex-start;
    }

    .cart3 {
        font-size: 30px;
        width: 23%;
        /*height: 44% !important;*/
        cursor: pointer;
        display: flex !important;
        flex-direction: row;
        justify-content: flex-start;
        align-items: center;
        margin-top: 1%;
    }

    .cart_img_container {
        width: 27%;
        height: 90%;
        background: #bebebe;
        background: linear-gradient(to top, #bebebe, white, #bebebe);
        padding: 10px;
        padding-top: 8px;
        border-radius: 10px;
        cursor: pointer;
    }

    .cart_img_container:hover {
        background: gray;
    }

    .cart_img_container > div {
        height: 100%;
        width: 100%;
        background: yellow;
        box-shadow: 0px 5px 5px rgb(112, 112, 112);
    }

    .cart_text {
        /* padding-top: 5%; */
        display: flex;
        flex-direction: column;
        height: 100px;
        /*height: %;*/
        margin-left: 5%;
        align-items: flex-start;
        justify-content: space-around;
        /*background: red;*/
    }

    .cart_text > :nth-child(1) {
        color: rgb(45, 45, 45);
        font-size: 26px;
        font-weight: 600;
    }

    .cart_text > :nth-child(2) {
        color: rgb(107, 107, 107);
        font-size: 15px;
        /* font-weight: 500; */
    }

    .cart_text > :nth-child(2) > span {
        color: #bebebe;
        font-size: 14px;
    }

    .cart_text > :nth-child(3) {
        color: rgb(87, 87, 87);
        font-size: 15px;
        font-weight: 300;
    }

    .gold {
        /*border-style: solid;*/
        /*border-color: yellow;*/
        color: red;
    }

    .silver {

        border-style: solid;
        border-color: silver;
    }
</style>