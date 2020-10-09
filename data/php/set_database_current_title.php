<?php
    session_start();
    if(isset($_POST['currentTitle'])){
        $_SESSION['currentTitle'] = $_POST['currentTitle'];
    }
