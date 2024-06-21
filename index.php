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
$posty = scandir("Posty/");
if (!isset($_SESSION['post'])) {
    $_SESSION['post'] = count($posty) - 1;
}

if (isset($_GET['nav'])) {
    if ($_GET['nav'] == 'next' && $_SESSION['post'] < count($posty) - 1) {
        $_SESSION['post']++;
    } elseif ($_GET['nav'] == 'prev' && $_SESSION['post'] > 2) {
        $_SESSION['post']--;
    }
}

$entry = $_SESSION['post'];
$last_entry = $posty[$entry];
include ("Posty/$last_entry/post.html");
?>

    <a href="index.php?nav=prev">Poprzedni post</a>
    <a href="index.php?nav=next">Nastepny post</a>

</body>
</html>