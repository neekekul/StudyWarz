<?php
    session_start();

    require_once 'DatabaseConn.php';

    if (isset($_SESSION['userSession'])!="") {
        header("Location: _home.php");
        exit;
    }

    if(isset($_POST['signed'])) {
        $email = htmlspecialchars($_POST['mail']);
        $password = htmlspecialchars($_POST['password']);

        $email = $conn->real_escape_string($email);
        $password = $conn->real_escape_string($password);

        $check_email = $conn->prepare('SELECT id, email, password FROM Instructor WHERE email = ?');
        $check_email->bind_param('s', $email);
        if (strlen($password) <= 100 && strlen($email) <= 60){
            $check_email->execute();
            $email_result = $check_email->get_result();
            $row = mysqli_fetch_array($email_result);
            $count = $email_result->num_rows;
        } else {
            $msg = "<div class='alert'>That's a bit much don't you think?</div>";
        }

        if (password_verify($password, $row['password']) && $count==1){
            $_SESSION['userSession'] = $row['id'];
            header("Location: _home.php");
        }
        else{
            $msg = "<div class='alert'>Invalid Username or Password!</div>";
        }

    $conn->close();

    }


?>
<!DOCTYPE html>
<html lang="en-US">

<head>
    <title>study_warz_student_login</title>
    <meta charset="UTF-8" />
    <meta name="description" content="Study Warz Website">
    <meta name="author" content="Luke Keen">
    <meta name="author" content="Jordan Wood">
    <meta name="author" content="Austin Sallee">
    <meta http-equiv="refresh" content="180">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="studywarz_style.css" />
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
  <div class="main">
        <h1>Instructor Sign In</h1>
    </div>
   <div id="head">
        <form method="post" id="log">
           <?php
                if (isset($msg)){
                    echo $msg;
                }
            ?>
            </br>
            </br>
            Email Address:
            <input id="mail" type="email" name="mail" placeholder="soandso@gmail.com..." autocomplete="Off" maxlength="60" required/></br>
            </br>
            </br>
            Password:
            <input id="last" type="password" name="password" placeholder="..." autocomplete="Off" maxlength="100" required/></br>
            <button id="bestbutton" type="submit" value="Submit" name="signed">SIGN IN</button>
        </form>
        <h3>Don't have an account? Click the button below to sign up!</h3>
        <form action="registration.php" method="GET" id="back">
            <button id="bestbutton">REGISTER</button>
        </form>

   </div>
</body>
</html>
