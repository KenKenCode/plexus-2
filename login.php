<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
error_reporting(E_ALL);
session_start();

$conn=mysqli_connect("localhost", "root", "", "plexus_db");

if (isset($_POST["login_button"])) {
    if(empty($_POST["userNameField"]) || empty($_POST["passwordField"])) {
        echo '<script>alert("Both Fields are required")</script>';
    } else {
        $username = $_POST["userNameField"];
        $password = $_POST["passwordField"];
        
        // Print PHP variables' values for debugging (remove in production)
        echo "<script>";
        echo "console.log('Username: " . $username . "');";
        echo "console.log('Password: " . $password . "');";
        echo "</script>";
        
        $login_query = "SELECT * FROM client_table WHERE client_username = ?";
        $login_stmt = mysqli_prepare($conn, $login_query);
        
        if (!$login_stmt) {
          echo "Error preparing statement: " . mysqli_stmt_error($login_stmt);
          exit();
        }
        
        mysqli_stmt_bind_param($login_stmt, "s", $username);
        
        if (!mysqli_stmt_execute($login_stmt)) {
          echo "Error executing statement: " . mysqli_stmt_error($login_stmt);
          exit();
        }
        
        $result = mysqli_stmt_get_result($login_stmt);
        $num_rows = mysqli_num_rows($result);
        echo '<script>alert("Number of rows returned: ' . $num_rows . '")</script>';

if ($num_rows === 1) {
  $row = mysqli_fetch_assoc($result);
  $row_json = json_encode($row);
  //echo '<script>alert("Row Data: ' . $row_json . '")</script>';
  echo '<script>alert("Test Alert")</script>';
  header("Location: index.php");
  
  
  if (password_verify($password, $row["client_password"])) { 
    /*
    $_SESSION["username"] = $username;
    $_SESSION["clientID"] = $row["client_id"];
    */
    
    header("Location: index.php");
    
    
    echo '<script>alert("Password Matches")</script>';
    
  }
  
  else {
    // Password does not match
    echo '<script>alert("Wrong User Details: Username - ' . $username . ' | Password - ' . $password . ' | Hash: ' . $row["client_password"] . '")</script>';
    $_SESSION['statusLogInWrongCred'] = "Wrong user details. Please try again.";
  }
  
  
} else {
            // Username not found in the database
            echo '<script>alert("User not found. Register first")</script>';
        }
    }

}
?>
<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>

<style>
/* HTML: <div class="ribbon">Your text content</div> */
.ribbon {
  font-size: 28px;
  font-weight: bold;
  color: #fff;
}
.ribbon {
  --f: .5em; /* control the folded part*/
  --r: .8em; /* control the ribbon shape */
  
  position: absolute;
  top: 10px;
  left: calc(-1*var(--f));
  padding-inline: .25em;
  line-height: 1.8;
  background: #ffe066;
  border-bottom: var(--f) solid #0005;
  border-right: var(--r) solid #0000;
  clip-path: 
    polygon(calc(100% - var(--r)) 0,0 0,0 calc(100% - var(--f)),var(--f) 100%,
      var(--f) calc(100% - var(--f)),calc(100% - var(--r)) calc(100% - var(--f)),
      100% calc(50% - var(--f)/2));
}
</style>

</head>

<body style="background: #cff7ef;">

<div class="container-fluid">

<div class="row">


<div class="col-sm-4">

</div>

<div class="col-sm-4 mt-5" id="logInContainer" >
<div class="card col-sm-12" style="border-radius: 30px; background: #cff7ef; box-shadow: 15px 15px 30px #bebebe,-15px -15px 30px #ffffff;">
<div class="container" style="background-image: url('media/loginBackground.png'); background-size: cover; background-position: center; padding-bottom: 130px; border-radius: 30px;">

</div>

<div class="p-2">
<form action="" method="POST">
<div class="col-sm-12">
    <label for="userNameFieldID">Username: </label><br />
    <input type="text" class="form-control" id="userNameFieldID" name="userNameField" placeholder="Type your username" required> <br />
</div>

<div class="col-sm-12">
    <label for="passwordFieldID">Password: </label><br />
    <input type="password" class="form-control" id="passwordFieldID" name="passwordField" placeholder="Type your password" required>
</div>
<br>
    <input type="submit" class="btn " value="Log-In" name="login_button" style="border-radius: 50px;
background: #b3daff;
box-shadow:  5px 5px 10px #98b9d9,
             -5px -5px 10px #cefbff;">

</form>

<div class="ribbon">Log-In</div> 


<hr>
<div class="row">
<div class="col-sm-4">

</div>

<div class="col-sm-4 text-center" >

<footer>
<p>New account? <a href="registration.php" target="_blank"><b>Register.</b></a></p>
<br>
</footer>
</div>

<div clas="col-sm-4">

</div>
</div>
</div>
</div>

</div>


<div class="col-sm-4">

</div>
</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</body>
</html>