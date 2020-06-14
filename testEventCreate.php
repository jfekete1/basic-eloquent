<?php

require __DIR__.'/./config/bootstrap.php';
require __DIR__.'/./libs/globalFunctions.php';

$sJson = file_get_contents("php://input");
$data = json_decode_nice($sJson);


// make sure data is not empty
if (
    !empty($data->event_title) &&
    !empty($data->event_summary) &&
    !empty($data->event_details) &&
    !empty($data->event_date_start)
) {
    $lastEvent = EventsModel::orderby('event_id', 'desc')->first();
    $newId = $lastEvent->event_id + 1;

    // create the event
    $event = EventsModel::updateOrCreate(
        ['event_id' => $newId,],
        [
            'event_title' => $data->event_title,
            'event_summary' => $data->event_summary,
            'event_details' => $data->event_details,
            'event_date_start' => $data->event_date_start
        ]
    );
    if ($event) {
        // set response code - 201 created
        http_response_code(201);
        // tell the user
        echo json_encode(array("message" => "event was created."));

        //Send notification to channel users are subscribed to.
        $url = "http://localhost:4040/publish";
        $data = array(
            "channel" => "testchan",
            "payload" => "Event created guys !!"
            //to => [] GET THE USERS SUBSCRIBED TO THIS EVENT CATEGORY, AND ONLY SEND NOTIFICATION TO THEM !!
        );
        $content = json_encode($data);

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $curl,
            CURLOPT_HTTPHEADER,
            array("Content-type: application/json")
        );
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $content);

        $json_response = curl_exec($curl);

        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if ($status != 201) {
            die("Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
        }


        curl_close($curl);

        $response = json_decode($json_response, true);
        /*$url = "http://localhost:4040/publish";
        $data = array(
            "channel" => "testchan",
            "payload" => "Event created guys !!",
            "to" => "[]"
        );
        $options = array(
            'http' => array(
                'method'  => 'POST',
                'content' => json_encode($data),
                'header' =>  "Content-Type: application/json\r\n" .
                    "Accept: application/json\r\n"
            )
        );

        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        $response = json_decode($result);*/
    } else {
        http_response_code(503);
        echo json_encode(array("message" => "Unable to create event."));
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Bad JSON received"));
}






    /*$event = EventsModel::Create(
        [
            //'event_id' => 7553,
            'event_title' => $data->event_title,
            'event_summary' => $data->event_summary,
            'event_details' => $data->event_details,
            'event_date_end' => $data->event_date_start
        ]);*/
    
    // update an event
    /*$event = EventsModel::updateOrCreate(
        ['event_id' => 7552,],
        [
            'event_title' => "TÁJÉKOZTATÓ !!!",    'event_summary' => "asdasd", 'event_details' => '<p>Kormányzati döntés értelmében a szar járványügyi helyzet miatt a soron következő programok bizonytalan ideig elmaradnak.<br />A programok újraindulásáról tájékoztatni fogjuk önöket.</p>',
        ]
    );
    */