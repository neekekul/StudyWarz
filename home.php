<?php
    session_start();
    include_once 'DatabaseConn.php';

    if (!isset($_SESSION['studentSession'])){
        header("Location: studentLogin.php");
    }

    $check_sesh = $conn->prepare("SELECT * FROM Student WHERE id = ?");
    $check_sesh->bind_param('i', $_SESSION['studentSession']);
    $check_sesh->execute();
    $check_sesh_result = $check_sesh->get_result();
    $user_row = mysqli_fetch_array($check_sesh_result);
    $conn->close();
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
    <title>study_warz</title>
    <meta charset="UTF-8" />
    <meta name="description" content="Study Warz Website">
    <meta name="author" content="Luke Keen">
    <meta name="author" content="Jordan Wood">
    <meta name="author" content="Austin Sallee">
    <meta http-equiv="refresh" content="180">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="studywarz_style.css" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body id="okay">
    <div id="head">
        <h1>Welcome- <?php echo $user_row['username']; ?></h1>
        <a href="myAccount.php" id="register" target="_self">
            <button class="bestbuttonh" type="submit" value="Submit" name="myAccount">ACCOUNT</button>
        </a></br></br>
        <a href="settings.php" id="register" target="_self">
            <button class="bestbuttonh" type="submit" value="Submit" name="options">SETTINGS</button>
        </a></br></br>
        <a href="help.php" id="register" target="_self">
            <button class="bestbuttonh" type="submit" value="Submit" name="options">HELP</button>
        </a></br></br>
        <form action="logout.php" method="get">
            <button class="bestbuttonh" type="submit" value="Submit" name="logout">LOGOUT</button>
        </form>
   </div>
</body>
</html>
