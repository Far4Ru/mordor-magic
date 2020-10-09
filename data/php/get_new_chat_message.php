<?php
    include ("db_connect.php");
    if(isset($_POST['id']) && isset($_POST['recipientId'])){
        $id = $_POST['id'];
        $recipient_id = $_POST['recipientId'];
        $query = "SELECT last_read_message_id FROM chat_read_message WHERE user_id=$id AND recipient_id=$recipient_id;";
        $result = mysqli_query($db, $query);
        if(mysqli_num_rows($result)>0){
            $last_read_id = 0;
            while($last_read_array = mysqli_fetch_array($result)){
                $last_read_id = $last_read_array['last_read_message_id'];
            }
            if($last_read_id){
                $query = "SELECT users.user_nickname, message_id, chat_messages.user_id, message_text, message_date,recipient_id FROM chat_messages, users WHERE ((recipient_id=$recipient_id AND chat_messages.user_id=$id) OR (recipient_id=$id AND chat_messages.user_id=$recipient_id)) AND message_id>$last_read_id AND chat_messages.user_id=users.user_id;";
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
                         $html .= $value;

                    }
                    if($max_id != 0){

                        $query = "INSERT INTO chat_read_message (user_id,last_read_message_id,recipient_id) VALUES ($id, $max_id,$max_recipient_id) ON DUPLICATE KEY UPDATE last_read_message_id=$max_id";
                        if(mysqli_query($db, $query)){
                            //Изменено
                        }
                    }
                }

                echo $html;
            }
            else{
                echo "";
            }
        }

    }