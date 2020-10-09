<?php
session_start();
include($_SERVER['DOCUMENT_ROOT']."/data/php/check_login.php");
?>
<div class='mainPanelContent' id='Коты'>
    <h2 align='center'>Коты</h2>
    <div style='height:5%;'>
        <input type='button' value='Назад' onclick='changeFrameTo(previousPage.pop(),"","back")'>
    </div>
    <div>
        <p>В обычных подземельях и зале тишины можно встретить котов в труднодоступных местах. За поднятие можно получить достижение.</p>
    </div>
</div>