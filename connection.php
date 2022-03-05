<?php
include "data.php";

// Create connection
$connect = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection to the database failed: " . $conn->connect_error);
}



?>