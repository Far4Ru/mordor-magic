<?php
session_start();
include($_SERVER['DOCUMENT_ROOT']."/data/php/check_login.php");
?>
<div class='mainPanelContent' id='Достижения'>
    <h2 align='center'>Достижения</h2>
    <div style='height:5%;'>
        <input type='button' value='Назад' onclick='changeFrameTo(previousPage.pop(),"","back")'>
    </div>
    <div>
        <p>Достижения(Y)</p>
        <p>Выполняя достижения открываются этапы достижений, переходя на каждый из которых можно получить разные награды и титулы, дающие бонус к силе атаки, атаки питомца и снижению получаемого урона.</p>

    </div>
</div>