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
<body onload="backgroundColor()">

<?php
error_reporting(0);
// Includes login to the database
include "data.php";

// Sets email_end to @purkynka.cz
$email_end = "@purkynka.cz";

// Create connection
$mysqli = new mysqli($servername, $username, $password, $db);
$mysqli->set_charset("UTF8");

// Check connection
if ($mysqli->connect_error) {
  die("Connection to the database failed, please try again later");
}

function score_update($mysqli, $score, $email_end){
    $email_whole = $_COOKIE['id'] . $email_end;

    $result = $mysqli->query("SELECT score FROM user WHERE email = '$email_whole'");
    $row = $result -> fetch_assoc(); 
    
    if ($row['score'] + $score >= 0){
        
        $score_calculated = $row['score'] + $score; 

        $result = $mysqli->query("UPDATE user SET score='$score_calculated' WHERE email = '$email_whole'");
        
        $result = $mysqli->query("SELECT score FROM user WHERE email = '$email_whole'");
        $row = $result -> fetch_assoc();
        setcookie("score", $row['score'], time() + 86400, $secure = true);
    }

    echo"<br>Vaše aktualní skore je: " . $row['score'];
}
if ($_COOKIE['been'] != "true" and $_COOKIE['count'] < 2) {


    $answer = $_POST['input'];

    $result = $mysqli->query("SELECT * FROM questions WHERE answer = '$answer'");
    $row = $result -> fetch_assoc();

    if ($row['answer'] != null) {
        echo "<div class='wrapper' id='success'>Správná odpověď 🎉</div>";
        if ($_COOKIE['time'] <= 10){
           $score = $row['score'] + 10; 
        }else{
        $score = $row['score'] + (10/$_COOKIE['time']) *10;
        }

        score_update($mysqli, $score, $email_end);
        echo "<br>Vraťte se a odpovězte na další";
        if ($_COOKIE['count'] == 1){
            setcookie("count", $_COOKIE['count'] + 1, time() + 30, $secure = true);
            header("Refresh:0");
        }else{
          setcookie("count", $_COOKIE['count'] + 1, time() + 86400, $secure = true);  
        }

    } else {
        echo "<div class='wrapper' id='error'>Špatná odpověď :( </div>";

        $result = $mysqli->query("SELECT * FROM questions WHERE hering1 = '$answer' OR hering2 = '$answer'");
        $row = $result -> fetch_assoc();

        if ($_COOKIE['time'] <= 10){
           $score = -($row['score']/2); 
        }else{
        $score = -($row['score']/2);
        }

        score_update($mysqli, $score, $email_end);
        echo "<br>Vraťte se a odpovězte znovu";
    }
}else if ($_COOKIE['count'] == 2){
    $email_whole = $_COOKIE['id'] . $email_end;
    $result = $mysqli->query("SELECT * FROM user WHERE email = '$email_whole'");
    $row = $result -> fetch_assoc();
    $level = $row['level']; 

    echo"Vaše aktualní skore je: " . $row['score'];
    if ($_COOKIE['level'] != "true" and $level != 5){

        $level = $row['level'] + 1;
        $result = $mysqli->query("UPDATE user SET level='$level' WHERE email = '$email_whole'");
        setcookie("level", "true", time() + 30, $secure = "true");
    }
    if ($level != 5){
    echo"<br><br>Indície kde naleznete další vejce:";
    echo"<br><br>1. Nové místnosti, nová platforma. Dokázala se tam navést voda.";
    echo"<br><br>2. Knihy, papíry, stolky.";
    echo"<br><br>3. Panin.";
    echo"<br><br>4. Člověk, kterého nikdo neviděl, v jeho místnosti, ocítnout se nechceš. Tam nenajdeš poslední qr. Pojď zpět, a rozhlédni se.";
    echo"<br><br>5. Jdi odstřihnout zámek, tam najdeš další kód.";
    }else{
        echo"<br><h1>🎉Dohráli jste hru!!🎉</h1>";
        echo "<div class='wrapper' id='success'>Děkujeme za účast a těšíme se na vás další rok. Váš parlament.</div>";
        setcookie("count", 2, time() + 86400, $secure = true);
    }

}else{
    $email_whole = $_COOKIE['id'] . $email_end;
    $result = $mysqli->query("SELECT score FROM user WHERE email = '$email_whole'");
    $row = $result -> fetch_assoc();

    echo"Vaše aktualní skore je: " . $row['score'];
}
setcookie("been", "true", time() + 86400, $secure = true);

?>
</body>
</html>