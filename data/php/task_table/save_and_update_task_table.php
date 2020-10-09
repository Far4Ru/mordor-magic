<?php
    require("create_pdf_from_task_table.php");
    $pdf -> Output($_SERVER['DOCUMENT_ROOT']."/tmp/task_table/".$nickname."_ТаблицаЗаданий_".$day.".pdf",'F');

    $query = "UPDATE users,daytime_events,characters_ownage SET daytime_events.completion=0 WHERE users.user_nickname='$nickname' AND users.user_id=characters_ownage.user_id AND characters_ownage.character_nickname=daytime_events.character_nickname ORDER BY daytime_events.daytime_event_id desc;";
    if(mysqli_query($db, $query)){
        echo "success";
    }
    else{
        echo "Error: " . $query . "<br>" . mysqli_error($db);
    }