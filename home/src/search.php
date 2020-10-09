<?php

session_start();
include($_SERVER['DOCUMENT_ROOT']."/data/php/check_login.php");

?>
<div class='mainPanelContent' id='Поиск'>
    <h2 align='center'>Поиск</h2>
    <div class='menuPanelButtons' onclick='changeFrameTo("event_search_book_restoration",SEARCH_PAGES_PREFIX)'><p class='pButton'>Реставрация книг</p>
    </div>

    <BR>

    <div class='menuPanelButtons' onclick='changeFrameTo("event_search_quiz_irene",SEARCH_PAGES_PREFIX)'>
        <p style='color:grey' class='pButton'>Викторина Айрин</p>
    </div>

    <BR>

    <div class='menuPanelButtons' onclick='changeFrameTo("event_search_super_quiz",SEARCH_PAGES_PREFIX)'>
        <p style='color:grey' class='pButton'>Супервикторина</p>
    </div>

    <BR>

    <div class='menuPanelButtons' onclick='changeFrameTo("event_search_super_quiz_final",SEARCH_PAGES_PREFIX)'>
        <p style='color:grey' class='pButton'>Финал супервикторины</p>
    </div>

</div>
<script>
    document.title = "Поиск | Гильдия MORDOR";
</script>
