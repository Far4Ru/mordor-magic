<?php

session_start();
include($_SERVER['DOCUMENT_ROOT'] . "/data/php/check_login.php");

?>
<div class='mainPanelContent' id='Общая информация'>

    <h2 align='center' style='font-size:1.1em;color:white'>Заметки</h2>

    <div>
        <p>
            <textarea  id='profileNotes'></textarea>
        </p>
        <p align='right' style='margin-right:2%;'><input type='button' value='Сохранить' onclick='saveProfileNotes()'>
        </p>
    </div>


</div>
<script>
    getProfileNotes();
</script>