<?php
require_once('sql.php');

$host = "127.0.0.1";
$user = "host";
$password = "a";
$database = "final_project";
$db = new mysqli($host, $user, $password, $database);

// Clear dummy data from db.
delete_user($db, 'msmith');


// Add test user to database
add_user($db, 'msmith', 'mike smith', 'bla', 'msmith@a.com');

// Get user information
$mike = get_user_info($db, 'msmith');
$mike_expected = [
  "name" => "mike smith", 
  "email" => "msmith@a.com",
  "about" => NULL,
  "twitter" => NULL,
  "instagram" => NULL,
  "facebook" => NULL,
  "github" => NULL,
];

// Verify the result from get_user_info
assert($mike == $mike_expected);

// Update user profile
$mike_updated = update_user_profile($db, 'msmith', 'joe jackson', 'hi, im a student', 'm_smith_twitter', 'm_smith_instagram', 'm_smith_facebook', 'm_smith_github');

$mike_updated_expected = [
  "name" => "joe jackson", 
  "email" => "msmith@a.com",
  "about" => 'hi, im a student',
  "twitter" => 'm_smith_twitter',
  "instagram" => 'm_smith_instagram',
  "facebook" => 'm_smith_facebook',
  "github" => 'm_smith_github',
];

// Verify the result from update_user_profile
assert($mike_updated == $mike_updated_expected);

// Ttest verify_password
assert(verify_password($db, 'msmith', 'bla') == true);


// Ensure no projects exist for test user in db
assert(delete_all_projects($db, 'msmith') == true);

// Verify that get_projects returns no results
assert(get_projects($db, 'msmith') == []);
