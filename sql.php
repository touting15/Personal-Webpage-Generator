<?php

// Checks the given password against the password hash in the database
function verify_password($db_connection, $userName, $password) {
  $query = "SELECT password FROM users WHERE username='$userName'";

  if ($result = $db_connection->query($query)) {
    if ($result->num_rows == 0) {

      return false;
    } else {
      $row = $result->fetch_row();
      $is_valid = password_verify($password, $row[0]);

      return $is_valid;
    }
  } else {
    return false;
  }
}


// Adds a new project to the DB
function add_project($db_connection, $username, $project_name, $project_description, $project_image) {
  $query = "INSERT into projects VALUES('$username', '$project_name', '$project_description', '$project_image')";

  if ($result = $db_connection->query($query)) {
    return true;
  } else {
    echo "\nInsertion failed: " . $db_connection->error;
    return false;
  }


}

// Deletes a user
function delete_user($db_connection, $username) {
  $query = "DELETE from users where username='$username'";

  if ($result = $db_connection->query($query)) {
    return true;
  } else {
    echo "\nDeletion failed: " . $db_connection->error;
    return false;
  }
}

// Deletes all projects for a user
function delete_all_projects($db_connection, $username) {
  $query = "DELETE from projects where username='$username'";

  if ($result = $db_connection->query($query)) {
    return true;
  } else {
    echo "\nDeletion failed: " . $db_connection->error;
    return false;
  }
}


// create table users(username varchar(50) NOT NULL, password varchar(255) NOT NULL, name varchar(50) NOT NULL, email varchar(50) NOT NULL, about varchar(1000), twitter varchar(50), instagram varchar(50), facebook varchar(50), github varchar(50), PRIMARY KEY (username));
// Adds new user to the DB
function add_user($db_connection, $username, $name, $password, $email) {
  $pass_hash = password_hash($password, PASSWORD_DEFAULT);
  $query = "INSERT into users (username, password, name, email) VALUES ('$username', '$pass_hash', '$name', '$email')";
  $result = $db_connection->query($query);
  if ($result) {
    return true;
  } else {
    echo "\nInsertion failed: ".$db_connection->error;
    return false;
  }

}

// Updates the user profile after user account creation, or just in general.
function update_user_profile($db_connection, $username, $name, $about, $twitter, $instagram, $facebook, $github, $image){
  $query = "UPDATE users set name='$name', about='$about', twitter='$twitter', instagram='$instagram', facebook='$facebook', github='$github', user_picture='$image' WHERE username='$username'";

  if ($result = $db_connection->query($query)) {
    return true;
  } else {
    echo "\nUpdate User Profile failed: ".$db_connection->error;
    echo '<form action="../update_account/update.php" method="get">';
    echo '<input type="submit" name="submit" value="Go back to update page"/>';
    echo '</form>';
    return false;
  }
}


// Updates a project, given username and project name as identifiers.
function update_project($db_connection, $username, $project_name, $project_description, $project_image) {
  $query = "UPDATE projects set name='$project_name', description='$project_description', image='$project_image' WHERE username='$username' &&  name='$project_name'";

  if ($result = $db_connection->query($query)) {
    return true;
  } else {
    echo "\nUpdate User Project failed: ".$db_connection->error;
    return false;
  }
}

// Gets information on an individual project
function get_project($db_connection, $username, $project_name) {
  $query = "SELECT name, description, image FROM projects WHERE username='$username' && name='$project_name'";

  $project = array();

  if ($result = $db_connection->query($query)) {
    if ($result->num_rows == 0) {
      $result->close();

      return $project;
    } else {
      $row = $result->fetch_row();
      $project = ["name" => $row[0], "description" => $row[1], "image" => $row[2]];
      $result->close();

      return $project;
    }
  } else {
    return NULL;
  }
}

// Get the project image, based on the project name, it will output the image in the body
// Insert the height and width to specify the image size
function get_project_image($db_connection, $username, $project_name, $width, $height, $index) {
  $sql = "SELECT image FROM projects WHERE name='$project_name'";
  $result = mysqli_query($db_connection, $sql);
  	if ($result) {
  		$recordArray = mysqli_fetch_assoc($result);
         #echo '<img src="data:image/jpeg;base64,'.base64_encode( $recordArray['image'] ).'" width="'.$width.'" height="'.$height.'"/>';

		$image = $recordArray['image'];
  		mysqli_free_result($result);
                return '<img id="'.$index.'" src="data:image/jpeg;base64,'.base64_encode($image).'" width="'.$width.'" height="'.$height.'"/>';

  	} else {
  		$body = "<h3>Failed to retrieve the image associated with $project_name: ".mysqli_error($db_connection)." </h3>";

  	}
}

// Get the name and descriptions of projects for a user
function get_projects($db_connection, $username) {
  $query = "SELECT name, description FROM projects WHERE username='$username'";

  $projects = array();
  $result = $db_connection->query($query);

    if ($result->num_rows == 0) {
      $result->close();

      return $projects;
    } else {
      for ($idx = 0; $idx < $result->num_rows; $idx++) {
        $row = $result->fetch_row();
        $projects[$idx] = ["name" => $row[0], "description" => $row[1]];
      }
      $result->close();

      return $projects;
    }
}




// Retrieve a users profile picture, returns true on success
function get_user_image($db_connection, $username, $height, $width) {
  $sql = "SELECT user_picture FROM users WHERE name='$username'";
  $result = mysqli_query($db_connection, $sql);

  if ($result) {
    $recordArray = mysqli_fetch_assoc($result);

    #echo '<img src="data:image/jpeg;base64,'.base64_encode( $recordArray['user_picture'] ).'" width="'.$width.'" height="'.$height.'"/>';
    $image = $recordArray['user_picture'];
    mysqli_free_result($result);
    return '<img src="data:image/jpeg;base64,'.base64_encode($image).'" width="'.$width.'" height="'.$height.'"/>';
    //return '<img src="data:image/jpeg;base64,'.base64_encode($image).'" width="'.$width.'" height="'.$height.'"/>';

  } else {
    $body = "<h3>Failed to retrieve the image associated with $username : ".mysqli_error($db_connection)." </h3>";

  }
}

// This gets all the usernames, with their respective names
function get_all_users($db_connection) {
  $query = "SELECT username, name FROM users";
  $users = array();

  if ($result = $db_connection->query($query)) {
    if ($result->num_rows == 0) {
      $result->close();
      return $users;
    } else {
      for ($index = 0; $index < $result->num_rows; $index++) {
        $row = $result->fetch_row();
        $users[$index] = ["username" => $row[0], "name" => $row[1]];
      }
      $result->close();
      return $users;
    }
  }
}
function get_user_info($db_connection, $username) {
  $query = "SELECT username, name, email, about, twitter, instagram, facebook, github FROM users WHERE username='$username'";

  $user = array();

  if ($result = $db_connection->query($query)) {
    if ($result->num_rows == 0) {
      $result->close();

      return $user;
    } else {
      $row = $result->fetch_row();
      $user = ["name" => $row[1], "email" => $row[2], "about" => $row[3], "twitter" =>$row[4],
                "instagram" => $row[5], "facebook" => $row[6], "github" => $row[7]];
      $result->close();

      return $user;
    }
  } else {
    echo "Selection failed $db_connection->error";
    return NULL;
  }
}

?>
