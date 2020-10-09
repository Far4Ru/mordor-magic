<?php
    session_start();
    include ("../db_connect.php");
    if(isset($_POST['character']) && isset($_POST['task'])){
        $character = $_POST['character'];
        $event = $_POST['task'];
        $user_id = $_SESSION['id'];
        $query = "SELECT event_id FROM events WHERE event_name='$event';";
        $event_id = mysqli_fetch_array(mysqli_query($db, $query))[0];
        $query = "INSERT INTO daytime_events (character_nickname,event_id) VALUES ('$character', $event_id) ON DUPLICATE KEY UPDATE character_nickname='$character', event_id=$event_id;";
        if(mysqli_query($db, $query)){
            echo "success";
        }
        else{
            echo "Error: " . $query . "<br>" . mysqli_error($db);
        }
    }