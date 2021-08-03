<?php

namespace App\Http\Controllers;

use App\models\Best;
use App\models\Comment;
use App\models\Event;
use App\models\EventRegistry;
use App\models\Factor;
use App\models\Registry;
use App\models\SurveyQuestion;
use App\models\TagModel;
use App\models\Tip;
use App\models\TipAssign;
use App\models\TipConstraint;
use App\models\Transaction;
use App\models\User;
use App\models\UserPhoto;

use App\models\EventDay;
use App\models\EventImage;
use App\models\Like;
use App\models\LikeAssign;

use App\models\UserSurvey;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

use App\models\Bio;

class EventController extends Controller
{

    public function getSubModes()
    {
        if (isset($_POST["mode"])) {
            echo json_encode(TagModel::whereMode(makeValidInput($_POST["mode"]))->get());
            return;
        }
        echo "nok";
    }

    private function getEventAvgPoint($eventId)
    {

        $points = UserSurvey::selectRaw('AVG(opinion) as avgPoint')->whereEventId($eventId)->groupBy('surveyQuestionId');

        $sum = 0;

        foreach ($points as $point) {
            $sum += 1.0 * $point->avgPoint;
        }

        return $sum;
    }

    public function getParticipants()
    {

        if (isset($_POST["eventId"])) {
            $users = EventRegistry::whereEventId(makeValidInput($_POST["eventId"]))->get();
            foreach ($users as $user) {
                $tmp = User::whereId($user->id);
                $user->name = $tmp->firstName . " " . $tmp->lastName;
            }

            echo json_encode($users);
            return;
        }
        echo "nok";
    }

    public function getSimilarityLevel($eventId)
    {
        return mt_rand(36, 65);
    }

    public function getEvents()
    {

        if (isset($_POST["subMode"]) && isset($_POST["page"])) {

            $subMode = TagModel::whereId($_POST["subMode"]);
            if ($subMode == null) {
                echo "nok2";
                return;
            }

            $page = (makeValidInput($_POST["page"]) - 1) * 40;

            $events = Event::whereMode($subMode->mode)->whereSubMode($subMode->id)->skip($page)->take(40)->get();

            foreach ($events as $event) {
                $tmp = EventDay::whereEventId($event->id)->get();
                foreach ($tmp as $itr) {
                    $itr->date = convertStringToDate($itr->date);
                }
                $event->days = $tmp;
                $tmp = EventImage::whereEventId($event->id)->first();
                if($tmp != null)
                    $event->image = URL::asset('images/contentPhotos/' . $tmp->pic . '.jpg');
                else
                    $event->image = URL::asset('images/contentPhotos/noimage.png');

                $event->avgPoint = $this->getEventAvgPoint($event->id);

                if ($subMode->mode == 3) {
                    $taraz = $this->getSimilarityLevel($event->id);
                    if ($taraz > 67)
                        $event->color = "gold";
                    else if ($taraz > 33)
                        $event->color = "silver";
                    else
                        $event->color = "bronze";
                }

                switch ($event->point) {
                    case getValueInfo('simple'):
                        $event->point = "ساده";
                        break;
                    case getValueInfo('avg'):
                        $event->point = "متوسط";
                        break;
                    case getValueInfo('advance'):
                        $event->point = "پیشرفته";
                        break;
                }
            }

            echo json_encode($events);
            return;
        }

        echo "nok";
    }

