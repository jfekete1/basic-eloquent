<?php
require __DIR__."/./config/bootstrap.php";

//$events = CategorysModel::find(1)->events()->orderBy('event_title')->get();
//echo $events;

//$categories = EventsModel::find(7550)->categorys()->orderBy('category_name')->get();
$lastEvent = EventsModel::orderby('event_id', 'desc')->first();
$lastUser = UsersModel::orderby('user_id', 'desc')->first();

//FILL UP PIVOT TABLE
//$lastUser->categorys()->attach(1);
//$lastEvent->categorys()->attach(3);


//echo $categories;
$lastId = $lastEvent->event_id;
$lastuid = $lastUser->user_id;
echo $lastuid;