<?php

require_once('../support.php');
require_once('../sql.php');

session_start();

if (isset($_GET['signout'])) {
    session_unset();
    header("Location: ../login/login.html");
}

else if (isset($_SESSION['username'])) {

    $host = "127.0.0.1";
    $user = "root";
    $password = "1234";
    $database = "final_project";
    $db = new mysqli($host, $user, $password, $database);

    $username = $_SESSION['username'];
    $user_info = get_user_info($db, $username);
    $projects = get_projects($db, $username);
    $name = $user_info['name'];
    $about = $user_info['about'];
    $twitter = $user_info['twitter'];
    $instagram = $user_info['instagram'];
    $facebook = $user_info['facebook'];
    $github = $user_info['github'];
    $user_projects = get_projects($db, $username);

    $user_project_amount = sizeof($user_projects);
    $project_result = "";
    $profilepicture = get_user_image($db, $username, 50,50);

    for ($index = 0; $index < $user_project_amount; $index++) {
        $project_name .= $user_projects[$index]["name"];
        $project_result .= "<div class='col-lg-4 col-sm-6 col-xs-12'><a href='#' onclick='return false;'>";
        $project_result .=  get_project_image($db, $username, $project_name, 70, 70, $index);
        $project_result .= "</a></div>";
        $project_result .= "<div id='modal" . $index . "' class='modal'>  <div class='modal-content'>
    <span class='close".$index."'>&times;</span>
    <p><strong>Project Name: ". $project_name ."</strong></p><br><p>Description: ". $user_projects[$index]["description"] . "</div></div>";


  };


    $body = "<!DOCTYPE html>
<html lang='en'>

<head>

    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <title>" . $name ."</title>

    <!-- Bootstrap Core CSS -->
    <link href='..//css/bootstrap.min.css' rel='stylesheet'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>


    <!-- Custom CSS -->
    <link href='../css/mainstyle.css' rel='stylesheet'>
    <link href='../css/icon.css' rel='stylesheet'>

</head>


<body id='page-top' data-spy='scroll' data-target='.navbar-fixed-top'>

    <!-- Navigation -->
    <nav class='navbar navbar-default navbar-fixed-top'>
        <div class='container'>

            <div class='navbar-header page-scroll'>

            <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='.navbar-ex1-collapse'>
                    <span class='sr-only'>Toggle navigation</span>
                    <span class='icon-bar'></span>
                    <span class='icon-bar'></span>
                    <span class='icon-bar'></span>
                </button>

                <a class='navbar-brand page-scroll' href='#page-top'>".$name."'s Resumé Page</a>". $profilepicture . "
            </div>

            <div class='collapse navbar-collapse navbar-ex1-collapse'>
                <ul class='nav navbar-nav'>
                    <li class='hidden'>
                        <a class='page-scroll' href='#page-top'></a>
                    </li>
                    <li>
                        <a class='page-scroll' href='#project'>Projects</a>
                    </li>
                    <li>
                        <a class='page-scroll' href='#about'>About</a>
                    </li>
                    <li>
                        <a class='page-scroll' href='#social'>Contact Me</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Intro Section -->
    <section id='intro' class='intro-section intro-background'>
        <div class='cover rounded-corners'>
            <h1 class='cover-heading'>".$name.".</h1>
            <p class='lead'>Welcome to my online CV.</p>
            <h2 class='lead'>
              <a href='#project' class='btn btn-secondary btn-lg page-scroll'>Learn more</a>
            </h2>
        </div>
    </section>

    <section id='project' class='project-section'>

        <a id='box-link' href='#'></a>
        <div class='container'>
            <h1>My Projects</h1>
            <br>
            <br>
            <div class='row'>".$project_result."
            </div>
        </div>
    </section>

    <section id='about' class='about-section'>
    <div class='container'>
            <div class='row'>
                <div class='col-lg-12'>
                    <header>
                        <h1>About</h1>
                    </header>
                    <br>
                    <br>
                </div>
            </div>
            <div class='row'>". $about ."

            </div>
        </div>

    </section>

    <section id='social' class='social-section'>
        <div class='container'>
            <h1>Contact Me.</h1><br><br>
                <a href='" . $facebook . "' class='fa fa-facebook'></a>
                <a href='" . $twitter . "'' class='fa fa-twitter'></a>
                <a href='" . $instagram . "'' class='fa fa-instagram'></a>
                <a href='" . $github . "'' class='fa fa-github'></a>
            </div>
        </div>
    </section>

    <form action='../main/main.php' method='get'>
      <button type='submit'>Back</button>
    </form>

    <!-- jQuery -->
    <script src='js/jquery.js'></script>

    <!-- Bootstrap Core JavaScript -->
    <script src='js/bootstrap.min.js'></script>

    <!-- Scrolling Nav JavaScript for onepage scrolling -->
    <script src='js/jquery.easing.min.js'></script>
    <script src='js/scrolling-nav.js'></script>

</body>
<script>
// Get the modal
var modal = document.getElementById('modal0');
var modal1 = document.getElementById('modal1');
var modal2 = document.getElementById('modal2');

// Get the button that opens the modal
var btn = document.getElementById('0');
var btn1 = document.getElementById('1');
var btn2 = document.getElementById('2');

// Get the <span> element that closes the modal
var span = document.getElementsByClassName('close0')[0];
var span1 = document.getElementsByClassName('close1')[0];
var span2 = document.getElementsByClassName('close2')[0];

// When the user clicks the button, open the modal

if(btn){
btn.onclick = function() {
    modal.style.display = 'block';
}

span.onclick = function() {
    modal.style.display = 'none';
}

};

if(btn1){

btn1.onclick = function() {
    modal1.style.display = 'block';
}

span1.onclick = function() {
    modal1.style.display = 'none';
}
};

if(btn2){
btn2.onclick = function() {
    modal2.style.display = 'block';
}


span2.onclick = function() {
    modal2.style.display = 'none';
}
}
</script>

</html>";

    echo($body);


}

else {
    header("Location: ../login/login.html");
}

?>
