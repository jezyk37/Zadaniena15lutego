<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strona komentarza</title>
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

if(isset($_POST['submit_comment'])) {
    $comment_text = $_POST['comment_text'];
    $login = $_POST['login'];

    if(empty($login)) {
        echo "Musisz podać swoją nazwe, aby dodać komentarz.";
    } else {
        if(empty($comment_text)) {
            echo "Komentarz nie może być pusty.";
        } else {
            $sql_check_comment = "SELECT * FROM Komentarze WHERE login = '$login' AND tresc = '$comment_text'";
            $result_check_comment = $conn->query($sql_check_comment);
            if($result_check_comment->num_rows > 0) {
                echo "";
            } else {
                $sql_insert = "INSERT INTO Komentarze (login, tresc) VALUES ('$login', '$comment_text')";
                if ($conn->query($sql_insert) === TRUE) {
                    echo "Nowy komentarz został dodany.";
                } else {
                    echo "Błąd podczas dodawania komentarza: " . $conn->error;
                }
            }
        }
    }
}

$sql_select = "SELECT * FROM Komentarze ORDER BY id ASC";
$result = $conn->query($sql_select);

if ($result->num_rows > 0) {
    echo "<h2>Dotychczasowe komentarze:</h2>";
    while($row = $result->fetch_assoc()) {
        echo "<strong>" . $row["login"] . "</strong>". "<br>" . $row["tresc"] . "</p>";
    }
} else {
    echo "Brak dotychczasowych komentarzy.";
}

$conn->close();
?>

<hr>
<div class="nopiszkom">
<h2>Napisz komentarz</h2>
</div>

<div class="komentarz">
<form action="" method="post">
    <label for="login">Nazwa:</label><br>
    <input type="text" id="login" name="login" class="inputname"><br><br>
    <label for="comment_text">Treść komentarza:</label><br>
    <textarea id="comment_text" name="comment_text" rows="4" cols="50"></textarea><br><br>
    <input type="submit" name="submit_comment" value="Dodaj komentarz" class="inputsend">
</form>
</div>


<hr>

<a href="Strona.html"><button style="cursor:pointer;">Wyloguj</button></a>
</body>
</html>