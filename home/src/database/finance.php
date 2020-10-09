<?php
session_start();
include($_SERVER['DOCUMENT_ROOT']."/data/php/check_login.php");
?>
<div class='mainPanelContent' id='Финансы'>
    <h2 align='center'>Финансы</h2>
    <div style='height:5%;'>
        <input type='button' value='Назад' onclick='changeFrameTo(previousPage.pop(),"","back")'>
    </div>
    <div>
        <p>Финансовое задание берется в зале гильдии и выполняется игроками, назначенными казначеями. </p>
    </div>
</div>