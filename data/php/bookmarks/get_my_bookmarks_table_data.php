<?php
    include ("../db_connect.php");
    if(isset($_POST['id']) && isset($_POST['category']) && isset($_POST['value']) && isset($_POST['author']) && isset($_POST['progress'])){
        $id = $_POST['id'];
        $category = $_POST['category'];
        $value = $_POST['value']; //
        $progress = $_POST['progress'];
        $author = $_POST['author']; //
        echo "<tr><th>#</th><th>Название</th><th>$author</th><th>Оценка</th><th>$value</th><th colspan='2'>Ред.</th></tr>";
        if($progress == 'Все'){
            $query = "SELECT bookmark_id, product_name, products.product_author, products.product_value, value, progress, score FROM products, bookmarks, product_types WHERE products.product_id = bookmarks.product_id AND user_id=$id AND product_type = product_type_id AND type_name = '$category' ORDER BY progress, product_name DESC;";
        }
        else{
            $query = "SELECT bookmark_id, product_name, products.product_author, products.product_value, value, progress, score FROM products, bookmarks, product_types WHERE products.product_id = bookmarks.product_id AND user_id=$id AND progress='$progress' AND product_type = product_type_id AND type_name = '$category'  ORDER BY progress, product_name DESC;";
        }
        $result = mysqli_query($db, $query);
        $number = 0;
        if($result){
            while($result_array = mysqli_fetch_array($result)){
                $number++;
                $row_style = "";
                switch($result_array['progress']){
                    case "В процессе":
                        $row_style=" style='background-color:rgba(45,176,57,0.7);'";
                        break;
                    case "Планируется":
                        $row_style=" style='background-color:rgba(195,195,195,0.7);'";
                        break;
                    case "Отложено":
                        $row_style=" style='background-color:rgba(249,212,87,0.7);'";
                        break;
                    case "Заброшено":
                        $row_style=" style='background-color:rgba(161,47,49,0.7);'";
                        break;
                    case "Завершено":
                        $row_style=" style='background-color:rgba(38,68,143,0.7);'";
                        break;
                }
                echo "<tr id='my_bookmark_row_".$result_array['bookmark_id']."' ".$row_style."><td>".$number."</td><td id='my_bookmark_name_".$result_array['bookmark_id']."'>".$result_array['product_name']."</td><td>".$result_array['product_author']."</td><td id='my_bookmark_score_".$result_array['bookmark_id']."'>".$result_array['score']."</td>";

                echo "<td id='value_".$result_array['bookmark_id']."'>";
                $v1 = $result_array['value'];
                $v2 = $result_array['product_value'];
                if(is_null($v1)){
                    $v1 = "-";
                }
                if(is_null($v2) || $v2==0){
                    $v2 = "?";
                }
                echo $v1."/".$v2;
                if((is_numeric($v1) && is_numeric($v2)) || ($v1 == "-") || ($v2 == "?")){
                    if(($v1 < $v2) || ($v1 == "-") || ($v2 == "?")){
                        echo "<p style='background-color:rgba(255,223,0,0.8);border-radius:50%;margin-left:2%;display:inline;font-size: 0.7em;padding: 2px;' onclick='myBookmarksValueAddOne(this.id)' align='center' id='button_value_add_one_".$result_array['bookmark_id']."'>➕</p>";
                    }
                }
                echo "</td>";
                echo "<td id='button_edit_".$result_array['bookmark_id']."' onclick='editFromMyBookmarks(this.id)'>🖊️</td><td id='button_delete_".$result_array['bookmark_id']."' onclick='deleteFromMyBookmarks(this.id)'>&#x274C</td>";
                echo "</tr>";
            }
        }
        else{
            echo "";
        }
    }