<?php
    include ("db_connect.php");
    setlocale(LC_ALL, "ru_RU.UTF-8");
    date_default_timezone_set('Europe/Moscow');
    if(isset($_POST['id']) && isset($_POST['recipientId']) && isset($_POST['text'])){
        $id = $_POST['id'];
        $recipient_id = $_POST['recipientId'];
        $text = $_POST['text'];
        $date = strftime ("%d.%m.%Y %H:%M:%S");
        $query = "INSERT INTO chat_messages (user_id,message_text,recipient_id,message_date) VALUES ($id, '$text',$recipient_id,'$date');";
        if(mysqli_query($db, $query)){
            echo "Успешно";
        }
        else{
            echo "Не удалось";
            $error = mysqli_error($db);
        }
    }