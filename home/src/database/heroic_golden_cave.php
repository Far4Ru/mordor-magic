<?php
session_start();
include($_SERVER['DOCUMENT_ROOT']."/data/php/check_login.php");
?>
<div class='mainPanelContent' id='Золотой грот (Герой)'>
    <h2 align='center'>Золотой грот</h2>
    <div style='height:5%;'>
        <input type='button' value='Назад' onclick='changeFrameTo(previousPage.pop(),"","back")'>
    </div>
    <div>
    <p>1 Босс:</p>
    <p>Под конец может впасть в ярость, рев наносит урон спустя какое-то время, избегать вагонеток и кругов.</p>
    <p>2 Босс:</p>
    <p>Во время разрывов держаться подальше от босса, во время круга льда отгородиться от босса за камень и не стоять рядом с другими (можно выстроиться в ряд), избегать красных зон</p>
    <p>3 Босс:</p>
    <p>Во время волны перепрыгивать. Как только появляется детеныш, стоит переключиться на него. Танку следует подвести босса ближе к призванным детенышам. Избегать красных зон.</p>
    </div>
</div>