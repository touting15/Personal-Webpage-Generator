<?php

/*
  This script is used when the user is logged in
  it provides a user the ability to
  Update their Account
  View their Account Information
  View all other users
  Log Out.
*/
require_once('../support.php');

session_start();

if (isset($_GET['signout'])) {
    session_unset();
    header("Location: ../login/login.html");
}

else if (isset($_SESSION['username'])) {

    $body = '<strong>Signed in as: </strong>' . $_SESSION['username'];
    $body .= '

<form action="../update_account/update.php" method="get">
    <button type="submit">Update Account Information</button>
</form>
<form action="../resume/resume.php" method="get">
    <button type="submit">View Resume Page</button>
</form>
<form action="../public_page/viewaccounts.php" method="get">
  <button type="submit">View all users</button>
</form>
<form action="main.php" method="get">
     <button type="submit" name="signout">Sign out</button>
</form>

';
    echo generatePage($body, 'Main page');

}

else {
    header("Location: ../login/login.html");
}