    public function getEventsByMode()
    {
        if (isset($_POST["mode"]) && isset($_POST["page"])) {
            $page = (makeValidInput($_POST["page"]) - 1) * 40;
            $mode = makeValidInput($_POST["mode"]);

            $events = Event::whereMode($mode)->skip($page)->take(40)->get();

            foreach ($events as $event) {
                $tmp = EventDay::whereEventId($event->id)->get();
                foreach ($tmp as $itr) {
                    $itr->date = convertStringToDate($itr->date);
                }
                $event->days = $tmp;


                $image = EventImage::whereEventId($event->id)->first();
                if($image == null)
                    $event->image = URL::asset('images/contentPhotos/' . $image->pic . '.jpg');
                else
                    $event->image = URL::asset('images/contentPhotos/noimage.png');
//                $event->image = EventImage::whereEventId($event->id)->first();
                $event->avgPoint = $this->getEventAvgPoint($event->id);
                if ($mode == 3) {
                    $taraz = $this->getSimilarityLevel($event->id);
                    if ($taraz > 67)
                        $event->color = "gold";
                    else if ($taraz > 33)
                        $event->color = "silver";
                    else
                        $event->color = "bronze";
                }

                switch ($event->point) {
                    case getValueInfo('simple'):
                        $event->point = "ساده";
                        break;
                    case getValueInfo('avg'):
                        $event->point = "متوسط";
                        break;
                    case getValueInfo('advance'):
                        $event->point = "پیشرفته";
                        break;
                }
            }

            echo json_encode($events);
            return;
        }

        echo "nok";
    }

    public function getEventsById()
    {
        if (isset($_POST["id"])) {
            $id = makeValidInput($_POST["id"]);
            $event = Event::whereId($id);
            $tmp = EventDay::whereEventId($event->id)->get();
            foreach ($tmp as $itr) {
                $itr->date = convertStringToDate($itr->date);
            }
            $event->days = $tmp;
            $tmp = EventImage::whereEventId($event->id)->get();
            foreach ($tmp as $itr) {
                $itr->pic = URL::asset('images/contentPhotos/' . $itr->pic . '.jpg');
            }
            $event->image = $tmp;
            $event->avgPoint = $this->getEventAvgPoint($event->id);

            echo json_encode($event);
            return;
        }

        echo "nok";
    }

    public function deleteEvent()
    {

        if (isset($_POST["id"])) {

            $id = makeValidInput($_POST["id"]);
            $images = EventImage::whereEventId($id)->get();

            try {
                DB::transaction(function () use ($images, $id) {

                    foreach ($images as $image) {
                        if (file_exists(__DIR__ . '/../../../public/images/contentPhotos/' . $image->pic . '.jpg')) {
                            unlink(__DIR__ . '/../../../public/images/contentPhotos/' . $image->pic . '.jpg');
                        }
                    }

                    Event::destroy($id);
                    echo "ok";
                });
            } catch (\Exception $x) {
                echo $x->getMessage();
            }
        }

    }

    public function doEditEvent()
    {

        if (isset($_POST["price"]) && isset($_POST["duration"]) && isset($_POST["launcher"]) &&
            isset($_POST["description"]) && isset($_POST["name"]) && isset($_POST["place"]) && isset($_POST["subMode"]) &&
            isset($_POST["mode"]) && isset($_POST["tips"]) && isset($_POST["likes"]) && isset($_POST["id"]) &&
            isset($_POST["point"]) && isset($_POST["level"])
        ) {

            $event = Event::whereId(makeValidInput($_POST["id"]));

            if ($event != null) {
                $event->price = makeValidInput($_POST["price"]);
                $event->place = makeValidInput($_POST["place"]);
                $event->duration = makeValidInput($_POST["duration"]);
                $event->launcher = makeValidInput($_POST["launcher"]);
                $event->description = $_POST["description"];
                $event->name = makeValidInput($_POST["name"]);
                $event->mode = makeValidInput($_POST["mode"]);
                $event->subMode = makeValidInput($_POST["subMode"]);
                $event->point = makeValidInput($_POST["point"]);
                $event->level = makeValidInput($_POST["level"]);

                Best::whereEventId($event->id)->delete();

                if (isset($_POST["best"]) && makeValidInput($_POST["best"]) == "ok") {
                    $tmp = new Best();
                    $tmp->eventId = $event->id;
                    try {
                        $tmp->save();
                    } catch (\Exception $x) {
                    }
                }

                $event->save();
                $tipIds = $_POST["tips"];
                $likeIds = $_POST["likes"];

                TipAssign::whereContentId($event->id)->delete();
                LikeAssign::whereContentId($event->id)->delete();

                foreach ($tipIds as $tipId) {
                    $tmp2 = new TipAssign();
                    $tmp2->tipId = makeValidInput($tipId);
                    $tmp2->contentId = $event->id;
                    $tmp2->save();
                }

                foreach ($likeIds as $likeId) {
                    $tmp2 = new LikeAssign();
                    $tmp2->likeId = makeValidInput($likeId);
                    $tmp2->contentId = $event->id;
                    $tmp2->save();
                }

                return "ok";
            }
        }

        return "nok";
    }

