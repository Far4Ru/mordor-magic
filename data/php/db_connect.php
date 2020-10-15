<?php
    include($_SERVER['DOCUMENT_ROOT']."/data/settings/env/db.php");
    $db = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $db->set_charset("utf8");