<?php

session_start();
include($_SERVER['DOCUMENT_ROOT'] . "/data/php/check_login.php");

?>
<div class='mainPanelContent' id='Поиск по реставрации книг'>
    <h2 align='center'>Поиск по <u title='Перейти на статью в базе данных' onclick='changeFrameTo("book_restoration",
        DATABASE_PAGES_PREFIX)'>реставрации книг</u></h2>
    <input type='button' value='Назад' onclick='changeFrameTo(previousPage.pop(),"","back")'>
    <p>Введите 3 первых слова в точности как в вопросе с большой буквы:</p>
    <p align='center' style='margin: 5px;'>
        <input style='width:25%;' id='searchBarInput' list='bookRestorationShortNames' type='text' placeholder='Например: Как связаны автор'>

        <datalist id='bookRestorationShortNames'>
            <?php
                $BOOK_RESTORATION_FILE_PATH = $_SERVER['DOCUMENT_ROOT'].'/data/book_restoration/book_restoration.xml';
                if (file_exists($BOOK_RESTORATION_FILE_PATH)) {
                    $book_restoration = simplexml_load_file($BOOK_RESTORATION_FILE_PATH);
                    foreach($book_restoration->restoration as $restoration){
                        echo "<option value='".$restoration->short_name."'>";
                    }
                }
            ?>
        </datalist>

        <input type='button' value='Найти' onclick='searchQuestion()'>
    </p>
    <div align='center' id='answerField'></div>
</div>
<script>
    BOOK_RESTORATION_FILES = '/data/book_restoration/';
    BOOK_RESTORATION_FILE_FORMAT = '.png';
    function searchQuestion() {
        var searchText = document.getElementById('searchBarInput').value;
        $.post('/data/php/search_book_restoration.php',{'question':searchText}).done(function(result){
            document.getElementById('searchBarInput').value = '';
            document.getElementById('answerField').innerHTML = result;
        });
    }
</script>