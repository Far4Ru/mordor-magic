<?php
    include ("send_mail.php");
    include ("db_connect.php");

    if(isset($_POST["name"])){
        $nickname = $_POST["name"];
        //sendmail
        //update
        //user_role user_registration_status
        $query = "UPDATE users SET user_registration_status='Подтвержден', user_role='Участник' WHERE user_nickname='$nickname' AND user_registration_status IS NULL";
        if(mysqli_query($db, $query)){
            $query_new_member = mysqli_query($db, "SELECT user_email,user_registration_status FROM users WHERE user_nickname='$nickname';");
            while($new_member = mysqli_fetch_array($query_new_member)){
                $email = $new_member['user_email'];
                $user_registration_status = $new_member['user_registration_status'];
            }
            if($user_registration_status == 'Подтвержден' && $email){
                send_mail_to($email, $nickname);
            }
        }
        else{
            echo "Не удалось";
        }

    }