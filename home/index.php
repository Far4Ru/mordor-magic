<?php
    session_start();
    require_once $_SERVER['DOCUMENT_ROOT']."/data/php/check_device.php";
    include($_SERVER['DOCUMENT_ROOT']."/data/php/check_login.php");
    setlocale(LC_ALL, "ru_RU.UTF-8");
    date_default_timezone_set('Europe/Moscow');
    $role = mysqli_fetch_array(mysqli_query($db, "SELECT user_role FROM users WHERE user_nickname='$nickname'"))[0];
    $_SESSION['role'] = $role;

?>
<html>
    <head>

        <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>

        <title>Гильдия MORDOR</title>
        <link rel="shortcut icon" href="/favicon.ico?v=2" type="image/x-icon">

        <script type="text/javascript" src="/data/libs/jquery_min.js"></script>

        <script src='/data/libs/sweetalert2/sweetalert2.all.min.js'></script>
        <script src="/data/libs/ckeditor5/build/ckeditor.js"></script>
    </head>
    <body>
        <style>
            @import url(https://fonts.googleapis.com/css?family=Roboto+Slab|PT+Sans+Caption&subset=latin,cyrillic);
            *, *:before, *:after{
                transition:.3s linear}
            h2 {
                font-family: 'Roboto Slab', serif;
                font-weight: normal;
                font-size: 1.6em;
                color:greenyellow;
            }
            h3 {
                margin-top: 5%;
                font-family: 'Roboto Slab', serif;
                font-weight: normal;
                font-size: 1em;
                color:white;

            }
            dt{

                font-family: 'PT Sans Caption', sans-serif;
                font-size: 1em;
                color:greenyellow;
            }
            p, a, textarea{
                 font-family: 'PT Sans Caption', sans-serif;
                 <?php
                    if($view_version=="Mobile"){
                        echo "font-size: 1.6em;";
                    }
                    else{
                        echo "font-size: .8em;";

                    }
                 ?>
                 color: white;
            }
            textarea{
                padding: 1%;
                width: 96%;
                height: 75%;
                background-color: rgba(30,30,30,0.3);
                border-color: rgba(40,40,40,0.8);
                line-height: 1.5;
                wrap: soft;
                resize: none;
            }
            p {
                text-indent: 20px;
                line-height: 1.5;
                word-wrap: break-word;
            }
            a, u {
                text-decoration: none;
            }
            html, body {
                margin: 0; height: 100%; overflow: hidden
            }
            body{
                background: no-repeat center center fixed;
                background-size: 100% 100%;
                background-image: linear-gradient(to right, #434343 0%, black 100%);
            }
            div{
                padding: 0;
                margin: 0;
            }
            .divButton {
                vertical-align: top;
                margin: 4%;
                height: 10%;
                border: 4px double black;
                padding: 4% 2% 2% 2%;
                width: 20%;
                display: inline-block;
                border-radius:10px;
                background-color: rgba(68,68,68,0.32);

            }
            .divButton p{
                font-size: 1em;
            }
            .divButton:hover {
                cursor: pointer;
                //background-color: #444444;
            }
            .divButton:hover p{
                 color: greenyellow;
             }
            .topPanelElements{
                display: inline-block;
                text-align: center;
                vertical-align: middle;
            }
            .mainPanelContent {
                padding: 2%;
            }
            .passedTimeBlock{
                color: rgba(170, 170, 170, 0.7);
                font-size: 0.7em;
                padding-left: 5%;
            }
            #topPanel{
                border-bottom: solid 1px rgba(160, 160, 160, 0.3);
                box-shadow: 0 0 5px -10px rgba(0,0,0,.4), 0 5px 10px 0 rgba(21,21,21,.4);
                background-image: radial-gradient(73% 147%, #EADFDF 59%, #ECE2DF 100%), radial-gradient(91% 146%, rgba(255,255,255,0.50) 47%, rgba(0,0,0,0.50) 100%);
                background-blend-mode: screen;
            }
            #menuPanel, #botPanel, #mainFrame{
                background-color: rgba(68,68,68,0.68);
            }
            .menuPanelButtons {
                display: inline-block;
                vertical-align: top;
                border-bottom: 1px groove white;
                text-align:center;
            }
            .menuPanelButtons p{
                padding-top:2%;
            }
            .menuPanelButtons:focus {
                border-bottom: 2px groove white;
            }
            .menuPanelButtons:hover {
                cursor: pointer;
                background-color: #ccc;
            }
            #botPanel p{
                margin: unset;
                padding: 2%;
            }
            u:hover, a:hover {
                cursor: pointer;
                text-decoration:underline;
            }
            li{
                color: #888888;
            }
            .pButton, li p{
               <?php
                    if($view_version=="Mobile"){
                        echo "font-size: 1.1em;";
                    }
                ?>
                text-indent: unset;
                margin: unset;
            }
            input[type=text], input[type=password], input[type=number], input[type=search]{
                background-color: rgba(205,205,205,0.1);
                font-family: 'PT Sans Caption', sans-serif;

                <?php
                     if($view_version=="Mobile"){
                         echo "font-size: 1.1em;";
                     }
                     else{
                         echo "font-size: .9em;";
                     }
                ?>
                color: floralwhite;
                border: 1px groove lightblue;
                border-radius:10px;
                padding: 5px 10px;
                opacity: 1;
            }
            input[type=text]::-webkit-input-placeholder, input[type=password]::-webkit-input-placeholder, input[type=text]::placeholder, input[type=password]::placeholder, input[type=number]::-webkit-input-placeholder, input[type=number]::placeholder, input[type=search]::-webkit-input-placeholder, input[type=search]::placeholder{
                color: alicewhite;
                opacity: 0.6;
            }
            input:focus {
                color: #cccccc;
            }
            input[list]::-webkit-calendar-picker-indicator {
              display: none;
            }
            input[type=button]{
                cursor: pointer;
                background: transparent;
                border: none;
                color: white;

                <?php
                     if($view_version=="Mobile"){
                         echo "font-size: 1em;";
                     }
                     else{
                         echo "font-size: .9em;";
                     }
                ?>
                border-bottom: 1px solid rgba(255,255,255,0.8);
                font-family: 'Roboto Slab', serif;
                font-weight: bold;
            }
            input[type=button]:hover {
                border-bottom: 2px solid rgba(255,255,255,1);

            }
            lh p, ul{
                margin: unset;
            }
            .hr-shelf {
                position:absolute;
                pointer-events:none;
                left:30%;
                top:90%;
                margin: -30px auto 10px;
                padding: 0;
                height: 50px;
                border: none;
                border-bottom: 1px solid rgba(255,255,255,0.25);
                box-shadow: 0 20px 20px -20px rgba(255,255,255,0.25);
                width: 40%;
            }
            .topPanelElements img{
                margin-top: 3%;
            }
            #mainFrame{
                overflow-y: scroll;
            }
            ::-webkit-scrollbar {
                width: 12px;
            }

            /* Track */
            ::-webkit-scrollbar-track {
                -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
                -webkit-border-radius: 10px;
                border-radius: 10px;
            }

            /* Handle */
            ::-webkit-scrollbar-thumb {
                -webkit-border-radius: 10px;
                border-radius: 10px;
                background: rgba(255,255,255,0.4);
                -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5);
            }
            ::-webkit-scrollbar-thumb:window-inactive {
                background: rgba(255,255,255,0.0);
            }
            #appleMusicPlaylist, #appleMusicPlaylistButton {
                position: absolute;
                display: none;
            }
            #appleMusicPlaylistButton{

                <?php
                    if($view_version=="Mobile"){
                        echo "display:none;";
                    }
                    else{
                        echo "display:block;";

                    }
                ?>
                opacity: 0.1;
            }
            #appleMusicPlaylistButton:hover{
                cursor: pointer;
                opacity: 1;
            }
            span {
                cursor: default;
            }
            table {
                padding: 1px;
                background-color: rgba(255,255,255,0.4);
                font-family: 'PT Sans Caption', serif;
                font-size: .4em;
                color: rgba(36,36,36,0.6);
            }
            th, tr{
                padding: 1px;
            }
            .color_nickname_swordsman{
                color: #e577a8;
            }
            .color_nickname_knight{
                color: #b68a5b;
            }
            .color_nickname_gunner{
                color: #8dbc59;
            }
            .color_nickname_assassin{
                color: #f2e744;
            }
            .color_nickname_priest{
                color: #fffae5;
            }
            .color_nickname_mage{
                color: #7f6cac;
            }
            select{
                <?php
                    if($view_version=="Mobile"){
                        echo "font-size: 1.2em;";
                    }
                    else{
                        echo "font-size: .9em;";

                    }
                ?>
                background-color: rgba(30,30,30,0.1);
                border-color: rgba(0,0,0,0);
                color: white;
            }

            .rightInfoBlockButton{
                background: rgba(20,20,20,0.4);
                border: none;

                <?php
                    if($view_version=="Mobile"){
                        echo "margin: 1% 1% 1% 1%;";
                        echo "width: 31%;";
                        echo "height: 20%;";
                        echo "font-size: 5.5em;";
                    }
                    else{
                        echo "margin: 2% 2% 2% 2%;";
                        echo "width: 28%;";
                        echo "height: 19%;";
                        echo "font-size: 3.5em;";

                    }
                ?>
            }
            .rightInfoBlockButton:hover{
                background: rgba(20,20,20,0.8);
            }
            .rightInfoBlockButton:active{
                background: rgba(20,20,20,1);
                transform: translateY(-2px);
            }
            #canvas{
                width:auto;
                height:100%;
            }
        </style>


        <!-- Верхняя панель -->
        <div id='topPanel'>
            <!-- Заголовок, переход домой -->
            <div class='topPanelElements' id='topPanelTitle' title='На гланую страницу' onclick='location.href="/home/"'>
                <img src='/data/icons/mordor_title.png' height='80%' alt='MORDOR'>
            </div>
            <div class='topPanelElements' id='topPanelMiddle' >
                <!-- Середина -->
                <p ondblclick='changeTopPanelMiddleText()' id='topPanelMiddleText' title='Текущая дата' style='color:#444444;padding-right:11%;'><?php echo strftime ("%A %d %b %Y")?></p>
            </div>
            <!-- Выход-->
            <div class='topPanelElements' id='topPanelExit' title='На страницу входа'  onclick='window.location.href="/data/php/close_session.php"'>
                <img src='/data/icons/exit_icon.png' height='80%' alt='Выйти'>
            </div>

        </div>
        <!-- Меню -->
        <div id='menuPanel'>
            <div class='menuPanelButtons' value='Главная' onclick='changeFrameTo("mainPage",PAGES_PREFIX)'><p class='pButton'>Главная</p></div>
            <div class='menuPanelButtons' value='Профиль' onclick='next_profile_page="general";changeFrameTo("profile",PAGES_PREFIX)'><p class='pButton'>Профиль</p></div>
            <div class='menuPanelButtons' value='Объявления' onclick='changeFrameTo("announcements",PAGES_PREFIX)'><p class='pButton'>Объявления</p></div>
            <div class='menuPanelButtons' value='Библиотека' onclick='changeFrameTo("database",PAGES_PREFIX)'><p class='pButton'>Библиотека</p></div>
            <div class='menuPanelButtons' value='Поиск' onclick='changeFrameTo("search",PAGES_PREFIX)'><p class='pButton'>Поиск</p></div>
            <div class='menuPanelButtons' value='События' onclick='changeFrameTo("events",PAGES_PREFIX)'><p class='pButton'>События</p></div>
            <div <?php
                     if($view_version=="Mobile"){
                         echo "style='display:none;'";
                     }
                 ?>
             class='menuPanelButtons' value='Ссылки' onclick='changeFrameTo("sources",PAGES_PREFIX)'><p class='pButton'>Cсылки</p></div>
        </div>
        <!-- Главное окно -->
        <div id='mainFrame'></div>
        <!-- Нижняя панель -->
        <div id='botPanel'>
            <hr class="hr-shelf">
        <p align='center'>Гильдия MORDOR. По вопросам можно обращаться к Фарару.</p>
        </div>

        <div id='appleMusicPlaylistButton'><p class='pButton'>Apple Music Playlist</p></div>
        <iframe id='appleMusicPlaylist' allow="autoplay *; encrypted-media *;" frameborder="0" style="height:450px;width:660px;overflow:hidden;background:transparent;" sandbox="allow-forms allow-popups allow-same-origin allow-scripts allow-storage-access-by-user-activation allow-top-navigation-by-user-activation" src="https://embed.music.apple.com/ru/playlist/%D0%B0%D0%BF%D1%80%D0%B5%D0%BB%D1%8C-2020-2/pl.u-kv9lDWlsL63DRx"></iframe>

        <script>
            /* Размеры окна */
            WINDOW_HEIGHT = innerHeight;
            WINDOW_WIDTH = innerWidth;

            /* Префиксы и суффиксы */
            PAGE_FORMAT = '.php';
            PAGES_PREFIX = 'src/';
            DATABASE_PAGES_PREFIX = PAGES_PREFIX + 'database/';
            DATABASE_STRUCTURE_PREFIX = PAGES_PREFIX + 'database_structure/';
            SEARCH_PAGES_PREFIX = PAGES_PREFIX + 'search/';
            PROFILE_PAGES_PREFIX = PAGES_PREFIX + 'profile/';
            CHAT_PAGES_PREFIX = PAGES_PREFIX + 'chat/';
            BOOKMARKS_PAGES_PREFIX = PAGES_PREFIX + 'bookmarks/';

            topPanelElement = document.getElementById("topPanel");
            topPanelTitleElement = document.getElementById("topPanelTitle");
            topPanelExitElement = document.getElementById("topPanelExit");
            topPanelMiddleElement = document.getElementById("topPanelMiddle");

            menuPanelElement = document.getElementById("menuPanel");

            mainFrameElement = document.getElementById("mainFrame");

            botPanelElement = document.getElementById("botPanel");

            topPanelMiddleText = document.getElementById('topPanelMiddleText');

            appleMusicPlaylistElement = document.getElementById("appleMusicPlaylist");
            appleMusicPlaylistButtonElement = document.getElementById("appleMusicPlaylistButton");
            defineWindow();
            function defineWindow(){
                WINDOW_HEIGHT = innerHeight;
                WINDOW_WIDTH = innerWidth;
                <?php
                    if($view_version=="Mobile"){
                        echo "defineElementDimensionsBy('style',topPanelElement,0.1,1);";
                        echo "defineElementDimensionsBy('style',menuPanelElement,0.1,1);";
                        echo "defineElementDimensionsBy('style',mainFrameElement,0.725,1);";
                        echo "defineElementDimensionsBy('style',botPanelElement,0.075,1);";
                        echo "defineElementDimensionsBy('style',topPanelTitleElement,0.07,0.15);";
                        echo "defineElementDimensionsBy('style',topPanelMiddleElement,0.1,0.74);";
                        echo "defineElementDimensionsBy('style',topPanelExitElement,0.07,0.1);";
                    }
                    else{
                        echo "defineElementDimensionsBy('style',topPanelElement,0.05,1);";
                        echo "defineElementDimensionsBy('style',menuPanelElement,0.05,1);";
                        echo "defineElementDimensionsBy('style',mainFrameElement,0.825,1);";
                        echo "defineElementDimensionsBy('style',botPanelElement,0.075,1);";

                        echo "defineElementDimensionsBy('style',topPanelTitleElement,0.05,0.15);";
                        echo "defineElementDimensionsBy('style',topPanelMiddleElement,0.05,0.74);";
                        echo "defineElementDimensionsBy('style',topPanelExitElement,0.05,0.1);";

                    }
                ?>
            }

            currentPage = 'index';
            previousPage = [''];
            databaseCurrentTitle = '';
            databaseCurrentSubTitle = '';


            defineHidingPanel(appleMusicPlaylistButtonElement,appleMusicPlaylistElement,0.6);
            /*appleMusicPlaylistButtonElement.addEventListener('click', hidingPanelAppearance(appleMusicPlaylistButtonElement,appleMusicPlaylistElement,'right'),false);*/

            function defineHidingPanel(buttonElement, frameElement, positionPercent){
                var buttonWidthPercent = 0.02;
                var width = parseInt(frameElement.style.width,10);
                var height = parseInt(frameElement.style.height,10);
                buttonElement.style.transform = 'rotate(90deg)';
                buttonElement.style.width = '140px';
                if(width < WINDOW_WIDTH && height < WINDOW_HEIGHT){
                    buttonElement.style.top = WINDOW_HEIGHT * positionPercent;
                    frameElement.style.top = WINDOW_HEIGHT * positionPercent - height / 2;
                    buttonElement.style.left = -60;
                    frameElement.style.left = 0 - width;
                }
                //buttonElement.style.display = 'block';
                frameElement.style.display = 'block';
            }
            appleMusicPlaylistButtonElement.onclick = function () {
                var buttonElement = appleMusicPlaylistButtonElement;
                var frameElement = appleMusicPlaylistElement;
                var width = parseInt(frameElement.style.width,10);
                var height = parseInt(frameElement.style.height,10);
                var buttonWidthPercent = 0.02;

                if(parseInt(frameElement.style.left,10) >= -8){
                    //раскрыт

                    frameElement.style.left = 0 - width + 'px';
                    buttonElement.style.left = -60 + 'px';
                }
                else{
                    //закрыт
                    frameElement.style.left = -8 + 'px';
                    buttonElement.style.left = -60 + width + 'px';

                }

            };

            changeFrameTo('mainPage',PAGES_PREFIX);
            menuPanelButtonsElements = document.getElementsByClassName("menuPanelButtons");
            for (i = 0; i < menuPanelButtonsElements.length; i++) {
                <?php
                    if($view_version=="Mobile"){
                        echo "defineElementDimensionsBy('style',menuPanelButtonsElements[i],0.05,0.12);";
                    }
                    else{
                        echo "defineElementDimensionsBy('style',menuPanelButtonsElements[i],0.03,0.08);";

                    }
                ?>

                menuPanelButtonsElements[i].style.margin = Math.floor(WINDOW_HEIGHT * 0.01);
            }


            function defineElementDimensionsBy(method,element, height, width,type='percent') {
                if(method = 'style'){
                    if(type='percent'){
                        element.style.height = Math.floor(WINDOW_HEIGHT * height);
                        element.style.width = Math.floor(WINDOW_WIDTH * width);

                    }
                    else {
                        element.style.height = height;
                        element.style.width = width;
                    }
                }
                else{
                    if(type='percent'){
                        element.height = Math.floor(WINDOW_HEIGHT * height);
                        element.width = Math.floor(WINDOW_WIDTH * width);

                    }
                    else {
                        element.height = height;
                        element.width = width;
                    }
                }

            }
            function changeFrameTo(source, prefix='', type='', element = '#mainFrame'){
                if(type=='back'){
                    $(element).load(source + PAGE_FORMAT, function(){
                        currentPage = source;
                    });
                }
                else{
                    $(element).load(prefix + source + PAGE_FORMAT, function(){

                        if(prefix == '' || prefix == 'src/'){
                            previousPage = [currentPage];
                        }
                        else{
                            previousPage.push(currentPage);
                        }
                        currentPage = prefix + source;
                    });
                }
            }
            <?php

                $SETTINGS_PATH = $_SERVER['DOCUMENT_ROOT']."/data/settings/settings";
                $SERVER_UPDATE_DATE = "";
                $SERVER_UPDATE_GAME_DATE = "";
                if(file_exists($SETTINGS_PATH)){
                    if(filesize($SETTINGS_PATH)!=0){
                        $handle = fopen($SETTINGS_PATH, "r");
                        $contents = fread($handle, filesize($SETTINGS_PATH));
                        $text = $contents;
                        fclose($handle);
                    }
                    else{
                        $SETTINGS_PATH = $_SERVER['DOCUMENT_ROOT']."/data/settings/settings.backup";
                        if(file_exists($SETTINGS_PATH)){
                            if(filesize($SETTINGS_PATH)!=0){
                                $handle = fopen($SETTINGS_PATH, "r");
                                $contents = fread($handle, filesize($SETTINGS_PATH));
                                $text = $contents;
                                fclose($handle);
                            }
                        }

                    }
                    $settings_text_array = explode("\n",$text);
                    foreach($settings_text_array as $parameter){
                        if($parameter != ""){
                            $parameter_array = explode(": ",$parameter);
                            $option = $parameter_array[0];
                            $value = $parameter_array[1];
                            switch($option){
                                case "Server Update Date":
                                    $SERVER_UPDATE_DATE = $value;
                                    break;
                                case "Server Update Game Date":
                                    $SERVER_UPDATE_GAME_DATE = $value;
                                    break;
                                case "Apple Music Playlist":
                                    $APPLE_MUSIC_PLAYLIST = $value;
                                    break;
                            }
                        }
                    }
                }
            ?>
            appleMusicPlaylist.src = 'https://embed.music.apple.com/ru/playlist/<?php echo $APPLE_MUSIC_PLAYLIST?>';
            function changeTopPanelMiddleText(){

                if(topPanelMiddleText.style.color == "rgb(68, 68, 68)"){
                    topPanelMiddleText.style.color = "skyblue";
                    topPanelMiddleText.title = "Дата игрового сервера";
                    topPanelMiddleText.innerHTML = '<?php echo $SERVER_UPDATE_GAME_DATE;?>';


                }
                else{
                    topPanelMiddleText.style.color = "#444444";
                    topPanelMiddleText.title = "Текущая дата";

                    topPanelMiddleText.innerHTML = '<?php echo $SERVER_UPDATE_DATE;?>';
                }
            }
            <?php
                /*switch($role){

                    case 'Администратор':
                        echo "document.body.style.backgroundImage = \"url('/data/backgrounds/sauron_background.jpg')\"";
                        break;
                    case 'Балрог':
                        echo "document.body.style.backgroundImage = \"url('/data/backgrounds/balrog_background.jpg')\"";
                        break;
                    case 'Назгул':
                        echo "document.body.style.backgroundImage = \"url('/data/backgrounds/nazgul_background.jpg')\"";
                        break;
                    default:
                        echo "document.body.style.backgroundImage = \"url('/data/backgrounds/mordor_main_background.jpg')\"";
                }*/
            ?>
            window.onresize = function( event ) {defineWindow();};
        </script>
    </body>
</html>
