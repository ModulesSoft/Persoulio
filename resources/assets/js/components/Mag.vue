<template>
    <div class="left_2">
        <div class="left_2_1">
            <div class="books" id="div8">
                <div class="book_row">
                    <div class="book_container">
                        <img src="http://placehold.it/150x190/e8117f/fff&amp;text=Book%20Title" class="img-responsive book">
                    </div>
                    <div class="book_container">
                        <img src="http://placehold.it/150x190/e8117f/fff&amp;text=Book%20Title" class="img-responsive book">
                    </div>
                    <div class="book_container">
                        <img src="http://placehold.it/150x190/e8117f/fff&amp;text=Book%20Title" class="img-responsive book">
                    </div>
                    <div class="book_container">
                        <img src="http://placehold.it/150x190/e8117f/fff&amp;text=Book%20Title" class="img-responsive book">
                    </div>
                    <div class="book_container">
                        <img src="http://placehold.it/150x190/e8117f/fff&amp;text=Book%20Title" class="img-responsive book">
                    </div>
                    <div class="shelf"></div>
                    <div class="shelf2"></div>
                </div>
                <div class="book_row">
                    <div class="book_container">
                        <img src="http://placehold.it/150x190/e8117f/fff&amp;text=Book%20Title" class="img-responsive book">
                    </div>
                    <div class="book_container">
                        <img src="http://placehold.it/150x190/e8117f/fff&amp;text=Book%20Title" class="img-responsive book">
                    </div>
                    <div class="book_container">
                        <img src="http://placehold.it/150x190/e8117f/fff&amp;text=Book%20Title" class="img-responsive book">
                    </div>
                    <div class="book_container">
                        <img src="http://placehold.it/150x190/e8117f/fff&amp;text=Book%20Title" class="img-responsive book">
                    </div>
                    <div class="book_container">
                        <img src="http://placehold.it/150x190/e8117f/fff&amp;text=Book%20Title" class="img-responsive book">
                    </div>
                    <div class="shelf"></div>
                    <div class="shelf2"></div>
                </div>
                <div class="book_row">
                    <div class="book_container">
                        <img src="http://placehold.it/150x190/e8117f/fff&amp;text=Book%20Title" class="img-responsive book">
                    </div>
                    <div class="book_container">
                        <img src="http://placehold.it/150x190/e8117f/fff&amp;text=Book%20Title" class="img-responsive book">
                    </div>
                    <div class="book_container">
                        <img src="http://placehold.it/150x190/e8117f/fff&amp;text=Book%20Title" class="img-responsive book">
                    </div>
                    <div class="book_container">
                        <img src="http://placehold.it/150x190/e8117f/fff&amp;text=Book%20Title" class="img-responsive book">
                    </div>
                    <div class="book_container">
                        <img src="http://placehold.it/150x190/e8117f/fff&amp;text=Book%20Title" class="img-responsive book">
                    </div>
                    <div class="shelf"></div>
                    <div class="shelf2"></div>
                </div>
                <div class="book_row">
                    <div class="book_container">
                        <img src="http://placehold.it/150x190/e8117f/fff&amp;text=Book%20Title" class="img-responsive book">
                    </div>
                    <div class="book_container">
                        <img src="http://placehold.it/150x190/e8117f/fff&amp;text=Book%20Title" class="img-responsive book">
                    </div>
                    <div class="book_container">
                        <img src="http://placehold.it/150x190/e8117f/fff&amp;text=Book%20Title" class="img-responsive book">
                    </div>
                    <div class="book_container">
                        <img src="http://placehold.it/150x190/e8117f/fff&amp;text=Book%20Title" class="img-responsive book">
                    </div>
                    <div class="book_container">
                        <img src="http://placehold.it/150x190/e8117f/fff&amp;text=Book%20Title" class="img-responsive book">
                    </div>
                    <div class="shelf"></div>
                    <div class="shelf2"></div>
                </div>
            </div>
            <div></div>
            <div class="left_2_1_right">
                <div>
                    امروز روز توعه، پاشو یه غلطی بکن
                </div>
                <div>
                    <img src="../../assets/billgates.jpg" class="img-responsive" />
                    <div>مصاحبه استیو جاب</div>
                </div>
            </div>
        </div>
        <div class="left_2_2">
            <div> <img class="img-responsive" src="../../assets/ted.jpg" /> </div>
            <div> <img class="img-responsive" src="../../assets/ted.jpg" /> </div>
            <div> <img class="img-responsive" src="../../assets/ted.jpg" /> </div>
            <div> <img class="img-responsive" src="../../assets/ted.jpg" /> </div>
            <div> <img class="img-responsive" src="../../assets/ted.jpg" /> </div>
        </div>
        <div class="left_2_3">
            <div class="btn btn-primary disabled" style="padding: 0px"> <img class="img-responsive" src="../../assets/ted.jpg" /> </div>
            <div> <img class="img-responsive" src="../../assets/ted.jpg" /> </div>
        </div>

        <alert  v-if="modalShown" @close="modal" color="red" error="امکان استفاده از این بخش میسر نیست!"></alert>
    </div>

