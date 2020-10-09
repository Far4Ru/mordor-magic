<?php

session_start();
include($_SERVER['DOCUMENT_ROOT'] . "/data/php/check_login.php");
$role = $_SESSION['role'];
?>
<div class='mainPanelContent' id='Вычисления'>

    <h2 align='center' style='font-size:1.1em;color:white'>Вычисления</h2>
    <h3>Постройка и улучшение зданий, изучение магии</h3>
    <p>Время: <input id='guildBuildTime' type='number' onchange='calculateGuildBuild()'> мин.</p>
    <p>Время завершения: <span id='guildBuildResult'></span></p>
    <h3>Репутация</h3>
    <p>Тек. репутация: <input type='number' id='guildReputationValue' onchange='calculateGuildReputation()'> репутации</p>
    <p>Снижение репутации:  <input type='number' id='guildReputationChange' onchange='calculateGuildReputation()' value='72'> репутации/час</p>
    <p>Время: <span id='guildReputationResult'></span></p>


</div>
<script>
    function calculateGuildBuild(){
        guildBuildTime = document.getElementById('guildBuildTime').value;
        timeArray = [['н',Math.floor(guildBuildTime / 10080 % 52)],['д',Math.floor(guildBuildTime / 1440 % 7)],['ч',Math.floor(guildBuildTime / 60 % 24)],['м',Math.floor(guildBuildTime % 60)]];
        document.getElementById('guildBuildResult').innerHTML = '';
        timeArray.forEach(showGuildBuildResult);
        function showGuildBuildResult(item){
            if(item[1] != 0){
                document.getElementById('guildBuildResult').innerHTML += ' ' + item[1] + ' ' + item[0];
            }
        }
    }
    function calculateGuildReputation(){
        guildReputationValue = document.getElementById('guildReputationValue').value;
        guildReputationChange = document.getElementById('guildReputationChange').value;
        guildReputationResult = Math.floor(guildReputationValue / guildReputationChange);
        timeArray = [['н',Math.floor(guildReputationResult / 168 % 52)],['д',Math.floor(guildReputationResult / 24 % 7)],['ч',Math.floor(guildReputationResult % 24)]];
        document.getElementById('guildReputationResult').innerHTML = '';
        timeArray.forEach(showGuildReputationResult);
        function showGuildReputationResult(item){
            if(item[1] != 0){
                document.getElementById('guildReputationResult').innerHTML += ' ' + item[1] + ' ' + item[0];
            }
        }
    }
</script>