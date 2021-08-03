<template>
    <div class="left_41">
        <div class="left_4_1">
            <div> کامنت ها</div>
            <div> نظر شما</div>
        </div>
        <div class="left_4_2">
            <div class="comment_box" id="div5">

                <div v-for="comment in comments" class="comment">
                    <div class="comment_header">
                        <p class="comment_date">{{comment.date}}</p>
                        <p style="margin-right: 15px">{{comment.username}}</p>
                        <img v-if="comment.usernamePic" v-bind:src="comment.usernamePic"
                             class="img-responsive comment_img">
                        <img v-else src="../../../assets/profile-pic.png" class="img-responsive comment_img">
                    </div>
                    <div class="comment_body">
                        {{comment.text}}
                    </div>
                </div>
                <div v-if="!disableNewComment" class="your_comment">
                    <div style="margin-top: 5px; text-align: right; width: 97%; direction: rtl" >
                       نظر شما :
                    </div>
                    <div style="width: 100%;">
                        <textarea type="text" class="commentInput" dir="rtl" v-model="newComment"></textarea>
                    </div>
                    <br>
                    <div>
                        <div @click="sendComment(id,newComment)" class="my_button centered_text_div" style="width:50%">
                            ارسال
                        </div>
                    </div>
                </div>
                <div v-else style="color:green; text-align: center; width: 100%;">
                    نظر شما با موفقیت ارسال شد
                </div>
            </div>
            <div class="comment_emoji">
                <div class="left_4_left">
                    <div>
                        <img src="../../../assets/sad.png" class="img_fill_div" />
                        <!--<i class="fas fa-frown smiley_font" style="color: red;"></i>-->
                    </div>
                    <div>
                        <img src="../../../assets/confused.png" class="img_fill_div" />
                        <!--<i class="fas fa-meh smiley_font" style="color:blue;"></i>-->
                    </div>
                    <div>
                        <img src="../../../assets/in-love.png" class="img_fill_div" />
                        <!--<i class="fas fa-smile-wink smiley_font" style="color: green;"></i>-->
                    </div>
                </div>
            </div>
        </div>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
              integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU"
              crossorigin="anonymous">
    </div>
</template>

<script>
    export default {
        name: "Comments",
        props: {
            id: null
        },
        data() {
            return {comments: null, newComment: '' ,disableNewComment: false,}
        },
        mounted() {
            // console.log("umad " + this.id)
            this.fetchData(this.id);
        },
        methods: {
            fetchData(id) {
                var form = new FormData();
                form.append('eventId', id);
                axios.post('/getComments', form).then(response => {
                        this.comments = response.data;
                        // console.log(response.data);
                    }
                );
            },
            sendComment(id, text) {
                if (text) {
                    var form = new FormData();
                    form.append('eventId', id);
                    form.append('text', text)
                    axios.post('/addComment', form).then(response => {
                            // this.comments = response.data;
                            // console.log(response.data);
                            if(response.data == 'ok'){
                                this.disableNewComment = true;
                            }
                        }
                    );
                }
            }
        }
    }
</script>

