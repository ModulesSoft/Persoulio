<?php

use Illuminate\Support\Facades\Route;


Route::get('pay/{forWhat}/{additionalId}/{offCode?}', ['as' => 'pay', 'uses' => 'CheckoutConfirmOrderController@doPayment']);

Route::any('callback',function(){
    try {
//        $gateway = \Gateway::verify();
//        $trackingCode = $gateway->trackingCode();
//        $refId = $gateway->refId();
//        $cardNumber = $gateway->cardNumber();
// عملیات خرید با موفقیت انجام شده است
// در اینجا کالا درخواستی را به کاربر ارائه میکنم

        $t = \App\models\Transaction::whereRefId($_POST["RefId"])->first();

        if($t != null) {

            include_once __DIR__ . '/../app/Http/Controllers/Common.php';

            $user = \Illuminate\Support\Facades\Auth::user();

            switch ($t->forWhat) {

                case getValueInfo('chargeTransaction'):
                    $user->money += $t->price;
                    $user->save();
                    break;
                case getValueInfo('eventTransaction'):
                    $eventRegistry = new \App\models\EventRegistry();
                    $eventRegistry->uId = \Illuminate\Support\Facades\Auth::user()->id;
                    $eventRegistry->eventId = $t->additionalId;

                    $event = \App\models\Event::whereId($t->additionalId);
                    $price = floor($event->price * (100 - $event->off) / 100);
                    try {
                        $eventRegistry->save();
                        $message = new \App\models\MessageBox();
                        if($event->mode != getValueInfo('mag'))
                            $message->message = "کاربر گرامی ثبت نام شما در رویداد " . $event->name . ' با موفقیت انجام پذیرفت';
                        else
                            $message->message = "کاربر گرامی خرید مجله " . $event->name . ' شما با موفقیت انجام پذیرفت';
                        $message->uId = $user->id;
                        $message->sdate = getToday()["date"];
                        $message->save();
                    }
                    catch (\Exception $x) {}
                    break;
                case getValueInfo('quizTransaction'):
                    $quizRegistry = new \App\models\QuizRegistry();
                    $quizRegistry->uId = \Illuminate\Support\Facades\Auth::user()->id;
                    $quizRegistry->quizId = $t->additionalId;
                    $quiz = \App\models\Quiz::whereId($t->additionalId);
                    $price = floor($quiz->price * (100 - $quiz->off) / 100);
                    try {
                        $quizRegistry->save();

                        $message = new \App\models\MessageBox();
                        $message->message = "کاربر گرامی ثبت نام شما در آزمون " . $quiz->name . ' با موفقیت انجام پذیرفت';
                        $message->uId = $user->id;
                        $message->sdate = getToday()["date"];
                        $message->save();

                    }
                    catch (\Exception $x) {}
                    break;
            }

            if(!empty($t->offCode)) {
                if(checkOffCodeValidation($t->offCode)) {
                    $code = \App\models\Offer::whereCode($t->offCode)->first();
                    if($code->offerKind == getValueInfo('staticOffer'))
                        $price -= $code->amount;
                    else
                        $price -= floor(100 - $code->amount / 100);

                    $code->delete();
                }
            }
            
            if($t->forWhat != getValueInfo('chargeTransaction')) {
                $user->money -= $price;
                if($user->money < 0)
                    $user->money = 0;
                $user->save();
            }

            $t->status = "SUCCEED";
            $t->save();

            echo "ok";
            return;
        }

        echo "nok1";

    } catch (Exception $e) {
        echo "nok2 " . $e->getMessage();
    }
})->name('callback');

Route::post('mellatPage', function() {
    return view('mellatPage');
})->name('mellatPage');
Route::get('/dashboard', 'HomeController@home')->name("dashboard");
Route::get('/fun/article{id}', 'HomeController@home');
Route::get('/tunnel/article{id}', 'HomeController@home');
Route::get('/fun', 'HomeController@home');
Route::get('/portfolio', 'HomeController@home');
Route::group(['middleware' => 'auth'], function () {
    Route::get('/laravel-filemanager', '\UniSharp\LaravelFilemanager\Controllers\LfmController@show');
    Route::post('/laravel-filemanager/upload', '\UniSharp\LaravelFilemanager\Controllers\UploadController@upload');
    // list all lfm routes here...
});

