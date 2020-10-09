<?php
    if(isset($_POST['name'])){
        $selected_name = $_POST['name'];

        $dir = $_SERVER['DOCUMENT_ROOT'].'/home/src/database';
        if(is_dir($dir)){
            if($files = opendir($dir)){
                while(false !== ($file=readdir($files))){
                    if ($file != "." && $file != ".."&&$file != "glossary.php"){
                        $name = explode("'",file_get_contents($_SERVER['DOCUMENT_ROOT'].'/home/src/database/'.$file, FALSE, NULL, 124))[0];
                        $left_file_part = "";
                        $right_file_part = "";
                        if($name == $selected_name){
                            $file_pointer = $_SERVER['DOCUMENT_ROOT'].'/home/src/database/'.$file;

                            if (!unlink($file_pointer)) {
                                echo ("Ошибка");
                            }
                            else {
                                echo ("Успешно");
                            }
                        }
                    }
                }
               closedir($files);
            }
        }
    }