<?php
session_start();
include($_SERVER['DOCUMENT_ROOT']."/data/php/check_login.php");
setlocale(LC_ALL, "ru_RU.UTF-8");
$glossary = array();
for($i=0;$i<32;$i++){
    $glossary[chr(208) . chr(144+$i)]=array();

}
$files = opendir(getcwd());
while(false !== ($file=readdir($files))){
    if ($file != "." && $file != ".."&&$file != "glossary.php"){
        $name = explode("'",file_get_contents($file, FALSE, NULL, 124))[0];
        $glossary[substr($name, 0, 2)][$file]=$name;
    }
}

?>
<div class='mainPanelContent' id='База данных'>
    <h2 align='center'>Глоссарий</h2>
    <div style='height:5%;'>
        <input type='button' value='Назад' title='На страницу базы данных' onclick='changeFrameTo(previousPage.pop(),"","back")'>
    </div>
    <?php
    foreach($glossary as $key => $array){
        if(!empty($array)){
            echo "<dl><dt><b>".$key."</b></dt>";
            foreach($array as $filename => $value){
                if (file_exists($filename)) {
                    $modifiedFileDate = "В последний раз статья была изменена: " . strftime ("%A %d %b %Y %H:%M:%S",filemtime($filename));
                }
                echo "<dd><a title='".$modifiedFileDate."' onclick=changeFrameTo('".explode(".",$filename)[0]."',DATABASE_PAGES_PREFIX)>".$value."</a></dd>";
            }
        }
    }
    echo "</dl>";
    ?>
</div>