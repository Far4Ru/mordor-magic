<?php

session_start();
include($_SERVER['DOCUMENT_ROOT'] . "/data/php/check_login.php");
$user_role = $_SESSION['role'];
$query_member_list = mysqli_query($db, "SELECT user_nickname, user_role,user_registration_status, user_registration_date, user_email FROM users ORDER BY user_role ASC");
$member_list = array();
$member_request_list = array();
while($member = mysqli_fetch_array($query_member_list)){
    if($member['user_registration_status']=='Подтвержден'){
        $member_list[$member['user_nickname']]=$member['user_role'];
    }
    else{
        $member_request_list[$member['user_nickname']]=array($member['user_registration_date'],$member['user_email']);
    }
}

?>
<div class='mainPanelContent' id='Участники'>

    <h2 align='center' style='font-size:1.1em;color:white'>Участники</h2>
    <div align='center'>


        <?php
            echo "<table style='width:90%;background-color:rgba(2,2,2,0.2);'>";
            foreach($member_list as $member => $role){
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
                echo "<tr><td><p style='font-size:2.5em;".$role_color_style."'>".$member."</p></td><td><p style='font-size:2.5em;".$role_color_style."'>".$role."</p></td></tr>";
            }
            echo "</table>";
        ?>
    </div>
    <?php
        if(($user_role == 'Администратор' || $user_role == 'Балрог' || $user_role == 'Назгул') && $member_request_list){

            echo "<h2 align='center' style='font-size:1.1em;color:white'>Заявки</h2><div align='center'>";
            echo "<table style='width:90%;background-color:rgba(2,2,2,0.2);'>";
                foreach($member_request_list as $name => $info){
                    if(count($info)==2){
                        $date = $info[0];
                        $email = $info[1];
                    }
                    else{
                        $date = "";
                        $email = "";
                    }
                    echo "<tr><td><p style='font-size:2.5em;color:grey;'>".$name."</p></td><td><p style='font-size:2.5em;color:grey;'>".$date."</p></td>";
                    if($user_role == 'Администратор'){
                        echo "<td><p style='font-size:2.5em;color:grey;'>".$email."</p></td>";
                    }
                    echo "<td><p style='font-size:2.5em;' onclick='acceptMember(\"".$name."\")'>Принять</p></td><td><p style='font-size:2.5em;' onclick='refuseMember(\"".$name."\")'>Отклонить</p></td></tr>";
                }
                echo "</table>";
            echo "</div>";
            echo "<script>function acceptMember(name){Swal.fire({title: 'Принять участника ' + name + '?',text: name+' получит роль участника.',icon: 'question',showCancelButton: true,confirmButtonColor: '#3085d6',cancelButtonColor: '#d33',confirmButtonText: 'Да, принять',cancelButtonText: 'Отмена'}).then((result) =>{if(result.value) {\$.post('/data/php/accept_registration_member.php',{'name':name}).done(function(response){if(response == 'Не удалось'){Swal.fire('Ошибка','Добавить участника не удалось.','error');}else{Swal.fire('Успешно!','Участник принят в Мордор. На почту отправлено уведомление о завершении регистрации.','success');changeFrameTo('memberlist',PROFILE_PAGES_PREFIX,'','#profileBlock');}});}});}function refuseMember(name){Swal.fire({title: 'Отклонить заявку ' + name + '?',text: 'Заявка будет удалена.',icon: 'question',showCancelButton: true,confirmButtonColor: '#d33',cancelButtonColor: '#3085d6',confirmButtonText: 'Да, отклонить',cancelButtonText: 'Отмена'}).then((result) =>{if(result.value) {\$.post('/data/php/refuse_registration_member.php',{'name':name}).done(function(response){if(response == 'Не удалось'){Swal.fire('Ошибка','Отклонить заявку не удалось.','error');} else{Swal.fire('Успешно!','Заявка отклонена.','success');changeFrameTo('memberlist',PROFILE_PAGES_PREFIX,'','#profileBlock');}});}});}</script>";
        }
    ?>

</div>