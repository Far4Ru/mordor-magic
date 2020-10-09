<?php
    function saveRSS(){

        include($_SERVER['DOCUMENT_ROOT']."/data/php/get_rss_news_wall.php");
        include($_SERVER['DOCUMENT_ROOT']."/data/php/get_vkrss_news_wall.php");

        $RSS_FOLDER_PATH = $_SERVER['DOCUMENT_ROOT']."/data/rss/";
        $SETTINGS_RSS_PATH = $_SERVER['DOCUMENT_ROOT']."/data/settings/rss.list";
        if(file_exists($SETTINGS_RSS_PATH) && file_exists($RSS_FOLDER_PATH)){
            $handle = fopen($SETTINGS_RSS_PATH, "r");
            $contents = fread($handle, filesize($SETTINGS_RSS_PATH));
            $text = $contents;
            fclose($handle);

            $rss_array = explode("\n", $text);
            foreach($rss_array as $rss){
                $rss_options = explode(": ",$rss);
                $name = $rss_options[0];
                $src = $rss_options[1];
                $split_name = explode("_",$name);
                $type = $split_name[0];

                switch($type){
                    case "VK":
                        $search = 0;
                        foreach($split_name as $piece){
                            if($piece == "KEYWORD"){
                                $search = 1;
                            }
                        }

                        $text = getVKFeedsBy($src,$search);
                        break;
                    case "RSS":
                        $text = getFeedsBy($src);
                        break;
                }
                if(strlen($text) > 7){
                    if($text == "Ошибка"){
                        continue;
                    }
                }

                $RSS_FILE_FORMAT = ".rss";
                $handle = fopen($RSS_FOLDER_PATH.strtolower($name).$RSS_FILE_FORMAT, "w");
                $contents = fwrite($handle, $text);
                fclose($handle);

            }
        }
    }