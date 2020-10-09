<?php

session_start();
include($_SERVER['DOCUMENT_ROOT']."/data/php/check_login.php");

?>
<div class='mainPanelContent' id='Аркады'>
    <h2 align='center'>Аркады</h2>


    <ul type="disk">
        <li>
            <a onclick='changeFrameTo("Town_Breaker:_Smaug_Attack","/data/games/Town_Breaker:_Smaug_Attack/")'>Town Breaker: Smaug Attack;</a>
        </li>
    </ul>
</div>

<script>
    document.title = "Игры | Гильдия MORDOR";
</script>