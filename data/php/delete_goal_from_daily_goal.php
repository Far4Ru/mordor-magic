<?php
    include ("db_connect.php");
    if(isset($_POST['id']) && isset($_POST['goal_id'])){

        $id = $_POST['id'];
        $goal_id = $_POST['goal_id'];
        if(isset($_POST['day'])){
            $day = $_POST['day'];
        }
        else{
            $day = "";
        }
        $query = "DELETE FROM goal_checklist WHERE user_id=$id AND daily_goal_id = $goal_id AND daily_goal_date='$day'";
        if($day){
            $query = "DELETE FROM goal_checklist WHERE user_id=$id AND daily_goal_id = $goal_id AND daily_goal_date='$day'";
            if(mysqli_query($db, $query)){
                echo "success";
            }
            else{
                echo "Error: " . $query . "<br>" . mysqli_error($db);
            }
        }
        else{
            $query = "DELETE FROM daily_goals WHERE user_id=$id AND daily_goal_id=$goal_id";
            if(mysqli_query($db, $query)){
                echo "success";
            }
            else{
                echo "Error: " . $query . "<br>" . mysqli_error($db);
            }
            $query = "DELETE FROM goal_checklist WHERE user_id=$id AND daily_goal_id = $goal_id";
            if(mysqli_query($db, $query)){
                echo "success";
            }
            else{
                echo "Error: " . $query . "<br>" . mysqli_error($db);
            }
        }
    }