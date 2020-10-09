<?php

session_start();
include($_SERVER['DOCUMENT_ROOT'] . "/data/php/check_login.php");
$role = $_SESSION['role'];
?>

<div class='mainPanelContent' id='Обновления'>

    <h2 align='center' style='font-size:1.1em;color:white'>Обновления</h2>

    <p>Пока обновлений нет</p>

</div>