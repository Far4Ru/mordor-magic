<?php

session_start();
include($_SERVER['DOCUMENT_ROOT']."/data/php/check_login.php");

$role = $_SESSION['role'];
if($role!="Администратор"){
    header('Location: /');
}


$glossary = array();
for($i=0;$i<32;$i++){
    $glossary[chr(208) . chr(144+$i)]=array();

}
chdir('../database/');
$files = opendir(getcwd());
while(false !== ($file=readdir($files))){
    if ($file != "." && $file != ".."&&$file != "glossary.php"){
        $name = explode("'",file_get_contents($file, FALSE, NULL, 124))[0];
        $glossary[substr($name, 0, 2)][$file]=$name;
    }
}
closedir($files);

?>
<div class='mainPanelContent' id='Редактирование базы данных'>
    <h2 align='center'>Редактирование базы данных</h2>
    <div style='height:5%;'>
        <input type='button' value='Назад' onclick='changeFrameTo(previousPage.pop(),"","back")'>
    </div>

    <div>
        <p>
            <input type='text' id='database_value' list='database_names' placeholder='Название'>
            <input type='button' value='Добавить' onclick='showEditDatabase("create")'>
            <input type='button' value='Изменить' onclick='showEditDatabase("update")'>
            <input type='button' value='Удалить' onclick='showEditDatabase("delete")'>
            <datalist id='database_names'>
                <?php
                    foreach($glossary as $key => $array){
                        if(!empty($array)){
                            foreach($array as $filename => $value){
                                if (file_exists($filename)) {
                                    echo "<option value='".$value."'>";
                                }
                            }
                        }
                    }
                ?>
            </datalist>
        </p>
        <div id='CRUDPanel'>

        </div>
    </div>
</div>
<div id="editor"></div>
<script>
/*ClassicEditor
        .create( document.querySelector( '#editor' ) , {

            toolbar: {
                items: [
                    'heading',
                    'undo',
                    'redo',
                    'fontFamily',
                    'highlight',
                    '|',
                    'bold',
                    'italic',
                    'strikethrough',
                    'underline',
                    'removeFormat',
                    '|',
                    'alignment',
                    'indent',
                    'numberedList',
                    'bulletedList',
                    'blockQuote',
                    '|',
                    'link',
                    'imageUpload',
                    'insertTable',
                    'mediaEmbed',
                    'MathType',
                    'specialCharacters'
                ]
            },
            language: 'ru',
            image: {
                toolbar: [
                    'imageTextAlternative',
                    'imageStyle:full',
                    'imageStyle:side'
                ]
            },
            table: {
                contentToolbar: [
                    'tableColumn',
                    'tableRow',
                    'mergeTableCells',
                    'tableCellProperties',
                    'tableProperties'
                ]
            },
            licenseKey: '',

        } )
        .then( editor => {
            window.editor = editor;




        } )
        .catch( error => {
            console.error( error );
        } );
*/
</script>
<script>
    function showEditDatabase(action){
        panel = document.getElementById('CRUDPanel');
        switch(action){
            case 'create':
                panel.innerHTML = "<p><input type='text' id='file_name' placeholder='Называние файла'></p><p><input type='button' value='Создать' onclick='createDatabaseFile()'></p>";
                break;
            case 'update':
                getDatabaseText();
                break;
            case 'delete':
                panel.innerHTML = "<p>Точно удалить?</p><p><input type='button' value='Удалить' onclick='deleteFromDatabase()'></p>";
                break;
        }
    }
    function createDatabaseFile(){
        name = document.getElementById('database_value').value;
        file_name = document.getElementById('file_name').value;
        $.post('/data/php/database_edit/create_database_file.php',{'name':name,'file_name':file_name}).done(function(){
            reloadDatabaseEdit();
        });

    }
    function getDatabaseText(){
        name = document.getElementById('database_value').value;
        $.post('/data/php/database_edit/get_database_text.php',{'name':name}).done(function(text){
            panel = document.getElementById('CRUDPanel');
            panel.innerHTML = "<p><textarea  onfocus=this.style.height='79%';  id='databaseText' style='height:49%'></textarea></p><p align='right' style='margin-right:2%;'><input style='margin-right:2%;' type='button' value='Свернуть' onclick=document.getElementById('databaseText').style.height='49%';><input type='button' value='Сохранить' onclick='updateDatabaseText()'></p>";
            document.getElementById('databaseText').value = text;
        });
    }
    function updateDatabaseText(){
        name = document.getElementById('database_value').value;
        text = document.getElementById('databaseText').value;
        $.post('/data/php/database_edit/update_database_text.php',{'name':name,'text':text}).done(function(){
            reloadDatabaseEdit();
        });
    }
    function deleteFromDatabase(){
        name = document.getElementById('database_value').value;
        $.post('/data/php/database_edit/delete_from_database.php',{'name':name}).done(function(){
            reloadDatabaseEdit();
        });

    }

    function reloadDatabaseEdit(){
        changeFrameTo('database_edit',DATABASE_STRUCTURE_PREFIX);
    }
</script>
