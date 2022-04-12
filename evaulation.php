<!DOCTYPE html>
<html lang="en-cs">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="registration.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <script src="app.js"></script>
    <title>Egghunt - vyhodnocení otázky</title>
</head>
<body>

<?php
// Includes login to the database
include "data.php";

// Create connection
$mysqli = new mysqli($servername, $username, $password, $db);
$mysqli->set_charset("UTF8");

// Check connection
if ($mysqli->connect_error) {
  die("Connection to the database failed, please try again later");
}

$result = $mysqli->query("SELECT * FROM user ORDER BY score DESC");

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    echo "id: " . $row["iduser"]. " - Email: " . $row["email"]. " Score: " . $row["score"]. " level reached: " . $row["level"] ."<br>";
  }
}
?>

</body>
</html>