<?php
    if(isset($_POST['name'])){
        $RSS_FOLDER_PATH = $_SERVER['DOCUMENT_ROOT']."/data/rss/";
        $RSS_FILE_FORMAT = '.rss';
        $name = strtolower($_POST['name']);
        $filepath = $RSS_FOLDER_PATH.$name.$RSS_FILE_FORMAT;
        if(file_exists($filepath)){
            $handle = fopen($filepath, "r");
            $contents = fread($handle, filesize($filepath));
            $text = $contents;
            fclose($handle);
            echo $text;
        }
        else{
            echo "Не удается загрузить страницу.";
            $msg = "Отсутствует директория для хранения RSS";
        }
    }