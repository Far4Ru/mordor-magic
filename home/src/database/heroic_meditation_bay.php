<?php
session_start();
include($_SERVER['DOCUMENT_ROOT']."/data/php/check_login.php");
?>
<div class='mainPanelContent' id='Бухта медитации (Герой)'>
    <h2 align='center'>Бухта медитации</h2>
    <div style='height:5%;'>
        <input type='button' value='Назад' onclick='changeFrameTo(previousPage.pop(),"","back")'>
    </div>
    <div>
    <p>1 Босс:</p>
    <p>Может появиться прицел над головой и идти от босса красная линия, урона можно избежать, спрятавшись от босса за стойким игроком (танком), расстояние не важно.</p>
    <p>2 Босс:</p>
    <p>Избегать красных зон.</p>
    <p>3 Босс:</p>
    <p>Босс призывает мобов с двух сторон. Ближние могут вырасти и нанести большой урон одному игроку. Дальние могут призвать молнии, которые наносят большой урон всем игрокам. После снижения хп босса меньше половины, босс перестает призывать мобов и может вызвать шары, исходящие от него волнами, во время которых лучше отойти и пробегать между ними.</p>
    </div>
</div>