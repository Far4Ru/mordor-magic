<?php
session_start();
include($_SERVER['DOCUMENT_ROOT']."/data/php/check_login.php");
?>
<div class='mainPanelContent' id='Камень призыва'>
    <h2 align='center'>Камень призыва</h2>
    <input type='button' value='Назад' onclick='changeFrameTo(previousPage.pop(),"","back")'>
    <div>
        <p>Камень призыва находится у входа в каждое героическое подземелье или хаос. Выглядит как высокая заострённая каменная глыба, окружённая пятью низкими камнями. Призвать можно, выбрав остальных участников в отряде по одному и нажав на камень призыва.</p>
    </div>
</div>