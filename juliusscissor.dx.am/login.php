<?php
$servername = "fdb22.awardspace.net";
$username = "2846112_db";
$password = "js123!@#";
$dbname = "2846112_db";


$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
session_start();
if(isset($_SESSION["user"])){
        header("location:admin_index.php");
        exit;
}
else {

if (isset($_POST['login'])) {

        $get_credentials = "SELECT username, password FROM login_creds where username='".$_POST['username']."'";
        $credentials = mysqli_query($conn, $get_credentials);
       
        while($row = mysqli_fetch_assoc($credentials)) {
                    $usn=$row['username'];
                    $pwd=$row['password'];
                    $entered_pwd_hash=hash('sha512', $_POST['password']);
        }
               
        if ($_POST['username'] == $usn && $_POST['username'] <> "" && $entered_pwd_hash == $pwd) {
                
                $_SESSION["user"] = $usn;
                header("location:admin_index.php");
                echo "Entered username: ".$_POST['username']."<br>";
                echo "Actual username: ".$usn."<br>";
                echo "Entered password: ".$entered_pwd_hash."<br>";
                echo "Actual password: ".$pwd."<br>";
        }
        
        else {
                $msg = 'Wrong username or password';
        }
}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="utf-8">
        <title>Julius Scissor</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="styles.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Amiri">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
        <link rel="icon" type="image/png" href="img/favicon-32x32.png" sizes="32x32" />
        <link rel="icon" type="image/png" href="img/favicon-16x16.png" sizes="16x16" />
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
 
<body>

        <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
                <div class="container-fluid">
                        <a class="navbar-brand" href="#"><img class="navbar-logo" src="img/IS_logo3_transparent.png"></a>
                        <p class="navbar-title">JULIUS SCISSOR</p>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
                                <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarResponsive">
                                <ul class="navbar-nav ml-auto">
                                        <li class="nav-item">
                                                <a class="nav-link" href="index.php">Back to website</a>
                                        </li>
                                </ul>
                        </div>
                </div>
        </nav>

        <div class="w3-card-4">
        <div class="w3-display-middle ">
        <br>
          <div class="w3-container w3-round-xxlarge w3-display-center w3-black">
            <h2>Administrator Login</h2>
          </div>
          
          <form class="w3-container" action="" method="POST">
            <p>      
            <label class="w3-text-black"><b>Username</b></label>
            <input class="w3-input w3-border w3-round-xlarge w3-white" name="username" type="text"></p>
            <p>      
            <label class="w3-text-black"><b>Password</b></label>
            <input class="w3-input w3-border w3-round-xlarge w3-white" name="password" type="password"></p>
            <p>
            <center><button type= "submit" class="w3-btn w3-black w3-round-xxlarge" name="login">Login</button></center>
            </p>
          </form>
          
        </div>
        </div>
        


</body>


</html> 