</template>

<script>
    import Vue from 'vue'
    Vue.component('alert', require('./Alert.vue'));
    export default {
        name: "Mag",
        data(){
            return{
                modalShown : true
            }
        },
        methods:{
            modal(){
                this.modalShown = !this.modalShown;
                console.log(this.modalShown)
            }
        }
    }
</script>

<style scoped>

    .left_2{
        height: calc(87% - 30px);
        margin-top: 30px;
        /* background: cyan; */
    }

    .left_2_1{
        height: calc(50% - 10px);
        margin-top: 10px;
        /* background: blue; */
        width: 100%;
        padding-left: 20px;
        padding-right: 20px;
        display: grid;
        grid-template-columns: 35% 1% 64%;
    }

    .left_2_1 > div{
        height: 100%;
        width: 100%;
        max-height: 100%;
    }
    .books{
        overflow-y: scroll;
        position: relative;
        background: cyan;
        background: #e2a219;
        border: 4px solid brown;
    }
    .left_2_1_right{
        max-height: 100%;
        max-width: 100%;
        /* background: greenyellow; */
    }
    .left_2_1_right > :nth-child(1){
        height: 15%;
        width: 100%;
        color: white;
        font-size: 20px;
        font-weight: 500;
        display: flex;
        align-items: center;
        justify-content: flex-end;
        padding-right: 3%;
        border-radius: 10px;
        background: linear-gradient(to right, rgb(49, 49, 184), rgb(108, 108, 209));
    }
    .left_2_1_right > :nth-child(2){
        cursor: pointer;
        height: calc(85% - 10px);
        margin-top: 10px;
        /* height: 83%; */
        /* margin-top: 2%; */
        width: 100%;
        color: white;
        background: cyan;
        border-radius: 10px;
        overflow: hidden;
        position: relative;
    }
    .left_2_1_right > :nth-child(2) > img{
        width: 100%;
        height: 100%;
    }
    .left_2_1_right > :nth-child(2) > div{
        position: absolute;
        color: white;
        font-size: 30px;
        font-weight: 600;
        top: 3%;
        right: 5%;
    }
    .left_2_2{
        height: calc(20% - 10px);
        margin-top: 10px;
        /* background: gray; */
        width: 100%;
        display: flex;
        flex-direction: row;
    }
    .left_2_3{
        height: calc(30% - 10px);
        margin-top: 10px;
        /* background: green; */
        width: 100%;
        display: flex;
        flex-direction: row;
    }

    .left_2_2 > div{
        margin-left: 10px;
        margin-right: 10px;
        height: 100%;
        width: 100%;
        overflow: hidden;
        border-radius: 10px;
        box-shadow: 0px 0px 2px;
        cursor: pointer;
    }
    .left_2_2 > :nth-child(1){
        margin-left: 20px;
    }
    .left_2_2 > :nth-last-child(1)
    {
        margin-right: 20px;
    }
    .left_2_2 > div > img{
        height: 100%;
        width: 100%;
    }

    .left_2_3 > div{
        cursor: pointer;
        margin-left: 10px;
        margin-right: 10px;
        height: 100%;
        width: 100%;
        overflow: hidden;
        border-radius: 10px;
        box-shadow: 0px 0px 2px;
    }
    .left_2_3 > :nth-child(1){
        margin-left: 20px;
    }
    .left_2_3 > :nth-last-child(1)
    {
        margin-right: 20px;
    }
    .left_2_3 > div > img{
        height: 100%;
        width: 100%;
    }


    .book_row{
        position: relative;
        width: 100%;
        height: 30%;
        display: flex;
        flex-direction: row;
        justify-content: flex-start;
        align-items: flex-end;
        padding-bottom: 10px;
        padding-left: 20px;
        padding-right: 20px;
        /* background: cyan; */
    }

    .book_container{
        cursor: pointer;
        z-index: 2;
        width: 15%;
        margin: 0px 10px;
    }
    .book_container:hover{
        width: 18%
    }
    .book {
        width: 100%;
        height: auto;
        padding: 15px 0 0 0;
        margin: auto;
        /* -webkit-filter: blur(1px); */
        /* filter: blur(1px); */
    }
    .shelf {
        width: 95%;
        left:2.5%;
        position: absolute;
        /* margin-top: -10px; */
        border-bottom: 20px solid #a5a5a5;
        border-left: 30px solid transparent;
        border-right: 30px solid transparent;
        bottom: 5px;
        z-index: 1;
    }
    .shelf2 {
        position: absolute;
        bottom: 0px;
        content: '';
        background: #686868;
        height: 5px;
        left: 2.5%;
        width: 95%;
        z-index: 1;
    }
</style>