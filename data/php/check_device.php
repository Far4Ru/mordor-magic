<?php
    require_once $_SERVER['DOCUMENT_ROOT']."/data/libs/mobiledetect/Mobile_Detect.php";

    /*$view_version = "Desktop";
    if(isset($_COOKIE["userDevice"])){
        if($_COOKIE["userDevice"] == "Mobile"){
            $view_version = "Mobile";
        }
    }
    else{*/
        $detect = new Mobile_Detect;

        // Any mobile device (phones or tablets).
        if ( $detect->isMobile() ) {

            //setcookie("userDevice", "Mobile", time()+3600*24*365, '/');
            $view_version = "Mobile";
        }
        else {
            //setcookie("userDevice", "Desktop", time()+3600*24*365, '/');
            $view_version = "Desktop";

        }
    /*}*/