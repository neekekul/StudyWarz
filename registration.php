<?php
    session_start();

    if (isset($_SESSION['userSession'])!="") {
        header("Location: home.php");
    }

    require_once 'DatabaseConn.php';

    $type = $username = $email = $password = $password_check = $msg = "";

    if(isset($_POST['signed'])) {

        $type = validate_input_string($_POST['type'], $conn);
        $username = validate_input_string($_POST['username'], $conn);
        $email = validate_input_email($_POST['mail'], $conn);
        $password = validate_input_string($_POST['password'], $conn);
        $password_check = validate_input_string($_POST['passwordCheck'], $conn);

        if ($password==$password_check && strlen($password)<=100){
            $hashed_pass = password_hash($password, PASSWORD_DEFAULT);

            $check_email = $conn->prepare('SELECT email FROM '.$type.' WHERE email = ?');
            $check_email->bind_param('s', $email);
            $check_email->execute();
            $email_result = $check_email->get_result();
            $count = $email_result->num_rows;

            if ($count==0 && strlen($email)<=60 && strlen($username)<=60 && strlen($type)<=11){
                $query = $conn->prepare("INSERT INTO ".$type."(username, email, password) VALUES(?, ?, ?)");
                $query->bind_param('sss', $username, $email, $hashed_pass);

                if ($query->execute()){
                    $msg = "<div class='alert'>Successfully Registered!</div>";
                }
                else{
                    $msg = "<div class='alert'>ERROR Registering</div>";
                }
            }
            else{
                $msg = "<div class='alert'>Email has already been taken!</div>";
            }
        }
        else{
            $msg = "<div class='alert'>The passwords you entered do not match!</div>";
        }

    }

    function validate_input_string($data, $conn){
        $data = htmlspecialchars($data);
        $data = filter_var($data, FILTER_SANITIZE_STRING);
        $data = $conn->real_escape_string($data);
        return $data;
    }

    function validate_input_email($email, $conn){
        $email = htmlspecialchars($email);
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $email = $conn->real_escape_string($email);
        return $email;
    }

    $conn->close();
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
    <title>study_warz_registration</title>
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
  <div class="main">
        <h1>Sign Up</h1>
    </div>
   <div id="head">
       <?php
                if (isset($msg)){
                    echo $msg;
                }
            ?>
        <form method="post" id="registrate">
            </br>
            </br>
            <select name="type" size="2" required>
                <option value="student" selected>Student Account</option>
                <option value="instructor">Instructor Account</option>
            </select>
            </br>
            </br>
            Email Address:
            <input id="mail" type="email" name="mail" placeholder="soandso@gmail.com..." autocomplete="Off" maxlength="60" required/></br>
            </br>
            Username:
            <input id="first" type="text" name="username" placeholder="John..." autocomplete="Off" maxlength="60" required/></br>
            </br>
            Password:
            <input id="last" type="password" name="password" placeholder="..." autocomplete="Off" maxlength="100" required/></br></br>
            Reenter Password:
            <input id="last1" type="password" name="passwordCheck" placeholder="..." autocomplete="Off" maxlength="100" required/></br>
            <button id="bestbutton" type="submit" value="Submit" name="signed">SIGN UP</button>
        </form>
        <h3>Already have an account? Click the button below to sign in!</h3>
        <form action="studystation.php" method="GET" id="back1">
            <button id="bestbutton">LOGIN</button>
        </form>
   </div>
</body>
</html>
