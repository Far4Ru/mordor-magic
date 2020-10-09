<?php
    include ("db_connect.php");
    if(isset($_POST['id']) && isset($_POST['recipientId']) && isset($_POST['number']) && isset($_POST['total'])){
        $id = $_POST['id'];
        $recipient_id = $_POST['recipientId'];
        $number = $_POST['number'];
        $total = $_POST['total'];
        if($recipient_id == 0){
            $query = "SELECT users.user_nickname, message_id, chat_messages.user_id, message_text, message_date,recipient_id FROM chat_messages, users WHERE recipient_id=$recipient_id AND users.user_id = chat_messages.user_id ORDER BY message_id DESC LIMIT $number,$total;";
        }
        else{
            $query = "SELECT users.user_nickname, message_id, chat_messages.user_id, message_text, message_date,recipient_id FROM chat_messages WHERE ((recipient_id=$recipient_id AND chat_messages.user_id=$id) OR (recipient_id=$id AND chat_messages.user_id=$recipient_id)) AND chat_messages.user_id = users.user_id ORDER BY message_id DESC LIMIT $number,$total;";
        }
        $no_html_message = "<p style='color:grey;' align='center'>Сообщений пока нет. Напишите что-нибудь.</p>";
        $result = mysqli_query($db, $query);
        $html = "";
        if(mysqli_num_rows($result)>0){
            $max_id = 0;
            while($message_array = mysqli_fetch_array($result)){
                if($max_id < $message_array['message_id']){
                    $max_id = $message_array['message_id'];
                    $max_recipient_id = $message_array['recipient_id'];
                }
                $message_date = explode(" ",$message_array['message_date']);
                if(count($message_date) == 2){

                    $message_date_field= $message_date[0];
                    $message_time_field= $message_date[1];
                }
                else{
                    $message_date_field= "";
                    $message_time_field= "";
                }
                $value = "<p><b>".$message_array['user_nickname'].":</b> ".$message_array['message_text']." <span title='".$message_date_field."' style='color:grey;font-size:0.6em;'>".$message_time_field."</span></p>";
                $html= $value .$html;
            }
            if($max_id != 0){

                    $query = "INSERT INTO chat_read_message (user_id,last_read_message_id,recipient_id) VALUES ($id, $max_id,$max_recipient_id) ON DUPLICATE KEY UPDATE last_read_message_id=$max_id";
                if(mysqli_query($db, $query)){
                    //Изменено
                }
            }
            if($html){
                echo $html;

            }
            elseif ($number>0){
                echo "<p style='color:grey;' align='center'>Сообщений больше нет.</p>";
            }
            else{
                echo $no_html_message;

            }
        }
        else{
            echo "";
        }
    }