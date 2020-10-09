<?php
    include ("db_connect.php");

    if(isset($_POST["name"])){
        $nickname = $_POST["name"];
        $query = "DELETE FROM users WHERE user_nickname='$nickname' AND user_registration_status IS NULL";
        if(mysqli_query($db, $query)){
            echo "Успешно";
        }
        else{
            echo "Не удалось";
            $error = mysqli_error($db);
        }
    }