<!DOCTYPE html>

<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "moja_szkola";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$login = $_POST['login'];
$haslo = $_POST['haslo'];

$sql = "SELECT * FROM Rejestracja WHERE login='$login' AND haslo='$haslo'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    header("Location: strona_komentarza.php");
    exit();
} else {
    header("Location: loginerror.php");
    exit();
}

$conn->close();
?>
