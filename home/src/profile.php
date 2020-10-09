<?php

session_start();
header('Content-Type: text/html; charset=utf-8');

include($_SERVER['DOCUMENT_ROOT']."/data/php/check_login.php");
require_once $_SERVER['DOCUMENT_ROOT']."/data/php/check_device.php";
$nickname = $_SESSION['nickname'];
$role = $_SESSION['role'];
$id = $_SESSION['id'];
?>
<div class='mainPanelContent' id='Профиль'>
    <h2 align='center'>Профиль</h2>
    <style>

        #profileBlockShell{
            <?php
                if($view_version=="Mobile"){
                    echo "height:96%;";
                    echo "width:98%;";
                    echo "margin-left:1%;";
                    echo "margin-top:2%;";
                }
                else{
                    echo "height:94%;";
                    echo "width:70%;";
                    echo "margin-left:2%;";

                }
            ?>


            background-color:rgba(30,30,30,0.3);
            overflow-y:auto;
            direction:rtl;

            display:inline-block;
        }

        #leftMenuBlock{
            <?php
                if($view_version=="Mobile"){
                    echo "height:25%;";
                    echo "width:98%;";
                }
                else{
                    echo "height:94%;";
                    echo "width:25%;";

                }
            ?>
            vertical-align: top;
            background-color:rgba(30,30,30,0.3);
            margin-left:1%;
            display:inline-block;
        }
        .profileMenuButtons{
            <?php
                if($view_version=="Mobile"){
                    echo "height:50%;";
                    echo "width:20%;";
                    echo "display: inline-block;";
                }
                else{
                    echo "height:10%;";
                    echo "width:96%;";
                    echo "display: block;";

                }
            ?>
            font-family: 'Roboto Slab';
            font-size: 0.9em;
            margin: 0 2% 0 2%;
        }
    </style>

    <div id='leftMenuBlock'>
        <input class='profileMenuButtons' type='button' value='Общая информация' onclick='changeFrameTo("general",PROFILE_PAGES_PREFIX,"","#profileBlock")'>
        <input class='profileMenuButtons' type='button' value='Таблица заданий' onclick='changeFrameTo("task_table",PROFILE_PAGES_PREFIX,"","#profileBlock")'>
        <input class='profileMenuButtons' type='button' value='Заметки' onclick='changeFrameTo("notes",PROFILE_PAGES_PREFIX,"","#profileBlock")'>
        <input class='profileMenuButtons' type='button' value='Участники' onclick='changeFrameTo("memberlist",PROFILE_PAGES_PREFIX,"","#profileBlock")'>
        <input class='profileMenuButtons' type='button' value='Редакция' onclick='changeFrameTo("editor",PROFILE_PAGES_PREFIX,"","#profileBlock")'>
        <input class='profileMenuButtons' type='button' value='Вычисления' onclick='changeFrameTo("calculations",PROFILE_PAGES_PREFIX,"","#profileBlock")'>
        <input class='profileMenuButtons' type='button' value='Настройки' onclick='changeFrameTo("settings",PROFILE_PAGES_PREFIX,"","#profileBlock")'>
    </div>
    <div id='profileBlockShell'>
    <div style='direction:ltr;' id='profileBlock'></div>
    </div>



