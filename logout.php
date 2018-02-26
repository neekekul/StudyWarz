<?php
    session_start();

    if (!isset($_SESSION['userSession'])){
        header("Location: studystation.php");
    }
    elseif (isset($_SESSION['userSession']) != ""){
        session_destroy();
        unset($_SESSION['userSession']);
        header("Location: studystation.php");
    }

    if (isset($_GET['logout'])){
        session_destroy();
        unset($_SESSION['userSession']);
        header("Location: studystation.php");
    }
?>
