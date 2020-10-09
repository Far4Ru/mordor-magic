<?php

session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/data/php/check_device.php";
include($_SERVER['DOCUMENT_ROOT']."/data/php/check_login.php");

?>
<style>
    #bookmarksBlockShell{
        <?php
            if($view_version=="Mobile"){
                echo "height:96%;";
                echo "width:98%;";
                echo "margin-left:1%;";
                echo "margin-top:2%;";
            }
            else{
                echo "height:94%;";
                echo "width:76%;";
                echo "margin-left:2%;";

            }
        ?>
        background-color:rgba(30,30,30,0.3);
        overflow-y:auto;
        direction:rtl;
        display:inline-block;
    }

    #leftBookmarksMenuBlock{
        <?php
            if($view_version=="Mobile"){
                echo "height:25%;";
                echo "width:98%;";
            }
            else{
                echo "height:94%;";
                echo "width:20%;";

            }
        ?>
        vertical-align: top;
        background-color:rgba(30,30,30,0.3);
        margin-left:1%;
        display:inline-block;
    }
    .profileMenuButtons{
        <?php
            if($view_version=="Mobile"){
                echo "height:50%;";
                echo "width:20%;";
                echo "display: inline-block;";
            }
            else{
                echo "height:10%;";
                echo "width:96%;";
                echo "display: block;";

            }
        ?>
        font-family: 'Roboto Slab';
        font-size: 0.9em;
        margin: 0 2% 0 2%;
    }
</style>
<div class='mainPanelContent' id='Закладки'>
    <h2 align='center'>Закладки</h2>

    <div id='leftBookmarksMenuBlock'>
        <input class='profileMenuButtons' type='button' value='Профиль' onclick='changeFrameTo("profile",BOOKMARKS_PAGES_PREFIX,"","#bookmarksBlock")'>
        <input class='profileMenuButtons' type='button' value='Мои закладки' onclick='changeFrameTo("my_bookmarks",BOOKMARKS_PAGES_PREFIX,"","#bookmarksBlock")'>
        <input class='profileMenuButtons' type='button' value='Поиск' onclick='changeFrameTo("search",BOOKMARKS_PAGES_PREFIX,"","#bookmarksBlock")'>
        <input class='profileMenuButtons' type='button' value='Рейтинг' onclick='changeFrameTo("rating",BOOKMARKS_PAGES_PREFIX,"","#bookmarksBlock")'>
        <input class='profileMenuButtons' type='button' value='Рекомендации' onclick='changeFrameTo("recommendations",BOOKMARKS_PAGES_PREFIX,"","#bookmarksBlock")'>
        <input class='profileMenuButtons' type='button' value='Обновления' onclick='changeFrameTo("updates",BOOKMARKS_PAGES_PREFIX,"","#bookmarksBlock")'>
        <input class='profileMenuButtons' type='button' value='Редакция' onclick='changeFrameTo("editor",BOOKMARKS_PAGES_PREFIX,"","#bookmarksBlock")'>
        <?php
            //<input class='profileMenuButtons' type='button' value='Редакция' onclick='changeFrameTo("edit",BOOKMARKS_PAGES_PREFIX,"","#bookmarksBlock")'>
        ?>
    </div>
    <div id='bookmarksBlockShell'>
        <div style='direction:ltr;' id='bookmarksBlock'>
        </div>
    </div>
</div>

<script>
    document.title = "Закладки | Гильдия MORDOR";
    mainPanelContent = document.getElementById('mainFrame');
    if (typeof next_chat_page !== 'undefined') {
        changeFrameTo(next_bookmarks_page,BOOKMARKS_PAGES_PREFIX,"","#bookmarksBlock");
    }
    else{
        changeFrameTo("profile",BOOKMARKS_PAGES_PREFIX,"","#bookmarksBlock");
    }
    mainPanelContent.scrollTop = mainPanelContent.scrollHeight;

</script>