</div>
<script>
    document.title = "Профиль | Гильдия MORDOR";
    mainPanelContent = document.getElementById('mainFrame');
    if (typeof next_profile_page !== 'undefined') {
        changeFrameTo(next_profile_page,PROFILE_PAGES_PREFIX,"","#profileBlock");
    }
    else{
        changeFrameTo("general",PROFILE_PAGES_PREFIX,"","#profileBlock");
    }
    mainPanelContent.scrollTop = mainPanelContent.scrollHeight;
    function addTaskToTaskTable(){
        character = document.getElementById('characterAddTaskFromTaskTable');
        task = document.getElementById('eventAddTaskFromTaskTable');
        character = character.options[character.selectedIndex].value;
        task = task.options[task.selectedIndex].value;
        $.post('/data/php/task_table/add_task_to_task_table.php',{'character':character,'task':task}).done(function(){
            next_profile_page="task_table";
            reloadProfile();
        });
    }
    function removeTaskFromTaskTable(){
        character = document.getElementById('characterRemoveTaskFromTaskTable');
        task = document.getElementById('taskRemoveTaskFromTaskTable');
        character = character.options[character.selectedIndex].value;
        task = task.options[task.selectedIndex].value;
        $.post('/data/php/task_table/remove_task_from_task_table.php',{'character':character,'task':task}).done(function(){
            next_profile_page="task_table";
            reloadProfile();
        });
    }
    function addCharacterToTaskTable(){
        character = document.getElementById('characterAddCharacterToTaskTable').value;
        email = document.getElementById('emailAddCharacterToTaskTable').value;
        $.post('/data/php/task_table/add_character_to_task_table.php',{'character':character,'email':email}).done(function(){
            next_profile_page="task_table";
            reloadProfile();
        });
    }
    function removeCharacterFromTaskTable(){
        character = document.getElementById('characterRemoveCharacterFromTaskTable');
        character = character.options[character.selectedIndex].value;
        $.post('/data/php/task_table/remove_character_from_task_table.php',{'character':character}).done(function(){
            next_profile_page="task_table";
            reloadProfile();
        });
    }

    function changeCompletionCell(character, task, cell_id, cell_value){
        if(cell_value == 0){
            $.post('/data/php/task_table/change_completion_cell_from_task_table.php',{'character':character,'task':task, 'cell_value':cell_value}).done(function(){
                next_profile_page="task_table";
                reloadProfile();
            });
        }
        else if(cell_value == 1){
            $.post('/data/php/task_table/change_completion_cell_from_task_table.php',{'character':character,'task':task, 'cell_value':cell_value}).done(function(){
                next_profile_page="task_table";
                reloadProfile();
            });
        }
        else{
        }

    }
    function removeTaskFromTaskTableBy(character, task){
        $.post('/data/php/task_table/remove_task_from_task_table.php',{'character':character,'task':task}).done(function(){
            next_profile_page="task_table";
            reloadProfile();
        });
    }
    function addTaskToTaskTableBy(character, task){
        $.post('/data/php/task_table/add_task_to_task_table.php',{'character':character,'task':task}).done(function(){
            next_profile_page="task_table";
            reloadProfile();
        });
    }
    function saveAndUpdateTaskTable(){
        $.post('/data/php/task_table/save_and_update_task_table.php',{'day':'yesterday','update':true}).done(function(){
            next_profile_page="task_table";
            reloadProfile();
        });
    }
    function reloadProfile(){

        if (typeof fullPage !== 'undefined') {
            if(fullPage == 'Назад'){
                changeFrameTo("task_table",PROFILE_PAGES_PREFIX);
            }
            else{
                changeFrameTo("profile",PAGES_PREFIX);
            }
        }
        else{
            changeFrameTo("profile",PAGES_PREFIX);
        }
    }
    function createBookRestorationQuestion(){
        var question = document.getElementById('bookRestorationNewRestorationQuestion').value;
        var book = document.getElementById('bookRestorationNewRestorationBook').value;
        var right_answer = document.getElementById('bookRestorationNewRestorationRightAnswer').value;
        $.post('/data/php/create_book_restoration_question.php',{'question':question,'book':book,'right_answer':right_answer}).done(function(){
            document.getElementById('bookRestorationNewRestorationQuestion').value = '';
            document.getElementById('bookRestorationNewRestorationBook').value = '';
            document.getElementById('bookRestorationNewRestorationRightAnswer').value = '';

        });
    }
    function saveProfileNotes(){
        text = document.getElementById('profileNotes').value;

        id = 0<?php echo "+".$id; ?>;
        $.post('/data/php/save_profile_notes.php',{'text':text,'id':id}).done(function(){

            Swal.fire(
                'Сохранено!',
                'Заметки успешно сохранены.',
                'success'
            );
        });
    }
    function getProfileNotes(){
        profileNotes = document.getElementById('profileNotes');
        profileNotes.setAttribute("disabled", "true");
        id = 0<?php echo "+".$id; ?>;
        $.post('/data/php/get_profile_notes.php',{'id':id}).done(function(text){
            profileNotes.value = text;
            profileNotes.removeAttribute("disabled");
        });
    }
</script>