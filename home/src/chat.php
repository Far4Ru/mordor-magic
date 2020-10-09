<?php

session_start();
include($_SERVER['DOCUMENT_ROOT']."/data/php/check_login.php");

$id = $_SESSION['id'];
?>
<style>

    #chatBlockShell{
        height:80%;
        width:100%;
        background-color:rgba(30,30,30,0.2);
        overflow-y:auto;
        direction:rtl;
        //margin-top:2%;
    }
    #generalChatBlock{
        vertical-align: top;
        height:94%;
        width:57%;
        margin-left:2%;
        display:inline-block;
    }

    #leftChatBlock, #rightChatBlock{
        vertical-align: top;
        background-color:rgba(30,30,30,0.3);
        width:18%;
        height:94%;
        margin-left:1%;
        display:inline-block;
    }
    #rightChatBlock{
        margin-left:2%;
    }
    #topChatBlock, #bottomChatBlock{
        background-color:rgba(30,30,30,0.3);
        width:100%;
        height:10%;
    }
    #bottomChatBlock{
        //margin-top:2%;
    }
    .chatBlockItems{
        font-family: 'Roboto Slab';
        display: block;
        font-size: 0.8em;
        width: 96%;
        height: 10%;
        margin: 0 2% 0 2%;
    }
    #bottomChatBlock div,#topChatBlock div{
        height:100%;
        vertical-align:top;
        display:inline-block;
    }
</style>
<div class='mainPanelContent' id='Чат'>
    <h2 align='center'>Чат</h2>
    <div id='leftChatBlock'>
        <input class='chatBlockItems' type='button' value='Общий чат' onclick='changeFrameTo("general",CHAT_PAGES_PREFIX,"","#chatBlock")'>
        <input class='chatBlockItems' type='button' value='Личные сообщения' onclick='changeFrameTo("personal",CHAT_PAGES_PREFIX,"","#chatBlock")' disabled>
        <input class='chatBlockItems' type='button' value='Словарь' onclick='changeFrameTo("dictionary",CHAT_PAGES_PREFIX,"","#chatBlock")' disabled>
    </div>
    <div id='generalChatBlock'>

        <div id='topChatBlock'>
            <div style='width:100%'>
            <p class='chatBlockItems' align='center' style='text-indent:0;margin-top:2%;font-size:1.3em;'>Общий чат</p>
            </div>

        </div>

        <div id='chatBlockShell'>
            <div style='direction:ltr;' id='chatBlock'></div>
        </div>

        <div id='bottomChatBlock'>
            <div style='width:10%'>
                <button style='margin-top:6%;margin-left:25%;font-size:1.9em;background:none;border:none;' >&#x1F923️</button>
            </div>
            <div style='width:78%'>
                <input style='margin:2%;width:96%;' type='text' placeholder='Напишите сообщение...' id='chatInput'>
            </div>
            <div style='width:10%'>
                <button style='margin-top:6%;font-size:1.9em;background:none;border:none;' onclick='sendMessage()'>➡️</button>
            </div>
        </div>


    </div>
    <div id='rightChatBlock'>

    </div>
</div>
<script>
    document.title = "Чат | Гильдия MORDOR";
    mainPanelContent = document.getElementById('mainFrame');
    if (typeof next_chat_page !== 'undefined') {
        changeFrameTo(next_chat_page,CHAT_PAGES_PREFIX,"","#chatBlock");
    }
    else{
        changeFrameTo("general",CHAT_PAGES_PREFIX,"","#chatBlock");
    }
    mainPanelContent.scrollTop = mainPanelContent.scrollHeight;
    recipientId = 0;
    addMessagesNumber = 10;
    totalMessagesNumber = addMessagesNumber;
    messagesNumber = 0;
    id = 0 <?php echo "+".$id; ?>;
    function loadMessages(){
        getChatOnlineUserStatus();
        messageBlock = document.getElementById('messageBlock');
        $.post('/data/php/load_chat_messages.php',{'id':id,'recipientId':recipientId,'number':messagesNumber,'total':totalMessagesNumber}).done(function(html){
            messageBlock.innerHTML = html + messageBlock.innerHTML;
            messagesNumber = totalMessagesNumber;
        });
    }
    function sendMessage(){
        text = document.getElementById('chatInput').value;
        $.post('/data/php/send_chat_message.php',{'id':id,'recipientId':recipientId,'text':text}).done(function(response){
            if(response == 'Успешно'){
                getNewMessages();
                document.getElementById('chatInput').value ='';
            }
            else{
                Swal.fire(
                    'Не удалось',
                    'Сообщение не удалось отправить.',
                    'warning'
                );
            }
        });
    }
    function getNewMessages(){
        getChatOnlineUserStatus();
        messageBlock = document.getElementById('messageBlock');
        $.post('/data/php/get_new_chat_message.php',{'id':id,'recipientId':recipientId}).done(function(html){
            //split = +total +messagesNumber
            messageBlock.innerHTML += html;
        });
    }
    function getChatOnlineUserStatus(){
        rightChatBlock = document.getElementById('rightChatBlock');
        $.post('/data/php/get_chat_online_user_status.php').done(function(html){
            rightChatBlock.innerHTML = html;
        });
    }

</script>