    public function events($tagId, $err = "")
    {

        $events = DB::select('select event.id, duration, level, name, description, price, mode, place, point, launcher from event left join (select eventId, max(date) as date from eventDay group by(eventId)) as tmpDay On event.id = tmpDay.eventId where subMode = ' . $tagId . ' ORDER by tmpDay.date DESC');

        // Get current page form url e.x. &page=1
        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        // Create a new Laravel collection from the array data
        $itemCollection = collect($events);

        // Define how many items we want to be visible in each page
        $perPage = 5;

        // Slice the collection to get the items to display in current page
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();

        // Create our paginator and pass it to the view
        $paginatedItems = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);

        // set url path for generted links
        $paginatedItems->setPath(route('events', ['tagId' => $tagId]));

        foreach ($events as $event) {

            if (Best::whereEventId($event->id)->count() > 0)
                $event->best = true;
            else
                $event->best = false;

            switch ($event->level) {
                case getValueInfo('simple'):
                    $event->levelName = "ساده";
                    break;
                case getValueInfo('avg'):
                    $event->levelName = "متوسط";
                    break;
                case getValueInfo('advance'):
                    $event->levelName = "پیشرفته";
                    break;
            }

            $str = "";
            $tips = TipAssign::whereContentId($event->id)->get();
            foreach ($tips as $tip)
                $str .= Tip::whereId($tip->tipId)->name . " - ";
            $event->tips = $str;


            $str = "";
            $likes = LikeAssign::whereContentId($event->id)->get();
            foreach ($likes as $like)
                $str .= Like::whereId($like->likeId)->name . " - ";

            $event->likes = $str;

            $days = EventDay::whereEventId($event->id)->get();
            $str = "";
            foreach ($days as $day)
                $str .= convertStringToDate($day->date) . " - ";
            $event->days = $str;
        }

        $tips = Tip::orderBy('id', 'ASC')->get();
        foreach ($tips as $tip) {
            $tip->constraints = TipConstraint::whereTipId($tip->id)->get();
        }

        $contents = [];
        $counter = 0;
        foreach ($paginatedItems as $itr) {
            $contents[$counter++] = $itr;
        }

