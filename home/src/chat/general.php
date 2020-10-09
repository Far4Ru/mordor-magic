<?php

session_start();
include($_SERVER['DOCUMENT_ROOT'] . "/data/php/check_login.php");
$role = $_SESSION['role'];
$id = $_SESSION['id'];

?>
<p style='color:grey;' align='center' onclick='totalMessagesNumber+=addMessagesNumber;loadMessages()'>Загрузить больше</p>

<div id='messageBlock'>
</div>

<script>
    recipientId = 0;
    addMessagesNumber = 10;
    totalMessagesNumber = addMessagesNumber;
    messagesNumber = 0;
    loadMessages();
    chatBlockShell = document.getElementById('chatBlockShell');
    chatBlockShell.scrollTop = chatBlockShell.scrollHeight;
</script>