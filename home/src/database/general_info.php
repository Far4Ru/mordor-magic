<?php
session_start();
include($_SERVER['DOCUMENT_ROOT']."/data/php/check_login.php");
?>
<div class='mainPanelContent' id='Общая информация'>
    <h2 align='center'>Общая информация</h2>
    <div style='height:5%;'>
        <input type='button' value='Назад' onclick='changeFrameTo(previousPage.pop(),"","back")'>
    </div>
    <div>
        <p>Открыв чат, зажав Shift и нажав на предмет в инвентаре можно отобразить предмет в сообщении. Также можно отобразить питомцев, нажав на их иконки слева в окне питомцев, и координаты на карте, открыв карту и нажав на нужную точку.</p>
        <p>Рывок у земли спасает от получения урона при падении с большой высоты.</p>
        <p> В игре можно узнать текущий урон каждого игрока в отряде в процентах, а также свой в значении урона в секунду (дпс). Отобразить можно, зайдя в Систему, Параметры игры и отметив пункт Статистика битвы. Панель появляется рядом с чатом. В статистике также можно узнать урон питомцев, общий урон, полученный урон и количество единиц лечения.</p>
        <p>Получение предметов из сундуков можно спокойно пропускать. Выпавшие предметы определяются в момент открытия.</p>
        <p>Не подобранные предметы из сундуков подземелий приходят после исчезновения на почту.</p>
        <p>Некоторые украшения могут быть активными. Для быстрой активации можно переместить украшение со снаряжения на верхнюю панель быстрого доступа.</p>
        <p>В героических подземельях и хаосах после активации босса закрывается проход к нему и бесплатное воскрешение становится недоступным. За барьером игроки не могут лечить и атаковать. Поэтому до активации босса следует убедиться, что все зашли на поле босса.</p>
        <p>Войти в уже активированное обычное подземелье можно, зайдя в кристалл хаоса, вкладку подземелья и нажав Войти.</p>
        <p>Войти в уже активированное героическое подземелье или хаос можно, прибежав к порталу активированного подземелья и нажав на Войти, если игроки в подземелье не активировали битву с одним из боссов.</p>
        <p>Быстро выйти из подземелья после завершения можно, нажав на значок Выйти справа внизу. При этом стоит убедиться, что подземелье действительно завершено.</p>
        <p>Скопировать сообщение из чата можно, открыв строку чата и нажав канал справа от копируемого сообщения.</p>
        <p>Скорость передвижения на коне можно увеличить на 60 уровне за 2.5 млн. серебра у НПС в Валлунде рядом с конюшней.</p>
        <p>В астрологии можно и нужно уменьшать молитвой на 60% стоимость улучшения. Для молитвы лучше всего покупать фрагменты любого питомца по 1500 серебра у Брокера.</p>
        <p>В героическом подземелье некоторые классы могут использовать навык, призывающий моба через барьер до начала подземелья. Например, рыцарь может использовать флаг, закинув поближе к монстрам. Это может сэкономить десятки секунд.</p>
    </div>
</div>