Route::group(array('middleware' => ['throttle:30', 'auth', 'adminLevel']), function (){

    Route::get('requirement', ['as' => 'requirement', 'uses' => 'RequirementController@requirement']);

    Route::post('doAddRequirement', ['as' => 'doAddRequirement', 'uses' => 'RequirementController@doAddRequirement']);

    Route::post('deleteRequirement', ['as' => 'deleteRequirement', 'uses' => 'RequirementController@deleteRequirement']);

    Route::post('getEventsName', ['as' => 'getEventsName', 'uses' => 'EventController@getEventsName']);

    Route::post('getQuizesName', ['as' => 'getQuizesName', 'uses' => 'QuizController@getQuizesName']);

    Route::get('createOffer', ['as' => 'createOffer', 'uses' => 'AdminController@createOffer']);

    Route::post('doCreateOffer', ['as' => 'doCreateOffer', 'uses' => 'AdminController@doCreateOffer']);

    Route::get('createOfferOnEvent', ['as' => 'createOfferOnEvent', 'uses' => 'AdminController@createOfferOnEvent']);

    Route::post('doCreateOfferOnEvent', ['as' => 'doCreateOfferOnEvent', 'uses' => 'AdminController@doCreateOfferOnEvent']);
        
    Route::get('tips', ['as' => 'tips', 'uses' => 'TipController@tips']);

    Route::get('addTip', ['as' => 'addTip', 'uses' => 'TipController@addTip']);

    Route::get('editTip/{tipId}', ['as' => 'editTip', 'uses' => 'TipController@editTip']);
    
    Route::post('doEditTip', ['as' => 'doEditTip', 'uses' => 'TipController@doEditTip']);
    
    Route::post('doAddTip', ['as' => 'doAddTip', 'uses' => 'TipController@doAddTip']);

    Route::get('showTipDetail/{tipId}', ['as' => 'showTipDetail', 'uses' => 'TipController@showTipDetail']);

    Route::post('deleteTip', ['as' => 'deleteTip', 'uses' => 'TipController@deleteTip']);

    Route::post('toggleUserStatus', ['as' => 'toggleUserStatus', 'uses' => 'AdminController@toggleUserStatus']);
    
    Route::post('doAdviserRegister', array('as' => 'doAdviserRegister', 'uses' => 'RegisterController@doAdviserRegister'));

    Route::get('certifier', ['as' => 'certifier', 'uses' => 'CertifierController@certifier']);

    Route::get('advisers', ['as' => 'advisers', 'uses' => 'AdviserController@advisers']);

    Route::post('doCertifierRegister', array('as' => 'doCertifierRegister', 'uses' => 'RegisterController@doCertifierRegister'));

    Route::post('doUploadNotifSentences', ['as' => 'doUploadNotifSentences', 'uses' => 'SentenceController@doUploadNotifSentences']);

    Route::get('daySentences', ['as' => 'daySentences', 'uses' => 'SentenceController@daySentences']);

    Route::post('deleteNotifSentence', ['as' => 'deleteNotifSentence', 'uses' => 'SentenceController@deleteNotifSentence']);

    Route::post('deleteEvent', array('as' => 'deleteEvent', 'uses' => 'EventController@deleteEvent'));

    Route::post('deleteEvent', array('as' => 'deleteEvent', 'uses' => 'EventController@deleteEvent'));

    Route::post('addEvent', array('as' => 'addEvent', 'uses' => 'EventController@addEvent'));

    Route::get('manageEvents', array('as' => 'manageEvents', 'uses' => 'EventController@manageEvents'));

    Route::get('events/{tagId}', array('as' => 'events', 'uses' => 'EventController@events'));

    Route::post('reLaunchContent', ['as' => 'reLaunchContent', 'uses' => 'EventController@reLaunchContent']);
    
    Route::post('togglePublish', ['as' => 'togglePublish', 'uses' => 'EventController@togglePublish']);
    
    Route::post('getEventDates', ['as' => 'getEventDates', 'uses' => 'EventController@getEventDates']);

    Route::post('removeDate', ['as' => 'removeDate', 'uses' => 'EventController@removeDate']);

    Route::post('addDate', ['as' => 'addDate', 'uses' => 'EventController@addDate']);

    Route::post('getTipsAndLikes', ['as' => 'getTipsAndLikes', 'uses' => 'EventController@getTipsAndLikes']);

    Route::post('editEvent', array('as' => 'editEvent', 'uses' => 'EventController@doEditEvent'));

    Route::post('removeImage', ['as' => 'removeImage', 'uses' => 'EventController@removeImage']);

    Route::post('addImage/{id}', ['as' => 'addImage', 'uses' => 'EventController@addImage']);

    Route::get('manageTags', ['as' => 'manageTags', 'uses' => 'AdminController@manageTags']);

    Route::post('getTags', ['as' => 'getTags', 'uses' => 'AdminController@getTags']);

    Route::post('addTag', ['as' => 'addTag', 'uses' => 'AdminController@addTag']);

    Route::post('deleteTag', ['as' => 'deleteTag', 'uses' => 'AdminController@deleteTag']);

    Route::post('editTag', ['as' => 'editTag', 'uses' => 'AdminController@editTag']);

    Route::get('manageSurveys', ['as' => 'manageSurveys', 'uses' => 'SurveyController@manageSurveys']);

    Route::post('getSurveyQuestions', ['as' => 'getSurveyQuestions', 'uses' => 'SurveyController@getSurveyQuestions']);

    Route::post('addSurveyQuestion', ['as' => 'addSurveyQuestion', 'uses' => 'SurveyController@addSurveyQuestion']);

    Route::post('deleteSurveyQuestion', ['as' => 'deleteSurveyQuestion', 'uses' => 'SurveyController@deleteSurveyQuestion']);

    Route::post('editSurveyQuestion', ['as' => 'editSurveyQuestion', 'uses' => 'SurveyController@editSurveyQuestion']);

    Route::post('setOpinion', ['as' => 'setOpinion', 'uses' => 'SurveyController@setOpinion']);


    Route::post('getComments', array('as' => 'getComments', 'uses' => 'CommentController@getComments'));

    Route::post('setStatusComment', array('as' => 'setStatusComment', 'uses' => 'CommentController@setStatusComment'));

    Route::post('deleteComment', array('as' => 'deleteComment', 'uses' => 'CommentController@deleteComment'));


    Route::get('quizes', ['as' => 'quizes', 'uses' => 'QuizController@quizes']);

    Route::post('addQuiz', ['as' => 'addQuiz', 'uses' => 'QuizController@addQuiz']);

    Route::post('editQuiz', ['as' => 'editQuiz', 'uses' => 'QuizController@editQuiz']);
    
    Route::post('deleteQuiz', ['as' => 'deleteQuiz', 'uses' => 'QuizController@deleteQuiz']);

    Route::post('addQuizExcel/{quizId}', ['as' => 'addQuizExcel', 'uses' => 'QuizController@addQuizExcel']);

    Route::get('quizOverView/{quizId}', ['as' => 'quizOverView', 'uses' => 'QuizController@quizOverView']);

    Route::post('deleteQOQ', ['as' => 'deleteQOQ', 'uses' => 'QuizController@deleteQOQ']);
    
    Route::get('factors', ['as' => 'factors', 'uses' => 'AdminController@factors']);

    Route::post('addFactor', ['as' => 'addFactor', 'uses' => 'AdminController@addFactor']);

    Route::post('deleteFactor', ['as' => 'deleteFactor', 'uses' => 'AdminController@deleteFactor']);

    Route::post('editFactor', ['as' => 'editFactor', 'uses' => 'AdminController@editFactor']);

    Route::get('adviserFields', ['as' => 'adviserFields', 'uses' => 'AdviserController@adviserFields']);
    
    Route::post('removeAdviserField', ['as' => 'removeAdviserField', 'uses' => 'AdviserController@removeAdviserField']);

    Route::post('editAdviserField', ['as' => 'editAdviserField', 'uses' => 'AdviserController@editAdviserField']);
    
    Route::post('createAdviserFields', ['as' => 'createAdviserFields', 'uses' => 'AdviserController@createAdviserFields']);

    Route::get('adviserSpecs', ['as' => 'adviserSpecs', 'uses' => 'AdviserController@adviserSpecs']);

    Route::post('createAdviserSpecs', ['as' => 'createAdviserSpecs', 'uses' => 'AdviserController@createAdviserSpecs']);

    Route::post('removeAdviserSpec', ['as' => 'removeAdviserSpec', 'uses' => 'AdviserController@removeAdviserSpec']);

    Route::post('editAdviserSpec', ['as' => 'editAdviserSpec', 'uses' => 'AdviserController@editAdviserSpec']);

    Route::post('setAdviserPic', ['as' => 'setAdviserPic', 'uses' => 'AdviserController@setAdviserPic']);
    
});

