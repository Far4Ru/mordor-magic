<?php
session_start();
include($_SERVER['DOCUMENT_ROOT']."/data/php/check_login.php");
?>
<div class='mainPanelContent' id='Ранг'>
    <h2 align='center'>Ранг</h2>
    <div style='height:5%;'>
        <input type='button' value='Назад' onclick='changeFrameTo(previousPage.pop(),"","back")'>
    </div>
    <div>
    </div>
</div>