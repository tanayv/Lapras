<?php

    session_start();
    $_SESSION['customerID'] = '';
    echo "<script type = 'text/javascript'>window.location.assign('index.php');</script>";

?>