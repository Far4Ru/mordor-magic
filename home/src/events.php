<?php

session_start();
include($_SERVER['DOCUMENT_ROOT']."/data/php/check_login.php");

?>
<div class='mainPanelContent' id='База данных'>
    <h2 align='center'>События</h2>
    <p>Понедельник - вечер - Алтарь близнецов 1.</p>
    <p>Пятница - вечер - Алтарь близнецов 1.</p>
    <p>Раз в неделю - Барьер измерений.</p>
    <p>Ежедневно - Охота на элиту.</p>

    <BR><p>Заполнить событие:</p>
    <p>Событие*
        <input type='text' list='groupEvents' placeholder='Название события' id='newEventName'>
        участники*
        <input type='text' placeholder='Количество участников' id='playersCount'>
        дата*
        <input type='text' placeholder='Дата' title='В формате ДД.ММ.ГГ' id='newEventDate'>
        время
        <input type='text' placeholder='Время' id='newEventTime'>
        <input type='button' id='createEventCreationButton' value='Заполнить' onclick='createEventCreation()'>
    </p>
    <div id='eventCreationField'>
    </div>
    <datalist id='groupEvents'>
        <option value="Алтарь близнецов 1">
        <option value="Алтарь близнецов 2">
        <option value="Зал тишины 1">
        <option value="Зал тишины 2">
        <option value="Зал тишины 3">
        <option value="Храм Акамана 1">
        <option value="Храм Акамана 2">
        <option value="Путь паломника 1">
        <option value="Путь паломника 2">
        <option value="Охота на элиту">
    </datalist>
    <datalist id='guildList'>
        <option value="MORDOR">
        <option value="OnlineGamesTV">
        <option value="ЛИГА">
        <option value="БДСМ">
        <option value="Empire">
        <option value="MyWay">
        <option value="DOMINANCE">
    </datalist>
    <datalist id='playersList'>
        <option value="Фарару">
        <option value="Eternalia">
        <option value="Ioanna">
        <option value="Лавинья">
        <option value="ksesha">
        <option value="Ksesha23">
        <option value="Karil">
        <option value="Карил">
        <option value="КирсанКайфат">
        <option value="Jok313">
        <option value="OlgaMisschanel">
        <option value="Нандалее">
        <option value="Ретар">
        <option value="Дезмонд">
        <option value="Гезер">
        <option value="Zerato">
        <option value="Suntory">
        <option value="Helly">
    </datalist>
    <datalist id='bossesList'>
        <option value="1">
        <option value="1-2">
        <option value="2">
        <option value="2-3">
        <option value="3">
        <option value="1,3">
    </datalist>
    <BR><p>Пройденные события: <input type='button' id='changePassedEventsBlockButton' onclick='changePassedEventsBlock()' style='margin-left:75%;' value='Развернуть'></p>
    <div style='height:26%;width:99%;margin-left:1%;overflow-y:auto;direction: rtl;background-color:rgba(30,30,30,0.3);' id='passedEventsScrollBlock'>
    <div style='direction:ltr;'>
    <?php
        $PAST_EVENTS_FILE_PATH = $_SERVER['DOCUMENT_ROOT'].'/data/past_events/past_events.xml';
        if (file_exists($PAST_EVENTS_FILE_PATH)) {
            $past_events = simplexml_load_file($PAST_EVENTS_FILE_PATH);
            foreach ($past_events->event as $event) {
                echo "<p>".$event->date." - ".$event->name;
                if($event->time){
                    echo " <i>".$event->time."</i>";
                }
                echo ": ";
                $comma_counter=0;
                foreach($event->players->player as $player){
                    switch($player->class){
                        case "Рыцарь":
                            $player_class = 'knight';
                            break;
                        case "Мечник":
                            $player_class = 'swordsman';
                            break;
                        case "Жрец":
                            $player_class = 'priest';
                            break;
                        case "Маг":
                            $player_class = 'mage';
                            break;
                        case "Ассасин":
                            $player_class = 'assassin';
                            break;
                        case "Стрелок":
                            $player_class = 'gunner';
                            break;
                        default:
                            $player_class = 'none';
                    }
                    echo "<b title='".$player->guild."' class='color_nickname_".$player_class."'>".$player->nickname."</b>";
                    if($player->bosses){
                        echo " (".$player->bosses.")";
                    }
                    $comma_counter++;
                    if($comma_counter < count($event->players->player)){
                        echo ", ";
                    }
                    else{
                        echo "";
                    }
                }
                echo".</p>";
            }
        }

    ?>
    </div>
    </div>

