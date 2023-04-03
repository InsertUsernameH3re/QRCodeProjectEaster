<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post">
        <input type="text" name="l1">
        <input type="text" name="l2">
        <input type="text" name="l3">
        <input type="text" name="l4">
        <input type="text" name="l5">
        <input type="submit" value="idk">
    </form>
</body>
</html>

<?php
include "data.php";

$l1 = $_POST['l1'];
$l2 = $_POST['l2'];
$l3 = $_POST['l3'];
$l4 = $_POST['l4'];
$l5 = $_POST['l5'];
$l6 = intval($_POST['l5']) * 10;


$mysqli = new mysqli($servername, $username, $password, $db);
$mysqli->set_charset("UTF8");

$statement = $mysqli->prepare("INSERT INTO `questions`(`question`, `answer`, `hering1`, `hering2`, `level`, `score`) VALUES (?,?,?,?,?,?)");
$statement->bind_param("sssssi",$l1,$l2,$l3,$l4,$l5,$l6);
$statement->execute();

$mysqli->close();


?>