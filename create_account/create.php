<?php

require_once('../support.php');
require_once('../sql.php');

// TODO: check that email is not already in database

$email = $_POST['email'];
$username = $_POST['username'];
$name = $_POST['name'];
$pwd= $_POST['password'];

$host = "127.0.0.1";
$user = "root";
$password = "1234";
$database = "final_project";
$db = new mysqli($host, $user, $password, $database);

if (add_user($db, $username, $name, $pwd, $email)) {
    $body = '<p> Account creation successful! </p>';
    $body .=
        "<form action='../login/login.html' method='get'>
        <button type='submit'>Go to login</button>
        </form>";

echo generatePage($body, 'Account creation successful');

}
else {
    echo 'Account creation failed.';
}
