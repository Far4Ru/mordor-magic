<?php
    define("SETTINGS_PATH", $_SERVER['DOCUMENT_ROOT']."/data/settings/settings");
    if(file_exists(SETTINGS_PATH)){
        include($_SERVER['DOCUMENT_ROOT']."/data/php/save_rss.php");
        setlocale(LC_ALL, "ru_RU.UTF-8");
        date_default_timezone_set('Europe/Moscow');
        $handle = fopen(SETTINGS_PATH, "r");
        $contents = fread($handle, filesize(SETTINGS_PATH));
        $text = $contents;
        fclose($handle);

        $settings_text_array = explode("\n",$text);

        $new_settings_text_array = array();

        $date = strftime("%A %d %b %Y");
        $time_hour = (int)strftime("%k");
        if($time_hour == 5){
            //Сохранить Server Update Date
            //Сохранить Server Update Game Date
            //Server Update Time
            //rss
            //pdf
            $change = 1;
        }
        else{
            //Сохранить Server Update Date
            //Server Update Time
            //rss
            $change = 0;

        }

        foreach($settings_text_array as $parameter){
            if($parameter != ""){
                $parameter_array = explode(": ",$parameter);
                $option = $parameter_array[0];
                $value = $parameter_array[1];
                switch($option){
                    case "Server Update Date":
                        $value = $date;
                        break;
                    case "Server Update Game Date":
                        if($change){
                            $value = $date;
                        }
                        break;
                    case "Server Update Time":
                        if($value == $time_hour){
                            $change = 0;
                        }
                        $value = $time_hour;
                        break;
                }
                array_push($new_settings_text_array,$option.": ".$value);
            }
        }

        $text = "";
        foreach ($new_settings_text_array as $new_text){
            $text .= $new_text."\n";
        }
        if($text != ""){
            $handle = fopen(SETTINGS_PATH, "w");
            $contents = fwrite($handle, $text);
            fclose($handle);
        }

        saveRSS();

        if($change){
            //Сохранение PDF
        }

    }