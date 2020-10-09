<?php
    include ("../db_connect.php");
    if(isset($_POST['id']) && isset($_POST['bookmark_id']) && isset($_POST['value']) && isset($_POST['score']) && isset($_POST['progress'])){
        $id = $_POST['id'];
        $bookmark_id = $_POST['bookmark_id'];
        $value = $_POST['value'];
        $score = $_POST['score'];
        $progress = $_POST['progress'];
        if(is_numeric($value) && is_numeric($score)){
            $query = "UPDATE bookmarks SET value=$value, score=$score, progress='$progress' WHERE user_id=$id AND bookmark_id=$bookmark_id;";
            if(mysqli_query($db, $query)){
                echo "Успешно";
            }
            else{
                echo "Error:" . mysqli_error($db);
            }
        }
        else{
            echo "Значения введены неверно";
        }
    }