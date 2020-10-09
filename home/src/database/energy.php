<?php
session_start();
include($_SERVER['DOCUMENT_ROOT']."/data/php/check_login.php");
?>
<div class='mainPanelContent' id='Энергия'>
    <h2 align='center'>Энергия</h2>
    <div style='height:5%;'>
        <input type='button' value='Назад' onclick='changeFrameTo(previousPage.pop(),"","back")'>
    </div>
    <div>
        <p>Энергия используется в изготовлении предметов и при отправке сообщений в чат Мир (10 единиц).</p>
        <p>Получить энергию можно за активность, отдых в усадьбе и таблетками энергии.</p>
    </div>
</div>