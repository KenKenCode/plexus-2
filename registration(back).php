<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
error_reporting(E_ALL);
session_start();

$conn=mysqli_connect("localhost", "root", "", "plexus_db");
$server = "localhost";
$username = "root";
$password = "";
$database = "plexus_db";

$pdo = new PDO("mysql:host=$server;dbname=$database", $username, $password);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $client_fullname = $_POST['clientNameField'];
    $client_username = $_POST['clientUsernameField'];
    $client_email = $_POST['clientEmailField'];
    $client_password = $_POST['clientPasswordField'];
    $encrypt_password = password_hash($client_password, PASSWORD_DEFAULT);
    try {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $pdo->prepare("INSERT INTO client_table (client_fullname, client_username, client_email, client_password) VALUES (?, ?, ?, ?)");
        $stmt->execute([$client_fullname, $client_username, $client_email, $encrypt_password]);

        echo "User registered successfully.";
    } catch (PDOException $e) {
        echo '<script type="text/javascript"> . $e->getMessage() . </script>';
    }
}


?>