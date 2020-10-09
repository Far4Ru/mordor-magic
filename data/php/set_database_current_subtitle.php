<?php
    session_start();
    if(isset($_POST['currentSubTitle'])){
        $_SESSION['currentSubTitle'] = $_POST['currentSubTitle'];
    }
