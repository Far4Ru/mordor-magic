<?php

session_start();
include($_SERVER['DOCUMENT_ROOT'] . "/data/php/check_login.php");
$role = $_SESSION['role'];
$id = $_SESSION['id'];
$query = mysqli_query($db, "SELECT user_email,user_online_date FROM users WHERE user_id='$id';");
while($user_info = mysqli_fetch_array($query)){
    $email = $user_info['user_email'];
    $user_online_date = $user_info['user_online_date'];
}
if($email){
    $email = explode("@", $email);
    if(count($email) == 2){
        $email=str_split($email[0])[0]."***@".$email[1];
    }
    else{
        $email = 'Не действительный адрес';
    }
}
else{
    $email = 'Не указана';
}
if($user_online_date){
    $user_online_pass_time = (strtotime("now") - strtotime($user_online_date))/ 60 % 60;
    if($user_online_pass_time < 15){
        $user_online_status = 'Онлайн';
    }

}
else{
    $user_online_status = 'Неизвестно';
}


?>
<div class='mainPanelContent' id='Общая информация'>

    <h2 align='center' style='font-size:1.1em;color:white'><?php echo $nickname?></h2>


    <p>
        Роль:
        <?php
            if($role){
                echo $role;
            }
            else{
                echo 'Участник';
            }
        ?>
    </p>
    <p>
        Электронная почта:
        <?php
            if($email){
                echo $email;
            }
            else{
                echo 'Не указана';
            }
        ?>
    </p>
        <?php
            /*if($user_online_status){
                echo $user_online_status;
            }
            else{
                echo 'Неизвестно';
            }*/
        ?>
</div>