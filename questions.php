<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <script src="app.js"></script>
    <title>Egghunt - otázky</title>
</head>
<body onload="login()">
    <div class="wrapper">
        <h1 id="login">Přihlas se</h1>
    </div>

    <div class="wrapper">
    <form method="post" id="form">
      <div class="wrapper">
        <label for="email">Školní email:</label><br>
      </div>
      <input type="text" name="email" maxlength="32" placeholder="prijmeni.jmeno" id="email"><br>
      <span class="email">@purkynka.cz</span><br>
      <div class="wrapper">
        <label for="password">Heslo:</label><br>
      </div>
      <input type="password" name="password" maxlength="32" placeholder="Password" id="password"><br>
      <div class="wrapper">
        <input type="submit" value="Submit" class="submit">
      </div>
    </form>
    </div>
</body>
</html>


<?php
// Includes login to the database
include "data.php";
//Sets default parameter
$email_end = "@purkynka.cz";

// Create connection
$mysqli = new mysqli($servername, $username, $password, $db);
$mysqli->set_charset("UTF8");
// Check connection
if ($mysqli->connect_error) {
  die("Connection to the database failed, please try again later");
}

if (isset($_POST['email']) and $_POST['email'] != "" and $_POST['password'] != ""){
    $email = $_POST['email'] . $email_end;
    $password = hash('sha256', $_POST['password']);

    $result = $mysqli->query("SELECT * FROM user WHERE email = '$email'");
    $row = $result -> fetch_assoc();

    if ($row != null and $row['email'] == $email){
        if($row['password'] == $password){
            setcookie("registered", "true", time() + 86400, $secure = true);
            setcookie("logged", "true", time() + 86400, $secure = true);
            setcookie("id", $row['iduser'], time() + 86400, $secure = true);
            
        } else {
            echo "Error: Wrong password";
        }
    } else {
        echo "Error: Wrong credentials, user does not exist";
    }

} elseif(isset($_POST['email']) and $_POST['email'] == "") {
    echo "Error: No credentials provided, please try again";
}

$mysqli->close();
?>