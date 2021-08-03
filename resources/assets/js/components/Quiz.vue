<template>
    <div class="row  " style="margin-top: 80px;">
        <div class="box" v-for="question in questions">
            <div class="col-md-12 col-xs-12" style="margin-bottom: 50px;">
                <h2>سوال&nbsp;{{(question.id)}}</h2>
                <h3>{{question.description}}</h3>
                <div class="answers">
                    @if($roqs[$idx]->result == 5)
                    <div onclick="changeAns('{{$question->qoqId}}', 5, '{{$idx}}')"
                         class="answer answer_1 active"></div>
                    @else
                    <div id="answer_{{$idx}}_5"
                         onclick="changeAns('{{$question->qoqId}}', 5, '{{$idx}}')"
                         class="answer answer_1"></div>
                    @endif
                    @if($roqs[$idx]->result == 4)
                    <div onclick="changeAns('{{$question->qoqId}}', 4, '{{$idx}}')"
                         class="answer answer_2 active"></div>
                    @else
                    <div id="answer_{{$idx}}_4"
                         onclick="changeAns('{{$question->qoqId}}', 4, '{{$idx}}')"
                         class="answer answer_2"></div>
                    @endif
                    @if($roqs[$idx]->result == 3)
                    <div onclick="changeAns('{{$question->qoqId}}', 3, '{{$idx}}')"
                         class="answer answer_3 active"></div>
                    @else
                    <div id="answer_{{$idx}}_3"
                         onclick="changeAns('{{$question->qoqId}}', 3, '{{$idx}}')"
                         class="answer answer_3"></div>
                    @endif
                    @if($roqs[$idx]->result == 2)
                    <div onclick="changeAns('{{$question->qoqId}}', 2, '{{$idx}}')"
                         class="answer answer_4 active"></div>
                    @else
                    <div id="answer_{{$idx}}_2"
                         onclick="changeAns('{{$question->qoqId}}', 2, '{{$idx}}')"
                         class="answer answer_4"></div>
                    @endif
                    @if($roqs[$idx]->result == 1)
                    <div onclick="changeAns('{{$question->qoqId}}', 1, '{{$idx}}')"
                         class="answer answer_5 active"></div>
                    @else
                    <div id="answer_{{$idx}}_1"
                         onclick="changeAns('{{$question->qoqId}}', 1, '{{$idx}}')"
                         class="answer answer_5"></div>
                    @endif
                </div>
                <div align="center" style="margin-left: auto">
                    <p style="float: right" class="text-success">موافقم</p>
                    <p style="float: left" class="text-danger">مخالفم</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Quiz",
        data(){
            questions : ''
        },
        mounted(){
            
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

    body{
        font-family: IRANSans;
        /*overflow-y: hidden;*/
        overflow-x: hidden;
        -webkit-overflow-scrolling: touch;
    }

    /*over ride part*/
    .container-fluid{
        padding: 0px;
    }
    .row{
        padding: 0px;
    }
    .add_padding{
        padding: 15px;
    }

    /*top part og the page header*/
    .top_part{
        font-family: ghasem;
        background-color: #32245f;
        height: 10vh;
        text-align: center;
        color: #f7f7f7;
        padding: 10px;
        font-size: 34px;
        margin-bottom: 50px;
    }

    .box{
        width: 50vw;
        margin: auto;
        text-align: justify;
        direction: rtl;
    }

    .answers{
        text-align: center;
        margin: auto;
        width: 100%;
        height: 50px;
        margin-bottom: 20px;
    }
    .answer{
        width: 50px;
        height: 50px;
        margin: 10px;
        position: absolute;
        /*float: right;*/
        border-radius: 100%;
        cursor: pointer;
    }

    .answer_1{
        margin-right: 0;
        background-size: 100% 100%;
        background-image: url("../../assets/em/1.png");
    }
    .answer_2{
        margin-right: 20%;
        background-size: 100% 100%;
        background-image: url("../../assets/em/2.png");}
    .answer_3{
        margin-right: 40%;
        background-size: 100% 100%;
        background-image: url("../../assets/em/3.png");
    }
    .answer_4{
        margin-right: 60%;
        background-size: 100% 100%;
        background-image: url("../../assets/em/4.png");
    }
    .answer_5{
        margin-right: 80%;
        background-size: 100% 100%;
        background-image: url("../../assets/em/5.png");
    }
    .answer_1:hover{
        background-size: 100% 100%;
        background-image: url("../../assets/em/1-2.png");
    }
    .answer_2:hover{
        background-size: 100% 100%;
        background-image: url("../../assets/em/2-1.png");
    }
    .answer_3:hover{
        background-size: 100% 100%;
        background-image: url("../../assets/em/3-1.png");
    }
    .answer_4:hover{
        background-size: 100% 100%;
        background-image: url("../../assets/em/4-1.png");
    }
    .answer_5:hover{
        background-size: 100% 100%;
        background-image: url("../../assets/em/5-1.png");
    }

    .answer_1.active{
        background-size: 100% 100%;
        background-image: url("../../assets/em/1-2.png");
    }
    .answer_2.active{
        background-size: 100% 100%;
        background-image: url("../../assets/em/2-1.png");
    }
    .answer_3.active{
        background-size: 100% 100%;
        background-image: url("../../assets/em/3-1.png");
    }
    .answer_4.active{
        background-size: 100% 100%;
        background-image: url("../../assets/em/4-1.png");
    }
    .answer_5.active{
        background-size: 100% 100%;
        background-image: url("../../assets/em/5-1.png");
    }

    @media screen and (max-width: 768px) {
        /*.answer{*/
        /*width: 30px;*/
        /*height: 30px;*/
        /*}*/
        .box{
            width: 90vw;
        }
    }

</style>