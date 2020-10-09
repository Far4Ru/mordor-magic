<?php
    include ("../db_connect.php");
    if(isset($_POST['category']) && isset($_POST['author'])){
        $category = $_POST['category'];
        $author = $_POST['author'];
        echo "<tr><th>#</th><th>Название</th><th>$author</th><th>Средняя оценка</th></tr>";
        $query = "SELECT product_name, products.product_author, AVG(NULLIF(score,0)) AS avg_score FROM products, bookmarks, product_types  WHERE products.product_id = bookmarks.product_id AND product_type = product_type_id AND type_name = '$category' GROUP BY product_name ORDER BY avg_score DESC; ";
        $result = mysqli_query($db, $query);
        $number = 0;
        if(mysqli_num_rows($result)>0){
            while($result_array = mysqli_fetch_array($result)){
                $number++;
                echo "<tr><td>".$number."</td><td>".$result_array['product_name']."</td><td>".$result_array['product_author']."</td><td>".round($result_array['avg_score'],1)."</td></tr>";
            }
        }
    }