        return view('contentManager', array('err' => $err, 'factors' => Factor::all(), 'AllTips' => $tips,
            'likes' => Like::all(), 'contents' => $paginatedItems, 'contentsJS' => $contents));
    }

    public function manageEvents()
    {
        return view('selectTag');
    }

    public function reLaunchContent()
    {

        if (isset($_POST["id"])) {

            $event = Event::whereId(makeValidInput($_POST["id"]));
            if ($event != null) {
                $event->counter = $event->counter + 1;
                try {
                    $event->save();
                    echo "ok";
                } catch (\Exception $x) {
                }
            }

        }

    }

    public function togglePublish()
    {

        if (isset($_POST["id"])) {

            $event = Event::whereId(makeValidInput($_POST["id"]));
            if ($event != null) {
                if ($event->duration == 0) {
                    if (EventDay::whereEventId($event->id)->count() != 2) {
                        echo "nok2";
                        return;
                    }
                    $event->duration = 1;
                } else
                    $event->duration = 0;
                try {
                    $event->save();
                    echo "ok";
                } catch (\Exception $x) {
                }
            }

        }

    }

    public function getEventDates()
    {

        if (isset($_POST["id"])) {

            $days = EventDay::whereEventId(makeValidInput($_POST["id"]))->get();
            foreach ($days as $day)
                $day->date = convertStringToDate($day->date);

            echo json_encode($days);
        }
    }

    public function getEventImages()
    {

        if (isset($_POST["id"])) {
            $images = EventImage::whereEventId(makeValidInput($_POST["id"]))->get();
            foreach ($images as $image)
                $image->pic = URL::asset('images/contentPhotos/' . $image->pic . '.jpg');
            echo json_encode($images);
            return;
        }
        echo "nok";
    }

    public function addDate()
    {

        if (isset($_POST["eventId"]) && isset($_POST["date"]) && isset($_POST["sTime"])) {

            $eventId = makeValidInput($_POST["eventId"]);

            $event = Event::whereId($eventId);
            if ($event->mode == getValueInfo('mag')) {
                if (EventDay::whereEventId($eventId)->count() >= 2) {
                    echo "nok2";
                    return;
                }
            }

            $eventDay = new EventDay();
            $eventDay->date = convertDateToString(makeValidInput($_POST["date"]));
            $eventDay->eventId = $eventId;
            $eventDay->startTime = makeValidInput($_POST["sTime"]);

            try {
                $eventDay->save();
                echo "ok";
            } catch (\Exception $x) {
            }
        }
    }

    public function removeDate()
    {

        if (isset($_POST["id"])) {
            try {
                EventDay::destroy(makeValidInput($_POST["id"]));
                echo "ok";
            } catch (\Exception $x) {
            }
        }
    }

    public function getTipsAndLikes()
    {

        if (isset($_POST["id"])) {

            $eventId = makeValidInput($_POST["id"]);

            $tips = TipAssign::whereContentId($eventId)->select('tipId')->get();
            $likes = LikeAssign::whereContentId($eventId)->select('likeId')->get();

            echo json_encode(['tips' => $tips, 'likes' => $likes]);
            return;
        }

        echo [];
    }

    public function removeImage()
    {

        if (isset($_POST["id"])) {
            try {
                $img = EventImage::whereId(makeValidInput($_POST["id"]));
                if (file_exists(__DIR__ . '/../../../public/images/contentPhotos/' . $img->pic . '.jpg'))
                    unlink(__DIR__ . '/../../../public/images/contentPhotos/' . $img->pic . '.jpg');
                $img->delete();
                echo "ok";
            } catch (\Exception $x) {
            }
        }

    }

    public function addImage($id)
    {

        if (Event::whereId($id) == null) {
            echo "nok1";
            return;
        }

        if (count($_FILES) > 0) {

            $file = $_FILES[0];
            $fileName = explode('.', $file["name"])[0];

            $path = __DIR__ . '/../../../public/images/contentPhotos/' . $fileName . '.jpg';

            $count = 2;
            while (file_exists($path)) {
                $fileName = $fileName . $count++;
                $path = __DIR__ . '/../../../public/images/contentPhotos/' . $fileName . '.jpg';
            }

            $err = uploadCheck($path, 0, "تصویر رویداد", 300000000, "jpg");
            if (empty($err)) {
                $err = upload($path, 0, "تصویر رویداد");
                if (empty($err)) {
                    $tmp = new EventImage();
                    $tmp->eventId = $id;
                    $tmp->pic = $fileName;
                    try {
                        $tmp->save();
                        echo "ok";
                    } catch (\Exception $x) {
                        echo "nok2 " . $x->getMessage();
                        unlink($path);
                    }
                    return;
                }
            }
            echo "nok3 " . $err;
            return;
        }
    }

    public function addEvent()
    {

        if (isset($_POST["price"]) && isset($_POST["duration"]) && isset($_POST["launcher"]) && isset($_POST["level"]) &&
            isset($_POST["description"]) && isset($_POST["name"]) && isset($_POST["place"]) && isset($_POST["point"]) &&
            isset($_POST["mode"]) && isset($_POST["tips"]) && isset($_POST["likes"]) && isset($_POST["subMode"])
        ) {

            $event = new Event();
            $event->price = makeValidInput($_POST["price"]);
            $event->place = makeValidInput($_POST["place"]);
            $event->duration = makeValidInput($_POST["duration"]);
            $event->launcher = makeValidInput($_POST["launcher"]);
            $event->description = $_POST["description"];
            $event->name = makeValidInput($_POST["name"]);
            $event->mode = makeValidInput($_POST["mode"]);
            $event->subMode = makeValidInput($_POST["subMode"]);
            $event->point = makeValidInput($_POST["point"]);
            $event->level = makeValidInput($_POST["level"]);

            $event->save();
            $tipIds = $_POST["tips"];
            $likeIds = $_POST["likes"];

            if (isset($_POST["best"]) && makeValidInput($_POST["best"]) == "ok") {
                $tmp = new Best();
                $tmp->eventId = $event->id;
                try {
                    $tmp->save();
                } catch (\Exception $x) {
                }
            }

            foreach ($tipIds as $tipId) {
                $tmp2 = new TipAssign();
                $tmp2->tipId = makeValidInput($tipId);
                $tmp2->contentId = $event->id;
                $tmp2->save();
            }

            foreach ($likeIds as $likeId) {
                $tmp2 = new LikeAssign();
                $tmp2->likeId = makeValidInput($likeId);
                $tmp2->contentId = $event->id;
                $tmp2->save();
            }

            return "ok";
        }

        return "nok";
    }

    public function getShortMag()
    {

        if (isset($_POST["subMode"])) {

            $subMode = makeValidInput($_POST["subMode"]);
            $date = getToday()["date"];

            $events = DB::select('select e.id, e.name, e.place, e.price from event e, tipAssign t, userTip u WHERE' .
                ' t.contentId = e.id and t.tipId = u.tipId and u.uId = ' . Auth::user()->id . ' and' .
                ' (SELECT COUNT(*) FROM eventDay eD WHERE eD.eventId = e.id and eD.date <= ' . $date . ') = 1' .
                ' and (SELECT COUNT(*) FROM eventDay eD WHERE eD.eventId = e.id and eD.date >= ' . $date . ') = 1' .
                ' and e.duration = 1 and e.subMode = ' . $subMode);

            if ($events == null || count($events) == 0) {
                echo "nok1";
                return;
            }

            $events = $events[0];
            $image = EventImage::whereEventId($events->id)->first();
            if ($image != null)
                $events->image = URL::asset('images/contentPhotos/' . $image->pic . '.jpg');
            else
                $events->image = URL::asset('images/contentPhotos/nopic.jpg');

            $days = EventDay::whereEventId($events->id)->get();
            if ($days != null && count($days) > 1) {

                $start = $days[0]->date;
                $end = $days[1]->date;

                if ($start > $end) {
                    $events->start = convertStringToDate($end);
                    $events->end = convertStringToDate($start);
                } else {
                    $events->start = convertStringToDate($start);
                    $events->end = convertStringToDate($end);
                }
            } else {
                $events->start = "نامشخص";
                $events->end = "نامشخص";
            }

            echo json_encode($events);
            return;
        }

        echo "nok2";
    }

    public function getTotalMag()
    {

        if (isset($_POST["subMode"])) {

            $subMode = makeValidInput($_POST["subMode"]);

            $general = TagModel::whereId($subMode);
            if ($general == null) {
                echo json_encode(["status" => "nok2"]);
                return;
            }

            $date = getToday()["date"];

            $events = DB::select('select e.id, e.name, e.description from event e, tipAssign t, userTip u WHERE' .
                ' t.contentId = e.id and t.tipId = u.tipId and u.uId = ' . Auth::user()->id . ' and' .
                ' (SELECT COUNT(*) FROM eventDay eD WHERE eD.eventId = e.id and eD.date <= ' . $date . ') = 1' .
                ' and (SELECT COUNT(*) FROM eventDay eD WHERE eD.eventId = e.id and eD.date >= ' . $date . ') = 1' .
                ' and e.duration = 1 and e.subMode = ' . $subMode);

            if ($events == null || count($events) == 0) {
                echo json_encode(["status" => "nok1"]);
                return;
            }

            $event = $events[0];

            if ($general->general ||
                Auth::user()->level == getValueInfo('adminLevel') ||
                EventRegistry::whereEventId($event->id)->whereUId(Auth::user()->id)->count() > 0) {

                $image = EventImage::whereEventId($event->id)->first();
                if ($image != null)
                    $event->image = URL::asset('images/contentPhotos/' . $image->pic . '.jpg');
                else
                    $event->image = URL::asset('images/contentPhotos/nopic.jpg');

                $days = EventDay::whereEventId($event->id)->get();
                if ($days != null && count($days) > 1) {

                    $start = $days[0]->date;
                    $end = $days[1]->date;

                    if ($start > $end) {
                        $event->start = convertStringToDate($end);
                        $event->end = convertStringToDate($start);
                    } else {
                        $event->start = convertStringToDate($start);
                        $event->end = convertStringToDate($end);
                    }
                } else {
                    $event->start = "نامشخص";
                    $event->end = "نامشخص";
                }

                echo json_encode(['status' => "ok", 'mag' => $event]);
            } else
                echo json_encode(["status" => "nok3"]);

            return;
        }

        echo json_encode(["status" => "nok4"]);

    }

    public function getEventsName()
    {

        $events = Event::select('id', 'name', 'mode', 'subMode')->get();

        foreach ($events as $event) {
            switch ($event->mode) {
                case getValueInfo('tunnel'):
                default:
                    $event->mode = "تونل";
                    break;
                case getValueInfo('fun'):
                    $event->mode = "فان";
                    break;
                case getValueInfo('mag'):
                    $event->mode = "مگ";
                    break;
            }

            $event->subMode = TagModel::whereId($event->subMode)->name;
        }

        echo json_encode($events);

    }

    public function getTotalEventsNum()
    {

        if (isset($_POST["subMode"])) {

            echo Event::whereSubMode(makeValidInput($_POST["subMode"]))->count();
            return;
        }

        echo "-1";

    }

    public function getTotalEventsNumByMode()
    {

        if (isset($_POST["mode"])) {

            echo Event::whereMode(makeValidInput($_POST["mode"]))->count();
            return;
        }

        echo "-1";

    }

    public function workshops()
    {

        $day = getToday()["date"];

        $events = DB::select('select e.id, e.subMode, e.name, e.level, e.description, e.place, e.duration, e.launcher from event e WHERE e.mode = ' . getValueInfo('tunnel') . ' and ' .
            '(select max(eD.date) from eventDay eD where eD.eventId = e.id) < ' . $day);

        foreach ($events as $event) {
            switch ($event->level) {
                case getValueInfo('simple'):
                    $event->levelName = "ساده";
                    break;
                case getValueInfo('avg'):
                    $event->levelName = "متوسط";
                    break;
                case getValueInfo('advance'):
                    $event->levelName = "پیشرفته";
                    break;
            }
        }

        return view('workshop', ['contents' => $events]);
    }

    public function getMyDoneTunnels()
    {

        $day = getToday()["date"];
        $uId = Auth::user()->id;

        $events = DB::select('select e.id, e.subMode, e.name, e.level, e.description, e.place, e.duration, e.launcher from event e, eventRegistry eR WHERE e.id = eR.eventId and eR.uId = ' . $uId . ' and e.mode = ' . getValueInfo('tunnel') . ' and ' .
            '(select max(eD.date) from eventDay eD where eD.eventId = e.id) < ' . $day);

        foreach ($events as $event) {
            switch ($event->level) {
                case getValueInfo('simple'):
                    $event->levelName = "ساده";
                    break;
                case getValueInfo('avg'):
                    $event->levelName = "متوسط";
                    break;
                case getValueInfo('advance'):
                    $event->levelName = "پیشرفته";
                    break;
            }
            $image = EventImage::whereEventId($event->id)->first();
            $event->image = $image;
        }

        echo json_encode($events);
    }

}