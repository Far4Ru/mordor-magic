<?php

session_start();
include($_SERVER['DOCUMENT_ROOT']."/data/php/check_login.php");

?>
<div class='mainPanelContent' id='База данных'>
    <h2 align='center'>Объявления</h2>
    <style>

        #announceBlockShell{
            height: 94%;
            width: 98%;
            background-color:rgba(30,30,30,0.3);
            overflow-y:auto;
            direction:rtl;
            margin-left:1%;
            display:inline-block;
        }
        #announceBlock .postTitle{
            margin-top:4%;
            margin-bottom:2%;
            text-indent:0;
        }
        #announceBlock .postTitleReference{
            font-size:1em;
        }
        #announceBlock .postTitleDescription, #announceBlock .postTitleDescription p{
            color:rgba(180,180,180,0.8);
            margin: 6px;
            margin-left: 2%;
            margin-right: 2%;
            word-wrap:break-word;
        }
    </style>

    <div id='announceBlockShell'>
    <div style='direction:ltr;' id='announceBlock'></div>
    </div>
    <?php
        //Admin/Balrog/Nazgul text -> Опубликовать

        /*
        ID Объявления
        Отправитель
        Время
        Текст

        Титул - Объявление Дата + Отправитель
        */
    ?>

</div>
<script>

    document.title = "Объявления | Гильдия MORDOR";
    displayRSS("RSS_MORDOR-MAGIC");
    function displayRSS(name){
        $.post('/data/php/get_rss.php',{'name':name}).done(function(html){
            announceBlock.innerHTML = html;
        });
    }
</script>