<?php
    include_once($_SERVER['DOCUMENT_ROOT']."/data/settings/env/notes.php");
    if(isset($_POST['id'])){
        $text = "";
        $id = $_POST['id'];
        if(file_exists($TMP_PATH)){
            $filename = TMP_PATH_DAILY_GOAL_NOTES . FILE_PREFIX . $id . FILE_SUFFIX . FILE_FORMAT;
            if(file_exists($filename)){
                $handle = fopen($filename, "r");
                $contents = fread($handle, filesize($filename));
                $text = $contents;
                fclose($handle);
            }
        }
        echo $text;
    }