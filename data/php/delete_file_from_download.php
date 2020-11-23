<?php
    if(isset($_POST['file']) && isset($_POST['directory'])){
        $filename = $_POST['file'];
        $nickname = $_POST['nickname'];

        $directory = $_POST['directory'];

        if($directory == ""){
            $dir = $_SERVER['DOCUMENT_ROOT'] . "/tmp/task_table/";
        }
        else{
            $dir = $_SERVER['DOCUMENT_ROOT'] . $directory;
        }
        if(is_dir($dir)){
            if($dir_num = opendir($dir)){
                while($file = readdir($dir_num)){
                    try{
                        if($directory == ""){
                            $file_user = explode("_",$file)[0];
                            if($nickname == $file_user){
                                if($file == $filename){
                                    if (!unlink($dir.$filename)) {
                                        echo ("Не удалось");
                                    }
                                    else {
                                        echo ("Успешно");
                                    }
                                }
                            }
                        }
                        else{
                            if($file == $filename){
                                if (!unlink($dir.$filename)) {
                                    echo ("Не удалось");
                                }
                                else {
                                    echo ("Успешно");
                                }
                            }
                        }

                    }
                    catch(Exception $e){
                    }
                }
                closedir($dir_num);
            }
        }
    }