<?php
    include ("../db_connect.php");
    if(isset($_POST['id']) && isset($_POST['name']) && isset($_POST['progress']) && isset($_POST['value']) && isset($_POST['score'])){
        $name = $_POST['name'];
        $id = $_POST['id'];
        $progress = $_POST['progress'];
        $value = $_POST['value'];
        $score = $_POST['score'];
        $query = "SELECT product_id FROM products WHERE product_name='$name';";
        $result = mysqli_query($db, $query);
        if(mysqli_num_rows($result)>0){
            while($result_array = mysqli_fetch_array($result)){
                $page_id = $result_array["product_id"];
            }

            $query = "INSERT INTO bookmarks (user_id,product_id,progress,value,score) VALUES ($id,$page_id,'$progress',$value,$score)";
            if(mysqli_query($db, $query)){
                echo "Успешно";
            }
            else{
                echo "Error:" . mysqli_error($db);
            }
        }
        else{
            echo "Не удалось найти страницу";
        }
    }