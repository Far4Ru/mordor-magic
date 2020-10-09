<?php
    include ("db_connect.php");
    if(isset($_POST['id']) && isset($_POST['day'])){
        $id = $_POST['id'];
        $day = $_POST['day'];
        $query = "SELECT COUNT(check_id) AS amount FROM goal_checklist WHERE user_id=$id AND daily_goal_date='$day'";
        $result = mysqli_query($db, $query);
        if($result_array = mysqli_fetch_array($result)){
            if($result_array['amount']==0){
                echo "<input style='margin-top:40%;margin-left:30%;color:rgba(150,150,150,0.6)' type='button' value='Создать список на день' onclick=createDailyGoalNewDay('$day')>";
            }
            else{

                $query = "SELECT daily_goals.daily_goal_id,daily_goal_user_value, daily_goal_value, daily_goal_status, daily_goal, daily_goal_period FROM goal_checklist, daily_goals WHERE goal_checklist.user_id=$id AND goal_checklist.daily_goal_date='$day' AND goal_checklist.daily_goal_id=daily_goals.daily_goal_id AND (daily_goal_time IS NULL OR daily_goal_time = '') ORDER BY daily_goal_status ASC;";
                $result = mysqli_query($db, $query);
                if(mysqli_num_rows($result)>0){

                    $goal_array = array();
                    while($daily_goal_array = mysqli_fetch_array($result)){
                        $goal_id = $daily_goal_array['daily_goal_id'];
                        $goal_user_value = $daily_goal_array['daily_goal_user_value'];
                        $goal_value = $daily_goal_array['daily_goal_value'];
                        $goal_status = $daily_goal_array['daily_goal_status'];
                        $goal_period = $daily_goal_array['daily_goal_period'];
                        $goal_text = $daily_goal_array['daily_goal'];
                        create_main_daily_block($goal_id,$goal_user_value,$goal_value,$goal_status,$goal_text, $goal_period);

                    }

                }
                create_main_daily_block(-1,"","",-1,"Нажмите двойным кликом, чтобы добавить...");
            }
        }
        else {
            //Error
            echo "";
        }

    }
    function create_main_daily_block($goal_id,$user_value,$value,$status,$text,$period=''){

        //split $value
        $values = "";
        if($user_value){
            $values .= $user_value;
        }
        if($user_value && $value){
            $values .= "/";
        }
        if($value){
            $values .= $value;
        }
        if($status && ($status != -1)){
            $user_goal_div_style = " style='background-color:rgba(255,223,0,0.6);'";
        }
        else{
            $user_goal_div_style = "";
        }

        $block = "";

        $button_value_add_one = "";
        if($value){
            $onclick_attribute = "";

            if(!$user_goal_div_style){

                if($value && $user_value){
                    if(is_numeric($value) && is_numeric($user_value)){
                        $button_value_add_one = "<p style='background-color:rgba(255,223,0,0.8);border-radius:50%;margin-left:2%;display:inline;font-size: 0.7em;padding: 2px;' onclick='goalUserValueAddOne(this.id)' align='center' id='button_value_add_one_".$goal_id."'>➕</p>";
                    }
                }
                elseif($value){
                    if(is_numeric($value)){
                        $button_value_add_one = "<p style='background-color:rgba(255,223,0,0.8);border-radius:50%;margin-left:2%;display:inline;font-size: 0.7em;padding: 2px;' onclick='goalUserValueAddOne(this.id)' align='center' id='button_value_add_one_".$goal_id."'>➕</p>";
                    }
                }
            }
        }
        else{
            $onclick_attribute = " onclick='changeStatusFromGoalId(this.id,".$status.")'";
        }

        $block_start_left = "<div".$user_goal_div_style." id='user_goal_div_".$goal_id."' ondblclick='toChangeTextFromGoalId(this.id)'".$onclick_attribute." oncontextmenu='deleteGoalFromGoalId(this.id);return false;'><p id='user_goal_".$goal_id."'";
        $block_start_right = ">";

        $block_end = "</div>";

        $style_left = " style='";
        $style_right = "'";
        $hr_style = "";
        switch($status){
            case -1:
                $style_left .= "color:grey;";
                $hr_style .=  " style='border: none;color: grey;background-color: grey;height: 2px;'";
                break;
            case 1:
                $style_left .= "color:gold;";
                break;
            case 0:
                $style_left .= "color:white;";
                break;
            default:
                $style_left .= "";
        }

        $period_block = "<p title='Повторение' style='color:grey;font-size: 0.4em;margin-left:1%;display:inline;' id='user_goal_period_".$goal_id."'>";
        $period_block_end = "</p>";
        switch(mb_strlen($period)){
            case 0:
                //nothing
                $period_block = "";
                $period_block_end = "";
                break;
            case 1:
                //day
                $period_block .= "День";
                break;
            case 3:
                //week
                $period_block .= "Неделя";
                break;
            case 2:
                //month
                $period_block .= "Месяц";
                break;
            case 4:
                //year
                $period_block .= "Год";
                break;
        }
        $period_block .= $period_block_end;

        $block_end_line = "<hr".$hr_style.">";
        $style_left .= "display:inline-block;width:auto;";

        $block .= $block_start_left;
        $block .= $style_left;
        $block .= $style_right;
        $block .= $block_start_right;
        $block .= $text;

        $block .= "</p>";
        $block .= "<p ".$style_left.$style_right." id='user_goal_value_".$goal_id."'>";
        if($value){
            $block .= $values;
        }
        $block .= "</p>";
        $block .= $button_value_add_one;
        $block .= $period_block;
        $block .= $block_end;
        $block .= $block_end_line;

        echo $block;
    }