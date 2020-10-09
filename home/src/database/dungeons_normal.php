<?php
session_start();
include($_SERVER['DOCUMENT_ROOT']."/data/php/check_login.php");
?>
<div class='mainPanelContent' id='Обычные подземелья'>
    <h2 align='center'>Обычные подземелья</h2>
    <div style='height:5%;'>
        <input type='button' value='Назад' onclick='changeFrameTo(previousPage.pop(),"","back")'>
    </div>
    <div>
        <p>Прохождение обычыные подземелий дает опыт, звездную пыль (за разбор снаряжения), а также за первые три прохождения сундук с камнями духа и рунами.</p>
        <p>Войти можно зайдя в Кристалл Хаоса(I), выбрав вкладку Поздемелье и нажав на кнопку Войти (если собран отряд или отряд уже в подземелье), либо Найти отряд (если никого в отряде нет).</p>
    </div>
</div>