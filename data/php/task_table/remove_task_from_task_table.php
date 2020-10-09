<?php
    include ("../db_connect.php");
    if(isset($_POST['character']) && isset($_POST['task'])){
        $character = $_POST['character'];
        $event = $_POST['task'];
        $query = "SELECT event_id FROM events WHERE event_name='$event';";
        $event_id = mysqli_fetch_array(mysqli_query($db, $query))[0];
        $query = "DELETE FROM daytime_events WHERE event_id=$event_id AND character_nickname='$character'";
        if(mysqli_query($db, $query)){
            echo "success";
        }
        else{
            echo "Error: " . $query . "<br>" . mysqli_error($db);
        }
    }