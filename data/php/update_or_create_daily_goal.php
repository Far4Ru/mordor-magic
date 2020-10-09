<?php
    include ("db_connect.php");
    setlocale(LC_ALL, "ru_RU.UTF-8");
    date_default_timezone_set('Europe/Moscow');

    if(isset($_POST['id']) && isset($_POST['timeValue']) && isset($_POST['textValue']) && isset($_POST['periodValue']) && isset($_POST['valueValue']) && isset($_POST['goalId']) && isset($_POST['day'])){
        $id = $_POST['id'];
        $time = $_POST['timeValue'];
        $text = $_POST['textValue'];
        $value = $_POST['valueValue'];
        $period = $_POST['periodValue'];
        $day = $_POST['day'];
        switch($period){
            case 'День':
                $period = "1";
                break;
            case 'Неделя':
                $period =  strftime("%a",strtotime($day)).'ъ';
                break;
            case 'Месяц':
                $period =  strftime("%m",strtotime($day));
                break;
            case 'Год':
                $period =  strftime("%d%m",strtotime($day));
                break;
            default:
                $period = '';
        }
        $goal_id = $_POST['goalId'];
        $status = -1;
        if($value){
            $value_array = explode("/",$value);
            if(count($value_array) > 1){
                $value_max = $value_array[1];
                $value_user = $value_array[0];
                if($value_max==$value_user){
                    $status = 1;
                }
                else{
                    $status = 0;
                }
            }
            else{
                $value_max = $value_array[0];
                $value_user = "";
                $status = 0;
            }
        }
        else{
            $value_max = "";
            $value_user = "";
        }
        if($goal_id < 1){
            //insert
            //daily_goals
            //id = user_id, daily_goal = text, daily_goal_time = time, daily_goal_value = value
            $query = "INSERT INTO daily_goals (user_id,daily_goal,daily_goal_time,daily_goal_value,daily_goal_period) VALUES ($id, '$text','$time','$value_max','$period');";
        }
        else{
            //update
            //where daily_goal_id = goal_id
            //id = user_id, daily_goal = text, daily_goal_time = time, daily_goal_value = value
            $query = "UPDATE daily_goals SET user_id = $id, daily_goal = '$text', daily_goal_time = '$time', daily_goal_value = '$value_max', daily_goal_period = '$period' WHERE daily_goal_id = $goal_id;";
        }
        if(mysqli_query($db, $query)){

            if($goal_id < 1){
                $date = $day;
                $goal_id_query = "SELECT * FROM daily_goals WHERE user_id=$id ORDER BY daily_goal_id DESC LIMIT 1";
                if($new_daily_goal_id = mysqli_fetch_array(mysqli_query($db, $goal_id_query))[0]){
                    $checklist_query = "INSERT INTO goal_checklist (user_id, daily_goal_id,daily_goal_status,daily_goal_date,daily_goal_user_value) VALUES ($id, $new_daily_goal_id,0,'$date','$value_user');";
                    if(mysqli_query($db, $checklist_query)){
                        echo "Успешно";
                    }
                    else{
                        echo "Не удалось";
                        $error = mysqli_error($db);
                    }
                }
            }
            else{
                if($status == -1){
                    $checklist_query = "UPDATE goal_checklist SET daily_goal_user_value='$value_user'  WHERE daily_goal_id = $goal_id AND daily_goal_date='$day';";
                }
                else{
                    $checklist_query = "UPDATE goal_checklist SET daily_goal_user_value='$value_user', daily_goal_status = $status WHERE daily_goal_id = $goal_id AND daily_goal_date='$day';";
                }
                if(mysqli_query($db, $checklist_query)){
                    echo "Успешно";
                }
                else{
                    echo "Не удалось";
                    $error = mysqli_error($db);
                }
            }
        }
        else{
            echo "Ошибка";
            $error = mysqli_error($db);
        }
    }