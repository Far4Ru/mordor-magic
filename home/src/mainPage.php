<?php

session_start();
include($_SERVER['DOCUMENT_ROOT']."/data/php/check_login.php");
require_once $_SERVER['DOCUMENT_ROOT']."/data/php/check_device.php";

?>
<div class='mainPanelContent' id='База данных'>
    <h2 align='center'>Главная страница</h2>
    <p>Добро пожаловать! Приятной игры.</p>
    <BR>
    <style>
        #newsBlock img{
            margin-left:21%;
            width:50%;
            height:auto;
        }
        #newsBlock img .miniImg{
            margin-left:36%;
            width:20%;
            height:auto;
        }
        #newsBlockShell{
            <?php
               if($view_version=="Mobile"){
                   echo "width:98%;";
                   echo "height:50%;";
               }
               else{
                   echo "width:54%;";
                   echo "height:88%;";
               }
            ?>
            background-color:rgba(30,30,30,0.3);
            overflow-y:auto;
            direction:rtl;
            margin-left:1%;
            display:inline-block;
        }
        #newsBlock .postTitle{
            margin-top:4%;
            margin-bottom:2%;
            text-indent:0;
        }
        #newsBlock .postTitleReference{
            font-size:1em;
        }
        #newsBlock .postTitleDescription, #newsBlock .postTitleDescription p{
            color:rgba(180,180,180,0.8);
            margin: 6px;
            margin-left: 2%;
            margin-right: 2%;
            word-wrap:break-word;
        }
        #rightInfoBlock{
            overflow-y: auto;
            vertical-align: top;
            background-color:rgba(30,30,30,0.3);

            <?php
               if($view_version=="Mobile"){
                   echo "width:98%;";
                   echo "height:96%;";
                   echo "margin-left:1%;";
                   echo "margin-top:2%;";
               }
               else{
                   echo "width:38%;";
                   echo "height:88%;";
                   echo "margin-left:2%;";
               }
            ?>
            display:inline-block;
        }
    </style>
    <script>
        document.title = "Главная | Гильдия MORDOR";
        newsBlock = document.getElementById('newsBlock');
        /*

        RSS_YANDEX_GENERAL_INFO = 'http://news.yandex.ru/index.rss';
        RSS_RIA_NEWS = 'http://www.ria.ru/export/rss2/index.xml';
        RSS_AIF = 'http://www.aif.ru/rss/all.php';
        RSS_KODGES = 'http://www.kodges.ru/rss.xml';
        RSS_POVARENOK = 'http://www.povarenok.ru/rss/recipes/';
        RSS_YOUTUBE_KUPLINOV = 'https://www.youtube.com/feeds/videos.xml?channel_id=UCdKuE7a2QZeHPhDntXVZ91w';
        RSS_DOTABUFF = 'https://www.dotabuff.com/blog.rss';
        RSS_REDDIT_DOTA2 = 'https://www.reddit.com/r/DotA2/.rss?format=xml';
        RSS_REDDIT_FREE_GAMES_ON_STEAM = 'https://www.reddit.com/r/FreeGamesOnSteam/.rss?format=xml';
        RSS_REDDIT_GAME_DEALS = 'https://www.reddit.com/r/GameDeals/.rss?format=xml';

        VK_PAGE_ID_ETERNAL_MAGIC = 'eternalmagic101xp';
        VK_NEWS_KEYWORD_MORDOR = '#Middle_Earth';
        RSS_TYPE_SEARCH = 'search';

        */

        function displayRSS(name){
            $.post('/data/php/get_rss.php',{'name':name}).done(function(html){
                newsBlock.innerHTML = html;
            });
        }

        function globalUpdate(){
            button = document.getElementById('globalUpdateButton');
            button.setAttribute("disabled", "true");
            Swal.fire({
                title: 'Обновить?',
                text: 'Обновятся все новостные ленты.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Да, обновить!',
                cancelButtonText: 'Отмена'

            }).then((result) =>{
                if(result.value) {
                    $.post('/update.php').done(function(){
                        displayRSS('VK_PAGE_ID_ETERNAL_MAGIC');
                        button.removeAttribute("disabled");
                        Swal.fire(
                            'Обновление завершено!',
                            'Все новостные ленты были обновлены.',
                            'success'
                        );
                    });
                }
                else{
                    button.removeAttribute("disabled");
                }
            });
        }

    </script>
    <p>Новости:
        <input type='button' value='Eternal Magic' onclick='displayRSS("VK_PAGE_ID_ETERNAL_MAGIC")'>
        <input type='button' value='MORDOR' onclick='displayRSS("VK_NEWS_KEYWORD_MORDOR")'>
        <input type='button' value='Главное' onclick='displayRSS("RSS_YANDEX_GENERAL_INFO")'>
        <input type='button' value='РИА' onclick='displayRSS("RSS_RIA_NEWS")'>
        <input type='button' value='Арг-ты и Факты' onclick='displayRSS("RSS_AIF")'>
        <input type='button' value='Kuplinov' onclick='displayRSS("RSS_YOUTUBE_KUPLINOV")'>
        <input type='button' value='Рецепты' onclick='displayRSS("RSS_POVARENOK")'>
        <button id='globalUpdateButton' style='font-size:1.2em;width:3%;height:4%;background:none;border:none;' onclick='globalUpdate()'>&#x1F504</button>
    </p>
    <div id='newsBlockShell'>
    <div style='direction:ltr;' id='newsBlock'></div>
    </div>
    <div id='rightInfoBlock'>
        <h2 align='center' style='font-size:1.1em;color:white'>Панель управления</h2>
        <button class='rightInfoBlockButton' title='Объявления' onclick='changeFrameTo("announcements",PAGES_PREFIX)'>&#x1F4DC</button>
        <button class='rightInfoBlockButton' title='Таблица заданий' onclick='next_profile_page="task_table";changeFrameTo("profile",PAGES_PREFIX);'>&#x1F4CA</button>
        <button class='rightInfoBlockButton' title='Поиск' onclick='changeFrameTo("search",PAGES_PREFIX)'>&#x1F50D</button>
        <button class='rightInfoBlockButton' title='Заявки' onclick='next_profile_page="memberlist";changeFrameTo("profile",PAGES_PREFIX);'>&#x1F4E3</button>
        <button class='rightInfoBlockButton' title='Чат' onclick='next_chat_page="general";changeFrameTo("chat",PAGES_PREFIX)'>&#x1F4AC</button>
        <button class='rightInfoBlockButton' title='События' onclick='changeFrameTo("events",PAGES_PREFIX)'>&#x1F4C6</button>
        <button class='rightInfoBlockButton' title='Аркады' onclick='changeFrameTo("games",PAGES_PREFIX)'>&#x1F3AF</button>
        <button class='rightInfoBlockButton' title='Заметки' onclick='next_profile_page="notes";changeFrameTo("profile",PAGES_PREFIX);'>&#x1F5D2</button>
        <button class='rightInfoBlockButton' title='Загрузки' onclick='changeFrameTo("download",PAGES_PREFIX)'>&#x1F4BE</button>
        <button class='rightInfoBlockButton' title='Ежедневные цели' onclick='changeFrameTo("dailyGoal",PAGES_PREFIX)'>&#x1F5D3</button>
        <button class='rightInfoBlockButton' title='Закладки' onclick='next_bookmarks_page="profile";changeFrameTo("bookmarks",PAGES_PREFIX)'>&#x1F516</button>
        <button class='rightInfoBlockButton' title='Настройки' onclick='next_profile_page="settings";changeFrameTo("profile",PAGES_PREFIX)'>⚙️</button>

    </div>
    <script>

        mainPanelContent = document.getElementById('mainFrame');
        mainPanelContent.scrollTop = mainPanelContent.scrollHeight;

        displayRSS('VK_PAGE_ID_ETERNAL_MAGIC');
    </script>
</div>