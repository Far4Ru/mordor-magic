<?php
session_start();
include($_SERVER['DOCUMENT_ROOT']."/data/php/check_login.php");
?>
<div class='mainPanelContent' id='Питомцы'>
    <h2 align='center'>Питомцы</h2>
    <div style='height:5%;'>
        <input type='button' value='Назад' onclick='changeFrameTo(previousPage.pop(),"","back")'>
    </div>
    <div>
        <p>Начальный питомец Муни полезен и эффективен в начале игры. Навык пробуждения Муни наносит урон вокруг и обездвиживает некоторых монстров. Подвеска с райской вехой, получаемая каждым игроком со временем, усиливает от нее урон.</p>
    </div>
</div>