<?php
    include ("../db_connect.php");
    if(isset($_POST['id']) && isset($_POST['bookmark_id'])){
        $id = $_POST['id'];
        $bookmark_id = $_POST['bookmark_id'];
        $query = "DELETE FROM bookmarks WHERE user_id=$id AND bookmark_id=$bookmark_id;";
        if(mysqli_query($db, $query)){
            echo "Успешно";
        }
        else{
            echo "Error:" . mysqli_error($db);
        }
    }