</div>
<script>
    passedEventsScrollBlock = document.getElementById('passedEventsScrollBlock');
    passedEventsScrollBlock.scrollTop = passedEventsScrollBlock.scrollHeight;
    newEventNameElement = document.getElementById('newEventName');
    newEventPlayersCountElement = document.getElementById('playersCount');
    newEventDateElement = document.getElementById('newEventDate');
    newEventTimeElement = document.getElementById('newEventTime');
    createEventCreationButton = document.getElementById('createEventCreationButton');

    function createEventCreation(){
        eventCreationFieldElement = document.getElementById('eventCreationField');
        changeDisabledParameterNewEventInputs('true');
        newEventPlayersCount = +newEventPlayersCountElement.value;
        eventCreationFieldElement.innerHTML= '';
        if(newEventPlayersCount){
            for(i=1;i<=newEventPlayersCount;i++){
                eventCreationFieldElement.innerHTML+='<p> Участник '+i+' <input type="text" class="newEventPlayer" placeholder="Имя" list="playersList"> <input type="text" list="guildList" class="newEventPlayerGuild" placeholder="Гильдия"> <select class="newEventPlayerClass"><option value="Мечник">Мечник</option><option value="Маг">Маг</option><option value="Рыцарь">Рыцарь</option><option value="Жрец">Жрец</option><option value="Ассасин">Ассасин</option><option value="Стрелок">Стрелок</option></select> <input type="text" class="newEventPlayerBosses" placeholder="Пройденные боссы" list="bossesList"></p>';
            }
            eventCreationFieldElement.innerHTML+='<p><input type="button" value="Создать" onclick="createGuildEvent()"><input type="button" value="Отменить" onclick="cancelEventCreation()"></p>';
        }
        else{
            changeDisabledParameterNewEventInputs('false');
        }

    }
    function changeDisabledParameterNewEventInputs(type){
        if(type=='true'){
            newEventNameElement.disabled=true;
            newEventPlayersCountElement.disabled=true;
            newEventDateElement.disabled=true;
            newEventTimeElement.disabled=true;

            createEventCreationButton.disabled=true;
        }
        else{
            newEventNameElement.value = '';
            newEventPlayersCountElement.value = '';
            newEventDateElement.value = '';
            newEventTimeElement.value = '';

            newEventNameElement.disabled=false;
            newEventPlayersCountElement.disabled=false;
            newEventDateElement.disabled=false;
            newEventTimeElement.disabled=false;

            createEventCreationButton.disabled=false;

        }
    }
    function cancelEventCreation(){
        eventCreationFieldElement.innerHTML= '';
        changeDisabledParameterNewEventInputs('false');

    }
    function createGuildEvent(){
        eventName = newEventNameElement.value;
        players = document.getElementsByClassName('newEventPlayer');
        classes = document.getElementsByClassName('newEventPlayerClass');
        guilds = document.getElementsByClassName('newEventPlayerGuild');
        bosses = document.getElementsByClassName('newEventPlayerBosses');
        timeEvent = newEventTimeElement.value;
        dateEvent = newEventDateElement.value;
        var players = Array.prototype.map.call(players, function(element) {
            return element.value;
        });
        var classes = Array.prototype.map.call(classes, function(element) {
                    return element.options[element.selectedIndex].value;
                });
        var bosses = Array.prototype.map.call(bosses, function(element) {
                    return element.value;
                });
        var guilds = Array.prototype.map.call(guilds, function(element) {
                    return element.value;
                });
        if(eventName){
            $.post('/data/php/create_post_event.php',{'eventName':eventName,'players':players,'classes':classes,'guilds':guilds,'bosses':bosses,'timeEvent':timeEvent,'dateEvent':dateEvent}).done(function(){
            reloadEventsPage();
            });
        }
    }
    function changePassedEventsBlock(){
        changePassedEventsBlockButton = document.getElementById('changePassedEventsBlockButton');
        switch(passedEventsScrollBlock.style.height){
            case '26%':
                changePassedEventsBlockButton.style.marginLeft='76%';
                changePassedEventsBlockButton.value = 'Свернуть';
                passedEventsScrollBlock.style.height = '89%';
                break;
            case '89%':
                changePassedEventsBlockButton.style.marginLeft='75%';
                changePassedEventsBlockButton.value = 'Развернуть';
                passedEventsScrollBlock.style.height = '26%';
                break;
            default:
                changePassedEventsBlockButton.style.marginLeft='75%';
                changePassedEventsBlockButton.value = 'Развернуть';
                passedEventsScrollBlock.style.height = '26%';
        }
    }

    function reloadEventsPage(){
        changeFrameTo("events",PAGES_PREFIX);
    }
</script>

<script>
    document.title = "События | Гильдия MORDOR";
</script>