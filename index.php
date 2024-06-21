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
$_SESSION['obecnyPost'] = $last_entry;
include ("Posty/$last_entry/post.html");

echo "<hr>";
echo '<form action="Logika/Weryfikacja/obsluga_komentarzy.php" method="post">Komentarze: <br>';
echo "<br>";
$komentarze = "Posty/$last_entry/komentarze";
for ($i = count(scandir($komentarze)); $i > 2 ; $i--) {
    include ($komentarze . "/" . scandir($komentarze)[$i - 1]);
    echo "<br>";
}
echo '<hr>';
if (!isset($_SESSION['login'])) {
    echo '<label for="username">Proszę podać nick: </label>';
    echo '<input type="text" id="username" name="username" maxlength="15" required><br>';
} else {
    echo '<span>Dodajesz komentarz jako: ' . $_SESSION['login'] . '</span><br>';
}
echo '<label for="tresc">Proszę wpisać komentarz: </label>';
echo '<input type="text" id="tresc" name="tresc" maxlength="250" required><br>';
echo '<button type="submit">Dodaj komentarz</button>';
echo '</form>';
?>
    <a href="index.php?nav=prev">Poprzedni post</a>
    <a href="index.php?nav=next">Nastepny post</a>

</body>
</html>