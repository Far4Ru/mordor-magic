<?php
    if(isset($_POST['eventName']) && isset($_POST['players']) && isset($_POST['classes']) && isset($_POST['guilds']) && isset($_POST['bosses']) && isset($_POST['timeEvent']) && isset($_POST['dateEvent'])){
        $dateEvent = $_POST['dateEvent'];
        $eventName = $_POST['eventName'];
        $timeEvent = $_POST['timeEvent']; //0
        $playersArray = $_POST['players'];
        $classesArray = $_POST['classes'];
        $guildsArray = $_POST['guilds'];
        $bossesArray = $_POST['bosses']; //0

        $PAST_EVENTS_FILE_PATH = $_SERVER['DOCUMENT_ROOT'].'/data/past_events/past_events.xml';
        if (file_exists($PAST_EVENTS_FILE_PATH)) {
            $past_events = simplexml_load_file($PAST_EVENTS_FILE_PATH);
            $new_event = $past_events->addChild('event');
            $new_event->addChild('name',$eventName);
            $new_event->addChild('date',$dateEvent);
            if($timeEvent){
                $new_event->addChild('time',$timeEvent);
            }
            $players = $new_event->addChild('players');
            for($i=0;$i<count($playersArray);$i++){
                $player = $players->addChild('player');
                $player->addChild('nickname',$playersArray[$i]);
                $player->addChild('class',$classesArray[$i]);
                $player->addChild('guild',$guildsArray[$i]);
                if($bossesArray[$i]){
                    $player->addChild('bosses',$bossesArray[$i]);
                }
            }
            $past_events->saveXML($PAST_EVENTS_FILE_PATH);


        }

    }