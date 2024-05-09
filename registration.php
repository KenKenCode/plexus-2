<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
error_reporting(E_ALL);
session_start();

$conn=mysqli_connect("localhost", "root", "", "plexus_db");

/*
if(isset($_POST['register_button'])) {
    if(empty(trim($_POST['clientNameField'])) && empty(trim($_POST['clientUsernameField'])) && empty(trim($_POST['clientEmailField'])) && empty(trim($_POST['clientPasswordField']))) {
        echo '<script type="text/javascript"> alert("Input fields must have values (email, password)"); </script>';
    } else {
        try {
            $clientNameRegister = $_POST['clientNameField'];
            $clientUsernameRegister = $_POST['clientUsernameField'];
            $clientEmailRegister = $_POST['clientEmailField'];
            $clientPasswordRegister = $_POST['clientPasswordField'];

            $encrypt_password = password_hash($clientPasswordRegister, PASSWORD_DEFAULT);

            $dupeQuery = $conn->prepare("SELECT client_username FROM client_table WHERE client_username = ? OR client_email = ?");
            $dupeQuery->bind_param("ss", $clientUsernameRegister, $clientEmailRegister);
            $dupeQuery->execute();
            $dupeResult = $dupeQuery->get_result();

            if ($dupeResult->num_rows > 0) {
                echo "Username or email already taken. Please choose different username or email";
            } else {
                $registerQuery = $conn->prepare("INSERT INTO client_table(client_fullname, client_username, client_email, client_password) VALUES (?, ?, ?, ?)");
                $registerQuery->bind_param("ssss", $clientNameRegister, $clientUsernameRegister, $clientEmailRegister, $encrypt_password);
                $registerQuery->execute();

                if($conn->affected_rows != 1) {
                    echo '<script type="text/javascript"> alert("something went wrong"); </script>';
                } else {

                }
            }

        } catch (mysqli_sql_exception $e) {
            echo '<script type="text/javascript"> alert("Signup error: Either full name, username, and email is already taken\nPlease try again. \nError Details: ' . $e->getMessage() . '"); </script>';
        }
    }
}
*/


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
<body style="background: #b3daff;">

<div class="container-fluid">
<div class="row">
<div class="col-sm-4 col-md-4">

</div>

<div class="registrationContainer col-sm-4 col-md-4 mt-5 ">
<div class="col-sm-12 card p-2" style="border-radius: 10px; background: #b3daff; box-shadow: 15px 15px 30px #bebebe,-15px -15px 30px #ffffff;">
<div class="container" style="background-image: url('media/loginBackground.png'); background-size: cover; background-position: center; padding-bottom: 130px; border-radius: 30px;">
</div>
<br>
<div class="registerForm">
<form action="" method="POST" id="submitRegisterForm">
    <label for="clientNameFieldID" class="form-label">Full name: </label>
    <input type="text" id="clientNameFieldID" class="form-control" name="clientNameField" placeholder="Type your full name" required><br />

    <label for="clientUsernameFieldID" class="form-label">User name: </label>
    <input type="text" id="clientUsernameFieldID" class="form-control" name="clientUsernameField" placeholder="Type your username" required><br />

    <label for="clientEmailFieldID" class="form-label">Email: </label>
    <input type="email" id="clientEmailFieldID" class="form-control" name="clientEmailField" placeholder="email@domain.com" required><br />

    <label for="clientPasswordFieldID" class="form-label">Password: </label>
    <input type="password" id="clientPasswordFieldID" class="form-control" name="clientPasswordField" required><br />

    <label for="clientConfirmPasswordFieldID" class="form-label">Confirm Password: </label>
    <input type="password" id="clientConfirmPasswordFieldID" class="form-control" name="clientConfirmPasswordField" required><br />

    <!--
    <label for="confirmPasswordFieldID" class="">Confirm Password: </label>
    <input type="password" id="confirmPasswordFieldID" class="form-control" name="confirmPasswordField" required><br />
    -->
<br />
<input type="submit" value="Register" name="register_button" class="btn btn-success" style="border-radius: 50px;
background: #a1ecc9;
box-shadow:  5px 5px 10px #89c9ab,
             -5px -5px 10px #b9ffe7; color: black;">

</form>
<div class="ribbon">Register</div> 
<hr>
<footer>
<p>Already have an account? <a href="login.php" target="_blank" style="color: #5bd75b;"><b>Login.</b></a></p>
<br>
</footer>
</div>
</div>
</div>
<div class="col-sm-4 col-md-4">

</div>
</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
$('#submitRegisterForm').submit(function(event) {
event.preventDefault();
var password = $('#clientPasswordFieldID').val();
var confirmPassword = $('#clientConfirmPasswordFieldID').val();

var passwordValidate = password;
if(passwordValidate.match(/[a-z]/g) && passwordValidate.match(/[A-Z]/g) && passwordValidate.match(/[0-9]/g) && 
    passwordValidate.match(/[^a-zA-Z\d]/g) && passwordValidate.length >= 8) {
        //alert("Valid password");
    } else {
        alert("Invalid password. Must be 8 alphanumeric characters with one uppercase and one lowercase letter.");
        //Example of valid password: 12345Abl.
        return false;
    }

var passwordValidateSimilar = password;
var confirmPasswordValidateSimilar = confirmPassword;

if(passwordValidateSimilar !== confirmPasswordValidateSimilar) {
    alert("Passwords do not match. Try again");
    return false;
}

var formData = $(this).serialize();
console.log("formData content: " + formData);

$.ajax({
url: 'registration(back).php',
method: 'POST',
data: formData,
success: function(response) {
    console.log("Response is: " + response);
    console.log("Data from formData: " + formData);
    //$('#signupMessage').html(response); // Display response message
},
error: function() {
              alert('An error occurred while fetching all notes.');
          }
});

});
</script>

</body>
</html>