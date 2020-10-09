<?php
    if(isset($_POST['name'])){
        $selected_name = $_POST['name'];
        $glossary = array();
        for($i=0;$i<32;$i++){
            $glossary[chr(208) . chr(144+$i)]=array();

        }
        $dir = $_SERVER['DOCUMENT_ROOT'].'/home/src/database';
        if(is_dir($dir)){
            if($files = opendir($dir)){
                while(false !== ($file=readdir($files))){
                    if ($file != "." && $file != ".."&&$file != "glossary.php"){
                        $name = explode("'",file_get_contents($_SERVER['DOCUMENT_ROOT'].'/home/src/database/'.$file, FALSE, NULL, 124))[0];
                        //echo $name.PHP_EOL;
                        //$selected_name;
                        if($name == $selected_name){
                            echo trim(explode("</div>",explode("<div>",file_get_contents($_SERVER['DOCUMENT_ROOT'].'/home/src/database/'.$file, FALSE, NULL, 124))[1])[0]);
                        }
                    }
                }
               closedir($files);
            }
        }
    }