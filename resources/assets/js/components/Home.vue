<template>
    <div class="my_container" id="page1" dir="ltr">
        <div class="login">
            <img src="../../assets/login_background.png" class="fill_div img-responsive"/>
            <div class="login_container">
                <img src="../../assets/background.jpg" class="img-responsive fill_div"/>
                <div>
                    <div>
                        <!--<div>پرسولیو</div>-->
                        <img src="../../assets/PersoulioGradientLogo_-01.png" style="width: 50%;" />

                        <div>به خودت برس</div>
                    </div>
                    <div>
                        <div class="vorud" style="position:relative">
                            <!--<div v-if="!loginToggle"-->
                                 <!--style="position: absolute;height: 100%;left:5%;top: 0px;cursor: pointer;display: flex;justify-content: center;align-items: center">-->
                                <!--<i class="fas fa-chevron-left" @click="change_login"></i>-->
                            <!--</div>-->
                        </div>
                        <div class="fill_div flex_x">
                            <div v-if="loginToggle" class="fill_div" id="login_1">
                                <!--<div class="student" @click="change_login()">دانشجویان</div>-->
                                <!--<div class="other" @click="change_login()">سایر</div>-->
                                <router-link to="/login" style="text-decoration: none; color: inherit;">
                                    <div class="student" >ورود</div>
                                </router-link>
                                <a  href="/signUp" style="text-decoration: none;  color: inherit;"><div class="other" >ثبت نام</div></a>
                            </div>
                            <div v-if="!loginToggle" class="uni_login" id="login_2">
                                <div>سایر</div>
                                <div>
                                    <img src="../../assets/sut_logo.png" class="login_logo img-responsive"/>
                                    <div>دانشگاه شریف</div>
                                </div>
                                <div>
                                    <img src="../../assets/ut_logo.png" class="login_logo img-responsive"/>
                                    <div>دانشگاه تهران</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div>مشاوران</div>
                        <div class="active_login">کاربران</div>
                        <div>همکاران</div>
                        <div class="login_effect"></div>
                    </div>
                </div>
            </div>
            <div class="login_info" style="text-align: right">
                <div>
                    <div>حمایت از سوی دانشگاه تهران</div>
                    <img src="../../assets/Path_129.png"/>
                </div>
                <div>
                    سامانه راهبری توسعه فردی و تیمی هوشمند پرسولیو، افتخار حمایت های زیرساختی، علمی، مادی و معنوی از سوی مرکز مشاوره دانشگاه تهران به عنوان سامانه برگزیده در این حوزه را به همراه دارد

                </div>
            </div>
            <nav role="navigation">
                <div id="menuToggle">
                    <input type="checkbox" />
                    <span></span>
                    <span></span>
                    <span></span>
                    <div id="menu">
                        <div>اینستاگرام</div>
                        <div>درباره ما</div>
                        <div>تماس با ما</div>
                    </div>
                </div>
            </nav>
        </div>
        <div class="hover_page" style="text-align:right">
            <img class="hover_page_background img-responsive" src="../../assets/hover_background.png"/>
            <div class="hover_left">

                <div class="hover_left_row">
                    <div>
                        <div v-if="leftRowFirstHover" id="4l">سنجش</div>
                        <div v-if="leftRowFirstHover" class="hover_left_row_nav vis_hover" id="4c"></div>
                    </div>
                    <div class="hover_left_row_rast_container" style="cursor: pointer">
                        <div v-if="leftRowFirstHover" class="hover_left_row_rast active_hover  icons_div" id="4h">
                            <img class="hover_icon" src="../../assets/Layer_1.png"/>
                        </div>
                        <div v-else class="hover_left_row_rast  icons_div"
                             @click="leftRowFirstHover=true; leftRowSecondHover=false; leftRowThirdHover=false; setContent(1)"
                             id="4h">
                            <img class="hover_icon" src="../../assets/zarebin2.png"/>
                        </div>
                    </div>
                </div>

                <div class="hover_left_row">
                    <div class="left_row_2">
                        <div  v-if="leftRowHover" class="item1tosiye" id="1l">توصیه</div>
                        <div v-if="leftRowSecondHover" class="left_row_2_2" id="2l">کارگاه</div>
                        <div v-if="leftRowThirdHover" class="left_row_2_3" id="3l">کلاس</div>
                        <div v-if="leftRowHover" class="hover_left_row_nav" id="1c"></div>
                        <div v-if="leftRowSecondHover" class="hover_left_row_nav_2" id='2c'></div>
                        <div v-if="leftRowThirdHover" class="hover_left_row_nav_3" id='3c'></div>
                    </div>
                    <div class="hover_left_row_rast_container">
                        <div v-if="leftRowHover" @mouseleave="leftRowHover = false"
                             class="hover_left_row_rast hover_left_row_rast_2 active_hover" id="1h">
                            <div style="width: 100%; height: 20%;display: flex;
                            justify-content: center; align-items: center">توصیه
                            </div>
                            <div @click="leftRowHover = false ; leftRowSecondHover = true ; leftRowThirdHover = false ;leftRowFirstHover = false; setContent(3)"
                                 class="with_border  icons_div" id="2h"><img class="hover_icon"
                                                                  src="../../assets/Workshops-Icon.png"/>
                            </div>
                            <div @click="leftRowHover = false ; leftRowSecondHover = false ; leftRowThirdHover = true; leftRowFirstHover = false; setContent(4)"
                                 class="with_border  icons_div" id="3h"><img class="hover_icon"
                                                                  src="../../assets/faculty-512.png"/>
                            </div>
                        </div>
                        <div v-else @mouseover="leftRowHover = true;setContent(2)"
                             class="hover_left_row_rast hover_left_row_rast_2"
                             id="1h">
                            <div style="width: 100%; height: 20%;display: flex;
                            justify-content: center; align-items: center">توصیه
                            </div>
                            <div v-if="leftRowSecondHover" class="with_border active_hover  icons_div" id="2h"><img
                                    class="hover_icon"
                                    src="../../assets/Workshops-Icon.png"/>
                            </div>
                            <div v-else class="with_border  icons_div" id="2h"><img class="hover_icon"
                                                                         src="../../assets/Workshops-Icon.png"/>
                            </div>
                            <div v-if="leftRowThirdHover" class="with_border active_hover  icons_div" id="3h"><img
                                    class="hover_icon"
                                    src="../../assets/takhte.png"/>
                            </div>
                            <div v-else class="with_border  icons_div" id="3h"><img class="hover_icon"
                                                                         src="../../assets/faculty-512.png"/>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="hover_left_row">
                    <div></div>
                    <div class="hover_left_row_rast_container">
                        <div class="hover_down  icons_div">
                            <img src="../../assets/2-layerss.png" class="img_fill_div"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hover_right">
                <div class="hover_right_header">
                    <div class="big_title">
                        {{this.title}}
                    </div>
                    <img class="fill_div img-responsive" src="../../assets/zarebin2.png"/>
                </div>
                <div class="hover_right_text" id="sc1">
                    {{this.content}}
                </div>
            </div>
        </div>
        <div class="coach_page">
            <img class="coach_page_background img-responsive" src="../../assets/Layer_4.png"/>
            <div class="coach_page_container">
                <div class="circle_container">
                    <div class="circ1">
                        <div class="circ2">
                            <div class="circ3">
                                    <img class="fill_div img-responsive img-circle" src="../../assets/circ.jpg"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="coach_text_container">
                    <div class="scroll-area coach_text" v-once :settings="settings" @ps-scroll-y="scrollHanle"  id="sc2">
                        <div> کوچینگ</div>
                        <div>

                            هدفگذاری کن و وارد مسیر شو!!
                            </br></br>
                            •	تو مسیر پیشرفتت بمون!!
                            </br>

                            •	به اهدافت برس
                            </br></br>



                            همه‌‌ي ما ممکنه برای هدف گذاری و پیگیری اهدافمون نیاز به مشورت و انگیزه‌دهی داشته باشیم، یکی که تو مسیر ارتقای توامندی ها و مواجه شدن با مشکلات احتمالی این مسیر کنارمون باشه و بتونیم باهاش راه‌حل مواجه شدن با مشکلات رو پیدا کنیم، پرسولیو برای برطرف کردن این نیاز خدمت خیلی خوبی برات در نظر گرفته...
                            </br>
                            تو میتونی در مسیر پیشرفتت مربی شخصی داشته باشی و همیشه یکی رو تو مسیر همراه خودت داشته باشی!
                            </br>
                            مربی یا کوچ (coach) تو بهت کمک میکنه بهتر هدفگذاری کنی و البته مهمتر اینکه درراه رسیدن به اهدافت همیشه کنارت می‌مونه.
                            </br>
                            دوران دانشجویی با دوران دانش‌آموزی خیلی متفاوته...تفاوت اصلی هم بدلیل محیط و رویکرد دانشگاه و مدرسه است که از زمین تا آسمون با هم فرق میکنن
                            .
                            </br>

                            دانشجوها که آروم آروم وارد دوران بزرگسالی میشن همواره احساس استقلال توی زندگی و تصمیم گیری هاشون بیشتر میشه
                            درحالیکه شاید هنوز به طور کامل برای این تغییر اماده نشدن...
                            </br>

                            دیگه ردی از مشاور و راهنمایی که همیشه تو دوران دبیرستان همراه بچه ها بوده دیده نمیشه ودانشجوها به یکباره خودشون رو با هدفگذاری های مهم زندگیشون و پیمودن مسیر پر پیچ و خم دانشجوییشون تنها میبینن
                            ضمن اینکه پیدا کردن افراد قابل اطمینان و دوستان ارزشمند ممکنه مدتی طول بکشه ...
                            </br>
                            و این مدت معمولا برای دانشجوها سخت و پرابهام باقی میمونه
                            این موارد نیاز به حضور یک مربی خوب و قابل اطمینان برای حضور داشتن در کنار دانشجو‌ها رو ایجاد میکنه
                            .
                            </br>
                            پرسولیو تحت نظارت مرکز مشاوره دانشگاه تهران و با تایید متخصصین این مرکز خدمت ارزشمند کوچینگ (coaching)  رو برای دانشجو ها مهیا کرده تا اونا بتونن با خیال راحت و البته هزینه کم و دانشجویی از این خدمت استفاده کنن
                            </br>
                            خدمات ارائه شونده در جلسات کوچینگ پرسولیو
                            :
                            </br>
                            </br>
                            • یافتن و شفاف سازی خواسته ها و اهداف بلند مدت
                            </br>
                            •   هدفگذاری و مشخص کردن مسیر رسیدن به اهداف
                            </br>
                            •  برطرف سازی مشکلات موجود در مسیر رسیدن به اهداف
                            </br>
                            • انگیزش و پاسخگو نگه داشتن افراد برای رسیدن به خواسته‌هایشان
                            </br>
                            •  افزایش مسئولیت پذیری مراجعین
                            </br>
                            و ....
                            </br>
                            </br>
                            با کوچینگ پرسولیو همراه بشید و پلی بین اونچه که الان هستید و اونچه که میخواهید باشید ایجاد کنید!!!

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pers_info">
            <img class="pers_info_background img-responsive" src="../../assets/background_3.png"/>
            <div class="pers_info_container" style="text-align: right">
                <div>
                    <div class="info_title">
                        {{secondTitle}}
                    </div>
                    <div class="info_text">
                        {{secondContent}}
                    </div>
                </div>
                <div style="position: relative;padding:0px 3%; padding-bottom: 5%; ">
                        <div class="left_1">
                            <div v-if="introFifthHover" class="div_yek_sevvom left_1_font yellow_background">
                                <div class="centered_text_div"
                                     @click="introFirstHover = false;introSecondHover=false;introThirdHover=false;introFourthHover=false;introFifthHover=true;setSecondContent(5)">
                                    پرسولیو فان
                                </div>
                            </div>
                            <div v-else class="div_yek_sevvom left_1_font">
                                <div class="centered_text_div"
                                     @click="introFirstHover = false;introSecondHover=false;introThirdHover=false;introFourthHover=false;introFifthHover=true;setSecondContent(5)">
                                    پرسولیو فان
                                </div>
                            </div>
                            <div v-if="introSecondHover || introThirdHover || introFourthHover"
                                 class="div_yek_sevvom left_1_font yellow_background">
                                 <!--@click="introFirstHover = false;introSecondHover=true;introThirdHover=false;introFourthHover=false;introFifthHover=false;"-->

                                <div class="centered_text_div">
                                    تونل
                                </div>
                                <div class="tunel_options"
                                     @click="introFirstHover = false;introSecondHover=true;introThirdHover=false;introFourthHover=false;introFifthHover=false;">
                                    <div v-if="introFourthHover" class="tunel_selected"
                                         @mouseover="introFirstHover = false;introSecondHover=false;introThirdHover=false;introFourthHover=true;introFifthHover=false;setSecondContent(4)">
                                        پروژه /کار
                                    </div>
                                    <div v-else
                                         @mouseover="introFirstHover = false;introSecondHover=false;introThirdHover=false;introFourthHover=true;introFifthHover=false;setSecondContent(4)">
                                        پروژه /کار
                                    </div>
                                    <div v-if="introThirdHover" class="tunel_selected"
                                         @mouseover="introFirstHover = false;introSecondHover=false;introThirdHover=true;introFourthHover=false;introFifthHover=false; setSecondContent(3)">
                                        کلاس
                                    </div>
                                    <div v-else
                                         @mouseover="introFirstHover = false;introSecondHover=false;introThirdHover=true;introFourthHover=false;introFifthHover=false; setSecondContent(3)">
                                        کلاس
                                    </div>
                                    <div v-if="introSecondHover" class="tunel_selected"
                                         @mouseover="introFirstHover = false;introSecondHover=true;introThirdHover=false;introFourthHover=false;introFifthHover=false; setSecondContent(2)"
                                    > همایش/ کارگاه
                                    </div>
                                    <div v-else
                                         @mouseover="introFirstHover = false;introSecondHover=true;introThirdHover=false;introFourthHover=false;introFifthHover=false; setSecondContent(2)"
                                    > همایش/ کارگاه
                                    </div>
                                </div>
                            </div>
                            <div v-else class="div_yek_sevvom left_1_font"
                                 @click="introFirstHover = false;introSecondHover=true;introThirdHover=false;introFourthHover=false;introFifthHover=false; setSecondContent(2)">
                                <div class="centered_text_div">
                                    تونل
                                </div>
                            </div>
                            <div v-if="introFirstHover" class="div_yek_sevvom left_1_font yellow_background"
                                 @click="introFirstHover = true;introSecondHover=false;introThirdHover=false;introFourthHover=false;introFifthHover=false; setSecondContent(1)">
                                <div class="centered_text_div">
                                    پرسولیو مگ
                                </div>
                            </div>
                            <div v-else class="div_yek_sevvom left_1_font"
                                 @click="introFirstHover = true;introSecondHover=false;introThirdHover=false;introFourthHover=false;introFifthHover=false; setSecondContent(1)">
                                <div class="centered_text_div">
                                    پرسولیو مگ
                                </div>
                            </div>
                        </div>
                        <img v-if="introFirstHover" src="../../assets/666.png" class="fill_div" style="position: absolute;
                            top: 0px; left: 0px; height: 100%; width: 100%;" />
                        <img v-if="introSecondHover || introThirdHover || introFourthHover" src="../../assets/668.png" class="fill_div" style="position: absolute;
                                top: 0px; left: -10%; height: 100%; width: 120%;" />
                        <img v-if="introFifthHover" src="../../assets/667.png" class="fill_div" style="position: absolute;
                                top: 0px; left: 0px; height: 100%; width: 100%;" />
                </div>
            </div>
        </div>
        <div class="coach_page2" >
            <img class="coach_page_background img-responsive" src="../../assets/Layer_4.png"/>
            <div class="coach_2">
                <div>پنل کوچینگ</div>
                <div>
                    <div class="coach_2_container">
                        <div class="coach_2_contents">
                            <div>
                                <div>مربی</div>
                                <img src="../../assets/ut_logo.png" class="img-circle img-responsive coach_img"/>
                            </div>
                            <div v-if="coachGuide1" class="zoom" id="pop_div_1">
                                <div>
                                    این کارا رو انجام بده
                                </div>
                                <div class="coach_jobs">
                                    <div><img class="img-responsive" src="../../assets/spiderman.jpg"/></div>
                                    <div><img class="img-responsive" src="../../assets/ted.jpg"/></div>
                                    <div><img class="img-responsive" src="../../assets/spiderman.jpg"/></div>
                                    <div><img class="img-responsive" src="../../assets/ted.jpg"/></div>
                                </div>
                            </div>
                            <div v-else id="pop_div_1" class="notZoom">
                                <div>
                                    این کارا رو انجام بده
                                </div>
                                <div class="coach_jobs">
                                    <div><img class="img-responsive" src="../../assets/spiderman.jpg"/></div>
                                    <div><img class="img-responsive" src="../../assets/ted.jpg"/></div>
                                    <div><img class="img-responsive" src="../../assets/spiderman.jpg"/></div>
                                    <div><img class="img-responsive" src="../../assets/ted.jpg"/></div>
                                </div>
                            </div>
                            <div v-if="coachGuide2" class="zoom" id="pop_div_2">
                                <div>
                                    با هم قرار داریم
                                </div>
                                <div class="job_titles">
                                    <div>
                                        <div class="fill_div flex_y">
                                            <div> سه شنبه</div>
                                            <div> ۱۰:۳۰</div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="fill_div flex_y">
                                            <div> سه شنبه</div>
                                            <div> ۱۰:۳۰</div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="fill_div flex_y">
                                            <div> سه شنبه</div>
                                            <div> ۱۰:۳۰</div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="fill_div flex_y">
                                            <div> سه شنبه</div>
                                            <div> ۱۰:۳۰</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div v-else class="notZoom" id="pop_div_2">
                                <div>
                                    با هم قرار داریم
                                </div>
                                <div class="job_titles">
                                    <div>
                                        <div class="fill_div flex_y">
                                            <div> سه شنبه</div>
                                            <div> ۱۰:۳۰</div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="fill_div flex_y">
                                            <div> سه شنبه</div>
                                            <div> ۱۰:۳۰</div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="fill_div flex_y">
                                            <div> سه شنبه</div>
                                            <div> ۱۰:۳۰</div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="fill_div flex_y">
                                            <div> سه شنبه</div>
                                            <div> ۱۰:۳۰</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div v-if="coachGuide3" class="zoom" id="pop_div_3">
                                <div>
                                    برنامه هفتگی
                                </div>
                                <div class="week_plan">
                                    <img src="../../assets/week.jpg" class="img-responsive fill_div"/>
                                </div>
                            </div>
                            <div v-else class="notZoom" id="pop_div_3">
                                <div>
                                    برنامه هفتگی
                                </div>
                                <div class="week_plan">
                                    <img src="../../assets/week.jpg" class="img-responsive fill_div"/>
                                </div>
                            </div>
                            <div class="button_1" @click='coachGuide1 = !coachGuide1'>
                                <div class="button_sign" id="popover1">
                                    <i v-if="coachGuide1" class="fa fa-minus"></i>
                                    <i v-else class="fa fa-plus"></i>
                                </div>
                            </div>
                            <div v-if="coachGuide1" class="popover" style="margin-left: calc(100% + 50px) !important;">
                                ه گزارش ورزش سه، شروع جان توشاک در تبریز شروع خوبی نبود. 3 بازی و دو امتیاز. ازده بود
                                تراکتورسازی راه خود را با این مربی بزرگ پیدا خواهد کرد و این چنین هم شد.
                            </div>
                            <div id="b2" class="button_2">
                                <div class="button_sign" id="popover2" @click='coachGuide2 = !coachGuide2'>
                                    <i v-if="coachGuide2" class="fa fa-minus"></i>
                                    <i v-else class="fa fa-plus"></i>
                                </div>
                            </div>
                            <div v-if="coachGuide2" class="popover" style="margin-left: calc(-40% - 50px) !important;">
                                ه گزارش ورزش سه، شروع جان توشاک در تبریز شروع خوبی نبود. 3 بازی و دو امتیاز. ازده بود
                                تراکتورسازی راه خود را با این مربی بزرگ پیدا خواهد کرد و این چنین هم شد.
                            </div>
                            <div id="b3" class="button_3">
                                <div class="button_sign" id="popover3" @click='coachGuide3 = !coachGuide3'>
                                    <i v-if="coachGuide3" class="fa fa-minus"></i>
                                    <i v-else class="fa fa-plus"></i>
                                </div>
                            </div>
                            <div v-if="coachGuide3" class="popover"
                                 style="margin-left: calc(-40% - 50px) !important; margin-top: 30%">
                                ه گزارش ورزش سه، شروع جان توشاک در تبریز شروع خوبی نبود. 3 بازی و دو امتیاز. ازده بود
                                تراکتورسازی راه خود را با این مربی بزرگ پیدا خواهد کرد و این چنین هم شد.
                            </div>
                        </div>
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
        data() {
            return {
                settings: {
                    maxScrollbarLength: 60
                },
                loginToggle: true,
                coachGuide1: false,
                coachGuide2: false,
                coachGuide3: false,
                leftRowHover: false,
                leftRowFirstHover: true,
                leftRowSecondHover: false,
                leftRowThirdHover: false,
                content: '',
                title: '',
                introFirstHover: true,
                introSecondHover: false,
                introThirdHover: false,
                introFourthHover: false,
                introFifthHover: false,
                secondContent:'',
                secondTitle:''
            }
        },
        mounted() {
            console.log('Component mounted.');
            this.setContent(1);
            this.setSecondContent(1);
        },
        methods: {
            scrollHanle(evt) {
                console.log(evt)
            },
            change_login() {
                this.loginToggle = !this.loginToggle;
                console.log(this.loginToggle);
            },
            setContent(num) {
                switch (num) {
                    case (1) :
                        this.title = "مسیر پرسولیو\n" +
                            "مسیر توسعه فردي";
                        this.content = "خودتو پیدا کن \n" +
                            "\n" +
                            "با روش‌های مختلفی که پرسولیو بهت ارائه میده خودتو بهتر بشناس، اینجوری بهتر میتونی در کنار لذت بردن از لحظاتت کارای مفید بکنی و کمک میکنه همه فعالیت‌هات متناسب با ویژگی های شخصی خودت باشن \n" +
                            "ما بهت کمکت میکنیم تا : \n" +
                            "- با ابعاد مختلف شخصیتت آشنا بشی \n" +
                            "- استعداد های خودتو بهتر بشناسی \n" +
                            "- علاقه مندی ها و مهارت‌هاتو دسته بندی کنی \n" +
                            "- با تکنیک های مختلفی که بهت معرفی میکنیم سبک زندگیتو بهبود بدی ";
                        break;
                    case (2) :
                        this.title = "مسیر هاي پیشرفت\n" +
                            "مناسب خودت رو پیدا کن";
                        this.content = "وقتی ابعاد مختلف خودتو بهتر شناختی، دیگه\n" +
                            "خیالت راحت باشه\n" +
                            "پرسولیو بهترین و معتبر ترین پیشنهادات رو براي\n" +
                            "دنبال کردن علاقهمندي هات و ارتقاي توانمندي\n" +
                            "هات بهت میده،دیگه لازم نیست همه جا رو براي\n" +
                            "پیدا کردن مسیر پیشرفتت زیر و رو کنی";
                        break;
                    case (3) :
                        this.title = "همایش، سمینار و کارگاه";
                        this.content = "براي توسعه توامنمندي هاي فردي و کسب\n" +
                            "مهارت هاي ارتباطی میتونی از کارگاه هاي\n" +
                            "اختصاصی پرسولیو که با همکاري اساتید و\n" +
                            "متخصصین مرکز مشاوره دانشگاه تهران برگزار\n" +
                            "میشه استفاده کنی";
                        break;
                    case(4):
                        this.title = "کلاس هاي تخصصی";
                        this.content = "در راستاي کسب و ارتقاي مهارت هاي مورد\n" +
                            "علاقه و متناسب با رشته تحصیلیت میتونی\n" +
                            "کلاسهاي آموزشی معتبر دانشگاه تهران رو\n" +
                            "بشناسی با شرکت در اونها روز به روز به مهارت\n" +
                            "ها و دانسته هاي قبلیت اضافه کنی و مسیر\n" +
                            "پیشرفتت رو طی کنی";
                        break;
                    default :
                        this.title = "مسیر پرسولیو\n" +
                            "مسیر توسعه فردي";
                        this.content = "خودتو پیدا کن \n" +
                            "\n" +
                            "با روش‌های مختلفی که پرسولیو بهت ارائه میده خودتو بهتر بشناس، اینجوری بهتر میتونی در کنار لذت بردن از لحظاتت کارای مفید بکنی و کمک میکنه همه فعالیت‌هات متناسب با ویژگی های شخصی خودت باشن \n" +
                            "ما بهت کمکت میکنیم تا : \n" +
                            "- با ابعاد مختلف شخصیتت آشنا بشی \n" +
                            "- استعداد های خودتو بهتر بشناسی \n" +
                            "- علاقه مندی ها و مهارت‌هاتو دسته بندی کنی \n" +
                            "- با تکنیک های مختلفی که بهت معرفی میکنیم سبک زندگیتو بهبود بدی ";
                }
            },
            setSecondContent(num) {
                switch (num) {
                    case (1) :
                        this.secondTitle = "پرسو مگ، گوشه دنج تو";
                        this.secondContent = "تو این بخش که مجله پرسولیو نام داره\n" +
                            "میتونی کلی محتواي جذاب و مخصوص با\n" +
                            "روحیات و علاقهمنديهاي خودت پیدا کنی\n" +
                            "فیلم هاي اموزشی و تفریحی، مطالب جذاب\n" +
                            "براي اموزش مهارتهاي زندگی، انجام بازیهاي\n" +
                            "متناسب با استعداد هاي خودت، مصاحبه با\n" +
                            "افراد موفق و خیلی بخشهاي جذاب دیگه تو\n" +
                            "این مجله در انتظارته";
                        break;
                    case (2):
                        this.secondTitle="تونـــــــل";
                        this.secondContent="زمانیکه به خوبی مهارت هات رو ارتقا دادي و\n" +
                            "مورد تایید متخصصین پرسولیو و دانشگاه\n" +
                            "تهران قرار گرفتی دیگه میتونی با استفاده از\n" +
                            "مهارت هات ارزش افزایی و درآمدزایی کنی و\n" +
                            "پرسولیو و دانشگاه تهران بزرگترین حامی تو در\n" +
                            "این راه هستند و می تونن بهت پیشنهاد پروژه\n" +
                            ".و کار متناسب با و خودتو بدن\n" +
                            "براي رسیدن به این جایگاه مسیري رو برات\n" +
                            "طراحی کردیم که مثل یک تونل تو رو سریع به\n" +
                            "اهدافت می رسونه"
                        break;
                    case (5):
                        this.secondTitle="پرسو فـــــان";
                        this.secondContent="پیدا کردن تفریحات سالم و مناسب دوران\n" +
                            "دانشجویی شاید خیلی راحت نباشه،\n" +
                            "مخصوصا وقتی که درگیر درس و کاراي\n" +
                            "دانشگاه هستی\n" +
                            "به کمک این بخش از پرسولیو میتونی\n" +
                            "رویداد هاي تفریحی متناسب با شخصیت و\n" +
                            "علاقهمنديهات رو پیدا کنی و با شرکت تو\n" +
                            "این رویداد ها حسابی خوش بگذرونی";
                        break;
                    default :
                        this.secondTitle = "پرسو مگ، گوشه دنج تو";
                        this.secondContent = "تو این بخش که مجله پرسولیو نام داره\n" +
                            "میتونی کلی محتواي جذاب و مخصوص با\n" +
                            "روحیات و علاقهمنديهاي خودت پیدا کنی\n" +
                            "فیلم هاي اموزشی و تفریحی، مطالب جذاب\n" +
                            "براي اموزش مهارتهاي زندگی، انجام بازیهاي\n" +
                            "متناسب با استعداد هاي خودت، مصاحبه با\n" +
                            "افراد موفق و خیلی بخشهاي جذاب دیگه تو\n" +
                            "این مجله در انتظارته";
                }
            }
        }
    }
