<?php
session_start();
include($_SERVER['DOCUMENT_ROOT']."/data/php/check_login.php");
?>
<div class='mainPanelContent' id='Раздел'>
    <h2 id='topicPageTitle' align='center'></h2>
    <div style='height:5%;'>
        <input type='button' value='Назад' onclick='changeFrameTo(previousPage.pop(),"","back")'>
    </div>
    <div>
        <?php
            if (file_exists('database_tree.xml')) {
            $database = simplexml_load_file('database_tree.xml');
                foreach ($database->topic as $topic) {
                    if($topic->title == $_SESSION['currentTitle']){
                        foreach($topic->subtopic as $subtopic){
                            if(count($subtopic->paper)==1){
                                if(isset($subtopic->paper['src'])){
                                    echo "<div align='center' class='divButton' onclick=changeFrameTo('".$subtopic->paper['src']."',DATABASE_PAGES_PREFIX)><p class='pButton'>".$subtopic->paper."</p></div>";
                                }
                            }
                            else{
                                echo "<div align='center' class='divButton' onclick=\"databaseCurrentSubTitle='".$subtopic->title."';$.post('/data/php/set_database_current_subtitle.php',{'currentSubTitle':'".$subtopic->title."'}).done(function(){changeFrameTo('subtopic_page',DATABASE_STRUCTURE_PREFIX);});
                                      \"><p class='pButton'>".$subtopic->title."</p></div>";
                            }
                        }
                    }
                }
            }
        ?>
    </div>
</div>

<script>
    document.getElementById('topicPageTitle').innerHTML = databaseCurrentTitle;
</script>