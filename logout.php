<?php
    session_start();

    if (!isset($_SESSION['studentSession'])){
        header("Location: studentLogin.php");
    }
    elseif (isset($_SESSION['studentSession']) != ""){
        session_destroy();
        unset($_SESSION['studentSession']);
        header("Location: studentLogin.php");
    }

    if (!isset($_SESSION['instructorSession'])){
        header("Location: instructorLogin.php");
    }
    elseif (isset($_SESSION['instructorSession']) != ""){
        session_destroy();
        unset($_SESSION['instructorSession']);
        header("Location: instructorLogin.php");
    }

    if (isset($_GET['logout'])){
        session_destroy();
        unset($_SESSION['studentSession']);
        unset($_SESSION['instructorSession']);
        header("Location: studystation.php");
    }
?>
