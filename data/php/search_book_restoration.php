<?php
    if(isset($_POST['question'])){
        $question = $_POST['question'];

        $BOOK_RESTORATION_FILE_PATH = $_SERVER['DOCUMENT_ROOT'].'/data/book_restoration/book_restoration.xml';
        if (file_exists($BOOK_RESTORATION_FILE_PATH)) {
            $book_restoration = simplexml_load_file($BOOK_RESTORATION_FILE_PATH);
            $right_answer = "";
            foreach($book_restoration->restoration as $restoration){
                if($restoration->short_name == $question){
                    $right_answer = $restoration->right_answer;
                    echo "<p>".$restoration->question."</p>";
                    echo "<p style='color:gold;'>".$right_answer."</p>";
                }
            }
            if(!$right_answer){
                echo "<p>Ответ не найден. Возможно, он еще не добавлен или есть ошибка в поиске.</p>";
            }
        }
    }