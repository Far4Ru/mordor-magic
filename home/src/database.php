<?php

session_start();
include($_SERVER['DOCUMENT_ROOT']."/data/php/check_login.php");

$role = $_SESSION['role'];
?>
<div class='mainPanelContent' id='Библиотека'>
    <h2 align='center'>Библиотека</h2>
    <div style='height:5%;'>
        <div style='display:inline;margin-left:25%;'><input style='width:50%;' type='text' placeholder='Поиск'></div>
        <input type='button' style='margin-left:15%;' value='Глоссарий' onclick='changeFrameTo("glossary",DATABASE_PAGES_PREFIX)'>
    </div>
    <div>
        <?php
            if (file_exists('database_structure/database_tree.xml')) {
                $database = simplexml_load_file('database_structure/database_tree.xml');
                foreach ($database->topic as $topic) {
                    $div_style = "";
                    if(isset($topic->title['img'])){
                        $div_style = " style='background-size:100% 100%;background-image:url(\"".$topic->title['img']."\");' ";
                    }
                    echo "<div ".$div_style." align='center' class='divButton' onclick=\"databaseCurrentTitle='".$topic->title."';$.post('/data/php/set_database_current_title.php',{'currentTitle':'".$topic->title."'}).done(function(){changeFrameTo('topic_page',DATABASE_STRUCTURE_PREFIX);});
\"><p class='pButton'>".$topic->title."</p></div>";
                }
            }

        ?>
    </div>
    <?php
            if($role=="Администратор"){
            echo "<div style='position:absolute;left:6%;top:25%;'><input type='button' value='Редактировать' onclick=changeFrameTo('database_edit',DATABASE_STRUCTURE_PREFIX)></div>";
            }
    ?>
</div>

<script>
    document.title = "Библиотека | Гильдия MORDOR";
</script>