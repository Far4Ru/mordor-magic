<?php
    include ("db_connect.php");
    setlocale(LC_ALL, "ru_RU.UTF-8");
    date_default_timezone_set('Europe/Moscow');
    if(isset($_POST['id']) && isset($_POST['day'])){
        $id = $_POST['id'];
        $day = $_POST['day'];

        // day week month year
        $period_check = array("1", strftime("%a", strtotime($day)).'ъ', strftime("%m", strtotime($day)), strftime("%d%m", strtotime($day)));

        $query = "SELECT daily_goal_id FROM daily_goals WHERE user_id=$id AND (daily_goal_period='$period_check[0]' OR daily_goal_period='$period_check[1]' OR daily_goal_period='$period_check[2]' OR daily_goal_period='$period_check[3]');";
        $result = mysqli_query($db, $query);
        if(mysqli_num_rows($result)>0){

            $goal_id_array = array();

            while($result_array = mysqli_fetch_array($result)){
                array_push($goal_id_array,$result_array['daily_goal_id']);
            }
            if(!empty($goal_id_array)){
                foreach($goal_id_array as $goal_id){

                    $query = "INSERT INTO goal_checklist (user_id,daily_goal_id,daily_goal_date) VALUES ($id,$goal_id, '$day')";
                    if(mysqli_query($db, $query)){
                        echo "success";
                    }
                    else{
                        echo "Error: " . $query . "<br>" . mysqli_error($db);
                    }
                }
            }
            else{
                add_first_goal($db, $id, $day);
            }
        }
        else{
            add_first_goal($db, $id, $day);
        }
    }
    function add_first_goal($db, $id, $day){
            $query = "INSERT INTO daily_goals (user_id,daily_goal) VALUES ($id,'Первая цель')";
            if(mysqli_query($db, $query)){
                $query = "SELECT daily_goal_id FROM daily_goals WHERE user_id=$id AND daily_goal='Первая цель';";
                $result = mysqli_query($db, $query);
                if(mysqli_num_rows($result)>0){

                    $goal_id_array = array();

                    while($result_array = mysqli_fetch_array($result)){
                        array_push($goal_id_array,$result_array['daily_goal_id']);
                    }
                    foreach($goal_id_array as $goal_id){

                        $query = "INSERT INTO goal_checklist (user_id,daily_goal_id,daily_goal_date) VALUES ($id,$goal_id, '$day')";
                        if(mysqli_query($db, $query)){
                            echo "success";
                        }
                        else{
                            echo "Error: " . $query . "<br>" . mysqli_error($db);
                        }
                    }
                }
                echo "200";
            }
            else{
                echo "Error: " . $query . "<br>" . mysqli_error($db);
            }
    }