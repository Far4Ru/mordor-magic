<?php
    include ("../db_connect.php");
    if(isset($_POST['search_value'])){
        $search_value = $_POST['search_value'];
        $query = "SELECT product_name FROM products WHERE product_name LIKE '%$search_value%';";
        $result = mysqli_query($db, $query);
        if(mysqli_num_rows($result)>0){
            while($result_array = mysqli_fetch_array($result)){
                echo "<p>".$result_array['product_name']."<input style='margin-left:5px;' type='button' value='Добавить' onclick='addBookmark(\"".$result_array['product_name']."\")'></p>";
            }
        }
    }