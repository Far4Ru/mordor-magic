<?php
    include ("../db_connect.php");
    if(isset($_POST['id']) && isset($_POST['name']) && isset($_POST['value']) && isset($_POST['author'])){
        $id = $_POST['id'];
        $name = $_POST['name'];
        $value = $_POST['value'];
        $author = $_POST['author'];
        $query = "INSERT INTO product_types (type_name,product_value,product_author) VALUES ('$name','$value','$author')";
        if(mysqli_query($db, $query)){
            echo "Успешно";
        }
        else{
            echo "Error:" . mysqli_error($db);
        }
    }