<link type="text/css" rel="stylesheet" href="formstyle.css"/>
<body>
<div class="jumbotron text-center">
		  <h1>View Accounts</h1>
</div>



<?php
/*
This script displays all the users that exist within the application
It provides the ability for either a non logged in user, or logged in user to
view other peoples profiles/resume/aboutme pages
*/
require_once('../sql.php');
require_once('../support.php');

session_start();


// Get users info to display it
$host = "127.0.0.1";
$user = "root";
$password = "1234";
$database = "final_project";
$db = new mysqli($host, $user, $password, $database);


$users = get_all_users($db);
echo "<table>";
for($index = 0; $index < sizeof($users); $index++) {
  echo "<tr>";
  echo "<td>"."<a href='public.php?user=".$users[$index]['username']."'>".$users[$index]['username']."</a></td>";
  echo "<td>".$users[$index]['name']."</td>";
  echo "</tr>";
}

echo "</table>";


echo '<form action="../main/main.php" method="get">';
echo '<button type="submit">Main Menu</button>';
echo '</form>';
