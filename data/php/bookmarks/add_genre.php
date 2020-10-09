<?php
    include ("../db_connect.php");
    if(isset($_POST['id']) && isset($_POST['page']) && isset($_POST['genre']) && isset($_POST['percent'])){
        $id = $_POST['id'];
        $page = $_POST['page'];
        $genre = $_POST['genre'];
        $percent = $_POST['percent'];
        $query = "SELECT product_id FROM products WHERE product_name='$page';";
        $result = mysqli_query($db, $query);
        if(mysqli_num_rows($result)>0){
            while($result_array = mysqli_fetch_array($result)){
                $page_id = $result_array["product_id"];
            }

            $query = "INSERT INTO product_genres (product_id,genre_name,percent_genre) VALUES ($page_id,'$genre','$percent')";
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