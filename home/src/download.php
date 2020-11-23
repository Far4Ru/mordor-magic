<?php

session_start();
include_once($_SERVER['DOCUMENT_ROOT']."/data/settings/env/notes.php");
include($_SERVER['DOCUMENT_ROOT']."/data/php/check_login.php");
$nickname = $_SESSION['nickname'];
$id = $_SESSION['id'];

function render_download_list($dir,$listName, $nickname = 0){
    if(is_dir($_SERVER['DOCUMENT_ROOT'].$dir)){
        if($dir_num=opendir($_SERVER['DOCUMENT_ROOT'].$dir)){
            echo "<p>" . $listName . ":</p>";
            echo "<ul type='disk'>";
            while($file=readdir($dir_num)){
                try{
                    if($nickname){
                        $file_user = explode("_",$file)[0];
                        if($nickname == $file_user){
                            echo "<li><a href='".$dir.$file."' download>{$file}</a><button onclick='deleteFileFromDownload(\"{$file}\");' style='background:none;border:none;' >&#x274C</button></li>";
                        }
                    }
                    else{
                        if ($file != "." && $file != ".."){
                            echo "<li><a href='".$dir.$file."' download>{$file}</a><button onclick='deleteFileFromDownload(\"{$file}\",\"{$dir}\");' style='background:none;border:none;' >&#x274C</button></li>";
                        }
                    }

                }
                catch(Exception $e){
                }
            }
            closedir($dir_num);
            echo "</ul>";
        }
    }
}
?>
<div class='mainPanelContent' id='Загрузки'>
    <h2 align='center'>Загрузки</h2>
    <?php
        render_download_list("/tmp/task_table/", "Таблица заданий", $nickname);
        render_download_list(PURE_TMP_ARCHIVE_PATH_PROFILE_NOTES . $id . "/", "Заметки из профиля");
        render_download_list(PURE_TMP_ARCHIVE_PATH_DAILY_GOAL_NOTES . $id . "/", "Заметки из ежедневных целей");
    ?>
</div>

<script>
    function deleteFileFromDownload(name, directory = ''){
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
                $.post('/data/php/delete_file_from_download.php',{'file':name,'nickname':'<?php echo $nickname; ?>','directory':directory}).done(function(html){
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