<?php
session_start();
include($_SERVER['DOCUMENT_ROOT']."/data/php/check_login.php");
?>
<div class='mainPanelContent' id='Активность'>
    <h2 align='center'>Активность</h2>
    <div style='height:5%;'>
        <input type='button' value='Назад' onclick='changeFrameTo(previousPage.pop(),"","back")'>
    </div>
    <div>
        <p>Активность отображается в Кристалле хаоса(I) в виде очков активности. Активность набирается путем участия и завершения ежедневных событий. Когда активность достигает 120, 240 и 360 очков, выдается сундук, содержащий небольшие награды и энергию.</p>
    </div>
</div>