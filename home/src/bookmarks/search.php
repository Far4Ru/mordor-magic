<?php

session_start();
include($_SERVER['DOCUMENT_ROOT'] . "/data/php/check_login.php");
$role = $_SESSION['role'];
$id = $_SESSION['id'];
?>

<div class='mainPanelContent' id='Поиск'>
    <style>
        #outputSearchBlockShell{
            overflow-y:auto;
            direction:rtl;
            margin-left:1%;
            display:inline-block;
        }
        #bookmarks_page_search{
            margin-left: 10%;
            display: inline-block;
            width: 80%;
        }
    </style>
    <h2 align='center' style='font-size:1.1em;color:white'>Поиск</h2>

    <h3>По страницам</h3>
    <input type='text' placeholder='Поиск' onkeydown='searchBookmarksPage()' id='bookmarks_page_search'>

    <div id='outputSearchBlockShell'>
        <div style='direction:ltr;' id='outputSearchBlock'>
        </div>
    </div>
</div>
<script>
    function searchBookmarksPage(){
        search_value = document.getElementById('bookmarks_page_search').value;
        $.post('/data/php/bookmarks/search_bookmarks_page.php',{'search_value':search_value}).done(function(html){
            document.getElementById('outputSearchBlock').innerHTML = html;
        });
    }

    id = 0 <?php echo "+".$id; ?>;
    function addBookmark(name){
        console.log(name);
        $.post('/data/php/bookmarks/add_bookmark.php',{'id':id, 'name':name,'progress':'В процессе','value':'NULL','score':'NULL'}).done(function(response){
            if(response == 'Успешно'){
                Swal.fire(
                    'Успешно',
                    'Закладка добавлена.',
                    'success'
                );
            }
            else{
                Swal.fire(
                    'Не удалось',
                    'Добавить закладку не удалось',
                    'error'
                );
            }
        });
    }
</script>