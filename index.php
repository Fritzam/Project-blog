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
    <span><a href="Logika/logowanie.html">Zaloguj sie</a></span>
    <span><a href="Logika/rejestracja.html">Zarejestruj sie</a></span>
    <?php
    session_start();
        if(isset($_SESSION['login'])) {
            echo "<span>Zalogowano jako: " . $_SESSION['login'] . "</span>";
        }
    ?>
    <hr>
</header>
<body>
</body>
</html>