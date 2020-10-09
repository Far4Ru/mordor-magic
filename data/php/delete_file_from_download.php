<?php
    if(isset($_POST['file'])){
        $filename = $_POST['file'];
        $nickname = $_POST['nickname'];

        $dir=$_SERVER['DOCUMENT_ROOT']."/tmp/task_table/";
        if(is_dir($dir)){
            if($dir_num=opendir($dir)){
                while($file=readdir($dir_num)){
                    try{
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
                    catch(Exception $e){
                    }
                }
                closedir($dir_num);
            }
        }
    }