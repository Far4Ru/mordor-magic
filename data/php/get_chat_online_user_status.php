<?php
    include ("db_connect.php");
    setlocale(LC_ALL, "ru_RU.UTF-8");
    date_default_timezone_set('Europe/Moscow');
    $query_member_list = mysqli_query($db, "SELECT user_nickname, user_role,user_online_date,user_registration_status FROM users ORDER BY user_role ASC");
    $member_online_list = array();
    $member_offline_list = array();
    while($member = mysqli_fetch_array($query_member_list)){
        if($member['user_registration_status']=='Подтвержден'){
            $user_online_date=$member['user_online_date'];
            if($user_online_date){
                $user_online_pass_time = (strtotime("now") - strtotime($user_online_date))/ 60;
                if($user_online_pass_time < 960){
                    $user_online_status = 'Онлайн';
                }
                else{
                    $user_online_status = $user_online_date;
                }
            }
            else{
                $user_online_status = 'Неизвестно';
            }
            if($user_online_status == 'Онлайн'){

                $member_online_list[$member['user_nickname']] = array($member['user_role'],$user_online_status);
            }
            else{
                $member_offline_list[$member['user_nickname']] = array($member['user_role'],$user_online_status);
            }
        }
    }
    echo "<p class='chatBlockItems' align='center' style='text-indent:0;font-size:1em;height:28px;padding-top:10px;border-bottom: 1px solid rgba(255,255,255,1);'>В сети:</p>";

    foreach($member_online_list as $nickname => $info){
        if(count($info)==2){
            $role = $info[0];
        }
        else{
            $role = "";
        }
        $role_color_style = "color:";
        switch($role){
            case "Администратор":
                $role_color_style.="white;";
                break;
            case "Балрог":
                $role_color_style.="gold;";
                break;
            case "Назгул":
                $role_color_style.="silver;";
                break;
            case "Участник":
                $role_color_style.="grey;";
                break;
        }
        echo "<p class='chatBlockItems' align='center' style='text-indent:0;height:32px;padding-top: 6px;".$role_color_style."'>".$nickname."</p>";
    }


    echo "<p class='chatBlockItems' align='center' style='color:grey;text-indent:0;font-size:1em;height:28px;padding-top:10px;border-bottom: 1px solid rgba(155,155,155,1);'>Не в сети:</p>";
    foreach($member_offline_list as $nickname => $info){
            if(count($info)==2){
                $role = $info[0];
                $online_status = $info[1];
            }
            else{
                $role = "";
                $online_status = "Неизвестно";
            }
            $role_color_style = "color:";
            switch($role){
                case "Администратор":
                    $role_color_style.="white;";
                    break;
                case "Балрог":
                    $role_color_style.="gold;";
                    break;
                case "Назгул":
                    $role_color_style.="silver;";
                    break;
                case "Участник":
                    $role_color_style.="grey;";
                    break;
            }
            echo "<p class='chatBlockItems' align='center' style='text-indent:0;opacity:0.5;height:18px;padding-top: 6px;".$role_color_style."'>".$nickname."</p>";echo "<p class='chatBlockItems' align='center' style='text-indent:0;font-size:0.6em;opacity:0.5;height:15px;".$role_color_style."'>".$online_status."</p>";
        }