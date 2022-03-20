<?php
// Includes login to the database
include "data.php";
// Sets default_value to 0
$default_score = 0;
// Sets email_end to @purkynka.cz
$email_end = "@purkynka.cz";

// Create connection
$mysqli = new mysqli($servername, $username, $password, $db);

// Check connection
if ($mysqli->connect_error) {
  die("Connection to the database failed, please try again later");
}
// Adding new query to database
try {
  $email_whole = $_POST['email'] . $email_end;

  $statement = $mysqli->prepare("INSERT INTO user (email, score) VALUES (?,?)");
  $statement->bind_param("si", $email_whole, $default_score);
  $statement->execute();
  echo "Query delivered successfully";

  // Error handeling
} catch (Exception $e) {
  if ($mysqli->errno == 1062){
    echo "Error: User already registered with this email address". $mysqli->errno;
  } else {
    echo "Registration compleated successfully";
  }
}

$mysqli->close();

?>