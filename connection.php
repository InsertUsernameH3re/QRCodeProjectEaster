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
  <title>Registration</title>
</head>
<body>

<?php
setcookie("test_cookie", "test", time() + 1, '/');
if(count($_COOKIE) > 0) {
  echo "Cookies are enabled.";
} else {
  echo "Cookies are disabled.";
}
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
  echo "<div class='wrapper' id='success'>Registration completed successfully</div>";

  // Error handeling
} catch (Exception $e) {
  if ($mysqli->errno == 1062){
    echo "<div class='wrapper' id='error'>Error: User already registered with this email address. Error number: ". $mysqli->errno . "</div>";
  } else {
    echo "<div class='wrapper' id='error'>Error: Wrong email address entered. Try again</div>";
  }
}

$mysqli->close();

?>

<script src="background.js"></script>

</body>
</html>