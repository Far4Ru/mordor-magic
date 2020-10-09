<?php
    include ("db_connect.php");
    if(isset($_POST['id']) && isset($_POST['day'])){
        $id = $_POST['id'];
        $day = $_POST['day'];
        $query = "SELECT COUNT(check_id) AS amount FROM goal_checklist WHERE user_id=$id AND daily_goal_date='$day'";
        $result = mysqli_query($db, $query);
        if($result_array = mysqli_fetch_array($result)){
            if($result_array['amount']==0){
                echo "<p align='center' style='text-indent:0;'>Справка</p>";
                echo "<p>Формат: время - текст - число/число - повторение</p>";
                echo "<p>Формат времени: ЧЧ:ММ</p>";
                echo "<p>Формат повторения: День/Неделя/Месяц/Год</p>";
                echo "<p>ПКМ - удаление полностью или на день</p>";
                echo "<p>ЛКМ - изменение статуса завершения</p>";
            }
            else{
                $query = "SELECT daily_goals.daily_goal_id,daily_goal_user_value, daily_goal_value, daily_goal_status, daily_goal_time, daily_goal, daily_goal_period FROM goal_checklist, daily_goals WHERE goal_checklist.user_id=$id AND goal_checklist.daily_goal_date='$day' AND goal_checklist.daily_goal_id=daily_goals.daily_goal_id AND (daily_goal_time IS NOT NULL AND daily_goal_time <> '');";
                $result = mysqli_query($db, $query);
                if(mysqli_num_rows($result)>0){

                    $time_goal_array = array();

                    while($daily_goal_array = mysqli_fetch_array($result)){
                        $time_goal_value = $daily_goal_array['daily_goal_time'];
                        $goal_user_value = $daily_goal_array['daily_goal_user_value'];
                        $goal_value = $daily_goal_array['daily_goal_value'];
                        $goal_period = $daily_goal_array['daily_goal_period'];

                        //split $value
                        $values = "";
                        if($goal_user_value){
                            $values .= $goal_user_value;
                        }
                        if($goal_user_value && $goal_value){
                            $values .= "/";
                        }
                        if($goal_value){
                            $values .= $goal_value;
                        }

                        //$time_goal_values => h , m
                        if(count($time_goal_values = explode(":",$time_goal_value)) == 2){
                            $time_goal_value_h = intval($time_goal_values[0]);
                            $time_goal_value_m = intval($time_goal_values[1]);
                        }
                        elseif($time_goal_values = explode(":",$time_goal_value) == 1){
                            $time_goal_value_h = intval($time_goal_values[0]);
                            $time_goal_value_m = 0;
                        }
                        else{
                            $time_goal_value_h = 0;
                            $time_goal_value_m = 0;
                        }

                        if(!empty($time_goal_array)){
                            $counter = 0;
                            $close = 0;
                            while ($close == 0 ){


                                if(($time_goal_array[$counter][3] > $time_goal_value_h) || (($time_goal_array[$counter][3] == $time_goal_value_h) && ($time_goal_array[$counter][4] >= $time_goal_value_m))){
                                    if($counter == 0){
                                        array_unshift($time_goal_array, array($daily_goal_array['daily_goal_id'],$daily_goal_array['daily_goal'],$daily_goal_array['daily_goal_status'],$time_goal_value_h,$time_goal_value_m,$values));
                                    }
                                    else{
                                        //past > now
                                        $time_goal_array = array_merge(array_slice($time_goal_array, 0, $counter),array(array($daily_goal_array['daily_goal_id'],$daily_goal_array['daily_goal'],$daily_goal_array['daily_goal_status'],$time_goal_value_h,$time_goal_value_m,$values)),array_slice($time_goal_array, $counter));
                                    }
                                    $close = 1;
                                }
                                elseif ($counter == (count($time_goal_array)-1)){
                                    array_push($time_goal_array, array($daily_goal_array['daily_goal_id'],$daily_goal_array['daily_goal'],$daily_goal_array['daily_goal_status'],$time_goal_value_h,$time_goal_value_m,$values));
                                    $close = 1;
                                }
                                $counter++;
                            }
                        }
                        //first row
                        else{
                            array_push($time_goal_array, array($daily_goal_array['daily_goal_id'],$daily_goal_array['daily_goal'],$daily_goal_array['daily_goal_status'],$time_goal_value_h,$time_goal_value_m,$values));
                        }
                        //echo create_time_pass_daily_block_cell($daily_goal_array['daily_goal_id'],$daily_goal_array['daily_goal'],$daily_goal_array['daily_goal_status'],$daily_goal_array['daily_goal_time'],$values);
                    }

                    if(!empty($time_goal_array)){
                        for($i=0;$i<count($time_goal_array);$i++){
                            echo create_time_pass_daily_block_cell($time_goal_array[$i][0],$time_goal_array[$i][1],$time_goal_array[$i][2],($time_goal_array[$i][3] == 0 ? "00" : $time_goal_array[$i][3]).":".($time_goal_array[$i][4] == 0 ? "00" : $time_goal_array[$i][4]),$time_goal_array[$i][5], $goal_period);
                        }
                    }
                    echo create_time_pass_daily_block_cell(0,"Нажмите двойным кликом, чтобы добавить...",-1);
                }
                else{
                    echo create_time_pass_daily_block_cell(0,"Нажмите двойным кликом, чтобы добавить...",-1);
                }
                //if user_id = id on goal_checklist daily_goal_date= day
                // then load
                //else
                //make
                //if 0 new value
            }
        }
    }
    function create_time_pass_daily_block_cell($goal_id,$text,$status,$time="",$value="", $period=""){
        $cell = "";
        $hr_style = "";
        if($status && ($status != -1)){
            $user_goal_div_style = " style='background-color:rgba(255,223,0,0.6);'";
        }
        else{
            $user_goal_div_style = "";
        }
        $button_value_add_one = "";
        if($value){
            $onclick_attribute = "";

            if(!$user_goal_div_style){
                try{
                    $value_array = explode("/",$value);
                    if(count($value_array)==2){
                        if(is_numeric($value_array[0]) && is_numeric($value_array[1])){
                            $button_value_add_one = "<p style='background-color:rgba(255,223,0,0.8);border-radius:50%;margin-left:2%;display:inline;font-size: 0.7em;padding: 2px;' onclick='goalUserValueAddOne(this.id)' align='center' id='button_value_add_one_".$goal_id."'>➕</p>";
                        }
                    }
                    elseif(count($value_array)==1){
                        if(is_numeric($value_array[0])){
                            $button_value_add_one = "<p style='background-color:rgba(255,223,0,0.8);border-radius:50%;margin-left:2%;display:inline;font-size: 0.7em;padding: 2px;' onclick='goalUserValueAddOne(this.id)' align='center' id='button_value_add_one_".$goal_id."'>➕</p>";
                        }
                    }
                }
                catch (Exception $e) {
                    $button_value_add_one = "";

                }
            }
        }
        else{
            $onclick_attribute = " onclick='changeStatusFromGoalId(this.id,".$status.")'";
        }

        $cell .= "<div".$user_goal_div_style." id='user_goal_div_".$goal_id."' ondblclick='toChangeTextFromGoalId(this.id)'".$onclick_attribute." oncontextmenu='deleteGoalFromGoalId(this.id);return false;'>";
        $add_attribute_style = "style='";
        switch($status){
            case -1:
                $add_attribute_style .= "color:grey;";
                $hr_style .= " style='border: none;color: grey;background-color: grey;height: 2px;'";
                break;
            case 1:
                $add_attribute_style .= "color:gold;";
                break;
            case 0:
                $add_attribute_style .= "color:white;";
                break;
            default:
                $add_attribute_style .= "";
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

       $add_attribute_style .= "display:inline-block;width:auto";
       $add_attribute_style .= "'"." ";

        //pTime
        $cell .= "<p ".$add_attribute_style."id='user_goal_time_".$goal_id."'>";
        if($time){
            $cell.= $time;
        }
        $cell .= "</p>";

        //pText
        $cell .= "<p ".$add_attribute_style."id='user_goal_".$goal_id."'>".$text."</p>";

        //pValue
        $cell .= "<p ".$add_attribute_style."id='user_goal_value_".$goal_id."'>";
        if($value){
            $cell .= $value;
        }
        $cell .= "</p>";
        $cell .= $button_value_add_one;
        $cell .= $period_block;
        $cell.="</div>";
        $cell.="<hr".$hr_style.">";
        return $cell;
    }