Route::group(array('middleware' => ['throttle:30', 'nothing']), function (){

    Route::post('getComments', array('as' => 'getComments', 'uses' => 'CommentController@getComments'));
    Route::get('/', 'HomeController@home')->name('root');

    Route::get('home', array('as' => 'home', 'uses' => 'HomeController@home'));

    Route::post('sendMail', ['as' => 'sendMail', 'uses' => 'HomeController@sendMail']);
    
    Route::get('resetPas', array('as' => 'resetPas', 'uses' => 'HomeController@resetPas'));

    Route::post('resetPas', array('as' => 'resetPas', 'uses' => 'HomeController@doResetPas'));

//    Route::get('login', array('as' => 'signIn', 'uses' => 'HomeController@signIn'));
    Route::get('login', array('as' => 'signIn', 'uses' => 'HomeController@home'));

//    Route::post('login', array('as' => 'login', 'uses' => 'HomeController@checkAuth'));
    Route::post('checkAuth', array('as' => 'login', 'uses' => 'HomeController@checkAuth'));

    Route::get('signUp', array('as' => 'signUp', 'uses' => 'HomeController@signUp'));
//    Route::get('signUp', array('as' => 'signUp', 'uses' => 'HomeController@home'));

    Route::post('getActivation', array('as' => 'getActivation', 'uses' => 'HomeController@getActivation'));

    Route::post('sendActivation', array('as' => 'sendActivation', 'uses' => 'HomeController@sendActivation'));

    Route::post('checkEducationalCode', array('as' => 'checkEducationalCode', 'uses' => 'HomeController@checkEducationalCode'));

    Route::post('checkUserName', array('as' => 'checkUserName', 'uses' => 'HomeController@checkUserName'));

});

