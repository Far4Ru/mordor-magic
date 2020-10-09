<?php

session_start();
include($_SERVER['DOCUMENT_ROOT'] . "/data/php/check_login.php");
include($_SERVER['DOCUMENT_ROOT']."/data/php/task_table/get_task_table_data.php");
$nickname = $_SESSION['nickname'];
$role = $_SESSION['role'];
$id = $_SESSION['id'];
list($all_events,$all_characters,$all_completion,$all_possible_events) = get_task_table_data($nickname,$db);

?>
<div class='mainPanelContent' id='Таблица заданий'>

    <h2 align='center' style='font-size:1.1em;color:white'>Таблица заданий</h2>
    <input style='margin-left:2%'id='fullPageTaskTableButton' type='button' align='right' value='Развернуть' onclick='fullPage="Назад";changeFrameTo("task_table",PROFILE_PAGES_PREFIX)'>
<div align='center'>
    <?php
        echo "<div style='overflow-x: auto;max-width: 96%;'><table>";
        echo "<tr><th></th>";
        for($i=0;$i<count($all_events);$i++){
            echo "<th>".$all_events[$i]."</th>";
        }
        echo "</tr>";

        $cell_style_color_greenyellow = "rgba(173,255,47,0.5);";
        $cell_style_color_none = "rgba(0,0,0,0);";
        $cell_style_color_grey = "rgba(47,47,47,0.8);";

        for($i=0;$i<count($all_characters);$i++){
            echo "<tr>";
            echo "<th title='".$all_characters[$i][1]."'>".$all_characters[$i][0]."</th>";
            for($j=0;$j<count($all_completion[$i]);$j++){
                    echo "<td id='cell_".$i."_".$j."' ";
                    switch($all_completion[$i][$j]){
                        case 1:
                            echo "onclick=\"changeCompletionCell('".$all_characters[$i][0]."','".$all_events[$j]."',this.id, 1);\" ";
                            echo "style='background-color:".$cell_style_color_greenyellow."'";
                            break;
                        case "false":
                            echo "onclick=\"changeCompletionCell('".$all_characters[$i][0]."','".$all_events[$j]."',this.id, -1);\" ";
                            echo "style='background-color:".$cell_style_color_none."'";
                            echo " ondblclick=\"addTaskToTaskTableBy('".$all_characters[$i][0]."','".$all_events[$j]."')\" ";
                            break;
                        case 0:
                            echo "onclick=\"changeCompletionCell('".$all_characters[$i][0]."','".$all_events[$j]."',this.id, 0);\" ";
                            echo "style='background-color:".$cell_style_color_grey."'";
                            echo " ondblclick=\"removeTaskFromTaskTableBy('".$all_characters[$i][0]."','".$all_events[$j]."')\" ";
                            break;
                    }
                    echo "></td>";

            }
            echo "</tr>";
        }
        echo "</table></div>";
    ?>
    </div>
    <?php
        $all_owned_characters = array();
        $all_owned_characters_query = "SELECT character_nickname FROM characters_ownage WHERE user_id=$id";
        $result = mysqli_query($db, $all_owned_characters_query);
        while($character = mysqli_fetch_array($result)){
            array_push($all_owned_characters,$character);
        }
    ?>

    <p>Добавить задание персонажу:</p>
    <p>
        Персонаж
        <select id='characterAddTaskFromTaskTable'>
            <?php
                foreach( $all_owned_characters as $character){
                    echo "<option value='".$character[0]."'>".$character[0]."</option>";
                }
            ?>
        </select>
        задание
        <select id='eventAddTaskFromTaskTable'>
            <?php
                foreach ($all_possible_events as $event){
                    echo "<option value='".$event."'>".$event."</option>";
                }
            ?>
        </select>
        <input type='button' value='Добавить' onclick='addTaskToTaskTable()'>
    </p>
    <p>Удалить задание персонажу:</p>
    <p>
        Персонаж
        <select id='characterRemoveTaskFromTaskTable'>
            <?php
                foreach( $all_owned_characters as $character){
                    echo "<option value='".$character[0]."'>".$character[0]."</option>";
                }
            ?>
        </select>
        задание
        <select id='taskRemoveTaskFromTaskTable'>
            <?php
                foreach ($all_events as $event){
                    echo "<option value='".$event."'>".$event."</option>";
                }
            ?>
        </select>
        <input type='button' value='Удалить' onclick='removeTaskFromTaskTable()'>
    </p>
    <p>Добавить персонажа:</p>
    <p>
        <input type='text' placeholder='Персонаж' id='characterAddCharacterToTaskTable'>
        <input type='text' placeholder='E-mail' id='emailAddCharacterToTaskTable'>
        <input type='button' value='Добавить' onclick='addCharacterToTaskTable()'>
    </p>
    <p>Удалить персонажа:</p>
    <p>
        Персонаж
        <select id='characterRemoveCharacterFromTaskTable'>
            <?php
                foreach( $all_owned_characters as $character){
                    echo "<option value='".$character[0]."'>".$character[0]."</option>";
                }
            ?>
        </select>
        <input type='button' value='Удалить' onclick='removeCharacterFromTaskTable()'>
    </p>
    <p>
        <button onclick='window.open("/data/php/task_table/create_pdf_from_task_table.php","_blank");'>Создать PDF</button>
    </p>
    <p>
        <button onclick='saveAndUpdateTaskTable()'>Обнулить и сохранить</button>
    </p>
</div>

<script>
    if (typeof fullPage !== 'undefined') {
        fullPageTaskTableButton = document.getElementById('fullPageTaskTableButton');
        if(fullPage=='Назад'){
            fullPageTaskTableButton.value='Назад';
            fullPageTaskTableButton.onclick=function(){
                fullPage='Развернуть';
                next_profile_page="task_table";
                changeFrameTo("profile",PAGES_PREFIX);
            };
        }
        else{
            fullPageTaskTableButton.value='Развернуть';
            fullPageTaskTableButton.onclick=function(){
                fullPage='Назад';
                changeFrameTo("task_table",PROFILE_PAGES_PREFIX);
            };
        }
    }
</script>