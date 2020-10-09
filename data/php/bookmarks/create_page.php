<?php
    include ("../db_connect.php");
    if(isset($_POST['id']) && isset($_POST['name']) && isset($_POST['value']) && isset($_POST['author']) && isset($_POST['date']) && isset($_POST['category'])){
        $id = $_POST['id'];
        $name = $_POST['name'];
        $value = $_POST['value'];
        $author = $_POST['author'];
        $date = $_POST['date'];
        $category = $_POST['category'];
        if($id==1){
            $verified = 1;
        }
        else{
            $verified = 0;
        }
        $query = "SELECT product_type_id FROM product_types WHERE type_name='$category';";
        $result = mysqli_query($db, $query);
        if(mysqli_num_rows($result)>0){
            while($result_array = mysqli_fetch_array($result)){
                $product_type_id = $result_array['product_type_id'];
            }

            $query = "INSERT INTO products (product_name,product_author,product_type,product_value,date_added,user_add_id,verified) VALUES ('$name','$author',$product_type_id,$value,'$date',$id,$verified)";
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