Route::group(array('middleware' => ['throttle:30', 'auth', 'certificateLevel']), function () {

    Route::get('workshops', ['as' => 'workshops', 'uses' => 'EventController@workshops']);

    Route::get('certificates/{eventId}', ['as' => 'certificates', 'uses' => 'CertifierController@certificates']);
    
    Route::post('removeCertificate', ['as' => 'removeCertificate', 'uses' => 'CertifierController@removeCertificate']);

    Route::get('publishCertificate/{eventId}/{uId}', ['as' => 'publishCertificate', 'uses' => 'CertifierController@publishCertificate']);

    Route::post('doPublishCertificate/{eventId}/{uId}', ['as' => 'doPublishCertificate', 'uses' => 'CertifierController@doPublishCertificate']);

});

Route::group(array('middleware' => ['throttle:30', 'auth', 'adviserLevel']), function () {

    Route::get('adviserQueue', array('as' => 'adviserQueue', 'uses' => 'AdviserController@adviserQueue'));

    Route::post('acceptStudent', array('as' => 'acceptStudent', 'uses' => 'AdviserController@acceptStudent'));

    Route::post('rejectStudent', array('as' => 'rejectStudent', 'uses' => 'AdviserController@rejectStudent'));

    Route::post('getMyPatients', array('as' => 'getMyPatients', 'uses' => 'AdviserController@getMyPatients'));

    Route::post('getPatientDates', array('as' => 'getPatientDates', 'uses' => 'AdviserController@getPatientDates'));

    Route::post('addDateToPatient', array('as' => 'addDateToPatient', 'uses' => 'AdviserController@addDateToPatient'));

    Route::post('deletePatientDate', array('as' => 'deletePatientDate', 'uses' => 'AdviserController@deletePatientDate'));

});

