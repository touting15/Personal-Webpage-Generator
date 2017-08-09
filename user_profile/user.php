<!-- User Info Page Test -->
<?php

require_once('../sql.php');
require_once('../support.php');

session_start();

// Get users info to display it
if (isset($_SESSION['username'])) {

  $host = "127.0.0.1";
  $user = "root";
  $password = "1234";
  $database = "final_project";
  $db = new mysqli($host, $user, $password, $database);
  $body = '';
  if ($db->connect_error) {
    $body = '<strong>Connectivity Error, Cannot Retrieve User Information </strong>';
    $body.='<br>';
    $body .= '<form action="../main/main.php" method="get">';
    $body .= '<input type="submit" name="submit" value="Go back to main page"/>';
    $body .= '</form>';
    die($db->connect_error);
    echo generatePage($body);
  } else {
  	//echo "Connection to database established<br><br>\n";
  }
  //$db_connection, $username, $height, $width

  $username = $_SESSION['username'];
  $userProfilePicture = get_user_image($db, $username, 50, 50);
  $user_info = get_user_info($db, $username);

  $name = $user_info["name"];
  $email = $user_info["email"];
  $about = $user_info["about"];
  $twitter = $user_info["twitter"];
  $instagram = $user_info["instagram"];
  $facebook = $user_info["facebook"];
  $github = $user_info["github"];
  $width=100;
  $height=100;

  echo '<strong> User Information: </strong>';

  echo "<strong>Username: </strong> '$username' <br>";
  echo "<strong>Name: </strong> '$name'<br>";
  echo "<strong>Email: </strong>'$email'<br>";
  echo "<strong>About: </strong>'$about'<br>";
  echo "<strong>Twitter: </strong>'$twitter'<br>";
  echo"<strong>Instagram: </strong>'$instagram'<br>";
  echo "<strong>Facebook: </strong>'$facebook'<br>";
  echo "<strong>Github: </strong>'$github'<br>";
  echo "<br>";
  echo '<strong> User Project Information: </strong><br>';

  echo $userProfilePicture;


get_user_image($db, $username, 300,300);
  // Get all the users projects , may be more than 1
  $user_projects = get_projects($db, $username);

  $user_project_amount = sizeof($user_projects);
  // For loop to go through all the users projects
  for ($index = 0; $index < $user_project_amount; $index++) {
    //echo "<strong>user var dump at $index</strong>";
    //echo var_dump($user_projects);
    echo "<br>";
    echo "<strong>Project Name </strong>".$user_projects[$index]["name"];
    echo "<br>";
    echo "<strong>Description </strong>".$user_projects[$index]["description"];
    echo "<br>";
    $project_name = $user_projects[$index]["name"];
    echo get_project_image($db, $username, $project_name, 300, 300, $index);
  }

echo '<form action="../main/main.php" method="get">';
echo '<button type="submit">Back to Main Menu</button>';
echo '</form>';
}



 ?>