</script>

<style scoped>

    @media screen and (max-width: 600px) {
        .login{
            overflow-x: hidden !important;
            /*position: relative;*/
            /*background: #391c4e;*/
            /*padding: 4px;*/
            /*padding-right: 0px;*/
            /*width: 100%;*/
            height: 200vh !important;
            /*font-family:"yekan";*/
            /*overflow-x: hidden;*/
            /*overflow-y: hidden;*/
        }
        .login > img{
            /* background-repeat: 5% 5%; */
            width: unset !important;
            height: 100%;
            margin-left: -300%;
            /*position: absolute;*/
            /*top: 0px;*/
            /*left: 0px;*/
            /*opacity: 0.5;*/
        }

        .login_container {
            position: absolute !important;
            top: 0% !important;
            right: 5% !important;
            width: 90% !important;
            /*height: 93% !important;*/
            height: 46.5% !important;
            border-bottom-left-radius: 20px !important;
            border-bottom-right-radius: 20px !important;

            /* background: #0baedd !important; */
        }
        .login_container > img{
            position: absolute;
            bottom: 0px;
            width: 100%;
            height: 50%;
            opacity: 0.25;
            -webkit-mask-image: -webkit-gradient(linear, left bottom,
            left top, from(rgba(0,0,0,1)), to(rgba(0,0,0,0)));
        }
        .login_container > div{
            padding-top: 10% !important;
            height: 100%;
            width: 100%;
            display: grid;
            grid-template-rows: 40% 40% 20%;
            display: flex;
            flex-direction: column;
            /* position: relative; */
        }
        .login_container > div > :nth-child(1)
        {
            /*background: cyan;*/
            margin-top: 15% !important;
            height: 25% !important;
        }
        .login_container > div > :nth-child(1) > :nth-child(2){
            /*font-family: yekan;*/
            font-size: 30px !important;
            /*font-weight: 400;*/
            /*color: #a229b2;*/
             /*color: red !important;*/
        }
        .div_yek_sevvom {
            /*border-radius: 0px !important;*/
            /*background: #b5b5b5;*/
        }

        .login_info {
            width: 90% !important;
            height: 35% !important;
            left: 5% !important;
            top: 55% !important;
            padding-left: 0px !important;
            /*visibility: hidden !important;*/
        }
        .login_info > :nth-child(2){
            /* width: 80%; */
            height: 80%;
            color: white;
            /*background: red;*/
            /*margin-top: 10% !important;*/
            padding: 0px 20px !important;
            padding-top: 10% !important;
            font-size: 23px;
            font-weight: 200;
            direction: rtl;
            margin-right: 2.5%;
        }


        #menuToggle {
            position: relative !important;
            margin-top: -8% !important;
            left: 13% !important;
            z-index: 10 !important;
            /* width: 10px; */
            /* height: 10px; */
             /*background: red;*/
        }

        #menu div {
            font-size: 15px !important;
            margin: 0px !important;
            margin-top: 15px !important;
            color: purple !important;
        }
        #menuToggle > span{
            background: purple !important;
        }
        #menuToggle input:checked ~ span{
            background: purple !important;
        }
        #menu div{
            font-size: 14px !important;
        }

        .hover_page_background{
            /*position: absolute;*/
            /*bottom: 0px;*/
            width: 290% !important;
            /*height: 120% !important;*/
            margin-left: -120% !important;
            opacity: 0.3;
            transform: scale(1.3) !important;
            /*transform: unset !important;*/
            /* scale(6.2); */
            /* -webkit-mask-image: -webkit-gradient(linear, left bottom,
            left top, from(rgba(0,0,0,1)), to(rgba(0,0,0,0))); */
        }


        .hover_right {
            width: 97% !important;
            margin-top: 10% !important;
        }

        .hover_left {
            visibility: hidden !important;
            z-index: -100 !important;
            width: 3% !important;
        }

        .vis_hover {
            margin-right: 400px !important;
        }

        .hover_right > :nth-child(1) {
            height: 20% !important;
        }

        .hover_right > :nth-child(2) {
            margin-top: 5% !important;
            height: 60% !important;
            padding: 10% !important;
            /*background: red;*/
        }

        .big_title {
            font-size: 25px !important;
            font-weight: 500;
            /* background: rebeccapurple; */
            width: 100%;
        }

        .hover_right_text {
            /*margin-top: -5% !important;*/
            height: 130%;
            /*background: cyan !important;*/
            width: 120% !important;
            margin-left: -12% !important;
            padding-top: 10% !important;
            overflow: hidden !important;
            /*padding-bottom: 0px;*/
            /*padding: 3% 0px;*/
            /*padding-left: 8%;*/
            /*padding-right: 10%;*/
            font-weight: 300;
            font-size: 15px !important;
        }

        .coach_page {
            overflow-x: hidden !important;
            height: unset !important;
        }
        .coach_page_background{
            /*position: absolute;*/
            /*bottom: 0px;*/
            width: 450% !important;
            margin-left: -300% !important;
            /*height: 100%;*/
            /* background-image: linear-gradient(180deg, rgba(0, 0, 0, 0) 0%, #000000 100%); */

            /* z-index: 2; */
            /*opacity: 1;*/
        }

        .coach_page_container {
            flex-direction: column !important;
            /* height: 150vh; */
        }

        .coach_page_container > :nth-child(1) {
            /* background: #07357a; */
            width: 100% !important;
            height: 70vh !important;
            box-sizing: border-box;
            /* background: red; */
            /* visibility:  hidden !important; */
        }

        .coach_page_container > :nth-child(2) {
            /* background: #0baedd; */
            width: 100% !important;
            height: 100vh !important;
        }

        .circ1 {
            margin-top: 5% !important;
            height: 55vh !important;
            width: 55vh !important;
        }

        .coach_text {
            margin-top: 0px !important;
        }

        .coach_text > :nth-child(1) {
            width: 100% !important;
            font-size: 50px !important;
            text-align: center !important;
            margin-left: 9% !important;
            margin-top: -13% !important;
        }

        .coach_text > :nth-child(2) {
            font-size: 18px !important;
            font-weight: 300;
            direction: rtl;
            /*background: cyan;*/
            width: 115% !important;
        }

        .pers_info {
            overflow-x: hidden !important;
            height: 160vh !important;
        }

        .pers_info_container {
            position: relative;
            width: 95%;
            left: 5%;
            height: 95% !important;
            top: -15% !important;
            /*padding-bottom: 5% !important;*/
            flex-direction: column-reverse !important;
        }
        .pers_info_background{
            /*position: absolute;*/
            /*bottom: 0px;*/
            width: 450% !important;
            margin-left: -300% !important;
            /*height: 100%;*/
            opacity: 0.2 !important;
        }
        .coach_page_background{
            /*position: absolute;*/
            /*bottom: 0px;*/
            width: 450% !important;
            margin-left: -300% !important;
            /*height: 100%;*/
            opacity: 0.86 !important;
        }

        .pers_info_container > :nth-child(1) {
            height: 50% !important;
            margin-bottom: -10% !important;
            margin-top: 5% !important;
            width: 90% !important;
            /*background: red;*/
            overflow-y: scroll !important;
        }

        .pers_info_container > :nth-child(2) {
            height: 30% !important;
            width: 90% !important;
            /*background: red;*/
            margin: 0px !important;
            margin-left: 3% !important;
            /*background: red;*/
        }

        .info_title {
            /*background: red;*/
            margin-top: 10% !important;
            font-size: 25px !important;
            /*font-weight: 550;*/
            /*margin-top: -3% !important;*/
            /*background: red;*/
        }

        .info_text {
            /* background: blueviolet; */
            /*margin-top: 10%;*/
            /*color: #474747;*/
            /*font-weight: 400;*/
            padding-left: 5% !important;
            font-size: 18px !important;
        }

        .left_1 {
            background: #e8e8e8;
            background: white;
            background: #d9d8dd !important;
            position: absolute;
            height: 15% !important;
            top: 5% !important;
            left: 7% !important;
            width: 90% !important;
            border-radius: 5px !important;
            font-size: 0;
            z-index: 2;
        }

        .left_1_font {
            font-size: 10px !important;
            font-weight: 800;
            color: #8d8d8d;
        }

        .div_yek_sevvom {
            overflow: hidden;
            position: relative;
            /* display: inline-block; */
            /*border-radius: 10px !important;*/
            height: 100%;
            width: 100%;
            cursor: pointer;
            /* background: white; */
        }

        /* .div_yek_sevvom:hover{
            background: #c9c8b5;
        } */
        .yellow_background {
            background: #eec558;
            background-image: linear-gradient(180deg, #f3c850 0%, #f6d272 100%);
            box-shadow: 0px 0px 10px;
            height: calc(100% + 16px) !important;
            border-radius: 10px !important;
            margin-top: -8px !important;
            color: white;
            padding-bottom: 5%;
        }

        .yellow_background:hover {
            background: #f4d459;

        }

        .tunel_options {
            position: absolute;
            height: 30%;
            bottom: 0px;
            width: 100%;
            background: rgb(180, 190, 30);
            background: #eec558;
        }
        .tunel_options > div {
            height: 100%;
            width: 100%;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 4px !important;
            font-weight: 200;
        }

        .tunel_options :nth-child(2) {
            border-left: 1px solid #ffefc1;
            border-right: 1px solid #ffefc1;
        }

        .tunel_selected {
            background: rgb(185, 72, 72);
        }

        .pers_info_container > div > img {
            /*margin-top: 5% !important;*/
        }

        .coach_2 > :nth-child(2) {
            height: 65%;
            width: 80% !important;
        }

        .coach_2 > :nth-child(1)
        {
            margin-top: 5% !important;
            /*font-family: entezar;*/
            font-size: 50px !important;
            /*font-weight: 500;*/
            /*color: red;*/
            /*color: #ae5042;*/
            /*height: 20%;*/
            /*display: flex;*/
            /*justify-content: center;*/
            /*align-items: center;*/
        }
        .coach_2_container{
            margin-top: 10% !important;
        }
        .coach_2_contents > :nth-child(1){
            font-size: 20px !important;
        }
        .coach_2_contents > :nth-child(1) >:nth-child(1){
            margin-right: 1%;
        }
        .coach_img{
            height: 100% !important;
            /*width: auto;*/
        }

        .coach_2_contents > :nth-child(2){
            font-size: 12px !important;
            /*font-weight: 300;*/
        }

        .coach_jobs > div{
            height: 40px !important;
            width: 40px !important;
        }
        .coach_jobs > div > img{
            height: 100%;
            width: 100%;
            border-radius: 10px;
        }


        .coach_2_contents > :nth-child(3){
            font-size: 12px !important;
            /*font-weight: 300;*/
        }
        .job_titles > div{
            font-size: 10px !important;
            font-weight: 200;
            height: 30px !important;
            width: 60px !important;
        }
        .job_titles > div:nth-child(3n+1){
            background: #943df7;
        }
        .job_titles > div:nth-child(3n+0){
            background: #61cddf;
        }
        .job_titles > div:nth-child(3n+2){
            background: #e3d737;
        }

        .coach_2_contents > :nth-child(4){
            font-size: 12px !important;
            /*font-weight: 300;*/
        }
        .button_1 {
            visibility: hidden !important;
        }
        .button_2 {
            visibility: hidden !important;
        }
        .button_3 {
            visibility: hidden !important;
        }
        .job_titles > :nth-child(3){
            visibility: hidden !important;
        }
        .job_titles > :nth-child(4){
            visibility: hidden !important;
        }
        .coach_jobs > :nth-child(4) {
            visibility: hidden !important;
        }
    }

    .img-circle{
        border-radius: 50%;
    }

    ::-webkit-scrollbar {
        width: 10px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
        background: rgba(127,127,127,0.00);
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 10px;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {

        background-color: #BD2E57;
        border: 1px solid rgb(255, 255, 255);
        border-radius: 10px;
    }
    .notZoom {
        transition: transform .2s; /* Animation */
    }

    .zoom {
        transform: scale(1.05); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
        transition: transform .3s;
        border: 0px !important;
    }

    @font-face {
        font-family: "yekan";
        src: url('../../fonts/b-yekan.ttf') format('truetype');
    }

    @font-face {
        font-family: "ghasem";
        src: url('../../fonts/AGhasem.ttf') format('truetype');
    }

    @font-face {
        font-family: "entezar";
        src: url('../../fonts/ent.ttf') format('truetype');
    }

    *:focus {
        outline: none;
    }

    .img_fill_div {
        height: 100%;
        width: 100%;
    }

    /* [aos="example-anim3"] {
        transform: rotate(360deg);
        opacity: 0.5;
        transition-property: transform, opacity;
        &.aos-animate {
          transform: rotate(0);
          opacity: 1;
        }
        transform: rotate(360deg);
        opacity: 0;
        transition-property: transform, opacity;
        &.aos-animate {
          transform: rotate(0);
          opacity: 1;
        }
      }
     */

    .my_container {
        position: absolute;
        left: 0;
        height: 100vh;
        width: 100%;;
        /*overflow-x: hidden;*/
        /*overflow-y: auto;*/
        /*scroll-snap-points-y: repeat(100%);*/
        /*scroll-snap-type: mandatory;*/
        font-size: 0;
    }

    .login{
        position: relative;
        background: #391c4e;
        padding: 4px;
        padding-right: 0px;
        width: 100%;
        height: 100vh;
        font-family:"yekan";
        overflow-x: hidden;
        overflow-y: hidden;
    }


    .login > img{
        /* background-repeat: 5% 5%; */
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0px;
        left: 0px;
        opacity: 0.5;
    }

    .fill_div{
        height: 100%;
        width: 100%;
    }

    /* /////////// */

    #menuToggle
    {
        display: block;
        position: relative;
        top: 50px;
        left: 50px;

        z-index: 1;

        -webkit-user-select: none;
        user-select: none;
    }

    #menuToggle input
    {
        display: block;
        width: 40px;
        height: 32px;
        position: absolute;
        top: -7px;
        left: -5px;

        cursor: pointer;

        opacity: 0;
        z-index: 2;

        -webkit-touch-callout: none;
    }

    #menuToggle span
    {
        display: block;
        width: 33px;
        height: 4px;
        margin-bottom: 5px;
        position: relative;

        background: #cdcdcd;
        background: white;
        border-radius: 3px;

        z-index: 1;

        transform-origin: 4px 0px;

        transition: transform 0.5s cubic-bezier(0.77,0.2,0.05,1.0),
        background 0.5s cubic-bezier(0.77,0.2,0.05,1.0),
        opacity 0.55s ease;
    }

    #menuToggle span:first-child
    {
        transform-origin: 0% 0%;
    }

    #menuToggle span:nth-last-child(2)
    {
        transform-origin: 0% 100%;
    }

    #menuToggle input:checked ~ span
    {
        opacity: 1;
        transform: rotate(45deg) translate(-2px, -1px);
        background: #232323;
        background: white;
        /*background: red;*/
    }

    #menuToggle input:checked ~ span:nth-last-child(3)
    {
        opacity: 0;
        transform: rotate(0deg) scale(0.2, 0.2);
    }

    #menuToggle input:checked ~ span:nth-last-child(2)
    {
        transform: rotate(-45deg) translate(0, -1px);
    }

    #menu
    {
        position: absolute;
        /* width: 300px; */
        margin: -100px 0 0 -50px;
        padding: 50px;
        padding-left: 100px;
        padding-top: 67px;
        /* margin-top: -10px; */
        /* background: #ededed; */
        list-style-type: none;
        -webkit-font-smoothing: antialiased;
        /* to stop flickering of text in safari */

        transform-origin: 0% 0%;
        transform: translate(-100%, 0);

        transition: transform 0.5s cubic-bezier(0.77,0.2,0.05,1.0);
    }

    #menu div
    {
        display: inline;
        padding: 10px 10px;
        margin: 20px;
        font-size: 22px;
        color: white;
        cursor: pointer;
    }


    #menuToggle input:checked ~ div
    {
        transform: none;
    }
    /* /////// */




    .login_container{
        position: absolute;
        top: 0px;
        right: 10%;
        width: 32%;
        height: 85%;
        background: white;
        /* background-image: linear-gradient(180deg, #ffffff 0%, rgba(255, 255, 255, 0) 100%); */
        border-bottom-left-radius: 7%;
        border-bottom-right-radius: 7%;
        overflow: hidden;
    }

    .login_container > img{
        position: absolute;
        bottom: 0px;
        width: 100%;
        height: 50%;
        opacity: 0.2;
        -webkit-mask-image: -webkit-gradient(linear, left bottom,
        left top, from(rgba(0,0,0,1)), to(rgba(0,0,0,0)));
    }
    .login_container > div{
        height: 100%;
        width: 100%;
        display: grid;
        grid-template-rows: 40% 40% 20%;
        display: flex;
        flex-direction: column;
        /* position: relative; */
    }
    .login_container > div > :nth-child(1)
    {
         /*background: cyan;*/
        height: 40%;
    }
    .login_container > div > :nth-child(2){
        height: 40%;
        padding: 0px 3%;
        /* background: greenyellow; */
    }
    .login_container > div > :nth-child(3){
        height: 20%;
        padding: 0px 6%;
        /* position: relative; */
        /* background: red; */
        left: 0px;
        top: 0px;
        position: relative;
    }
    .login_effect{
        position: absolute;
        z-index: 5;
        height: 70% !important;
        width: 90% !important;
        left: 5%;
        top: 0px;
        background: white;
        opacity: 0.5;
        border-radius: 15px;
        border: 0px !important;
    }

    .login_container > div > :nth-child(1)
    {
        font-family: ghasem;
        color: black;
        font-size: 60px;
        font-weight: 800;
        /* background: red; */
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    .login_container > div > :nth-child(1) > :nth-child(1){
        background: linear-gradient(to right,#b247a5,
        rgb(248, 92, 118),rgb(248, 92, 118),
        rgb(248, 92, 118), rgb(236, 214, 14));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .login_container > div > :nth-child(1) > :nth-child(2){
        font-family: yekan;
        font-size: 40px;
        font-weight: 400;
        color: #a229b2;
        /* color: red; */
    }

    .login_container > div > :nth-child(2)
    {
        color: #923d9f;
        /* color: red; */
        width: 80%;
        margin-left: auto;
        margin-right: auto;
        direction: rtl;
        z-index: 1;
        /* background: red; */

    }

    .vorud
    {
        position: relative;
        /* background: yellow; */
        margin-right: 5%;
        margin-bottom: 5%;
        text-align: right;
        font-size: 18px;
        font-weight: 300;
    }
    .back_pos{
        /* background: pink; */
        position: absolute;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        left: 5%;
        top: 0px;
        cursor: pointer;
    }

    .flex_x{
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        white-space: nowrap;
        font-size: 0px;
        /* overflow: scroll; */
    }
    .hide{
        visibility: hidden;
    }

    .student
    {
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 22px;
        font-weight: 500;
        width: 100%;
        height: 30%;
        border: 3px solid #923d9f;
        margin-top: 3%;
        cursor: pointer;
        z-index: 1;
        /* visibility: hidden; */
    }
    .other
    {
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 22px;
        font-weight: 500;
        width: 100%;
        cursor: pointer;
        height: 30%;
        border: 3px solid #923d9f;
        margin-top: 3%;
        z-index: 1;
        /* visibility: hidden; */
    }
    .active_login{
        font-size: 26px;
        color: #923d9f;
        font-weight: 500;
        border-bottom: 6px solid #923d9f !important;
        margin-top: 1px;
    }
    .login_container > div > :nth-child(3)
    {
        width: 100%;
        /* height: 100%; */
        /* background: cyan; */
        width: 90%;
        margin-left: auto;
        margin-right: auto;
        font-size: 19px;
        color: #424242;
        font-weight: 400;
        display: grid;
        grid-template-columns: 33% 34% 33%;
        display: flex;
        flex-direction: row;
    }
    .login_container > div > :nth-child(3) > :nth-child(1)
    {
        width: 33%;
    }
    .login_container > div > :nth-child(3) > :nth-child(2)
    {
        width: 34%;
        color: rgb(39, 0, 39) !important;
    }
    .login_container > div > :nth-child(3) > :nth-child(3)
    {
        width: 33%;
    }
    .login_container > div > :nth-child(3) > div{
        z-index: 1;
        height: 50%;
        /* width: 100%; */
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 2%;
        border-bottom: 4px solid #aaaaaa;
        cursor: pointer;
    }
    .uni_login{
        height: 75%;
        width: 100%;
        padding-top: 5%;
        /* background: cyan; */
        display: flex;
        flex-direction: row-reverse;
        justify-content: space-around;
        cursor: pointer;
    }
    .uni_login > :nth-child(1){
        height: 80%;
        width: 30%;
        border: 3px solid #923d9f;
        padding: 10%;
        /* padding: 5%; */
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        font-size: 40px;
    }
    .login_logo{
        width: 80%;
        height: auto;
    }
    .uni_login > :nth-child(2){
        height: 80%;
        width: 30%;
        color: #07357a;
        border: 3px solid #923d9f;
        padding: 2%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        font-size: 13px;
        font-weight: 300;
    }
    .uni_login > :nth-child(3){
        height: 80%;
        width: 30%;
        border: 3px solid #923d9f;
        padding: 2%;    display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        font-size: 13px;
        font-weight: 300;
        color: #0baedd;
    }

    .login_info{
        position: absolute;
         /*background: cyan !important;*/
        width: 50%;
        height: 60vh;
        left: 0px;
        bottom: 0px;
        padding-left: 10%;
        /* display: grid !important; */
        /* display: -ms-grid; */
        display: grid;
        grid-template-rows: 20% 80%;
        /* -ms-grid-columns: 20% 80%; */
        display: flex;
        flex-direction: column;
        z-index: 1;
    }
    .login_info > :nth-child(1)
    {
        /* background: blue; */
        width: 100%;
        height: 100%;
        height: 25%;
        display: flex;
        flex-direction: row;
        justify-content: flex-end;
        align-items: center;
    }
    .login_info > :nth-child(1) >img{
        height: 100%;
        width: auto;
    }
    .login_info > :nth-child(1) > div{
        margin-right: 2%;
        color: white;
        font-size: 30px;
        font-weight: 500;
    }
    .login_info > :nth-child(2){
        /* width: 80%; */
        height: 80%;
        padding-top: 6%;
        color: white;
        font-size: 23px;
        font-weight: 200;
        direction: rtl;
        margin-right: 2.5%;
    }

    .hover_page{
        overflow: hidden;
        position: relative;
        width: 100%;
        height: 100vh;
        font-family:"yekan";
        display: grid;
        grid-template-columns: 30% 70%;
        display: flex;
        flex-direction: row;
    }
    .hover_page_background{
        position: absolute;
        bottom: 0px;
        width: 100%;
        height: 100%;
        margin-left: 10%;
        opacity: 0.3;
        transform: scale(1.3);
        /* scale(6.2); */
        /* -webkit-mask-image: -webkit-gradient(linear, left bottom,
        left top, from(rgba(0,0,0,1)), to(rgba(0,0,0,0))); */
    }

    .hover_right{
        height: 100%;
        width: 70%;
        /* background: pink; */
        display: grid;
        grid-template-rows: 25% 75%;
        display: flex;
        flex-direction: column;
        padding: 0px 10%;
    }
    .hover_right > :nth-child(1)
    {
        height: 30%;
    }
    .hover_right > :nth-child(2)
    {
        height: 70%;
    }

    .hover_right_header{
        /* height: 100%; */
        width: 100%;
        /* background: cyan; */
        color: #a140a9;
        /* color: black; */
        z-index: 1;
        display: flex;
        flex-direction: row;
        justify-content: flex-end;
        align-items: center;
    }
    .hover_right_header > img{
        height: 60%;
        width: auto;
    }
    .hover_right_header > div{
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        direction: rtl;
        margin-right: 5%;
        /* color: #923d9f; */
    }

    .hover_right_text > br{
        margin-bottom: 0.5%;
    }

    .hover_right_text{
        margin-top: -5%;
        height: 100%;
        width: 100%;
        /* background: pink; */
        direction: rtl;
        z-index: 1;
        overflow-y: scroll;
        padding-bottom: 0px;
        padding: 3% 0px;
        padding-left: 8%;
        padding-right: 10%;
        /* padding-bottom: 5%; */
        /* color: rgb(44, 44, 44); */
        font-weight: 300;
        font-size: 25px;
        color: #575757;
        display: flex;
        flex-direction: column;
        justify-content: center;
        /* background: red; */

        /* overflow: hidden; */
        /* box-sizing: border-box; */
        max-height: 100%;
        /* cursor: pointer; */
    }

    .big_title{
        /* height: 100%; */
        /* width: 100%; */
        /* display: flex; */
        /* background: red; */
        /* justify-content: center; */
        font-size: 50px;
        font-weight: 500;
    }
    .big_title > :nth-child(2){
        margin-top: -6%;
    }
    .big_title > :nth-child(1){
        margin-top: -6%;
    }


    .hover_left{
        font-family: "yekan";
        width: 100%;
        width: 30%;
        height: 100%;
        /* background: yellow; */
        padding-top: 10%;
        font-size: 40px;
        display: grid;
        grid-template-rows: 20% 60% 20%;
        display: flex;
        flex-direction: column;
        color: #923d9f;
        font-size: 25px;
        font-weight: 400;
        /* background: #0baedd; */
    }

    .hover_left > :nth-child(1)
    {
        height: 20%;
    }
    .hover_left > :nth-child(2)
    {
        margin-top: 2%;
        height: 58%;
    }
    .hover_left > :nth-child(3)
    {
        height: 20%;
    }

    .hover_left_row{
        z-index: 1;
        width: 100%;
        /* height: 100%; */
        display: grid;
        grid-template-columns: 65% 35%;
        display: flex;
        flex-direction: row;
        /* background: red; */
        /* margin-top: 20px; */
        /* box-sizing: border-box; */
    }
    .hover_left_row_rast_container{
        margin-top: 1%;
        box-sizing: border-box;
        height: 100%;
        width: 100%;
        /* background: yellow; */
        /* padding-left: 2%; */
        display: flex;
        position: relative;
    }
    .hover_left_row > :nth-child(1)
    {
        font-size: 54px;
        font-weight: 500;
        width: 100%;
        width: 65%;
        height: 100%;
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .hover_left_row > :nth-child(1) > :nth-child(1){
        /* margin-top: -5%; */
    }

    .hover_left_row > :nth-child(2)
    {
        /* background: yellow; */
        padding-left: 6% !important;
        width: 35%;
    }
    .left_row_2{
        /* background: blue; */
        width: 100%;
        height: 100%;
        position: relative;
        display: flex;
        align-items: flex-start !important;
    }

    .hover_left_row_nav{
        background: linear-gradient(to top,#b247a5,
        rgb(248, 92, 118),rgb(248, 92, 118),
        rgb(248, 92, 118), rgb(236, 214, 14));
        position: absolute;
        width: 12px;
        height: 100%;
        top: 0px;
        right: 0px;
        visibility: hidden;
        /* background: black; */
    }
    .item1tosiye{
        color: black;
        font-size: 26px;
        font-weight: 500;
        visibility: hidden;
    }
    .icons_div{
        padding: 20% !important;
    }

    .hover_left_row_rast > :nth-last-child(1){
        margin-bottom: -4px;
    }

    .hover_left_row_rast
    {
        padding: 5%;
        padding: 10px;
        padding: 10px;
        /* padding: 20%; */
        border-radius: 28px;
        overflow: hidden;
        height: 100%;
        width: 100%;
        /* width: 100%; */
        /* height: auto; */
        background: blue;
        background: white;
        box-shadow: 0px 0px 30px gray;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .hover_left_row_rast_2{
        display: flex;
        flex-direction: column;
        justify-content: space-around;
        align-items: center;
    }
    .with_border{
        padding: 5%;
        border: 1px solid #707070;
        border-radius: 28px;
        overflow: hidden;
    }
    .hover_icon{
        /* background: red; */
        width: 90%;
        /* height: 100%; */
        height: auto;
    }
    .hover_left_row_nav_2{
        background: linear-gradient(to top,#b247a5,
        rgb(248, 92, 118),rgb(248, 92, 118),
        rgb(248, 92, 118), rgb(236, 214, 14));
        position: absolute;
        width: 12px;
        height: 34%;
        top: 35%;
        right: 0px;
        /* background: blue; */
        visibility: hidden;
    }
    .hover_left_row_nav_3{
        background: linear-gradient(to top,#b247a5,
        rgb(248, 92, 118),rgb(248, 92, 118),
        rgb(248, 92, 118), rgb(236, 214, 14));
        position: absolute;
        width: 12px;
        height: 36%;
        top: 64%;
        right: 0px;
        /* background: red; */
        visibility: hidden;
    }

    .left_row_2_2{
        position: absolute;
        width: 100%;
        display: flex;
        justify-content: center;
        top: 35%;
        left: 0px;
        visibility: hidden;
    }
    .left_row_2_3{
        position: absolute;
        width: 100%;
        display: flex;
        justify-content: center;
        left: 0px;
        top: 70%;
        visibility: hidden;
    }
    .hover_down{
        background: #8e4615;
        border-top-left-radius: 28px;
        border-top-right-radius: 28px;
        cursor: pointer;
        overflow: hidden;
        width: 82.1%;
        position: absolute;
        top: 20%;
        height: 80%;
        /* width: 90%; */
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;
        padding: 20%;
        box-shadow: 0px 0px 30px gray;
    }

    .hover_down > img{
        /* height: 100%; */
        width: 90%;
        height: auto;
    }

    .active_hover{
        background: linear-gradient(to left bottom,#ff0080,
        #b1349c, rgb(236, 214, 14));
        border: 0px;
        /* padding: 0px; */
    }
    .vis_hover{
        visibility: visible;
    }

    .coach_page2
    {
        position: relative;
        width: 100%;
        height: 100vh;
        font-family:"yekan";
        /* background: blue; */
        background: linear-gradient(to right bottom,#dd9b45,
        rgb(154, 17, 161),rgb(154, 17, 161),
        rgb(154, 17, 161), rgb(224, 54, 196));
        background: linear-gradient(to right bottom,
        rgba(152, 95, 0, 0.99) 15%,
        #640935,#640935,
        #560043,#560043,
        rgba(58, 0, 34, 1)
        );
        overflow-x: hidden !important;
    }

    .coach_page
    {
        position: relative;
        width: 100%;
        height: 100vh;
        font-family:"yekan";
        /* background: blue; */
        background: linear-gradient(to right bottom,#dd9b45,
        rgb(154, 17, 161),rgb(154, 17, 161),
        rgb(154, 17, 161), rgb(224, 54, 196));
        background: linear-gradient(to right bottom,
        rgba(152, 95, 0, 0.99) 15%,
        #640935,#640935,
        #560043,#560043,
        rgba(58, 0, 34, 1)
        );
    }
    .coach_page_container{
        /* filter: blur(0px) !important;  */
        height: 100%;
        width: 100%;
        display: grid;
        grid-template-columns: 50% 50%;
        /* background-image: linear-gradient(180deg, rgba(0, 0, 0, 0) 0%, #000000 100%); */
        display: flex;
        flex-direction: row;
    }
    .coach_page_container > :nth-child(1)
    {
        /* background: #07357a; */
        width: 50%;
    }
    .coach_page_container > :nth-child(2)
    {
        width: 50%;
    }
    .coach_page_background{
        position: absolute;
        bottom: 0px;
        width: 100%;
        height: 100%;
        /* background-image: linear-gradient(180deg, rgba(0, 0, 0, 0) 0%, #000000 100%); */

        /* z-index: 2; */
        opacity: 1;
    }

    .circle_container{
        /* background: #0baedd; */
        padding: 3% 0px !important;
    }
    .coach_text_container{
        height: 100% !important;
        /* background: black; */
        padding: 0% 0px !important;
        text-align: right;
    }

    .coach_page_container > :nth-child(1){
        z-index: 1;
        display: flex;
        justify-content: center;
        padding: 5% 10%;
        height: 100%;
        /*width: 100%;*/
        /* background: red; */
    }
    .circ1{
        position: relative;
        height: 80vh;
        width: 80vh;
        /* width: auto; */
        /* height: 500px; */
        /* width: 560px; */
        /* background: cyan; */
        border-radius: 50%;
        box-shadow: 0px 0px 2px;
        background-image: linear-gradient(199deg, #ffaa00 0%, #67007d 100%);
    }
    .circ2{
        height: 85%;
        width: 85%;
        position: relative;
        left: 11%;
        top: 11%;
        background: red;
        border-radius: 50%;
        box-shadow: 0px 0px 2px;
        background-image: linear-gradient(-32deg, #f7bf77 0%, #a0404e 58%, #360042 100%);
    }
    .circ3{
        height: 85%;
        width: 85%;
        position: absolute;
        right: 6%;
        top: 12%;
        /* background: cyan; */
        border-radius: 50%;
        box-shadow: 0px 0px 2px;
        background-image: linear-gradient(to top, #a0404e, #220129);


    }
    .circ4{
        overflow: hidden;
        height: 93%;
        width: 93%;
        /* width: auto; */
        position: absolute;
        right: 0px;
        top: 0px;
        background: red;
        border-radius: 50%;
        box-shadow: 0px 0px 2px;

    }

    .coach_page_container > :nth-child(2){
        z-index: 1;
        display: flex;
        justify-content: center;
        /* padding: 0px 8%; */
        /* padding-top: 12%; */
        /* padding-bottom: 12%; */
        height: 80%;
        /*width: 100%;*/
        /* background: cyan; */
        overflow: hidden;
        /* box-sizing: border-box; */
        /* display: block; */
        /* margin-right: 8%; */
    }
    .coach_text{
        height: 90%;
        width: 90%;
        padding: 5%;

        margin-top: 5%;
        margin-left: auto;
        margin-right: auto;
        /* padding-bottom: 2%; */
        /* height: 80%; */
        /* margin-top: 4%; */
        padding-right: 15%;
        overflow-y: scroll;
        box-sizing: border-box;
        /* background: yellow; */

    }
    .coach_text > :nth-child(1){
        font-family: "entezar";
        font-size: 130px;
        font-weight: 500;
        direction: rtl;
        text-align: right;
        /* color: red; */
        color: #ae5042;
    }
    .coach_text > :nth-child(2){
        font-size: 22px;
        font-weight: 300;
        direction: rtl;
        /* background: cyan; */
        color: white;
    }


    .coach_2{
        height: 100%;
        width: 100%;
        /* background: cyan; */
        text-align: center;
        z-index: 1;
    }
    .coach_2 > :nth-child(1)
    {
        font-family: entezar;
        font-size: 80px;
        font-weight: 500;
        color: red;
        color: #ae5042;
        height: 20%;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .coach_2 > :nth-child(2)
    {
        z-index: 2;
        margin-top: 2%;
        height: 65%;
        width: 50%;
        margin-left: auto;
        margin-right: auto;
        /* opacity: 1; */
        /* background: cyan; */
    }
    .coach_2_container{
        position: relative;
        /* z-index: 5; */
        height: 100%;
        width: 100%;
        /* background: red; */
        /* filter: blur(1px); */
        background: linear-gradient(to bottom right, #935152, #692a5c);
        /* background: #d87fc655; */
        opacity: 0.9;
        padding: 30px;
        /* background-image: linear-gradient(180deg, #ffffff 0%, #ffffff 100%); */
        opacity: 0.9;
    }
    .coach_2_contents{
        /* position: relative; */
        z-index: 100;
        /* z-index: 5; */
        /*background: red;*/
        /* opacity: 1; */
        height: 100%;
        width: 100%;
        display: grid;
        grid-template-rows: 13% 27% 20% 40%;
        display: flex;
        flex-direction: column;
        position: relative;
    }
    .coach_2_contents > :nth-child(1){
        height: 13% !important;
    }
    .coach_2_contents > :nth-child(2){
        height: 27% !important;
    }
    .coach_2_contents > :nth-child(3){
        height: 20% !important;
    }
    .coach_2_contents > :nth-child(4){
        height: 40% !important;
    }
    .coach_2_contents > :nth-child(1){
        /* background: yellow; */
        border-bottom: 1px solid #707070;
        display: flex;
        flex-direction: row;
        color: white;
        height: 100%;
        width: 100%;
        justify-content: flex-end;
        align-items: center;
        padding-right:  3%;
        padding-top: .4%;
        padding-bottom: .4%;
        box-sizing: border-box;
        /* background-image: linear-gradient(180deg, #bababa 0%, #ffffff 100%); */
        background-image: linear-gradient(180deg, #bababa 0%, rgba(255, 255, 255, 0.81) 100%);
        color: black;
        font-size: 24px;
        font-weight: 400;
    }
    .coach_2_contents > :nth-child(1) >:nth-child(1){
        margin-right: 1%;
    }
    .coach_img{
        height: 100%;
        width: auto;
    }

    .coach_2_contents > :nth-child(2){
        border-bottom: 1px solid #707070;

        background: yellow;
        color: #838383;
        height: 100%;
        width: 100%;
        padding-right:  3%;
        padding-top: .4%;
        padding-bottom: .4%;
        box-sizing: border-box;
        /* background-image: linear-gradient(180deg, #bababa 0%, #ffffff 100%); */
        background-image: linear-gradient(180deg, #bababa 0%, rgba(255, 255, 255, 0.81) 100%);
        font-size: 16px;
        font-weight: 300;
        /* direction: rtl; */
        text-align: right;
        display: flex;
        flex-direction: column;
    }
    .coach_2_contents > :nth-child(2) >:nth-child(1){
        height: 30%;
    }
    .coach_jobs{
        height: 70%;
        width: 100%;
        /* background: yellow; */
        padding: 1% 5%;
        /* display: flex; */
        /* flex-direction: row; */
        /* justify-content: flex-start; */
        /* align-items: flex-start; */
        /* align-content: flex-end; */
    }
    .coach_jobs > div{
        /* background: yellow; */
        display: inline-block;
        height: 50px;
        width: 50px;
        margin-right: 3%;
        overflow: hidden;
    }
    .coach_jobs > div > img{
        height: 100%;
        width: 100%;
        border-radius: 10px;
    }


    .coach_2_contents > :nth-child(3){
        position: relative;
        border-bottom: 1px solid #707070;

        background: yellow;
        color: #838383;
        height: 100%;
        width: 100%;
        padding-right:  3%;
        padding-top: .4%;
        padding-bottom: .4%;
        box-sizing: border-box;
        /* background-image: linear-gradient(180deg, #bababa 0%, #ffffff 100%); */
        background-image: linear-gradient(180deg, #bababa 0%, rgba(255, 255, 255, 0.81) 100%);
        font-size: 16px;
        font-weight: 300;
        /* direction: rtl; */
        text-align: right;
        display: flex;
        flex-direction: column;
    }
    .coach_2_contents > :nth-child(3) >:nth-child(1){
        height: 30%;
    }

    .job_titles{
        height: 70%;
        width: 100%;
        /* background: yellow; */
        padding: 1% 5%;
    }
    .flex_y{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    .job_titles > div{
        color: white;
        font-size: 14px;
        font-weight: 200;
        display: inline-block;
        height: 40px;
        width: 80px;
        margin-right: 3%;
        overflow: hidden;
        border-radius: 20px;
        background: #575757;
    }
    .job_titles > div:nth-child(3n+1){
        background: #943df7;
    }
    .job_titles > div:nth-child(3n+0){
        background: #61cddf;
    }
    .job_titles > div:nth-child(3n+2){
        background: #e3d737;
    }

    .coach_2_contents > :nth-child(4){
        background: yellow;
        color: #838383;
        height: 100%;
        border-bottom: 1px solid #707070;

        width: 100%;
        padding-right:  3%;
        padding-top: .4%;
        /* padding-bottom: .4%; */
        box-sizing: border-box;
        /* background-image: linear-gradient(180deg, #bababa 0%, #ffffff 100%); */
        background-image: linear-gradient(180deg, #bababa 0%, rgba(255, 255, 255, 0.81) 100%);
        font-size: 16px;
        font-weight: 300;
        /* direction: rtl; */
        text-align: right;
        display: flex;
        flex-direction: column;
    }
    .coach_2_contents > :nth-child(4) >:nth-child(1){
        height: 15%;
    }

    .week_plan{
        position: relative;
        bottom: 0px;
        height: 85%;
        width: 90%;
        left: 7%;
        /* background: yellow; */
        /* padding: 1% 5%; */
        /* background: cyan; */
    }

    .button_1{
        z-index: 20;
        font-size: 40px;
        color: #3f053c;
        color: #3f053c;
        border: 4px solid #3f053c;
        background: linear-gradient(to right, #0e030c, #e49ed9);
        background: #d6acc7;
        width: 30px;
        height: 30px;
        /* background: blue; */
        border-radius: 50%;
        position: absolute;
        top: calc(13% - 15px);
        right: -15px;
        cursor: pointer;
    }
    .button_2{
        z-index: 20;
        font-size: 40px;
        color: #3f053c;
        border: 4px solid #3f053c;
        background: linear-gradient(to right, #d6aacf, #be72b1);
        width: 30px;
        height: 30px;
        /* background: blue; */
        border-radius: 50%;
        position: absolute;
        top: calc(40% - 15px);
        left: -15px;
        cursor: pointer;
    }
    .button_3{
        z-index: 20;
        font-size: 40px;
        color: #3f053c;
        border: 4px solid #3f053c;
        background: linear-gradient(to right, #d6aacf, #be72b1);

        width: 30px;
        height: 30px;
        border-radius: 50%;
        position: absolute;
        top: calc(60% - 15px);
        left: -15px;
        cursor: pointer;
    }
    .popover{
        width: 40% !important; /* Max Width of the popover (depending on the container!) */
        background: #b516ad;
        opacity: 1;
        color: white;
        /* z-index: 1; */
        padding: 3%;
        direction: rtl;
        border-radius: 15px;
        background: #d87fc655;
        opacity: 0.8;
    }
    .popover.right .arrow:after {
        border-right-color:#d87fc655;
    }
    .popover.left .arrow:after {
        border-left-color:#d87fc655;
    }

    .button_sign{
        position: relative;
        top: 0px;
        left: 0px;
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 50%;
    }
    .active_div{
        /* margin-top: -10%; */
        height: 120% !important;
        width: 106% !important;
        margin-left: -3% !important;
        /* margin-right: auto !important; */
        border: 2px solid gray !important;
        z-index: 10;
    }
    .move_1{
        top: calc(11.9% - 15px);
        /* right: calc(-10% -15px) !important; */
        right: calc(-3% - 15px) !important;
    }
    .move_2{
        top: calc(38% - 15px);
        /* right: calc(-10% -15px) !important; */
        left: calc(-3% - 15px) !important;
    }
    .move_3{
        top: calc(58% - 15px);
        /* right: calc(-10% -15px) !important; */
        left: calc(-3% - 15px) !important;
    }
    .pers_info
    {
        position: relative;
        width: 100%;
        height: 100vh;
        font-family:"yekan";
    }
    .pers_info_background{
        position: absolute;
        bottom: 0px;
        width: 100%;
        height: 100%;
        opacity: 0.36;
    }
    .pers_info_container{
        position: relative;
        width: 95%;
        left: 5%;
        height: 70%;
        top: 15%;
        /* background: white; */
        /* opacity: 0.7; */
        display: flex;
        flex-direction: row;
    }
    .pers_info_container > :nth-child(1)
    {
        height: 100%;
        width: 40%;
        /* background: cyan; */
        direction: rtl;
    }
    .pers_info_container > :nth-child(2)
    {
        height: 100%;
        width: 60%;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 30px;
        /* border: 1px solid gray; */
    }
    .info_title{
        color: black;
        font-size: 40px;
        font-weight: 550;
        /* background: red; */
    }
    .info_text{
        /* background: blueviolet; */
        margin-top: 10%;
        color: #474747;
        font-weight: 400;
        font-size: 25px;
    }
    .centered_text_div {
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        align-content: center;
    }

    .left_1 {
        background: #e8e8e8;
        background: white;
        position: absolute;
        height: 10%;
        top: 8%;
        left: 15%;
        width: 70%;
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

    .left_1_font {
        font-size: 27px;
        font-weight: 800;
        color: #8d8d8d;
    }

    .div_yek_sevvom {
        overflow: hidden;
        position: relative;
        /* display: inline-block; */
        border-radius: 15px;
        height: 100%;
        width: 100%;
        cursor: pointer;
        /* background: white; */
    }

    /* .div_yek_sevvom:hover{
        background: #c9c8b5;
    } */
    .yellow_background {
        background: #eec558;
        background-image: linear-gradient(180deg, #f3c850 0%, #f6d272 100%);
        box-shadow: 0px 0px 10px;
        height: calc(100% + 40px);
        border-radius: 30px;
        margin-top: -20px;
        color: white;
        padding-bottom: 5%;
    }

    .yellow_background:hover {
        background: #f4d459;

    }


    .tunel_options{
        position: absolute;
        height: 30%;
        bottom: 0px;
        width: 100%;
        background: rgb(180, 190, 30);
        background: #eec558;
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
        width: 100%;
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 8px;
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

    .left_2 {
        width: 100%;
        margin-top: 3%;
        height: 84%;
        /* background: cyan; */
        padding: 2%;
        max-height: 84%;
    }

    .left_2 > img {
        height: 100%;
        width: 100%;
    }
</style>
