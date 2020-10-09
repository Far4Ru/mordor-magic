<?php
session_start();
include($_SERVER['DOCUMENT_ROOT']."/data/php/check_login.php");
?>
<div class='mainPanelContent' id='Гонка за сокровищами'>
    <h2 align='center'>Гонка за сокровищами</h2>
    <div style='height:5%;'>
        <input type='button' value='Назад' onclick='changeFrameTo(previousPage.pop(),"","back")'>
    </div>
    <div>
        <p>В ходе события можно собрать 6 редких сундуков и 2 таинственных.</p>
        <p><img src='/data/images/treasure_race_map.png'></p>
    </div>
</div>