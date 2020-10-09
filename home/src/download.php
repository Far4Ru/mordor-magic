<?php

session_start();
include($_SERVER['DOCUMENT_ROOT']."/data/php/check_login.php");
$nickname = $_SESSION['nickname'];

?>
<div class='mainPanelContent' id='Загрузки'>
    <h2 align='center'>Загрузки</h2>
    <?php
        $dir=$_SERVER['DOCUMENT_ROOT']."/tmp/task_table/";
        if(is_dir($dir)){
            if($dir_num=opendir($dir)){
                echo "<p>Таблица заданий:</p>";
                echo "<ul type='disk'>";
                while($file=readdir($dir_num)){
                    try{
                        $file_user = explode("_",$file)[0];
                        if($nickname == $file_user){
                            echo "<li><a href='/tmp/task_table/".$file."' download>{$file}</a><button onclick='deleteFileFromDownload(\"{$file}\");' style='background:none;border:none;' >&#x274C</button></li>";
                        }

                    }
                    catch(Exception $e){
                    }
                }
                closedir($dir_num);
                echo "</ul>";
            }
        }
    ?>
</div>

<script>
    function deleteFileFromDownload(name){
        Swal.fire({
            title: 'Удалить?',
            text: 'Файл удалится навсегда.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Удалить',
            cancelButtonText: 'Отмена'

        }).then((result) =>{

            if(result.value) {
                $.post('/data/php/delete_file_from_download.php',{'file':name,'nickname':'<?php echo $nickname; ?>'}).done(function(html){
                    if(html == "Успешно"){
                        Swal.fire(
                            'Удаление завершено!',
                            'Выбранный файл был успешно удален.',
                            'success'
                        );
                        changeFrameTo("download",PAGES_PREFIX);
                    }
                    else{
                        Swal.fire(
                            'Не удалось удалить.',
                            'Попробуйте снова позже.',
                            'error'
                        );
                    }
                })
            }

        })
    }
</script>

<script>
    document.title = "Загрузки | Гильдия MORDOR";
</script>