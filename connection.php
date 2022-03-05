<?php
#error_reporting(0);
include "data.php";

// Create connection
$mysqli = new mysqli($servername, $username, $password, $db);

// Check connection
if ($mysqli->connect_error) {
  die("Connection to the database failed: " . $mysqli->connect_error);
}

echo "Connection established";

try {
  mysqli_query($mysqli, "INSERT INTO user (nickname, email, score) VALUES ('Michal' , 'spitz.michal@purkynka.cz', '1000')");
  echo "Query delivered successfully";
} catch (PDOException $e){
  echo "Query failed";
}

if (mysqli_errno() == 1062) {
    print 'no way!';
}

echo "Query failed";

$mysqli->close();

?>