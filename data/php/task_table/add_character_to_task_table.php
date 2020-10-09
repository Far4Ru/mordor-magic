<?php
    session_start();
    include ("../db_connect.php");
    if(isset($_POST['character']) && isset($_POST['email'])){
        $character = $_POST['character'];
        $email = $_POST['email'];
        $user_id = $_SESSION['id'];
        $query = "INSERT INTO characters_ownage (user_id,character_nickname,email) VALUES ($user_id, '$character', '$email') ON DUPLICATE KEY UPDATE user_id=$user_id, character_nickname='$character', email='$email'";

        if(mysqli_query($db, $query)){
            echo "success";
        }
        else{
            echo "Error: " . $query . "<br>" . mysqli_error($db);
        }
    }