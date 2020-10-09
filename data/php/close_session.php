<?php
    session_start();
    if(isset($_COOKIE["userSign"])){
        setcookie("userSign", "", time() - 3600, '/');
    }
    if(empty($_SESSION['nickname']) or empty($_SESSION['password'])){
        header('Location: /');
    }
    unset($_SESSION['nickname']);
    unset($_SESSION['password']);
    unset($_SESSION['id']);
    header('Location:  /');