Route::group(array('middleware' => ['throttle:30', 'auth', 'adminLevel']), function (){

    Route::get('manageFriendAvailability', array('as' => 'manageFriendAvailability', 'uses' => 'AdminController@manageFriendAvailability'));

    Route::post('setFriendAvailibility', array('as' => 'setFriendAvailibility', 'uses' => 'AdminController@setFriendAvailibility'));

    Route::post('changeExchangeRate', array('as' => 'changeExchangeRate', 'uses' => 'AdminController@changeExchangeRate'));
    
    Route::get('manegeLikes', array('as' => 'manageLikes', 'uses' => 'AdminController@manageLikes'));

    Route::post('addLike', array('as' => 'addLike', 'uses' => 'AdminController@addLike'));

    Route::post('deleteLike', array('as' => 'deleteLike', 'uses' => 'AdminController@deleteLike'));

    Route::post('editLike', array('as' => 'editLike', 'uses' => 'AdminController@editLike'));

    Route::post('setQuizStatus', array('as' => 'setQuizStatus', 'uses' => 'AdminController@setQuizStatus'));

//yousef
    Route::post('saveMyDates/{id}', array('as' => 'saveMyDates', 'uses' => 'HomeController@saveMyDates'));

    Route::get('giveMeHashedPassword', array('as' => 'saveMyDates', 'uses' => 'AdminController@giveMeHashedPassword'));

    Route::get('pay/{id}', array('as' => 'pay', 'uses' => 'HomeController@pay'));

    Route::post('imageUploadTinyMce', array('as' => 'imageUploadTinyMce', 'uses' => 'HomeController@imageUploadTinyMce'));

});

Route::group(array('middleware' => ['throttle:30', 'auth', 'doQuiz', 'friendAvailability']), function (){

    Route::get('inviteFriend', array('as' => 'inviteFriend', 'uses' => 'FriendController@inviteFriend'));

    Route::get('manageFriends', array('as' => 'manageFriends', 'uses' => 'FriendController@manageFriends'));

    Route::post('findMySuggestionsWithConstraint', array('as' => 'findMySuggestionsWithConstraint', 'uses' => 'FriendController@findMySuggestionsWithConstraint'));

    Route::post('submitRequest', array('as' => 'submitRequest', 'uses' => 'FriendController@submitRequest'));

    Route::post('acceptRequest', array('as' => 'acceptRequest', 'uses' => 'FriendController@acceptRequest'));

    Route::post('rejectRequest', array('as' => 'rejectRequest', 'uses' => 'FriendController@rejectRequest'));

    Route::post('getBlocks', array('as' => 'getBlocks', 'uses' => 'FriendController@getBlocks'));

    Route::post('unBlock', array('as' => 'unBlock', 'uses' => 'FriendController@unBlock'));

    Route::post('getAccepted', array('as' => 'getAccepted', 'uses' => 'FriendController@getAccepted'));

    Route::post('reject', array('as' => 'reject', 'uses' => 'FriendController@reject'));

    Route::post('getMyRequestsStatus', array('as' => 'getMyRequestsStatus', 'uses' => 'FriendController@getMyRequestsStatus'));

    Route::post('cancelRequest', array('as' => 'cancelRequest', 'uses' => 'FriendController@cancelRequest'));

    Route::post('getRequests', array('as' => 'getRequests', 'uses' => 'FriendController@getRequests'));

    Route::post('changePhoneStatus', array('as' => 'changePhoneStatus', 'uses' => 'HomeController@changePhoneStatus'));

    Route::post('changeTelegramStatus', array('as' => 'changeTelegramStatus', 'uses' => 'HomeController@changeTelegramStatus'));

    Route::post('changeInstagramStatus', array('as' => 'changeInstagramStatus', 'uses' => 'HomeController@changeInstagramStatus'));

    Route::post('sendTelegramId', array('as' => 'sendTelegramId', 'uses' => 'HomeController@sendTelegramId'));

    Route::post('sendInstagramId', array('as' => 'sendInstagramId', 'uses' => 'HomeController@sendInstagramId'));

});


