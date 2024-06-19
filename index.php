<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog</title>
</head>
<header>
    <?php
    if(isset($_SESSION['login'])) {
        if ($_SESSION['login'] == 'Owner') {
            echo "<span>Zalogowano jako: " . $_SESSION['login'] . "</span>";
            echo "<span><a href='Logika/wylogowanie.php'>Wyloguj się </a></span>";
            echo "<span><a href='Logika/stworzPost.html'>Dodaj posta</a></span>";
        } else if ($_SESSION['login'] == 'admin') {
            echo "<span>Zalogowano jako: " . $_SESSION['login'] . "</span>";
            echo "<span><a href='Logika/wylogowanie.php'>Wyloguj się </a></span>";
            echo "<span><a href='Logika/wylogowanie.php'>Wyloguj się </a></span>";
            echo "<span><a href='Logika/rejestracja.html'>Zarejestruj się</a></span>";
        } else if ($_SESSION['permission'] == 'user') {
            echo "<span>Zalogowano jako: " . $_SESSION['login'] . "</span>";
            echo "<span><a href='Logika/wylogowanie.php'>Wyloguj się </a></span>";
        }
    } else {
        echo "<span><a href='Logika/logowanie.html'>Zaloguj się</a></span>";
        echo "<span><a href='Logika/rejestracja.html'>Zarejestruj się</a></span>";
    }
    ?>
    <hr>
</header>
<body>
<?php
include ("Posty/2024-06-19 22.53.26Jam_jest_Katunka/Jam jest Katunka.html");
?>
</body>
</html>