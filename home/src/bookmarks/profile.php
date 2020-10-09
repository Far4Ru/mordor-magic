<?php

session_start();
include($_SERVER['DOCUMENT_ROOT'] . "/data/php/check_login.php");
$role = $_SESSION['role'];

$id = $_SESSION['id'];
?>

<div class='mainPanelContent' id='Профиль'>

    <h2 align='center' style='font-size:1.1em;color:white'>Профиль</h2>

    <h3>Добавить закладку</h3>
    <p>Страница <input type='text' placeholder='Eternal Magic' id='bookmark_name'></p>
    <p>Прогресс
        <select id='bookmark_progress'>
            <option value='В процессе'>В процессе</option>
            <option value='Планируется'>Планируется</option>
            <option value='Отложено'>Отложено</option>
            <option value='Заброшено'>Заброшено</option>
            <option value='Завершено'>Завершено</option>
        </select>
    </p>
    <p>Значение <input type='number' placeholder='70' min='0' id='bookmark_value'></p>
    <p>Оценка
        <select id='bookmark_score'>
            <option disabled>Выберите оценку</option>
            <option value='10'>(10) Шедевр</option>
            <option value='9'>(9) Отлично</option>
            <option value='8'>(8) Очень хорошо</option>
            <option value='7'>(7) Хорошо</option>
            <option value='6'>(6) Неплохо</option>
            <option value='5'>(5) Нормально</option>
            <option value='4'>(4) Плохо</option>
            <option value='3'>(3) Очень плохо</option>
            <option value='2'>(2) Ужасно</option>
            <option value='1'>(1) Отвратительно</option>
        </select>
    </p>
    <p><input type='button' value='Добавить' onclick='addBookmark()'></p>
</div>
<script>
    id = 0 <?php echo "+".$id; ?>;
    function addBookmark(){
        name = document.getElementById('bookmark_name').value;
        progress = document.getElementById('bookmark_progress').options[document.getElementById('bookmark_progress').selectedIndex].value;
        value = document.getElementById('bookmark_value').value;
        score = document.getElementById('bookmark_score').options[document.getElementById('bookmark_score').selectedIndex].value;

        $.post('/data/php/bookmarks/add_bookmark.php',{'id':id, 'name':name,'progress':progress,'value':value,'score':score}).done(function(response){
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