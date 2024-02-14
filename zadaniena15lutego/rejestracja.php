<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>


<?php

$servername = "localhost";
$username = "root"; 
$password = "";
$dbname = "moja_szkola";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$imie = $_POST['imie'];
$nazwisko = $_POST['nazwisko'];
$wiek = $_POST['wiek'];
$klasa = $_POST['klasa'];
$login = $_POST['login'];
$haslo = $_POST['haslo'];


$sql = "INSERT INTO Uczen (imie, nazwisko, wiek, klasa) VALUES ('$imie', '$nazwisko', $wiek, '$klasa')";
if ($conn->query($sql) === TRUE) {
    $sql_rejestracja = "INSERT INTO Rejestracja (login, haslo) VALUES ('$login', '$haslo')";
    if ($conn->query($sql_rejestracja) === TRUE) {
        echo "Uczeń zarejestrowany pomyślnie!";
    } else {
        echo "Błąd: " . $sql_rejestracja . "<br>" . $conn->error;
    }
} else {
    echo "Błąd: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
    <br>
    <h1>Powrót na Strone Główną</h1>
    <a href="Strona.html"><button style = "cursor:pointer;">Powrót</button></a>

    <h1>Lub zaloguj się </h1>
    <a href="login.html"><button style = "cursor:pointer;">Logowanie</button></a>
    
</body>
</html>