Route::group(array('middleware' => ['throttle:30', 'auth', 'doQuiz']), function (){

    Route::get('profile', array('as' => 'profile', 'uses' => 'HomeController@profile'));

    Route::get('result/{quizId}', array('as' => 'result', 'uses' => 'QuizController@result'));

    Route::post('sendQuizResult', array('as' => 'sendQuizResult', 'uses' => 'QuizController@sendQuizResult'));

    Route::post('sendROQ', array('as' => 'sendROQ', 'uses' => 'QuizController@sendROQ'));

    Route::get('setting', array('as' => 'setting', 'uses' => 'HomeController@setting'));

    Route::post('submitPhoto', array('as' => 'submitPhoto', 'uses' => 'HomeController@submitPhoto'));

    Route::post('saveBio', array('as' => 'saveBio', 'uses' => 'HomeController@saveBio'));

    Route::get('contentShowComplete/{contentId}', array('as' => 'contentShowComplete', 'uses' => 'HomeController@contentShowComplete'));

    Route::post('changeLike', array('as' => 'changeLike', 'uses' => 'HomeController@changeLike'));

    Route::post('updateProfile', array('as' => 'updateProfile', 'uses' => 'HomeController@updateProfile'));

    Route::post('changePas', array('as' => 'changePas', 'uses' => 'HomeController@changePas'));

    Route::get('likesList', array('as' => 'likesList', 'uses' => 'HomeController@likesList'));

    Route::post('saveMyDates/{id}', array('as' => 'saveMyDates', 'uses' => 'HomeController@saveMyDates'));

    Route::post('getSubModes', array('as' => 'getSubModes', 'uses' => 'EventController@getSubModes'));

    Route::post('addComment', array('as' => 'addComment', 'uses' => 'CommentController@addComment'));

    Route::post('getEvents', array('as' => 'getEvents', 'uses' => 'EventController@getEvents'));
    
    Route::post('getEventsByMode', array('as' => 'getEventsByMode', 'uses' => 'EventController@getEventsByMode'));

    Route::post('getEventsById', array('as' => 'getEventsById', 'uses' => 'EventController@getEventsById'));
    
    Route::post('getTotalEventsNum', array('as' => 'getTotalEventsNum', 'uses' => 'EventController@getTotalEventsNum'));

    Route::post('getTotalEventsNumByMode', array('as' => 'getTotalEventsNumByMode', 'uses' => 'EventController@getTotalEventsNumByMode'));
    
    Route::post('getSimilarityLevel/{eventId}', array('as' => 'getSimilarityLevel', 'uses' => 'EventController@getSimilarityLevel'));

    Route::post('getParticipants', array('as' => 'getParticipants', 'uses' => 'EventController@getParticipants'));
    
    Route::post('getEventImages', ['as' => 'getEventImages', 'uses' => 'EventController@getEventImages']);

    Route::post('getDaySentence', ['as' => 'getDaySentence', 'uses' => 'SentenceController@getDaySentence']);

    Route::post('getMyNotifications', ['as' => 'getMyNotifications', 'uses' => 'HomeController@getMyNotifications']);

    Route::post('getAdvisers', array('as' => 'getAdvisers', 'uses' => 'AdviserController@getAdvisers'));

    Route::post('setAsMyAdviser', array('as' => 'setAsMyAdviser', 'uses' => 'AdviserController@setAsMyAdviser'));

    Route::post('myDates', array('as' => 'myDates', 'uses' => 'AdviserController@myDates'));

    Route::post('getShortMag', array('as' => 'getShortMag', 'uses' => 'EventController@getShortMag'));

    Route::post('getTotalMag', array('as' => 'getTotalMag', 'uses' => 'EventController@getTotalMag'));

    Route::post('doneQuizes', ['as' => 'doneQuizes', 'uses' => 'QuizController@doneQuizes']);

    Route::post('getMyDoneTunnels', ['as' => 'getMyDoneTunnels', 'uses' => 'EventController@getMyDoneTunnels']);

    Route::post('getMyCertificate', ['as' => 'getMyCertificate', 'uses' => 'CertifierController@getMyCertificate']);
    
    Route::post('setMyAdditionalInfo', ['as' => 'setMyAdditionalInfo', 'uses' => 'HomeController@setMyAdditionalInfo']);
});


Route::group(array('middleware' => ['throttle:30', 'auth']), function (){

    Route::get('logout', array('as' => 'logout', 'uses' => 'HomeController@logout'));

    Route::get('preQuiz/{quizId}', array('as' => 'preQuiz', 'uses' => 'QuizController@preQuiz'));

    Route::get('doQuiz/{quizId}', array('as' => 'doQuiz', 'uses' => 'QuizController@doQuiz'));

    Route::post('changeAns', array('as' => 'changeAns', 'uses' => 'QuizController@changeAns'));

    Route::get('endQuiz/{quizId}', array('as' => 'endQuiz', 'uses' => 'QuizController@endQuiz'));

    Route::get('waitForResult', array('as' => 'waitForResult', 'uses' => 'HomeController@waitForResult'));

    Route::post('getPersonalData', array('as' => 'getPersonalData', 'uses' => 'HomeController@getPersonalData'));
});