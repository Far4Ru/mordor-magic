<?php

session_start();
include($_SERVER['DOCUMENT_ROOT']."/data/php/db_connect.php");
include($_SERVER['DOCUMENT_ROOT'] . "/data/php/check_login.php");
include($_SERVER['DOCUMENT_ROOT']."/data/php/bookmarks/get_category_options.php");
$role = $_SESSION['role'];
$category_options = getCategoryOptions($db);
?>


<div class='mainPanelContent' id='Рейтинг'>

    <style>
        table{
             font-size: .7em;
             width: 100%;
         }
         #category_selector{
            width:100%;
         }
         td {
           text-align: center;
           vertical-align: middle;
         }
    </style>
    <h2 align='center' style='font-size:1.1em;color:white'>Рейтинг</h2>
    <div align='center' style='width:60%;margin-left:20%;'>
        <select id='category_selector' onchange='getRatingTableData(this.options[this.selectedIndex].value)'>
            <option disabled>Выберите категорию</option>
            <?php
                foreach ($category_options as $name => $values){
                    echo "<option value='".$name."-".$values[1]."'>".$name."</option>";
                }
            ?>
        </select>
    </div>
    <table id='rating_table'>
        <tr>
            <th>#</th>
            <th>Название</th>
            <th>Автор</th>
            <th>Средняя оценка</th>
        </tr>

    </table>
</div>
<script>
    getRatingTableData(document.getElementById('category_selector').options[document.getElementById('category_selector').selectedIndex].value)
    function getRatingTableData(values){
        values = values.split('-');
        $.post('/data/php/bookmarks/get_rating_table_data.php',{'category':values[0],'author':values[1]}).done(function(html){
            document.getElementById('rating_table').innerHTML = html;
        });
    }
</script>