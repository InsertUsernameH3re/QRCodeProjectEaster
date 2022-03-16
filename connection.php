<?php
#error_reporting(0);
include "data.php";
$default_score = 0;

// Create connection
$mysqli = new mysqli($servername, $username, $password, $db);

// Check connection
if ($mysqli->connect_error) {
  die("Connection to the database failed: " . $mysqli->connect_error);
}

echo "Connection established \n";

$statement = $mysqli->prepare("INSERT INTO user (nickname, email, score) VALUES (?,?,?)");
$statement->bind_param("ssi", $_POST['nickname'], $_POST['email'], $default_score);
$statement->execute();
echo "Query delivered successfully";

$mysqli->close();

?>