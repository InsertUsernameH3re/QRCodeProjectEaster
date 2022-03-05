<?php
include "data.php";

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
  die("Connection to the database failed: " . $conn->connect_error);
}

echo "Connection established";

$query = "INSERT INTO user (nickname, email, score) VALUES ('Michal' , 'spitz.michal@purkynka.cz', '1000')";

$conn->query($query);

?>