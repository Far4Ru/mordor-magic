<?php
    if(isset($_POST['name']) && isset($_POST['file_name'])){
        $part1 = file_get_contents('1.part'.$file, FALSE, NULL);
        $part2 = file_get_contents('2.part'.$file, FALSE, NULL);
        $part3 = file_get_contents('3.part'.$file, FALSE, NULL);
        $selected_name = $_POST['name'];
        $text = $part1 . $selected_name . $part2 . $selected_name . $part3;
        $selected_file_name = $_POST['file_name'];
        $dir = $_SERVER['DOCUMENT_ROOT'].'/home/src/database';
        if(is_dir($dir)){
            if($files = opendir($dir)){
                    if(file_put_contents($_SERVER['DOCUMENT_ROOT'].'/home/src/database/'.$selected_file_name.".php",$text)){
                        echo "Успешно";
                    }
               closedir($files);
            }
        }
    }