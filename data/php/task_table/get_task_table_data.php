<?php
    function get_task_table_data($nickname,$db){
        $all_events = array();
        $all_characters = array();
        $all_completion = array();

        $query_all_events = "SELECT event_name FROM events";
        $result_all_events = mysqli_query($db, $query_all_events);
        while($transmitter = mysqli_fetch_array($result_all_events)){
            array_push($all_events, $transmitter['event_name']);
        }

        $query = "SELECT characters_ownage.character_nickname, email,event_name, completion, day_completed FROM characters_ownage, users, daytime_events, events WHERE characters_ownage.user_id=users.user_id AND user_nickname='$nickname' AND daytime_events.event_id = events.event_id AND characters_ownage.character_nickname=daytime_events.character_nickname ORDER BY email, daytime_events.character_nickname DESC";
        $result = mysqli_query($db, $query);

        $current_nickname = "";
        $current_email = "";
        $current_event_name = "";
        $current_completion = 0;
        $current_array_position = -1;

        while($info = mysqli_fetch_array($result)){
            if($info['character_nickname'] != $current_nickname){

                // new character

                $current_nickname = $info['character_nickname'];
                $current_email = $info['email'];
                $current_event_name = $info['event_name'];
                $current_completion = $info['completion'];

                $current_array_position++;
                $current_event_position = array_search($current_event_name,$all_events);

                array_push($all_characters,[$current_nickname, $current_email]);
                array_push($all_completion,array_fill(0,count($all_events),'false'));

                $all_completion[$current_array_position][$current_event_position] = $current_completion;

            }
            else{

                // old character

                $current_event_name = $info['event_name'];
                $current_completion = $info['completion'];

                $current_event_position = array_search($current_event_name,$all_events);

                $all_completion[$current_array_position][$current_event_position] = $current_completion;
            }
        }
        $all_events_blank_array = search_nulls($all_events,$all_completion);

        $not_empty_all_events = array();
        $not_empty_completion = array();

        for($j=0;$j<count($all_events);$j++){
            if($all_events_blank_array[$j] !== "empty"){
                array_push($not_empty_all_events,$all_events[$j]);
            }
        }
        for($i=0;$i<count($all_characters);$i++){
            $not_empty_completion[$i] = array();
            for($j=0;$j<count($all_events);$j++){
                if($all_events_blank_array[$j] !== "empty"){
                    array_push($not_empty_completion[$i],$all_completion[$i][$j]);
                }
            }
        }
        $events = $not_empty_all_events;
        $all_completion = $not_empty_completion;
        return array($events, $all_characters, $all_completion,$all_events);
    }
    function search_nulls($array, $arrays){
        $null_array = array_fill(0,count($array),0);
        for($i=0;$i<count($array);$i++){
            for($j=0;$j<count($arrays);$j++){
                if($arrays[$j][$i] == 'false'){
                    $null_array[$i]++;
                }
            }
            if($null_array[$i] == count($arrays)){
                $null_array[$i] = 'empty';
            }
        }
        return $null_array;
    }
?>