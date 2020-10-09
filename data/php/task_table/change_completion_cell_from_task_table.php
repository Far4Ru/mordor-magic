<?php
    session_start();
    include ("../db_connect.php");
    if(isset($_POST['character']) && isset($_POST['task']) && isset($_POST['cell_value'])){
        $character = $_POST['character'];
        $event = $_POST['task'];
        $user_id = $_SESSION['id'];
        $cell_value = $_POST['cell_value'];
        if($cell_value == 1){
            $cell_value = 0;
        }
        elseif($cell_value == 0){
            $cell_value = 1;
        }
        $query = "SELECT event_id FROM events WHERE event_name='$event';";
        $event_id = mysqli_fetch_array(mysqli_query($db, $query))[0];
        $query = "UPDATE daytime_events SET completion=$cell_value WHERE character_nickname='$character' AND event_id='$event_id'";
        if(mysqli_query($db, $query)){
            echo "success";
        }
        else{
            echo "Error: " . $query . "<br>" . mysqli_error($db);
        }
    }