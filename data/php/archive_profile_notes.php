<?php
    include_once($_SERVER['DOCUMENT_ROOT']."/data/settings/env/notes.php");
    setlocale(LC_ALL, "ru_RU.UTF-8");
    date_default_timezone_set('Europe/Moscow');
    if(isset($_POST['id'])){
        $id = $_POST['id'];
        if(file_exists(TMP_PATH_PROFILE_NOTES) && file_exists(TMP_ARCHIVE_PATH_PROFILE_NOTES)){
            $filename = FILE_PREFIX . $id . FILE_SUFFIX . FILE_FORMAT;
            $filepath = TMP_PATH_PROFILE_NOTES . $filename;
            if(!is_dir(TMP_ARCHIVE_PATH_PROFILE_NOTES . $id)){
                mkdir(TMP_ARCHIVE_PATH_PROFILE_NOTES . $id);
            }

            $archiveName = "Заметка"."_". strftime ("%d-%m-%Y_%H-%M-%S") . FILE_FORMAT;
            $archive = TMP_ARCHIVE_PATH_PROFILE_NOTES . $id . "/" . $archiveName;


            if (!rename($filepath, $archive)) {
                echo "Не удалось";
            }
        }

    }