<style scoped>
    @media screen and (max-width: 600px) {
        .comment{
            width: 90% !important;
            /* background: green; */
            /*margin-left: auto;*/
            /*margin-right: auto;*/
            margin-top: 10px !important;
        }
        .comment_img{
            width: 5vh !important;
            height: 5vh !important;
            /*overflow: hidden;*/
            /*border-radius: 50%;*/
        }
        .comment_header{
            /*display: flex;*/
            /*flex-direction: row;*/
            /*justify-content: flex-end;*/
            /*align-items: center;*/
            font-size: 18px !important;
            /*font-weight: 400;*/
            /*color: black;*/
            /*cursor: pointer;*/
        }
        .comment_body{
            margin-right: 10px !important;
            /*text-align: right;*/
            font-size: 16px !important;
            /*font-weight: 300;*/
            /*color: rgb(87, 87, 87);*/
        }

        .comment_date{
            font-size: 12px !important;
            /*font-weight: 200;*/
            /*color: #3a3a3a;*/
            margin-right: 20px !important;
        }

        .commentInput {
            font-size: 13px;
        }
        .left_4_left{
            /*display: flex;*/
            /*flex-direction: row;*/
            /*align-items: center;*/
            /*justify-content: space-around;*/
            /*background: cyan;*/
            /*background-image: linear-gradient(180deg, #84cae4 0%, #6fddbc 100%);*/
            border-radius: 20px !important;
            /*height: 60%;*/
            width: 90% !important;
            /*margin-right: auto;*/
            /*margin-left: auto;*/
            padding-left: 10px !important;
            padding-right: 10px !important;
            padding-top: 5px !important;
            padding-bottom: 5px !important;
        }
        .left_4_left > div{
            height: 5vh !important;
            width: 5vh !important;
            /* overflow: hidden; */
            /* background: yellow; */
            /*display: flex;*/
            /*justify-content: center;*/
            /*align-items: center;*/
            /*border-radius: 50%;*/
            /*cursor: pointer;*/
        }
    }

    .img_fill_div {
        height: 100%;
        width: 100%;
    }

    .left_41 {
        margin-top: 5%;
        width: 100%;
        height: 35%;
        background: cyan;
    }

    .left_4_1{
        padding: 0px 10%;
        height: 20%;
        width: 100%;
        /*display: grid;*/
        /*grid-template-columns: 50% 50%;*/
        display: flex;
        flex-direction: row;
        background: rgb(175, 175, 175);
        background: linear-gradient(to top,rgb(202, 202, 202),rgb(226, 226, 226) );
        /* background-image: linear-gradient(180deg, #f6f6f6 0%, #7b7b7b 100%); */
        color: purple;
        border-bottom: 1px solid black;
    }
    .left_4_1 > div{
        width: 50% !important;
    }
    .left_4_1 > div{
        font-size: 18px;
        font-weight: 400;
        height: 100%;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .left_4_2{
        height: 80%;
        width: 100%;
        background: white;
        box-shadow: 0px 0px 2px;
        display: grid;
        grid-template-columns: 60% 40%;
    }
    .left_4_2 > div{
        position: relative;
        max-height: 100%;
        width: 100%;

    }
    .comment_box{
        /* padding-bottom: 20px; */
        /* background: cyan; */
        overflow-y: scroll;
    }

    .comment{
        width: 80%;
        /* background: green; */
        margin-left: auto;
        margin-right: auto;
        margin-top: 20px;
    }
    .comment_img{
        width: 6vh;
        height: 6vh;
        overflow: hidden;
        border-radius: 50%;
    }
    .comment_header{
        display: flex;
        flex-direction: row;
        justify-content: flex-end;
        align-items: center;
        font-size: 22px;
        font-weight: 400;
        color: black;
        cursor: pointer;
    }
    .comment_body{
        margin-right: 15px;
        text-align: right;
        font-size: 20px;
        font-weight: 300;
        color: rgb(87, 87, 87);
        direction: rtl;
    }

    .comment_date{
        font-size: 15px;
        font-weight: 200;
        color: #3a3a3a;
        margin-right: 40px;
    }

    .your_comment{
        height: 100px;
        width: 100%;
        /*background: gray;*/
        /*display: flex;*/
        /*align-items: center;*/
        /*justify-content: center;*/
    }
    .comment_emoji{
        /* background: red; */
        border-left: 1px solid #4d4d4d;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .left_4_left{
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-around;
        background: cyan;
        background-image: linear-gradient(180deg, #84cae4 0%, #6fddbc 100%);
        border-radius: 30px;
        height: 60%;
        width: 80%;
        margin-right: auto;
        margin-left: auto;
        padding-left: 20px;
        padding-right: 20px;
        padding-top: 10px;
        padding-bottom: 10px;
    }
    .left_4_left > div{
        height: 9vh;
        width: 9vh;
        /* overflow: hidden; */
        /* background: yellow; */
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 50%;
        cursor: pointer;
    }
    .smiley_font{
        /* font-size: 300%; */
        color: yellow;
        font-size: 10vh;

    }

    .my_button {
        border-radius: 20px;
        background: #00aa00;
        height: 6vh;
        width: 7vw;
        cursor: pointer;
        margin-left: 25%;
        margin-bottom: 30px;
    }

    .my_button:hover {
        background: #52dc2e;
    }

    .centered_text_div {
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        align-content: center;
    }

    .commentInput {
        width: 96%;
        margin-left: 2%;
        padding: 5%;
        height: 100%;
        /*border: none;*/
        border: 1px solid gray;
        border-radius: 5px;
        padding: 10px;
    }
    .commentInput:focus{
        border-color: #1e6abc;
    }
</style>