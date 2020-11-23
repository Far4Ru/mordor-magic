<?php

session_start();
include($_SERVER['DOCUMENT_ROOT'] . "/data/php/check_login.php");

$id = $_SESSION['id'];
?>
<div class='mainPanelContent' id='Общая информация'>

    <h2 align='center' style='font-size:1.1em;color:white'>Заметки</h2>

    <div>
        <p>
            <textarea  id='profileNotes'></textarea>
        </p>
        <p align='right' style='display:inline;margin-left:78%;'><input type='button' value='Архив' onclick='archiveProfileNotes()'></p>
        <p align='right' style='display:inline;margin-left:3%;'><input type='button' value='Сохранить' onclick='saveProfileNotes()'></p>
    </div>


</div>
<script>
    getProfileNotes();

    function archiveProfileNotes(){
        id = 0<?php echo "+".$id; ?>;
        $.post('/data/php/archive_profile_notes.php',{'id':id}).done(function(){

            Swal.fire(
                'Архивация завершена!',
                'Заметки успешно помощены в архив.',
                'success'
            );
            getProfileNotes();
        });
    }
</script>