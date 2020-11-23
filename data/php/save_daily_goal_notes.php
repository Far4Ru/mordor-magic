<?php
    include_once($_SERVER['DOCUMENT_ROOT']."/data/settings/env/notes.php");
    if(isset($_POST['id']) && isset($_POST['text'])){
        $id = $_POST['id'];
        $text = $_POST['text'];
        if(file_exists($TMP_PATH)){
            $filename = TMP_PATH_DAILY_GOAL_NOTES . FILE_PREFIX . $id . FILE_SUFFIX . FILE_FORMAT;
            $handle = fopen($filename, "w");
            $contents = fwrite($handle, $text);
            fclose($handle);
        }

    }