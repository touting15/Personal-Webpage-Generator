<?php
require_once('../sql.php');
require_once('../support.php');

$username = $_POST['username'];
$pwd = $_POST['password'];

$host = "127.0.0.1";
$user = "root";
$password = "1234";
$database = "final_project";
$db = new mysqli($host, $user, $password, $database);

// Verify password
if (verify_password($db, $username, $pwd)) {

    // Add username to session
    session_start();
    $_SESSION['username'] = $username;

    // Send user to main page
    header("Location: ../main/main.php");
}
else {
    $body = 'Login failed';
    $body .=
    "<form action='../login/login.html' method='get'>
            <button type='submit'>Go back</button>
    </form>";

    echo generatePage($body, 'Login failed');

}
