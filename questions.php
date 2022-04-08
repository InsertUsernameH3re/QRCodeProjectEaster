<!DOCTYPE html>
<html lang="en-cs">
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
<body>


<?php
// Includes login to the database
include "data.php";

// Sets email_end to @purkynka.cz
$email_end = "@purkynka.cz";

//Arrays of question ids
$level_1 = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
$level_2 = array(11, 12, 13, 14, 15, 16, 17, 18, 19, 20);
$level_3 = array(21, 22, 23, 24, 25, 26, 27, 28, 29, 30);
$level_4 = array(31, 32, 33, 34, 35, 36, 37, 38, 39, 40);
$level_5 = array(41, 42, 43, 44, 45, 46, 47, 48, 49, 50);

// Create connection
$mysqli = new mysqli($servername, $username, $password, $db);
$mysqli->set_charset("UTF8");
// Check connection
if ($mysqli->connect_error) {
  die("Connection to the database failed, please try again later");
}

if(isset($_COOKIE['id'])){
    $userid = $_COOKIE['id'] . $email_end;
    $result = $mysqli->query("SELECT * FROM user WHERE email = '$userid'");
    $row = $result -> fetch_assoc();

    if ($row['email'] == null or $row['login'] == "FALSE"){
        header("Location: ./login.php");
        die();
        $mysqli->close();
    }else{
        $question = rand(1,10);
        echo "<p>" . $question . ".</p>";
        if ($row['level'] == 0 or $row['level'] == 1){
            $result = $mysqli->query("SELECT * FROM questions WHERE idquestions = '$question'");
            $row = $result -> fetch_assoc();


            echo "<h1>Otázka:</h1><br>";
            echo "<h2>" . $row['question'] . "</h2>";
        }
        
    }
}else{
    header("Location: ./login.php");
    die();
    $mysqli->close();
}

?>

</body>
</html>