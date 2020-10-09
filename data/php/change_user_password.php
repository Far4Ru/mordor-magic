<?php
    include ("db_connect.php");
    include ("registration.php");

    if(isset($_POST['id']) && isset($_POST['old']) && isset($_POST['new'])){
        $id = $_POST['id'];
        $old = $_POST['old'];
        $new = $_POST['new'];

        $query = mysqli_query($db, "SELECT user_password FROM users WHERE user_id='$id';");
        while($query_array = mysqli_fetch_array($query)){
            $user_password = $query_array['user_password'];
        }
        if(password_verify($old,$user_password)){
            $hash = generate_hash($new);
            $query = "UPDATE users SET user_password='$hash' WHERE user_id='$id'";
            if(mysqli_query($db, $query)){
                echo "Успешно";
                $_SESSION['password'] = $new;
            }
            else{
                echo "Ошибка";
            }
        }
        else{
            echo "Неверный пароль";
        }
    }