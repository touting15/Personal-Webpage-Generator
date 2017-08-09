
<?php
require_once('sql.php');
require_once('generatePageWithImage.php');
// Change user and password to reflect local sql setup
$host = "localhost";
$user = "root";
$password = "1234";
$database = "final_project";
$db = new mysqli($host, $user, $password, $database);


if ($db->connect_error) {
	die($db->connect_error);
} else {
	//echo "Connection to database established<br><br>\n";
}
//$project_results = get_project($db, 'foo', 'test_project1');
$sql = "SELECT image FROM projects WHERE name='test_project1'";

$result = mysqli_query($db, $sql);
	if ($result) {
		$recordArray = mysqli_fetch_assoc($result);

		echo "<h1> HI </h1>";
		echo '<img src="data:image/jpeg;base64,'.base64_encode( $recordArray['image'] ).'"/>';
		mysqli_free_result($result);
	} else {
		$body = "<h3>Failed to retrieve document test_project1: ".mysqli_error($db)." </h3>";
	}

echo generatePage($body);

?>
