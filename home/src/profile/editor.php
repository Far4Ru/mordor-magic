<?php

session_start();
include($_SERVER['DOCUMENT_ROOT'] . "/data/php/check_login.php");
$role = $_SESSION['role'];

?>
<div class='mainPanelContent' id='Общая информация'>

    <h2 align='center' style='font-size:1.1em;color:white'>Редакция</h2>


    <?php
        if($role=="Администратор"){
            echo "<h3>Реставрация книг</h3>";
            echo "<p>Вопрос <input style='width:85%' type='text' placeholder='Вопрос' id='bookRestorationNewRestorationQuestion'></p><p>Книга <input style='width:65%' type='text' placeholder='Название' id='bookRestorationNewRestorationBook'></p><p>Правильный ответ <input style='width:35%' type='text' placeholder='Ответ' id='bookRestorationNewRestorationRightAnswer'></p><p><input type='button' value='Отправить' onclick='createBookRestorationQuestion()'></p>";
        }
    ?>
</div>