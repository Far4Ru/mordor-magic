<?php
    if(isset($_POST['id'])){
        $text = "";
        $id = $_POST['id'];
        $TMP_PATH = $_SERVER['DOCUMENT_ROOT']."/tmp/profile_notes/";
        $FILE_PREFIX = "M";
        $FILE_SUFFIX = "RDOR";
        $FILE_FORMAT = ".txt";
        if(file_exists($TMP_PATH)){
            $filename = $TMP_PATH . $FILE_PREFIX . $id . $FILE_SUFFIX . $FILE_FORMAT;
            if(file_exists($filename)){
                $handle = fopen($filename, "r");
                $contents = fread($handle, filesize($filename));
                $text = $contents;
                fclose($handle);
            }
        }
        echo $text;
    }