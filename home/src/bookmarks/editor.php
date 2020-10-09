<?php

session_start();
setlocale(LC_ALL, "ru_RU.UTF-8");
date_default_timezone_set('Europe/Moscow');
include($_SERVER['DOCUMENT_ROOT'] . "/data/php/check_login.php");
$role = $_SESSION['role'];

$id = $_SESSION['id'];
?>

<div class='mainPanelContent' id='Редакция'>

    <h2 align='center' style='font-size:1.1em;color:white'>Редакция</h2>

    <h3>Добавить категорию</h3>
    <p>Категория <input type='text' placeholder='Игры' id='category_name'></p>
    <p>Обозначение количества <input type='text' placeholder='Уровни' id='category_values'></p>
    <p>Обозначение авторства <input type='text' placeholder='Разработчик' id='category_author'></p>
    <p><input type='button' value='Добавить' onclick='add_category()'></p>

    <h3>Создать страницу</h3>
    <p>Имя <input type='text' placeholder='Eternal Magic' id='page_name'></p>
    <p>Автор <input type='text' placeholder='Duoyi Network' id='page_author'></p>
    <p>Категория <input type='text' placeholder='Игры' id='page_category'></p>
    <p>Значение <input type='text' placeholder='70' id='page_value'></p>
    <p><input type='button' value='Создать' onclick='create_page()'></p>

    <h3>Добавить жанр к странице</h3>
    <p>Страница <input type='text' placeholder='Eternal Magic' id='add_genre_page'></p>
    <p>Жанр <input type='text' placeholder='MMORPG' id='add_genre_name'></p>
    <p>Процент <input type='number' placeholder='90' min='1' max='100' id='add_genre_percent'></p>
    <p><input type='button' value='Добавить' onclick='add_genre()'></p>

</div>

<script>
    today = '<?php echo strftime ("%d.%m.%Y"); ?>';
    id = 0 <?php echo "+".$id; ?>;
    function add_category(){
        name = document.getElementById('category_name').value;
        value = document.getElementById('category_values').value;
        author = document.getElementById('category_author').value;
        $.post('/data/php/bookmarks/add_category.php',{'id':id,'name':name,'value':value,'author':author}).done(function(response){
            if(response == 'Успешно'){
                Swal.fire(
                    'Успешно',
                    'Добавена новая категория.',
                    'success'
                );
            }
            else{
                Swal.fire(
                    'Не удалось',
                    'Добавить новую категорию не удалось.',
                    'error'
                );
            }
        });
    }
    function create_page(){
        name = document.getElementById('page_name').value;
        author = document.getElementById('page_author').value;
        category = document.getElementById('page_category').value;
        value = document.getElementById('page_value').value;

        $.post('/data/php/bookmarks/create_page.php',{'id':id,'name':name,'value':value,'author':author,'date':today,'category':category}).done(function(response){
            if(response == 'Успешно'){
                Swal.fire(
                    'Успешно',
                    'Страница успешно создана.',
                    'success'
                );
            }
            else{
                Swal.fire(
                    'Не удалось',
                    'Страницу создать не удалось.',
                    'error'
                );
            }
        });
    }
    function add_genre(){
        page = document.getElementById('add_genre_page').value;
        genre = document.getElementById('add_genre_name').value;
        percent = document.getElementById('add_genre_percent').value;

        $.post('/data/php/bookmarks/add_genre.php',{'id':id,'page':page,'genre':genre,'percent':percent}).done(function(response){
            if(response == 'Успешно'){
                Swal.fire(
                    'Успешно',
                    'Жанр добавлен.',
                    'success'
                );
            }
            else{
                Swal.fire(
                    'Не удалось',
                    'Добавить жанр не удалось',
                    'error'
                );
            }
        });
    }
</script>