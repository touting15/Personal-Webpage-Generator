<?php

//TODO: Handle file uploads and insertion into database properly

require_once('../sql.php');
require_once('../support.php');

session_start();

// If user is logged in, serve them their information
// Else, redirect back to main page
if (isset($_SESSION['username'])) {

    $host = "127.0.0.1";
    $user = "root";
    $password = "1234";
    $database = "final_project";
    $db = new mysqli($host, $user, $password, $database);

    // If updated information is posted through the form
    if (isset($_POST['submit'])) {

        $username = $_SESSION['username'];
        $name = $_POST['name'];
        $pwd = $_POST['password'];
        $about = $_POST['about'];
        $twitter = $_POST['twitter'];
        $instagram = $_POST['instagram'];
        $facebook = $_POST['facebook'];
        $github = $_POST['github'];

        $projectNames = $_POST["projectNames"];
        $projectDescriptions = $_POST["projectInfo"];
        $projectImages = $_FILES['projectImages']['tmp_name'];

        if (verify_password($db, $username, $pwd)) {

            // Update user info in db
            if (update_user_profile($db, $username, $name, $about, $twitter, $instagram, $facebook, $github)) {

                // Delete all projects before adding the new ones
                delete_all_projects($db, $username);

                // Add project info in db
                for($i=0; $i<count($projectNames); $i++) {

                    $imageData = addslashes(file_get_contents($projectImages[$i]));
                    add_project($db, $username, $projectNames[$i], $projectDescriptions[$i], $imageData);
                }

                header("Location: ../main/main.php");
            }
            else {
                echo 'Account update failed.';
            }
        }
        else {
            $body = '<p>Invalid username and password combination</p>';

            $body .= '<form action="../main/main.php" method="get">';
            $body .= '<input type="submit" name="submit" value="Go back to main page"/>';
            $body .= '</form>';

            echo generatePage($body);
        }
    }

    // Else, fill in the form with informatin from the db, and serve it to the user
    else {
        $username = $_SESSION['username'];
        $user = get_user_info($db, $username);
        $projects = get_projects($db, $username);

        $name = $user['name'];
        $about = $user['about'];
        $twitter = $user['twitter'];
        $instagram = $user['instagram'];
        $facebook = $user['facebook'];
        $github = $user['github'];

        $projectInfo = array();

        // Generate HTML for project information
        for ($i=0;$i<count($projects);$i++) {
            $name = $projects[$i]['name'];
            $description = $projects[$i]['description'];

            $projectInfo[$i] = "
            <div><br> Project Name: <input type='text' name='projectNames[]' required='' value='$name'> <br><br> Project Description:<br><br> <textarea name='projectInfo[]' rows='6' cols='80'>$description</textarea> <br>Project Image: <br><br><input type='file' name='projectImages[]'> <br><br></div>";
    }

    $page = "<!doctype html>
        <html>
        <head>
        <meta charset='utf-8' />
        <title>Update Account</title>
        <link rel='stylesheet' href='update.css'>
        <script src='update.js'></script>
</head>

<body>
";

            $page .= "<body>
                <form action='update.php' method='post' enctype='multipart/form-data'>
                <h2> Personal Information </h2>

                Name: <input type='text' name='name' value=$name required>
                <br>
                <br>
                <br>
                About me: <br>
                <textarea name='about' rows='6' cols='80'>
                $about
                </textarea>
                <br>
                <br>

                <h2> Social Media (Optional) </h2>
                Twitter: <input type='text' name='twitter' value=$twitter>
                <br>
                Instagram: <input type='text' name='instagram' value=$instagram>
                <br>
                Facebook: <input type='text' name='facebook' value=$facebook>
                <br>
                Github: <input type='text' name='github' value=$github>
                <br>

                <h2> Projects </h2>

                <div id='projectInput'>

";

            if(isset(projectInfo[0])) {
                $page .= $projectInfo[0];
            }
            if(isset(projectInfo[1])) {
                $page .= $projectInfo[1];
            }
            if(isset(projectInfo[2])) {
                $page .= $projectInfo[2];
            }

            $page .= "
                </div>
                <input type='button' id='add_project' value='Add project' onClick='addProject();'>
                <input type='button' id='delete_project' value='Delete project' onClick='deleteProject();'>

                <br>
                <br>

";
            $page .= "
<br>
Confirm Password: <input type='password' name='password' required>
<br>
<input type='submit' id='submitButton' name='submit' value='Submit Information'/>
</form>
    </body>
</html>
";

            echo $page;

    }
}
else {
    header("Location: ../main/main.php");
}
