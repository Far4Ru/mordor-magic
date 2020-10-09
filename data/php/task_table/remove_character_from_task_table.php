<?php
    session_start();
    include ("../db_connect.php");
    if(isset($_POST['character'])){
        $character = $_POST['character'];
        $user_id = $_SESSION['id'];
        $query = "DELETE FROM characters_ownage WHERE user_id=$user_id AND character_nickname='$character'";

        if(mysqli_query($db, $query)){
            echo "success";
        }
        else{
            echo "Error: " . $query . "<br>" . mysqli_error($db);
        }
    }