<?php
    include ("db_connect.php");
    if(isset($_POST['id']) && isset($_POST['current_status']) && isset($_POST['day']) && isset($_POST['goal_id'])){
        $id = $_POST['id'];
        $status = $_POST['current_status'];
        $day = $_POST['day'];
        $goal_id = $_POST['goal_id'];
        $status = (int)!(bool)$status;

        $query = "UPDATE goal_checklist SET daily_goal_status=$status WHERE user_id = $id AND daily_goal_date='$day' AND daily_goal_id=$goal_id;";
        if(mysqli_query($db, $query)){
            echo "success";
        }
        else{
            echo "Error: " . $query . "<br>" . mysqli_error($db);
        }
    }