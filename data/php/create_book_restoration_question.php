<?php
    if(isset($_POST['question']) && isset($_POST['book']) && isset($_POST['right_answer'])){
        $question = $_POST['question'];
        $book = $_POST['book'];
        $right_answer = $_POST['right_answer'];

        $BOOK_RESTORATION_FILE_PATH = $_SERVER['DOCUMENT_ROOT'].'/data/book_restoration/book_restoration.xml';
        if (file_exists($BOOK_RESTORATION_FILE_PATH)) {
            $book_restoration = simplexml_load_file($BOOK_RESTORATION_FILE_PATH);
            $new_restoration = $book_restoration->addChild('restoration');
            $short_question = preg_split('/[\s,\?\-\"\:]+/', $question);
            $short_question = $short_question[0]." ".$short_question[1]." ".$short_question[2];
            $duplicate_restoration_exist = 0;
            foreach($book_restoration->restoration as $restoration){
                if($restoration->short_name == $short_question){
                    if($restoration->question == $question && $restoration->right_answer == $right_answer){
                        echo "Уже существует.";
                        $duplicate_restoration_exist=1;
                    }
                }
            }
            if(!$duplicate_restoration_exist){
                $new_restoration->addChild('short_name',$short_question);
                $new_restoration->addChild('question',$question);
                $new_restoration->addChild('book',$book);
                $new_restoration->addChild('right_answer',$right_answer);
                $book_restoration->saveXML($BOOK_RESTORATION_FILE_PATH);
            }
        }
    }