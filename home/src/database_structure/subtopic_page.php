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
                            if($subtopic->title == $_SESSION['currentSubTitle']){
                                foreach($subtopic->paper as $paper){
                                    if(isset($paper['src'])){
                                        echo "<div align='center' class='divButton' onclick=changeFrameTo('".$paper['src']."',DATABASE_PAGES_PREFIX)><p class='pButton'>".$paper."</p></div>";
                                    }
                                    else{
                                        echo "<div align='center' class='divButton'><p class='pButton' style='color:grey;'>".$paper."</p></div>";
                                    }
                                }
                            }
                        }
                    }
                }
            }
        ?>
    </div>
</div>

<script>
    document.getElementById('topicPageTitle').innerHTML = databaseCurrentSubTitle;
</script>