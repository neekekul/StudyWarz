<?php
    session_start();
    include_once 'DatabaseConn.php';

    if (!isset($_SESSION['userSession'])){
        header("Location: login.php");
    }

    $check_sesh = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
    $check_sesh->bind_param('i', $_SESSION['userSession']);
    $check_sesh->execute();
    $check_sesh_result = $check_sesh->get_result();
    $user_row = mysqli_fetch_array($check_sesh_result);
    $conn->close();
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
    <title>study_warz_account_hub</title>
    <meta charset="UTF-8" />
    <meta name="description" content="Study Warz Website">
    <meta name="author" content="Luke Keen">
    <meta name="author" content="Jordan Wood">
    <meta name="author" content="Austin Sallee">
    <meta http-equiv="refresh" content="180">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="myAccount_style.css" />
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
    <div class="container-fluid">
        <div class="dropdown">
            <button class="btn btn-link dropdown-toggle" type="button" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span></button>
            <ul class="dropdown-menu">
                <li><a href="#">Help</a></li>
                <li><a href="#">Edit Account</a></li>
                <li class="divider"></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
        <h1><strong><?php echo $user_row['username'];?></strong></h1>
        <div class="dropdown" id="home">
            <a href="home.php" target="_self">
                <button class="btn btn-link dropdown-toggle" type="button"><span class="glyphicon glyphicon-home"></span></button>
            </a>
        </div>
    </div>
    <div class="container-fluid" id="vert">
        <div class="vertical-menu">
            <a href="home.php" target="hub">myCourses</a>
            <a href="#" target="hub">myStudents</a>
            <a href="#" target="hub">lessonFactory</a>
            <a href="#" target="hub">quizFactory</a>
            <a href="#" target="hub">courseTimelines</a>
            <a href="#" target="hub">studentReports</a>
            <a href="#" target="hub"></a>
            <a href="#" target="hub"></a>
            <a href="#" target="hub"></a>
            <a href="#" target="hub"></a>
            <a href="#" target="hub"></a>
            <a href="#" target="hub"></a>
            <a href="#" target="hub"></a>
            <a href="#" target="hub"></a>
            <a href="#" target="hub"></a>
            <a href="#" target="hub"></a>
            <a href="#" target="hub"></a>
            <a href="#" target="hub"></a>
            <a href="#" target="hub"></a>
            <a href="#" target="hub"></a>
            <a href="#" target="hub"></a>
            <a href="#" target="hub"></a>
            <a href="#" target="hub"></a>
            <a href="#" target="hub"></a>
            <a href="#" target="hub"></a>
            <a href="#" target="hub"></a>
            <a href="#" target="hub"></a>
            <a href="#" target="hub"></a>
            <a href="#" target="hub"></a>
            <a href="#" target="hub"></a>
            <a href="#" target="hub"></a>


        </div>
        <div class="container">
            <iframe name="hub"></iframe>
        </div>
    </div>
</body>
</html>
