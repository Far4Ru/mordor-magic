<?php
    function getCategoryOptions($db){
        $categories = array();
        $query = "SELECT type_name, product_value, product_author FROM product_types";
        $result = mysqli_query($db, $query);
        if(mysqli_num_rows($result)>0){
            while($result_array = mysqli_fetch_array($result)){
                $categories[$result_array["type_name"]]=[$result_array["product_value"],$result_array["product_author"]];
            }
        }
        return $categories;
    }