<?php

session_start();
include($_SERVER['DOCUMENT_ROOT'] . "/data/php/check_login.php");
$id = $_SESSION['id'];

?>
<div class='mainPanelContent' id='Общая информация'>

    <h2 align='center' style='font-size:1.1em;color:white'>Настройки</h2>
    <h3>Пароль</h3>
    <p>Старый пароль <input style='width:35%' placeholder='Пароль' type='password' id='oldUserPassword'></p><p>Новый пароль <input style='width:35%' placeholder='Пароль' type='password' id='newUserPassword'></p><p><input type='button' value='Изменить' onclick='changeUserPassword()'></p>

</div>
<script>

    function changeUserPassword(){
        oldUserPassword = document.getElementById('oldUserPassword').value;
        newUserPassword = document.getElementById('newUserPassword').value;
        id = 0<?php echo "+".$id; ?>;
        $.post('/data/php/change_user_password.php',{'id':id,'old':oldUserPassword,'new':newUserPassword}).done(function(response){
            if(response == 'Успешно'){
                Swal.fire(
                    'Успешно!',
                    'Пароль успешно изменен.',
                    'success'
                );
                changeFrameTo("settings",PROFILE_PAGES_PREFIX,"","#profileBlock");
            }
            else if(response == 'Неверный пароль'){
                Swal.fire(
                    'Неверный пароль',
                    'Старый пароль неверен.',
                    'warning'
                );
            }
            else{
                Swal.fire(
                    'Ошибка',
                    'Не удалось изменить пароль.',
                    'error'
                );
            }
        });

    }
</script>