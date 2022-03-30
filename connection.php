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
  <title>Registration</title>
</head>
<body onload="backgroundColor()">

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
if (strlen($_POST['email'])> 5 and strlen($_POST['password']) > 0) {

  try {
    $email_whole = $_POST['email'] . $email_end;
    $password = hash('sha256', $_POST['password']);

    $statement = $mysqli->prepare("INSERT INTO user (email, score, password) VALUES (?,?,?)");
    $statement->bind_param("sis", $email_whole, $default_score, $password);
    $statement->execute();
    echo "<div class='wrapper' id='success'>Registration completed successfully</div>";
    setcookie("registered", "true", time() + 864000, $secure = true);

// Error handeling
  } catch (Exception $e) {
    if ($mysqli->errno == 1062){
      echo "<div class='wrapper' id='error'>Error: User already registered with this email address.</div>";
    }
  }
} else {
  echo "<div class='wrapper' id='error'>Error: Short email or password. Try again</div>";
}

$mysqli->close();

?>


</body>
</html>