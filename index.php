<?php

    session_start();
    require_once $_SERVER['DOCUMENT_ROOT']."/data/php/check_device.php";
    include($_SERVER['DOCUMENT_ROOT']."/data/php/check_login.php");
?>
<html>
    <head>
        <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>

        <title>Гильдия MORDOR</title>
        <meta name='description' content='Сайт гильдии MORDOR из игры Eternal Magic. Сервер Атрия RU (Антарес). Мордор - великий и вечный. Добро пожаловать!'>
        <link rel='canonical' href='http://mordor-magic.000webhostapp.com'>

    	<meta name="yandex-verification" content="9e2e6b63a76b6060" />

    	<link rel="shortcut icon" href="/favicon.ico?v=2" type="image/x-icon">
        <script type="text/javascript" src="/data/libs/jquery_min.js"></script>
        <script src='/data/libs/sweetalert2/sweetalert2.all.min.js'></script>
    </head>
    <body>
        <style>
            @import url(https://fonts.googleapis.com/css?family=Roboto+Slab|PT+Sans+Caption&subset=latin,cyrillic);
            *, *:before, *:after{transition:.3s linear}
            h2 {
                 font-family: 'Roboto Slab', serif;
                 font-weight: normal;
                 font-size: 1.6em;
                 color:greenyellow;
             }
            h3 {
                font-family: 'Roboto Slab', serif;
                font-weight: normal;
                font-size: 1em;
                color:#888888;
            }
            p{
                font-family: 'PT Sans Caption', sans-serif;
                font-size: 1em;
                color: #444444;
            }
            body{
                background: no-repeat center center fixed;
                background-size: 100% 100%;
                background-image: url('/data/backgrounds/mordor_background.png');
            }
            a {
                text-decoration: none;
            }
            td {
                padding:5px;
            }
            input[type=text], input[type=password] {
                font-family: 'Roboto Slab', serif;
                font-size: 1em;
                color:#888888;
                width: 60%;
                background-color: transparent;
                border: none;
                border-bottom: 1px solid #aaaaaa;
            }
            input[type=text]:focus, input[type=password]:focus {
                border-bottom: 2px solid #888888;
            }
            input {
                outline:none;
            }

            input[type=button]{
                cursor: pointer;
                background: transparent;
                color: #888888;
                border: 1px solid #888888;
                font-family: 'Roboto Slab', serif;
                font-weight: bold;
            }
            input[type=button]:hover {
                color: #444444;
                border: 1px solid #444444;

            }
            #discordField,#discordFieldButton{
                position: absolute;
            }
            #discordFieldButton{
                background-color: #7289da;
                border-radius: 10px 10px 0 0;
            }
            #discordFieldButton p{

                font-size: 1.1em;
                color:white;
            }
            #discordFieldButton:hover{
                cursor: pointer;
            }
            #signUpButton:hover{
                cursor: pointer;
            }
            #signUpButton{
                position: absolute;
                background-color: #7289da;
                top: 2vh;
                left: 88vw;
                width: 10vw;
                height: 10vh;
                padding-left: 1vw;
                border-radius: 30% 30% 30% 400%;

            }
            #signUpButton p{

                font-size: 1em;
                color:white;

            }
            
        </style>
        <!-- Приветствие -->
        <h2 align='center'>Добро пожаловать в MORDOR</h2>

        <!-- Название игры -->
        <h3 align='center' title="Перейти на сайт игры"><a href='https://em-ru.101xp.com' style='color:lightblue' target='_blank'>Eternal Magic</a></h3>
        
        <!-- Форма входа-->
        <div align='center' style='border: 3px groove black;background: lightblue;width:25%;padding:30px;border-radius:25px;opacity: 0.9;display: block; margin:50px auto auto auto;' id='loginForm'>

            <p style='margin-left: 20%' align='left'>Имя:</p>
            <p><input id='nickname' type='text'></p>
            <p style='margin-left: 20%'  align='left'>Пароль:</p>
            <p><input id='password' type='password'></p>
            <input type='button' value='Вход' onclick='login()'>
        </div>
        <div id='signUpButton' align='center' onclick='changeLoginForm()'><p>Регистрация</p></div>
       <!--  Виджет дискорда -->
        <!--  style='position: absolute; top:270; left:970px;' -->
        <div id='discordFieldButton' align='center'><p>Discord</p></div>
        <iframe id='discordField'src='https://discordapp.com/widget?id=672578928501587987&theme=light' style='width: 350px;height: 500px;' allowtransparency="true" frameborder="0"></iframe>
        <script>

            /* Размеры окна */
            WINDOW_HEIGHT = innerHeight;
            WINDOW_WIDTH = innerWidth;
            discordFieldButton = document.getElementById("discordFieldButton");
            discordField = document.getElementById("discordField");
            defineHidingPanel(discordFieldButton,discordField, 0.6);
            /*appleMusicPlaylistButtonElement.addEventListener('click', hidingPanelAppearance(appleMusicPlaylistButtonElement,appleMusicPlaylistElement,'right'),false);*/

            function defineHidingPanel(buttonElement, frameElement, positionPercent){
                var buttonWidthPercent = 0.01;
                var width = parseInt(frameElement.style.width,10);
                var height = parseInt(frameElement.style.height,10);
                buttonElement.style.transform = 'rotate(90deg)';
                buttonElement.style.width = '120px';
                if(width < WINDOW_WIDTH && height < WINDOW_HEIGHT){
                    buttonElement.style.top = WINDOW_HEIGHT * positionPercent;
                    frameElement.style.top = WINDOW_HEIGHT * positionPercent - height / 2;
                    buttonElement.style.left = -41;
                    frameElement.style.left = 0 - width;
                }
                buttonElement.style.display = 'block';
                frameElement.style.display = 'block';
            }
            discordFieldButton.onclick = function () {
                var buttonElement = discordFieldButton;
                var frameElement = discordField;
                var width = parseInt(frameElement.style.width,10);
                var height = parseInt(frameElement.style.height,10);
                var buttonWidthPercent = 0.01;

                if(parseInt(frameElement.style.left,10) >= -8){
                    //раскрыт

                    frameElement.style.left = 0 - width + 'px';
                    buttonElement.style.left = -41 + 'px';
                }
                else{
                    //закрыт
                    frameElement.style.left = -8 + 'px';
                    buttonElement.style.left = -41 + width + 'px';

                }

            };
            function login(){
                nickname = document.getElementById('nickname').value;
                password = document.getElementById('password').value;
                $.post('/data/php/login.php',{'nickname':nickname,'password':password}).done(function(response){
                    switch(response){
                        case 'Успешно':
                            location.replace('/home/');
                            break;
                        case 'Не верный пароль':
                            Swal.fire(
                                'Не удалось войти',
                                'Имя или пароль введены неверно.',
                                'warning'
                            );
                            break;
                        case 'Не подтвержден':
                            Swal.fire(
                                'Не удалось войти',
                                'Аккаунт еще не подтвержден, ваша заявка на рассмотрении в Барад-дуре. Уведомление будет выслано на почту.',
                                'warning'
                            );
                            break;
                    }
                });
            }
            function signUp(){
                nickname = document.getElementById('nickname').value;
                password = document.getElementById('password').value;
                email = document.getElementById('email').value;
                $.post('/data/php/registration.php',{'nickname':nickname,'password':password,'email':email}).done(function(response){
                    switch(response){
                        case 'Успешно':
                            Swal.fire(
                                'Успешно',
                                'Ваша заявка принята и будет рассмотрена в Барад-дуре. Уведомление будет выслано на почту.',
                                'success'
                            );
                            break;
                        case 'Не удалось':
                            Swal.fire(
                                'Не удалось',
                                'Что-то пошло не так.',
                                'error'
                            );
                            break;
                        case 'Пользователь уже существует':
                            Swal.fire(
                                'Не удалось',
                                'Пользователь с таким именем уже существует.',
                                'warning'
                            );
                            break;
                    }
                });
            }
            signUpButton = document.getElementById('signUpButton');
            loginForm = document.getElementById('loginForm');

            function changeLoginForm(){
                signUpButtonText = signUpButton.firstElementChild;
                signUpButtonTextValue = signUpButton.firstElementChild.innerHTML;
                if(signUpButtonTextValue == 'Регистрация'){
                    signUpButtonText.innerHTML = 'Вход';
                    signUpButton.style.backgroundColor = "#72892a";
                    loginForm.innerHTML = "<p style='margin-left: 20%' align='left'>Имя:</p><p><input id='nickname' type='text'></p><p style='margin-left: 20%'  align='left'>Пароль:</p><p><input id='password' type='password'></p><p style='margin-left: 20%'  align='left'>Эл. почта:</p><p><input id='email' type='text'></p><input type='button' value='Подать заявку' onclick='signUp()'>";
                }
                else{
                    signUpButtonText.innerHTML = 'Регистрация';
                    signUpButton.style.backgroundColor = "#7289da";
                    loginForm.innerHTML = "<p style='margin-left: 20%' align='left'>Имя:</p><p><input id='nickname' type='text'></p><p style='margin-left: 20%'  align='left'>Пароль:</p><p><input id='password' type='password'></p><input type='button' value='Вход' onclick='login()'>";
                }
            }
        </script>
    </body>
</html>
