<?php
    if(isset($_POST['name']) && isset($_POST['text'])){
        $selected_name = $_POST['name'];
        $selected_text = $_POST['text'];
        $dir = $_SERVER['DOCUMENT_ROOT'].'/home/src/database';
        if(is_dir($dir)){
            if($files = opendir($dir)){
                while(false !== ($file=readdir($files))){
                    if ($file != "." && $file != ".."&&$file != "glossary.php"){
                        $name = explode("'",file_get_contents($_SERVER['DOCUMENT_ROOT'].'/home/src/database/'.$file, FALSE, NULL, 124))[0];
                        $left_file_part = "";
                        $right_file_part = "";
                        if($name == $selected_name){
                            $full_file_array = explode("<div>",file_get_contents($_SERVER['DOCUMENT_ROOT'].'/home/src/database/'.$file, FALSE, NULL));
                            $left_file_part .= $full_file_array[0];
                            $main_part_file_array = explode("</div>",$full_file_array)[1];
                            $left_file_part .= "<div>";
                            $right_file_part .= "</div></div>";
                            $left_file_part .= $selected_text;

                            $text = $left_file_part . $right_file_part;
                            if(file_put_contents($_SERVER['DOCUMENT_ROOT'].'/home/src/database/'.$file,$text)){
                                echo "Успешно";
                            }
                        }
                    }
                }
               closedir($files);
            }
        }
    }