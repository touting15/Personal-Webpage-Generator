<?php

function generatePage($body, $title="Example") {
        $page = <<<EOPAGE
<!doctype html>
<html>
    <head>
        <meta charset='UTF-8'>
        <html lang='en'>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
        <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
        <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
        <link href='css/mainstyle.css' rel='stylesheet'>
        <link href='css/icon.css' rel='stylesheet'>


        <title>$title</title>
    </head>

    <body>
            $body
    </body>
</html>
EOPAGE;

            return $page;
}

function sanitize($db, $data) {
    //return htmlspecialchars(stripslashes(trim($data)));
    return $db->real_escape_string($data);
}
?>
