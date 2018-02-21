<?php
    session_start();

    if (!isset($_SESSION['userSession'])){
        header("Location: login.php");
    }
    elseif (isset($_SESSION['userSession']) != ""){
        session_destroy();
        unset($_SESSION['userSession']);
        header("Location: login.php");
    }

    if (isset($_GET['logout'])){
        session_destroy();
        unset($_SESSION['userSession']);
        header("Location: login.php");
    }
?>
